<?php
    session_start();
    if (isset($_SESSION['active_menu'])) {
        unset($_SESSION['active_menu']);
    }
    require_once '../model/server.php';
    include_once 'nav/header.php';

    $connector = new Connector();
    $sql = "SELECT * FROM messages ORDER BY date_sent DESC";
    $messages = $connector->executeQuery($sql);

    $sql = "SELECT COUNT(*) as unread_count FROM messages WHERE status = 0";
    $result = $connector->executeQuery($sql);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $unread_count = ($row && isset($row['unread_count'])) ? $row['unread_count'] : 0;

    // Check if there are new messages


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
                <link rel="stylesheet" href="../assets/css/booking.css">
                <style>
                    .container {
                        max-width: 77.0%; /* Adjust container width for responsiveness, making it larger for wider screens */
                    
                    }

                    .table-wrapper { /* Add a wrapper for the table to handle overflow */
                        overflow-x: auto; /* Enable horizontal scrolling on small screens */
                    }

                    .table-wrapper table {
                        width: 100%;  /* Table takes the full width of its wrapper */
                        min-width: 600px; /* Ensures table doesn't collapse too much */
                        white-space: nowrap; /* Prevent text wrapping in cells */

                    }

                    /* Table Styles */
                    table {
                        border-collapse: collapse;
                    }

                    thead {
                        color: white;
                        font-weight: 600;
                        background-color: #333;
                    }

                    th, td {
                        padding: 0.75rem;
                        text-align: left;
                        border-bottom: 1px solid #ddd;
                        color: #555;
                    }

                    /* tbody tr:hover {
                        background-color: #f0f8ff;
                    } */

                    /* Highlight Unread Messages */
                    .unread {
                        font-weight: bold;
                        background-color: #f9f9f9;  /* Light Gray or any color you prefer */
                    }

                    /* Responsive Design */
                    @media (max-width: 1200px) { /* Adjust the breakpoint as needed */
                        .container {
                            max-width: 95%; /* Further reduce container width */
                        }

                        th, td {
                            padding: 0.6rem;  /* Slightly reduce padding */
                            font-size: 0.85rem; /* Slightly reduce font size */
                        }
                    }

                    @media (max-width: 900px) { /* Adjust the breakpoint as needed */
                        th, td {
                            padding: 0.5rem;
                            font-size: 0.8rem;
                        }
                    }

                    @media (max-width: 700px) {  /* Smaller screens:  Important adjustments */
                        .container {
                            max-width: 100%; /* Container takes full width */
                        }
                        th, td {
                            padding: 0.4rem;
                            font-size: 0.75rem;
                        }

                        .table-wrapper {
                            overflow-x: auto; /* Ensure horizontal scroll */
                        }
                    }

                </style>
            </head>
            <body>
                <div class="mb-4 p-4 bg-white rounded shadow flex items-center justify-between">
                    <div class="flex items-center">
                        <label class="mr-2">Show</label>
                        <select id="entriesSelect" class="form-control input-sm px-3 py-1 border rounded" onchange="changeEntries()">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <label class="ml-2">entries</label>
                    </div>
                    <!-- Existing search and sort controls -->
                    <div class="search-container">
                        <input type="text" id="searchInput" class="search-input" placeholder="Search by name or email..." oninput="searchTable()">
                        <select id="sortSelect" class="sort-select" onchange="searchTable()">
                            <option value="name">Sort by Name</option>
                            <option value="date">Sort by Check-in Date</option>
                            <option value="status">Sort by Status</option>
                        </select>
                    </div>
                </div>
                <div class="messages-container">
                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr  class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                    <th class="px-4 py-3 text-center">No.</th>
                                    <th>SENDER EMAIL</th>
                                    <th>SUBJECT</th>
                                    <th>MESSAGE</th>
                                    <th>DATE</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $rowNumber = 1;?>
                                <?php foreach ($messages as $message): ?>
                                <tr class="<?php echo ($message['status'] === '0' || $message['status'] === 0 || $message['status'] === 'unread') ? 'unread' : ''; ?>"
                                    style="color: <?php echo ($message['status'] === '0' || $message['status'] === 0 || $message['status'] === 'unread') ? '#ff0000' : '#555'; ?>">
                                    <td class="px-4 py-3 text-center"><?php echo $rowNumber++; ?></td>
                                    <td><?php echo htmlspecialchars($message['recipient_email']); ?></td>
                                    <td><?php echo htmlspecialchars($message['subject']); ?></td>
                                    <td><?php echo htmlspecialchars($message['message_content']); ?></td>
                                    <td><?php echo date('Y-m-d H:i', strtotime($message['date_sent'])); ?></td>
                                    <td><?php echo htmlspecialchars($message['status']); ?></td>
                                    <td>
                                        <form id="messageForm_<?php echo htmlspecialchars($message['message_id']); ?>" 
                                            action="" 
                                            method="POST">
                                            <input type="hidden" name="message_id" value="<?php echo htmlspecialchars($message['message_id']); ?>">
                                            <input type="hidden" name="recipient_email" value="<?php echo htmlspecialchars($message['recipient_email']); ?>">
                                            <input type="hidden" name="status" value="1">
                                            <a href="javascript:void(0)" 
                                            onclick="markAsReadAndOpenModal('<?php echo htmlspecialchars($message['message_id']); ?>', '<?php echo htmlspecialchars($message['recipient_email']); ?>')" 
                                            class="btn btn-approve d-flex align-items-center justify-content-center" 
                                            style="margin-right: 15px;">Reply
                                            </a>
                                            <button type="button" class="btn btn-danger" onclick="if(confirm('Are you sure you want to delete this message?')) window.location.href='../pages/messagesdelete.php?message_id=<?php echo htmlspecialchars($message['message_id']); ?>&action=delete'">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="messageModal" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <h2>Send Message</h2>
                            <form class="message-form" id="emailForm" action="../../send_mail.php" method="POST">
                                <input type="hidden" id="booking_id" name="message_id" value="">
                                
                                <label for="email">Recipient Email:</label>
                                <input type="email" name="email" id="recipient_email" readonly>
                                
                                <label for="subject">Subject:</label>
                                <input type="text" name="subject" required>
                                
                                <label for="message">Message:</label>
                                <textarea name="message" required placeholder="Type your message here..."></textarea>
                                
                                <button type="submit">Send Message</button>
                            </form>
                        </div>
                    </div>
                </div>
               
                <script src="../assets/js/booking.js"></script>
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
                                const row = form.closest('tr');
                                row.classList.remove('unread'); // Remove the 'unread' class

                                const statusCell = form.closest('tr').querySelector('td:nth-child(5)');
                                statusCell.textContent = 'read';
                                form.submit();
                            }
                        })
                        .catch(error => console.error('Error:', error));
                        
                        return false;
                    }


                    // Modify existing searchTable function
                        function searchTable() {
                            currentPage = 1; // Reset to first page when searching
                            const sortValue = document.getElementById('sortSelect').value;
                            const tbody = document.querySelector('tbody');
                            const rows = Array.from(tbody.getElementsByTagName('tr'));

                            // Sort functionality remains the same
                            rows.sort((a, b) => {
                                const statusA = a.cells[9].textContent.toLowerCase();
                                const statusB = b.cells[9].textContent.toLowerCase();

                                // Always keep pending on top
                                if (statusA === 'pending' && statusB !== 'pending') return -1;
                                if (statusB === 'pending' && statusA !== 'pending') return 1;

                                switch(sortValue) {
                                    case 'name':
                                        return a.cells[1].textContent.localeCompare(b.cells[1].textContent);
                                    case 'date':
                                        return new Date(a.cells[5].textContent) - new Date(b.cells[5].textContent);
                                    case 'status':
                                        return a.cells[9].textContent.localeCompare(b.cells[9].textContent);
                                    default:
                                        return 0;
                                }
                            });

                            // Clear and re-append sorted rows
                            while (tbody.firstChild) {
                                tbody.removeChild(tbody.firstChild);
                            }
                            rows.forEach(row => tbody.appendChild(row));

                            // Update table with pagination
                            updateTable();
                        }

                        // Initialize table
                        document.addEventListener('DOMContentLoaded', function() {
                            updateTable();
                        });


                        // Add this new function
                        function markAsReadAndOpenModal(messageId, recipientEmail) {
                            // First mark as read
                            const formData = new FormData();
                            formData.append('message_id', messageId);
                            
                            fetch('../model/update_message_status.php', {
                                method: 'POST',
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Update UI to show message as read
                                    const row = document.getElementById('messageForm_' + messageId).closest('tr');
                                    row.classList.remove('unread');
                                    row.style.color = '#555';
                                    row.querySelector('td:nth-child(6)').textContent = 'read';
                                    
                                    // Then open the modal
                                    openModal(messageId, recipientEmail);
                                }
                            })
                            .catch(error => console.error('Error:', error));
                        }
                    </script>
            </body>
        </html>