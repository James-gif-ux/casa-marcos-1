<?php
    require_once '../model/server.php';
    include_once 'nav/header.php';

    try {
        $connector = new Connector();
        
        // Fetch all bookings
        $sql = "SELECT DISTINCT b.*, s.services_name, s.services_price,
                DATEDIFF(b.booking_check_out, b.booking_check_in) as total_nights,
                (DATEDIFF(b.booking_check_out, b.booking_check_in) * s.services_price) as total_amount
                FROM booking_tb b 
                LEFT JOIN services_tb s ON b.booking_services_id = s.services_id 
                WHERE b.booking_status IN ('pending', 'approved', 'completed')
                GROUP BY b.booking_id
                ORDER BY 
                    CASE 
                        WHEN b.booking_status = 'pending' THEN 1
                        WHEN b.booking_status = 'approved' THEN 2
                        ELSE 3 
                    END,
                    b.booking_check_in DESC";
        
        $stmt = $connector->executeQuery($sql);
        $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <link rel="stylesheet" href="../assets/css/booking.css">
            <!-- Add these styles to the top of your file or in your CSS -->
    <style>
        .table-container {
            max-height: 760px; /* Adjust height as needed */
            overflow-y: auto;
            margin: 20px 0;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .table-container::-webkit-scrollbar {
            width: 8px;
        }

        .table-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .table-container::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        .table-container::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Fixed header styles */
        thead {
            position: sticky;
            top: 0;
            z-index: 2;
        }

        th {
            position: sticky;
            top: 0;
            background-color:rgb(162, 203, 243);
            z-index: 2;
            border-bottom: 2px solid #e5e7eb;
        }

        /* Ensure header stays above content when scrolling */
        tbody {
            position: relative;
            z-index: 1;
        }
        #entriesSelect {
        background-color: white;
        border: 1px solid #e2e8f0;
        border-radius: 0.375rem;
        padding: 0.5rem;
        cursor: pointer;
        }

        .flex {
            display: flex;
        }

        .items-center {
            align-items: center;
        }

        .justify-between {
            justify-content: space-between;
        }
    </style>
    <script src="../assets/js/booking.js"></script>

    <script>
        <!-- Search and Sort Controls -->
        let currentPage = 1;
    
    function changeEntries() {
        currentPage = 1; // Reset to first page when changing entries
        updateTable();
    }

    function updateTable() {
        const entriesPerPage = parseInt(document.getElementById('entriesSelect').value);
        const tbody = document.querySelector('tbody');
        const rows = Array.from(tbody.getElementsByTagName('tr'));
        const searchInput = document.getElementById('searchInput').value.toLowerCase();

        // Filter rows based on search
        const filteredRows = rows.filter(row => {
            const name = row.cells[1].textContent.toLowerCase();
            const email = row.cells[2].textContent.toLowerCase();
            return name.includes(searchInput) || email.includes(searchInput);
        });

        // Calculate pagination
        const totalPages = Math.ceil(filteredRows.length / entriesPerPage);
        const start = (currentPage - 1) * entriesPerPage;
        const end = start + entriesPerPage;

        // Hide all rows first
        rows.forEach(row => row.style.display = 'none');

        // Show only rows for current page
        filteredRows.slice(start, end).forEach(row => row.style.display = '');

        // Update row numbers
        let rowNumber = start + 1;
        filteredRows.slice(start, end).forEach(row => {
            row.cells[0].textContent = rowNumber++;
        });
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
    </script>
        <!-- New Table -->

        
            <!-- Modify the table container structure -->
            <div class="w-full overflow-hidden">
                <!-- Add entries selector -->
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
                <div class="table-container">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                            <thead>
                            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-4 py-3 text-center">No.</th>
                                <th class="px-4 py-3 text-center">Customers Name</th>
                                <th class="px-4 py-3 text-center">Booking Email</th>
                                <th class="px-4 py-3 text-center">Contact Number</th>
                                <th class="px-4 py-3 text-center">Rooms Name</th>
                                <th class="px-4 py-3 text-center">Check in</th>
                                <th class="px-4 py-3 text-center">Check out</th>
                                <th class="px-4 py-3 text-center">Nights</th>
                                <th class="px-4 py-3 text-center">Total Amount</th>
                                <th class="px-4 py-3 text-center">Booking Status</th>
                                <th colspan="3" class="px-4 py-3 text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                <?php $rowNumber = 1; ?>
                                <?php foreach ($bookings as $booking): ?>
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-center"><?php echo $rowNumber++; ?></td>
                                        <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($booking['booking_fullname']); ?></td>
                                        <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($booking['booking_email']); ?></td>
                                        <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($booking['booking_number']); ?></td>
                                        <td class="px-4 py-3 text-center">
                                            <?php echo htmlspecialchars($booking['services_name'] ?? 'N/A'); ?>
                                        </td>
                                        <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($booking['booking_check_in']); ?></td>
                                        <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($booking['booking_check_out']); ?></td>
                                        <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($booking['total_nights']); ?></td>
                                        <td class="px-4 py-3 text-center">₱<?php echo number_format($booking['total_amount'], 2); ?></td>
                                        <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($booking['booking_status']); ?></td>
                                        <td style="display: flex; justify-content: center; align-items: center; padding: 10px;">
                                            <?php if (isset($booking['booking_id'])): ?>
                                               <!-- Update the chat icon to include email -->
                                                <a href="javascript:void(0)" onclick="openModal('<?php echo htmlspecialchars($booking['booking_id']); ?>', '<?php echo htmlspecialchars($booking['booking_email']); ?>')" 
                                                class="btn btn-primary d-flex align-items-center justify-content-center" style="margin-right: 15px;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="50" fill="grey" class="bi bi-chat-square-dots-fill" viewBox="0 0 16 16">
                                                        <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-2.5a1 1 0 0 0-.8.4l-1.9 2.533a1 1 0 0 1-1.6 0L5.3 12.4a1 1 0 0 0-.8-.4H2a2 2 0 0 1-2-2zm5 4a1 1 0 1 0-2 0 1 1 0 0 0 2 0m4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                                                    </svg>
                                                </a>
                                                <?php if ($booking['booking_status'] === 'pending'): ?>
                                                    <a href="../pages/admin-client.php?booking_id=<?php echo htmlspecialchars($booking['booking_id']); ?>&action=approve" 
                                                    class="btn-approve" style="padding: 10px; gap: 5px"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                                      <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
                                                      <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.384 7.323a.5.5 0 0 0-1.06 1.06L6.97 11.03a.5.5 0 0 0 1.079-.02l3.992-4.99a.5.5 0 0 0-.01-1.05z"/>
                                                    </svg></a>
                                                <?php endif; ?>
                                                
                                                <?php if ($booking['booking_status'] === 'approved'): ?>
                                                    <a href="../pages/admin-client.php?booking_id=<?php echo htmlspecialchars($booking['booking_id']); ?>&action=complete" 
                                                    class="btn-approve p-5"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                                      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                                    </svg></a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <?php
    } catch (Exception $e) { 
        echo "Error: " . $e->getMessage();
    }
    ?>
        <div id="messageModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Send Message</h2>
                <form class="message-form" id="emailForm" action="../../send_mail.php" method="POST">
                    <input type="hidden" id="booking_id" name="booking_id" value="">
                    
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
