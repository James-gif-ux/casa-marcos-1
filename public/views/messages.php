<?php
require_once('../model/connector.php');

// Create database connection instance
$db = new Connector();

// Fetch messages from database
$sql = "SELECT * FROM messages ORDER BY created_at DESC";
$messages = $db->executeQuery($sql);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Connector();
    
    $messageId = $_POST['message_id'];
    $recipientEmail = $_POST['recipient_email'];
    $replyContent = $_POST['reply_content'];
    
    $sql = "INSERT INTO message_replies (message_id, reply_content) VALUES (?, ?)";
    $params = [$messageId, $replyContent];
    
    if ($db->executeUpdate($sql, $params)) {
        // Update message read status
        $updateSql = "UPDATE messages SET read_status = 1 WHERE id = ?";
        $db->executeUpdate($updateSql, [$messageId]);
        
        header('Location: messages.php?success=1');
        
    }
}
?>
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

<div class="messages-container">
      <!-- Add this close button at the top -->
    <a href="../pages/dashboard.php" class="btn btn-secondary" style="position: absolute; top: 20px; right: 20px; padding: 8px 15px; border-radius: 8px; background: rgb(102, 67, 35); color: white; text-decoration: none; font-weight: 600;">
        Close
    </a>
    <div class="table-header">
        <h2>Messages</h2>
    </div>
    <div class="table-wrapper">
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <div class="w-full overflow-hidden rounded-lg shadow-xs">
                    <div class="w-full overflow-x-auto">
                        <div class="w-full overflow-hidden rounded-lg shadow-xs">
                            <div class="w-full overflow-x-auto">
                                <table class="w-full whitespace-no-wrap">
                                    <thead>
                                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                            <th class="px-4 py-3">Sender Email</th>
                                            <th class="px-4 py-3">Subject</th>
                                            <th class="px-4 py-3">Message</th>
                                            <th class="px-4 py-3">Date</th>
                                            <th class="px-4 py-3">Status</th>
                                            <th class="px-4 py-3">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                        <?php foreach($messages as $message): ?>
                                            <tr class="text-gray-700 dark:text-gray-400">
                                                <td class="px-4 py-3"><?= htmlspecialchars($message['sender_email']) ?></td>
                                                <td class="px-4 py-3"><?= htmlspecialchars($message['subject']) ?></td>
                                                <td class="px-4 py-3"><?= htmlspecialchars($message['message_content']) ?></td>
                                                <td class="px-4 py-3"><?= date('M d, Y', strtotime($message['created_at'])) ?></td>
                                                <td class="px-4 py-3">
                                                    <span class="px-2 py-1 font-semibold leading-tight rounded-full <?= $message['read_status'] ? 'text-green-700 bg-green-100' : 'text-red-700 bg-red-100' ?>">
                                                        <?= $message['read_status'] ? 'Read' : 'Unread' ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#replyModal" 
                                                            onclick="openReplyModal(<?= $message['id'] ?>, '<?= htmlspecialchars($message['sender_email']) ?>')">
                                                        Reply
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                             <!-- Reply Modal -->
                                <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="replyModalLabel">Reply to Message</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="../pages/send_reply.php">
                                                    <input type="hidden" name="recipient_email" value="<?= $message['sender_email'] ?>">
                                                    <input type="hidden" name="message_id" value="<?= $message['id'] ?>">
                                                    <div class="mb-3">
                                                        <label for="reply_content" class="form-label">Your Reply</label>
                                                        <textarea class="form-control" name="reply_content" rows="4" required></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Send Reply</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                function openReplyModal(messageId, senderEmail) {
                                    document.querySelector('input[name="message_id"]').value = messageId;
                                    document.querySelector('input[name="recipient_email"]').value = senderEmail;
                                    const modal = new bootstrap.Modal(document.getElementById('replyModal'));
                                    modal.show();
                                }
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

