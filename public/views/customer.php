  
<?php
    require_once '../model/server.php';
    include_once 'nav/header.php';

    try {
        $connector = new Connector();
        
        // Modified query to count duplicates
        $sql = "SELECT booking_fullname, booking_email, booking_number, 
                COUNT(*) as booking_count 
                FROM booking_tb 
                GROUP BY booking_fullname, booking_email, booking_number
                ORDER BY booking_count DESC, booking_fullname";
        
        $stmt = $connector->executeQuery($sql);
        $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($bookings)) {
            echo "<p>No customers found in the database.</p>";
        }
        
        ?>

        <script>
            // Function to clear URL parameters
            function clearUrlParams() {
                const url = window.location.href.split('?')[0];
                window.history.replaceState({}, document.title, url);
            }


            // <!-- Search and Sort Controls -->
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
            // Add this to your script section
            
                function adjustTableHeight() {
                    const entriesPerPage = parseInt(document.getElementById('entriesSelect').value);
                    const tableContainer = document.querySelector('.table-container');
                    
                    if (entriesPerPage <= 10) {
                        tableContainer.style.maxHeight = 'none';
                        tableContainer.style.overflowY = 'visible';
                    } else {
                        tableContainer.style.maxHeight = '500px';  // Adjust this value as needed
                        tableContainer.style.overflowY = 'auto';
                    }
                }
            
                // Modify the existing changeEntries function
                function changeEntries() {
                    currentPage = 1;
                    adjustTableHeight();  // Add this line
                    updateTable();
                }
            
                // Call on page load
                document.addEventListener('DOMContentLoaded', function() {
                    adjustTableHeight();
                    updateTable();
                });
            </script>
            <style>
                .table-container {
                    max-height: 760px;
                    overflow-y: auto;
                    margin-top: 1rem;
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
                    background-color: rgb(162, 203, 243);
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
                
                /* Keep your existing btn-complete styles */
                .btn-complete {
                    background-color: rgb(8, 17, 189);
                    color: white;
                    padding: 8px 16px;
                    text-decoration: none;
                    margin: 0 5px;
                    transition: background-color 0.3s ease;
                    width: 50px;
                }
            </style>
           
        <!-- New Table -->
            <div class="w-full overflow-hidden">
                <div class="w-full overflow-x-auto">
                <table class="table-container w-full whitespace-no-wrap">
                    <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">No.</th>
                        <th class="px-4 py-3">Customers Name</th>
                        <th class="px-4 py-3">Booking Email</th>
                        <th class="px-4 py-3 text-center">Contact Number</th>
                        <th class="px-4 py-3 text-center">Total Bookings</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <?php $rowNumber = 1; ?>
                        <?php foreach ($bookings as $booking): ?>
                            <tr class="text-gray-700 dark:text-gray-400 <?php echo $booking['booking_count'] > 1 ? 'bg-yellow-50' : ''; ?>">
                                <td class="px-4 py-3"><?php echo $rowNumber++; ?></td>
                                <td class="px-4 py-3"><?php echo htmlspecialchars($booking['booking_fullname']); ?></td>
                                <td class="px-4 py-3"><?php echo htmlspecialchars($booking['booking_email']); ?></td>
                                <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($booking['booking_number']); ?></td>
                                <td class="px-4 py-3 text-center">
                                    <?php if ($booking['booking_count'] > 1): ?>
                                        <span class="px-2 py-1 text-sm font-semibold leading-tight text-green-700 bg-green-100 rounded-full">
                                            <?php echo $booking['booking_count']; ?> bookings
                                        </span>
                                    <?php else: ?>
                                        <?php echo $booking['booking_count']; ?> booking
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>