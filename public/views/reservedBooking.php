<?php
    require_once '../model/server.php';
    include_once 'nav/header.php';

    try {
        $connector = new Connector();
        
        // Modified query to prioritize pending status
        $sql = "SELECT reservation_id, r.*, s.services_name,
                (SELECT COUNT(*) FROM reservations WHERE name = r.name) as booking_count
                FROM reservations r 
                LEFT JOIN services_tb s ON r.res_services_id = s.services_id 
                WHERE r.status IN ('pending', 'confirmed', 'cancelled')
                ORDER BY 
                    CASE r.status
                        WHEN 'pending' THEN 1
                        WHEN 'confirmed' THEN 2
                        WHEN 'cancelled' THEN 3
                        ELSE 4
                    END,
                    r.checkin DESC";
        
        $stmt = $connector->executeQuery($sql);
        $reservation = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
        // Fetch all messages

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
        } catch (PDOException $e) {
            echo "Error: ". $e->getMessage();
        }
        ?>

        <script>
            // Function to clear URL parameters
            function clearUrlParams() {
                const url = window.location.href.split('?')[0];
                window.history.replaceState({}, document.title, url);
            }
        </script>
            <style>
                 /* Add to existing styles */
                .bg-yellow-50 {
                    background-color: rgba(254, 252, 232, 0.5);
                }
                .bg-green-100 {
                    background-color: #D1FAE5;
                }
                .text-green-700 {
                    color: #047857;
                }
                .rounded-full {
                    border-radius: 9999px;
                }
                .table-container {
                        max-height: 760px;
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
            </style>
        <!-- New Table -->
        <div class="w-full overflow-hidden">
            <div class="w-full overflow-x-auto">
                <!-- Modify the table wrapper div -->
                <div class="w-full overflow-hidden">
                    <!-- ... sorting controls ... -->
                    
                    <div class="table-container">
                        <table class="w-full whitespace-no-wrap border-collapse" id="reservationTable">
                            <thead>
                                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                    <th class="px-4 py-3 text-center">No.</th>
                                    <th class="px-4 py-3 text-center">Rooms Name</th>
                                    <th class="px-4 py-3 text-center">Customers Name</th>
                                    <th class="px-4 py-3 text-center">Booking Email</th>
                                    <th class="px-4 py-3 text-center">Contact Number</th>
                                    <th class="px-4 py-3 text-center">check in</th>
                                    <th class="px-4 py-3 text-center">Check out</th>
                                    <th class="px-4 py-3 text-center">Messages</th>
                                    <th class="px-4 py-3 text-center">Booking Status</th>
                                    <th class="px-4 py-3 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                <?php  $rowNumber = 1; ?>
                                <?php foreach ($reservation as $res): ?>
                                    <tr class="text-gray-700 dark:text-gray-400 <?php echo $hasMultipleBookings ? 'bg-yellow-50' : ''; ?>"> 
                                        <td class="px-2 py-3 text-center" style="padding: 25px;"><?php echo $rowNumber ++;?></td>
                                        <td class="px-2 py-3 "><?php echo htmlspecialchars($res['services_name'] ?? 'N/A'); ?></td>
                                        <td class="px-2 py-3 "><?php echo htmlspecialchars($res['name']); ?></td>
                                        <td class="px-2 py-3 "><?php echo htmlspecialchars($res['email']); ?></td>
                                        <td class="px-2 py-3 text-center"><?php echo htmlspecialchars($res['phone']); ?></td>
                                        <td class="px-2 py-3 text-center"><?php echo htmlspecialchars(date('F d, Y', strtotime($res['checkin']))); ?></td>
                                        <td class="px-2 py-3 text-center"><?php echo htmlspecialchars(date('F d, Y', strtotime($res['checkout']))); ?></td>
                                        <td class="px-2 py-3 "><?php echo htmlspecialchars($res['message']); ?></td>
                                        <td class="px-2 py-3 text-center"><?php echo htmlspecialchars($res['status']); ?></td>
                                        <td style="display: flex; justify-content: center; align-items: center; padding: 10px; gap: 8px;">
                                            <?php if (isset($res['reservation_id'])): ?>
                                                <?php if ($res['status'] === 'pending'): ?>
                                                    <a href="javascript:void(0)" onclick="showConfirmModal(
                                                        '<?php echo htmlspecialchars($res['reservation_id']); ?>',
                                                        '<?php echo htmlspecialchars($res['services_name'] ?? 'N/A'); ?>',
                                                        '<?php echo htmlspecialchars($res['name']); ?>',
                                                        '<?php echo htmlspecialchars($res['email']); ?>',
                                                        '<?php echo htmlspecialchars($res['phone']); ?>',
                                                        '<?php echo htmlspecialchars($res['checkin']); ?>',
                                                        '<?php echo htmlspecialchars($res['checkout']); ?>',
                                                        '<?php echo htmlspecialchars($res['status']); ?>'
                                                    )" class="btn-sm" style="padding: 5px; border-radius: 8px; margin-top:15px; background-color: green; gap: 5px; position: relative;" title="Reserved Booking">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-check-square-fill" viewBox="0 0 16 16">
                                                            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z"/>
                                                        </svg></a>
                                                <?php endif; ?>
                                                <?php if ($res['status'] === 'pending'): ?>
                                                   <a href="../pages/approvedBooking.php?reservation_id=<?php echo htmlspecialchars($res['reservation_id']); ?>&action=cancel"
                                                   class="btn-sm" style="padding: 5px; border-radius: 8px; margin-top:15px; background-color: red; gap: 5px; position: relative;" title="Cancel Booking">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-x-square" viewBox="0 0 16 16">
                                                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                                    </svg>
                                                </a>
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

    <!-- Add this modal HTML before the closing body tag -->
        <div id="confirmModal" class="modal">
            <div class="modal-content">
                <h2 style="margin-bottom: 20px; font-size: 1.5rem;">Confirm Reservation to Book</h2>
                <div class="modal-body">
                    <form action="../pages/resBooks.php?reservation_id=<?php echo htmlspecialchars($res['reservation_id']); ?>&action=approve" method="POST">
                        <input type="hidden" name="service_id" id="service_id" />
                        <input type="hidden" name="fullname" id="form_fullname" />
                        <input type="hidden" name="email" id="form_email" />
                        <input type="hidden" name="number" id="form_number" />
                        <input type="hidden" name="check_in" id="form_checkin" />
                        <input type="hidden" name="check_out" id="form_checkout" />
                        <input type="hidden" name="action" value="approve" />
                        <div class="mb-3" style="margin-bottom: 0.75rem;">
                            <label for="fullname" class="form-label" style="font-size: 0.9rem;"><b>Full Name: &nbsp;</b> <span id="modalCustomer"></span></label>
                        </div>
                        <hr>
                        <div class="mb-3">
                                <label for="email" class="form-label"><b>Email: &nbsp;</b><span id="modalEmail"></span></label>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label for="number" class="form-label"><b>Phone Number:</b> &nbsp;<span id="modalPhone"></label>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label for="service" class="form-label"><b>Selected Room:</b> &nbsp;<span id="modalRoom"></label>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label for="check_in" class="form-label"><b>Check-in Date:</b> &nbsp;<span id="modalCheckin"></label>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label for="check_out" class="form-label"><b>Check-out Date:</b> &nbsp;<span id="modalCheckout"></label>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label for="check_out" class="form-label"><b>Status:</b> &nbsp;<span id="modalStatus"></span></label>
                            </div><br>
                            <div class="modal-buttons">
                                <button type="button" onclick="closeModal()" class="btn-danger">Cancel</button>
                                <button type="submit" class="btn-approve">Confirm Reservation</button>
                            </div>
                        </form>
                    </div>
                
            </div>
        </div>
    
        <!-- Add these styles to your existing style section -->
        <style>
            .modal {
                display: none;
                position: fixed;
                z-index: 1000;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0,0,0,0.5);
            }
            .modal-content {
                background-color: #fefefe;
                margin: 10% auto; /* Reduced from 15% */
                padding: 15px; /* Reduced padding */
                border: 1px solid #888;
                width: 35%; /* Reduced width */
                max-width: 450px; /* Reduced max-width */
                border-radius: 6px;
            }
            
            .mb-3 {
                margin-bottom: 0.75rem;
            }
            
            .modal-body label {
                font-size: 0.9rem;
                display: block;
                margin-bottom: 0.3rem;
            }
            
            .modal-buttons {
                margin-top: 1rem;
                display: flex;
                gap: 0.5rem;
                justify-content: flex-end;
            }
            
            .modal-buttons button {
                padding: 6px 12px;
                font-size: 0.9rem;
            }

              /* Add these styles to your existing style section */
            #sortSelect {
                background-color: white;
                border: 1px solid #e2e8f0;
                border-radius: 0.375rem;
                padding: 0.5rem 1rem;
                cursor: pointer;
            }

            #sortOrderBtn {
                background-color: #e2e8f0;
                border: none;
                border-radius: 0.375rem;
                padding: 0.5rem 1rem;
                cursor: pointer;
                transition: background-color 0.3s;
            }

            #sortOrderBtn:hover {
                background-color: #cbd5e0;
            }
            
        </style>
    
        <!-- Replace the confirm button with this -->


    
        <!-- Add this JavaScript -->
        <script>
            function showConfirmModal(id, room, customer, email, phone, checkin, checkout, status) {
                // Display in spans
                document.getElementById('modalRoom').textContent = room;
                document.getElementById('modalCustomer').textContent = customer;
                document.getElementById('modalEmail').textContent = email;
                document.getElementById('modalPhone').textContent = phone;
                document.getElementById('modalCheckin').textContent = checkin;
                document.getElementById('modalCheckout').textContent = checkout;
                document.getElementById('modalStatus').textContent = status;
                
                // Set hidden form values
                document.getElementById('service_id').value = id;
                document.getElementById('form_fullname').value = customer;
                document.getElementById('form_email').value = email;
                document.getElementById('form_number').value = phone;
                document.getElementById('form_checkin').value = checkin;
                document.getElementById('form_checkout').value = checkout;
                
                document.getElementById('confirmModal').style.display = 'block';
            }
    
            function closeModal() {
                document.getElementById('confirmModal').style.display = 'none';
            }
    
            window.onclick = function(event) {
                if (event.target == document.getElementById('confirmModal')) {
                    closeModal();
                }
            }

            let isAscending = true;

            function toggleSortOrder() {
                isAscending = !isAscending;
                const btn = document.getElementById('sortOrderBtn');
                btn.textContent = isAscending ? '↑ Ascending' : '↓ Descending';
                sortTable();
            }

            function sortTable() {
                const table = document.getElementById('reservationTable');
                const tbody = table.getElementsByTagName('tbody')[0];
                const rows = Array.from(tbody.getElementsByTagName('tr'));
                const sortBy = document.getElementById('sortSelect').value;

                rows.sort((a, b) => {
                    // Always check status first
                    const statusA = a.cells[8].textContent.trim().toLowerCase();
                    const statusB = b.cells[8].textContent.trim().toLowerCase();
                    
                    // If one is pending and the other isn't, pending goes first
                    if (statusA === 'pending' && statusB !== 'pending') return -1;
                    if (statusB === 'pending' && statusA !== 'pending') return 1;
                    
                    // If both have same status, sort by selected criteria
                    if (sortBy === 'name') {
                        const nameA = a.cells[1].textContent.trim().toLowerCase();
                        const nameB = b.cells[1].textContent.trim().toLowerCase();
                        return isAscending ? nameA.localeCompare(nameB) : nameB.localeCompare(nameA);
                    } else if (sortBy === 'date') {
                        const dateA = new Date(a.cells[5].textContent.trim());
                        const dateB = new Date(b.cells[5].textContent.trim());
                        return isAscending ? dateA - dateB : dateB - dateA;
                    }
                    return 0;
                });
                
                // Clear and re-append sorted rows
                while (tbody.firstChild) {
                    tbody.removeChild(tbody.firstChild);
                }
                rows.forEach(row => tbody.appendChild(row));
            }


                // Clear and re-append sorted rows
                while (tbody.firstChild) {
                    tbody.removeChild(tbody.firstChild);
                }
                rows.forEach(row => tbody.appendChild(row));

                // Update table with pagination
                updateTable();

                // Initialize table
                document.addEventListener('DOMContentLoaded', function() {
                    updateTable();
                });

                // Add this function to update row numbers
            function updateRowNumbers() {
                const tbody = document.querySelector('#reservationTable tbody');
                const rows = tbody.getElementsByTagName('tr');
                Array.from(rows).forEach((row, index) => {
                    const numberCell = row.cells[0];
                    numberCell.textContent = index + 1;
                });
            }

           
                // Filter and sort rows
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(searchValue) ? '' : 'none';
                });

                // Sort functionality remains the same...
                // ... your existing sort code ...

                // Update row numbers after sorting/filtering
                updateRowNumbers();
            

            // Call updateRowNumbers when page loads
            document.addEventListener('DOMContentLoaded', function() {
                updateRowNumbers();
            });
        </script>