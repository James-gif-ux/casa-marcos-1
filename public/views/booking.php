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


    <link rel="stylesheet" href="../assets/css/booking.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Include jQuery and DataTables scripts -->
    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <script src="../assets/js/script.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<style>
   

</style>

    <section>
        <div>
            <select class="form-select mb-3" id="bookingSelect" aria-label="Booking type selection">
            <option selected>Select booking type</option>
            <option value="1">New Booking</option>
            <option value="2">Reserved Booking</option>
            </select>
        </div>
        <div id="tableContainer">
            <div class="mb-3">
                <select id="statusFilter" class="form-select">
                    <option value="">All Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Approved">Approved</option>
                    <option value="Cancelled">Cancelled</option>
                    <option value="Check In">Check In</option>
                    <option value="Check Out">Check Out</option>
                </select>
            </div>
            
        
            <!-- Modify the table wrapper div -->
            <div >
                <table class="w-full whitespace-no-wrap border-collapse" id="reservedTable" class="display" style="display: none;">
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
                                <td class="px-2 py-3 text-center" style="padding: 0px;"><?php echo $rowNumber ++;?></td>
                                <td class="px-2 py-3 "><?php echo htmlspecialchars($res['services_name'] ?? 'N/A'); ?></td>
                                <td class="px-2 py-3 "><?php echo htmlspecialchars($res['name']); ?></td>
                                <td class="px-2 py-3 "><?php echo htmlspecialchars($res['email']); ?></td>
                                <td class="px-2 py-3 text-center"><?php echo htmlspecialchars($res['phone']); ?></td>
                                <td class="px-2 py-3 text-center"><?php echo htmlspecialchars(date('M. d, Y', strtotime($res['checkin']))); ?></td>
                                <td class="px-2 py-3 text-center"><?php echo htmlspecialchars(date('M. d, Y', strtotime($res['checkout']))); ?></td>
                                <td class="px-2 py-3 "><?php echo htmlspecialchars($res['message']); ?></td>
                                <td class="px-2 py-3 text-center"><?php echo htmlspecialchars($res['status']); ?></td>
                                <td class="px-2 py-3 text-center">
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
                                            )" class="btn btn-success" title="Approve Reservation">
                                                <i class="bi bi-check-square"  style="background-color: #1a96d3; padding: 5px;"></i>
                                            </a>
                                        <?php endif; ?>
                                        <?php if ($res['status'] === 'pending'): ?>
                                        <a href="../pages/approvedBooking.php?reservation_id=<?php echo htmlspecialchars($res['reservation_id']); ?>&action=cancelled"
                                            class="btn-sm" title="Cancel Reservation">
                                            <i class="bi bi-x-square" style="background-color: red; padding: 5px;"></i>
                                        </a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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
                                <label for="check_in" class="form-label"><b>Check-in Date:</b> &nbsp;<span id="modalCheckin"></span></label>
                                <input type="date" id="form_checkin_input" name="check_in" class="form-control" 
                                        onchange="document.getElementById('modalCheckin').textContent = this.value" required>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label for="check_out" class="form-label"><b>Check-out Date:</b> &nbsp;<span id="modalCheckout"></span></label>
                                <input type="date" id="form_checkout_input" name="check_out" class="form-control"
                                        onchange="document.getElementById('modalCheckout').textContent = this.value" required>
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
        </div>
    </section>
    <section>
    <div class="table-container">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap" id="myTable" class="display">
                <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py3">No.</th>
                    <th class="px-4 py3">Customer's Name</th>
                    <th class="px-4 py3">Email</th>
                    <th class="px-4 py3">Contact No.</th>
                    <th class="px-4 py3">Rooms Name</th>
                    <th class="px-4 py3">Checkin Date</th>
                    <th class="px-4 py3">Checkout Date</th>
                    <th class="px-4 py3">Night</th>
                    <th class="px-4 py3">Amount</th>
                    <th class="px-4 py3">Status</th>
                    <th class="px-4 py3">Action</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <?php $rowNumber = 1; ?>
                        <?php foreach ($bookings as $booking): ?>
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 "><?php echo $rowNumber++; ?></td>
                                <td class="px-4 py-3 "><?php echo htmlspecialchars($booking['booking_fullname']); ?></td>
                                <td class="px-4 py-3 r"><?php echo htmlspecialchars($booking['booking_email']); ?></td>
                                <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($booking['booking_number']); ?></td>
                                <td class="px-4 py-3 ">
                                    <?php echo htmlspecialchars($booking['services_name'] ?? 'N/A'); ?>
                                </td>
                                <td class="px-4 py-3 text-center"><?php echo date('M. d, Y', strtotime($booking['booking_check_in'])); ?></td>
                                <td class="px-4 py-3 text-center"><?php echo date('M. d, Y', strtotime($booking['booking_check_out'])); ?></td>
                                <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($booking['total_nights']); ?></td>
                                <td class="px-4 py-3" style="text-align: right;">₱<?php echo number_format($booking['total_amount'], 2); ?></td>
                                <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($booking['booking_status']); ?></td>
                                <td style="display: flex; justify-content: center; align-items: center; padding: 10px;">
                                    <?php if (isset($booking['booking_id'])): ?>
                                        <!-- Update the chat icon to include email -->
                                        <a href="javascript:void(0)" onclick="openModal('<?php echo htmlspecialchars($booking['booking_id']); ?>', '<?php echo htmlspecialchars($booking['booking_email']); ?>')" 
                                            class="btn btn-secondary-sm d-flex align-items-center justify-content-center"  style="margin-right: 15px;" title="Message">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="30" fill="grey" class="bi bi-chat-square-dots-fill" viewBox="0 0 16 16">
                                                <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-2.5a1 1 0 0 0-.8.4l-1.9 2.533a1 1 0 0 1-1.6 0L5.3 12.4a1 1 0 0 0-.8-.4H2a2 2 0 0 1-2-2zm5 4a1 1 0 1 0-2 0 1 1 0 0 0 2 0m4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                                            </svg>
                                        </a>
                                        <?php if ($booking['booking_status'] === 'pending'): ?>
                                            <a href="../pages/admin-client.php?booking_id=<?php echo htmlspecialchars($booking['booking_id']); ?>&action=approve" 
                                            class="btn-sm" style="padding: 5px; border-radius: 8px; background-color: blue; gap: 5px; position: relative;" title="Check-in">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                                    <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
                                                    <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.384 7.323a.5.5 0 0 0-1.06 1.06L6.97 11.03a.5.5 0 0 0 1.079-.02l3.992-4.99a.5.5 0 0 0-.01-1.05z"/>
                                                </svg>
                                            </a>
                                        <?php endif; ?>
                                        
                                        <?php if ($booking['booking_status'] === 'approved'): ?>
                                            <a href="../pages/admin-client.php?booking_id=<?php echo htmlspecialchars($booking['booking_id']); ?>&action=complete" 
                                            class="btn-sm" style="padding: 5px; border-radius: 8px; background-color: red; gap: 5px; position: relative;" title="Check-out">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
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
    </section>
    </div>
    <?php

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

<!-------scripts-------->       
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
    <script>
        $(document).ready(function() {
            var table = $('#reservedTable').DataTable();
            
            $('#bookingSelect').change(function() {
                if ($(this).val() === '1') {
                    $('#myTable').show();
                    $('#myTable_wrapper').show();
                    $('#reservedTable_wrapper').hide(); // Changed this line
                } else if ($(this).val() === '2') {
                    $('#myTable').hide();
                    $('#myTable_wrapper').hide();
                    $('#reservedTable').show();
                    $('#reservedTable_wrapper').show(); // Changed this line
                } else {
                    $('#myTable').hide();
                    $('#myTable_wrapper').hide();
                    $('#reservedTable').hide(); // Changed this line
                    $('#reservedTable_wrapper').hide(); // Changed this line
                }
            });

            // Status filter for reserved booking table
            var reservedBookingTable = $('#reservedTable').DataTable();
            $('#statusFilter').on('change', function() {
                var selectedStatus = $(this).val();
                // Column 8 appears to be the status column in your reserved bookings table
                reservedBookingTable.column(8).search(selectedStatus).draw();
            });

            // Status filter for new booking table
            var newBookingTable = $('#myTable').DataTable();
            $('#statusFilter').on('change', function() {
                var selectedStatus = $(this).val();
                // Map status values for new bookings
                switch(selectedStatus) {
                    case 'Pending':
                        selectedStatus = 'pending';
                        break;
                    case 'Approved':
                        selectedStatus = 'approved';
                        break;
                    case 'Check In':
                        selectedStatus = 'check in';
                        break;
                    case 'Check Out': 
                        selectedStatus = 'check out';
                        break;
                }
                newBookingTable.column(9).search(selectedStatus).draw();
            });

            

            // Initially hide both tables
            $('#myTable').hide();
            $('#reservedTable_wrapper').hide(); // Changed this line
        });
    </script>
    <script>
        // Function to clear URL parameters
        function clearUrlParams() {
            const url = window.location.href.split('?')[0];
            window.history.replaceState({}, document.title, url);
        }
    </script>

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

    
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to clear URL parameters
        function clearUrlParams() {
            const url = window.location.href.split('?')[0];
            window.history.replaceState({}, document.title, url);
        }
        // Function to open the message modal
        const modal = document.getElementById('messageModal');
        const span = document.getElementsByClassName('close')[0];
        const bookingIdInput = document.getElementById('booking_id');
        const recipientEmailInput = document.getElementById('recipient_email');
        function openModal(messageId, email) {
            modal.style.display = 'block';
            bookingIdInput.value = messageId;
            recipientEmailInput.value = email;
        }
        // Close modal when clicking (X)
        span.onclick = function() {
            modal.style.display = 'none';
        }
        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
        // Modal functionality inquiries
        window.openModal = function(messageId, email) {
            modal.style.display = 'block';
            bookingIdInput.value = messageId;
            recipientEmailInput.value = email;
        }
        if (span) {
            span.onclick = function() {
                modal.style.display = 'none';
            }
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
        // Form submission
        const emailForm = document.getElementById('emailForm');
        if (emailForm) {
            emailForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                try {
                    const formData = new FormData(this);
                    
                    const response = await fetch('../../send_mail.php', {
                        method: 'POST',
                        body: formData
                    });

                    const data = await response.json();
                    
                    if (data.success) {
                        alert(data.message);
                        modal.style.display = 'none';
                        this.reset(); // Clear form
                    } else {
                        throw new Error(data.message);
                    }

                } catch (error) {
                    alert(error.message);
                    console.error('Error:', error);
                }
                });
            }
        });
    </script>
