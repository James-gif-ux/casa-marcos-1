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
    <script src="../assets/js/booking.js"></script>
        <!-- Search and Sort Controls -->
        <div class="search-container">
            <input type="text" id="searchInput" class="search-input" placeholder="Search by name or email...">
            <select id="sortSelect" class="sort-select">
                <option value="name">Sort by Name</option>
                <option value="date">Sort by Check-in Date</option>
                <option value="status">Sort by Status</option>
            </select>
        </div>

        <!-- New Table -->
        <div class="w-full overflow-hidden">
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
