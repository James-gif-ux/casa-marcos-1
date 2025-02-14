<?php
require_once '../model/server.php';
include_once 'nav/header.php';

try {
    $connector = new Connector();
    
    // Fetch all bookings
    $sql = "SELECT b.*, s.services_name 
            FROM booking_tb b 
            LEFT JOIN services_tb s ON b.booking_services_id = s.services_id 
            WHERE b.booking_status IN ('pending', 'approved')";
    
    $stmt = $connector->executeQuery($sql);
    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            border-radius: 4px;
            text-decoration: none;
            margin: 0 5px;
            transition: background-color 0.3s ease;
            width: 50px;
        }

      
    </style>
    <!-- New Table -->
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                <th class="px-4 py-3 text-center">Rooms Name</th>
                <th class="px-4 py-3 text-center">Customers Name</th>
                <th class="px-4 py-3 text-center">Booking Email</th>
                <th class="px-4 py-3 text-center">Contact Number</th>
                <th class="px-4 py-3 text-center">Booking Date</th>
                <th class="px-4 py-3 text-center">Booking Status</th>
                <th class="px-4 py-3 text-center">Action</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                <?php foreach ($bookings as $booking): ?>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-center">
                            <?php echo htmlspecialchars($booking['services_name'] ?? 'N/A'); ?>
                        </td>
                        <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($booking['booking_fullname']); ?></td>
                        <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($booking['booking_email']); ?></td>
                        <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($booking['booking_number']); ?></td>
                        <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($booking['booking_date']); ?></td>
                        <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($booking['booking_status']); ?></td>
                        <td style="display: flex; justify-content: center; align-items: center; padding: 10px;">
                            <a href="../../sendMail_layout.php" class="btn btn-primary d-flex align-items-center justify-content-center" ><svg xmlns="http://www.w3.org/2000/svg" width="30" height="40" fill="currentColor" class="bi bi-chat-right" viewBox="0 0 16 16">
                                <path d="M2 1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h9.586a2 2 0 0 1 1.414.586l2 2V2a1 1 0 0 0-1-1zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                                </svg>
                            </a>
                            |
                            <a href="../pages/approvedBooking.php?echo $booking['booking_id']; ?>&action=approve" class="btn-approve"></i>Approve</a>
                            |
                            <a href="../pages/admin-client.php?booking_id=<?php echo $booking['booking_id']; ?>&action=delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this booking?');">Delete</a>
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