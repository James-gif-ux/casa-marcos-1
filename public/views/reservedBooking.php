<?php
    require_once '../model/server.php';
    include_once 'nav/header.php';

    try {
        $connector = new Connector();
        
        // Fetch all bookings with pending status first
        $sql = "SELECT reservation_id, r.*, s.services_name 
                FROM reservations r 
                LEFT JOIN services_tb s ON r.res_services_id = s.services_id 
                WHERE r.status IN ('pending', 'confirmed', 'cancelled')
                ORDER BY 
                    CASE 
                        WHEN r.status = 'pending' THEN 1
                        WHEN r.status = 'confirmed' THEN 2
                        ELSE 3 
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
                .btn-complete {
                    background-color:rgb(8, 17, 189);
                    color: white;
                    padding: 8px 16px;
                    text-decoration: none;
                    margin: 0 5px;
                    transition: background-color 0.3s ease;
                    width: 50px;
                }
                .btn-approve {
                    background-color: #10B981;
                    color: white;
                    padding: 8px 16px;
                    border-radius: 4px;
                    text-decoration: none;
                    margin: 0 5px;
                    transition: background-color 0.3s ease;
                }
                .btn-approve:hover {
                    background-color: #059669;
                }
                
                .btn-danger {
                    background-color: #EF4444;
                    color: white;
                    padding: 8px 16px;
                    border-radius: 4px;
                    text-decoration: none;
                    margin: 0 5px;
                    transition: background-color 0.3s ease;
                }
                .btn-danger:hover {
                    background-color: #DC2626;
                }
            </style>
        <!-- New Table -->
        <div class="w-full overflow-hidden">
            <!-- Add sorting controls -->
            <div class="mb-4 p-4 bg-white rounded shadow">
                <label class="mr-4">Sort by:</label>
                <select id="sortSelect" class="px-4 py-2 border rounded" onchange="sortTable()">
                    <option value="name">Customer Name</option>
                    <option value="date">Check-in Date</option>
                </select>
                <button onclick="toggleSortOrder()" id="sortOrderBtn" class="ml-2 px-4 py-2 bg-gray-200 rounded">
                    ↑ Ascending
                </button>
            </div>
            
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap" id="reservationTable">
                    <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
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
                        <?php foreach ($reservation as $res): ?>
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-center">
                                    <?php echo htmlspecialchars($res['services_name'] ?? 'N/A'); ?>
                                </td>
                                <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($res['name']); ?></td>
                                <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($res['email']); ?></td>
                                <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($res['phone']); ?></td>
                                <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($res['checkin']); ?></td>
                                <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($res['checkout']); ?></td>
                                <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($res['message']); ?></td>
                                <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($res['status']); ?></td>
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
                                            )" class="btn-approve">Confirm</a>
                                        <?php endif; ?>
                                        <?php if ($res['status'] === 'pending'): ?>
                                           <a href="../pages/approvedBooking.php?reservation_id=<?php echo htmlspecialchars($res['reservation_id']); ?>&action=cancel"
                                            class="btn-danger">Cancel</a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    
                    </tbody>
                </table>
            </div>
    </div>

    <!-- Add this modal HTML before the closing body tag -->
        <div id="confirmModal" class="modal">
            <div class="modal-content">
                <h2 style="margin-bottom: 20px; font-size: 1.5rem;">Confirm Reservation to Book</h2>
                <div class="modal-body">
                    <form action="../pages/resBooks.php" method="POST">
                        <input type="hidden" name="service_id" id="service_id" />
                        <input type="hidden" name="fullname" id="form_fullname" />
                        <input type="hidden" name="email" id="form_email" />
                        <input type="hidden" name="number" id="form_number" />
                        <input type="hidden" name="check_in" id="form_checkin" />
                        <input type="hidden" name="check_out" id="form_checkout" />
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
                    // Get status values
                    const statusA = a.cells[7].textContent.trim().toLowerCase();
                    const statusB = b.cells[7].textContent.trim().toLowerCase();
                    
                    // Always keep pending on top
                    if (statusA === 'pending' && statusB !== 'pending') return -1;
                    if (statusB === 'pending' && statusA !== 'pending') return 1;
                    
                    // If both are pending or both are not pending, sort by selected criteria
                    if (sortBy === 'name') {
                        const nameA = a.cells[1].textContent.trim().toLowerCase();
                        const nameB = b.cells[1].textContent.trim().toLowerCase();
                        return isAscending ? 
                            nameA.localeCompare(nameB) : 
                            nameB.localeCompare(nameA);
                    } else if (sortBy === 'date') {
                        const dateA = new Date(a.cells[4].textContent.trim());
                        const dateB = new Date(b.cells[4].textContent.trim());
                        return isAscending ? 
                            dateA - dateB : 
                            dateB - dateA;
                    }
                    return 0;
                });
                
                // Clear and re-append sorted rows
                while (tbody.firstChild) {
                    tbody.removeChild(tbody.firstChild);
                }
                rows.forEach(row => tbody.appendChild(row));
            }

            // Initialize sorting
            document.addEventListener('DOMContentLoaded', function() {
                sortTable();
            });
        </script>