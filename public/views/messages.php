<?php
session_start();
require_once '../model/server.php';
include_once 'nav/header.php';

$connector = new Connector();
$sql = "SELECT * FROM messages ORDER BY date_sent DESC";
$messages = $connector->executeQuery($sql);

$sql = "SELECT COUNT(*) as unread_count FROM messages WHERE status = 0";
$result = $connector->executeQuery($sql);
$row = $result->fetch(PDO::FETCH_ASSOC);
$unread_count = ($row && isset($row['unread_count'])) ? $row['unread_count'] : 0;
// When a new message is sent
$unread_count++;

// When an existing message is read
$unread_count--;
if ($unread_count < 0) {
    $unread_count = 0;
}
$sql = "SELECT * FROM messages 
    WHERE status IN ('unread', 'read') 
    ORDER BY date_sent DESC";
$messages = $connector->executeQuery($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Messages</title>
    <!-- Bootstrap CSS -->
    <!-- Custom CSS -->
    <link href="../assets/css/style.css" rel="stylesheet">
<style>
    .messages-container {
        max-width: 1400px;  /* Increased from 1200px */
        margin: 2rem auto;
        padding: 0 30px;    /* Increased from 20px */
    }

    .table-header {
        margin-bottom: 3rem;  /* Increased from 2rem */
    }

    .table-header h2 {
        color: #333;
        font-size: 32px;     /* Increased from 24px */
        border-bottom: 3px solid #007bff;  /* Increased from 2px */
        padding-bottom: 15px; /* Increased from 10px */
    }

    .table-wrapper {
        background: #fff;
        border-radius: 12px;  /* Increased from 8px */
        box-shadow: 0 0 30px rgba(0,0,0,0.1);  /* Increased from 20px */
        overflow: hidden;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background-color: #007bff;
        color: white;
    }

    th, td {
        padding: 16px 20px;  /* Increased from 12px 15px */
        text-align: left;
        border-bottom: 2px solid #ddd;  /* Increased from 1px */
        font-size: 16px;     /* Added font size */
    }

    tbody tr:hover {
        background-color: #f5f5f5;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;  /* Increased from 8px 16px */
        border-radius: 6px;  /* Increased from 4px */
        cursor: pointer;
        transition: background-color 0.3s;
        font-size: 16px;     /* Added font size */
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>
    <div class="messages-container">
        <div class="table-header">
            <h2>Messages</h2>
        </div>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Sender Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($messages as $message): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($message['recipient_email']); ?></td>
                        <td><?php echo htmlspecialchars($message['subject']); ?></td>
                        <td><?php echo htmlspecialchars($message['message_content']); ?></td>
                        <td><?php echo date('Y-m-d H:i', strtotime($message['date_sent'])); ?></td>
                        <td><?php echo htmlspecialchars($message['status']); ?></td>
                        <td>
                            <form id="messageForm_<?php echo htmlspecialchars($message['message_id']); ?>" 
                                  action="../../sendMail_layout.php" 
                                  method="POST">
                                <input type="hidden" name="message_id" value="<?php echo htmlspecialchars($message['message_id']); ?>">
                                <input type="hidden" name="recipient_email" value="<?php echo htmlspecialchars($message['recipient_email']); ?>">
                                <input type="hidden" name="status" value="1">
                                <button type="submit" class="btn btn-primary" onclick="return updateStatus('<?php echo htmlspecialchars($message['message_id']); ?>')">Reply</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function updateStatus(messageId) {
        const formData = new FormData();
        formData.append('message_id', messageId);
        
        fetch('../model/update_message_status.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const form = document.getElementById('messageForm_' + messageId);
                const statusCell = form.closest('tr').querySelector('td:nth-child(5)');
                statusCell.textContent = 'read';
                form.submit();
            }
        })
        .catch(error => console.error('Error:', error));
        
        return false;
    }
    </script>
</body>
</html>
