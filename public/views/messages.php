<?php
session_start();
require_once '../model/server.php';

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <style>
        :root {
            --primary: #ff6b6b;
            --secondary: #4ecdc4;
            --bg-gradient: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
            --text-primary: #2d3436;
            --text-secondary: #636e72;
            --error-color: #ff4757;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-gradient);
            padding: 20px;
            background: linear-gradient(45deg, #e6e9f0 0%, #eef1f5 100%);
            min-height: 100vh;
            padding: 2rem;
        }
        .messages-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
            background: linear-gradient(135deg, #f6f8fb 0%, #f1f4f8 100%);
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .table-header {
            text-align: center;
            margin-bottom: 2rem;
            position: relative;
        }

        .table-header h2 {
            font-size: 2rem;
            font-weight: 600;
            color: #2d3748;
            font-family: 'Impact', sans-serif;
            letter-spacing: 1px;
        }

        .table-header::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: rgb(102, 67, 35);
            margin: 1rem auto;
            border-radius: 2px;
        }

        .table-wrapper {
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }
        table {
            border: 1px solid #e0e0e0;
            border-collapse: collapse;
            width: 100%;
            background: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        th {
            background: rgb(102, 67, 35);
            color: white;
            font-weight: 600;
            padding: 12px 15px;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        td {
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            font-size: 0.9rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="messages-container">
        <!-- Add this close button at the top -->
        <a href="../pages/dashboard.php" class="btn btn-secondary" style="position: absolute; top: 20px; right: 20px; padding: 8px 15px; border-radius: 8px; background: rgb(102, 67, 35); color: white; text-decoration: none; font-weight: 600;">
            Close
        </a>
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
