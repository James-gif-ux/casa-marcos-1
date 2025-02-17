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
    // Fetch all messages
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
                            <a href="../../sendMail_layout.php" class="btn btn-primary d-flex align-items-center justify-content-center" ><svg xmlns="http://www.w3.org/2000/svg" width="40" height="50" fill="grey" class="bi bi-chat-square-dots-fill" viewBox="0 0 16 16">
                                    <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-2.5a1 1 0 0 0-.8.4l-1.9 2.533a1 1 0 0 1-1.6 0L5.3 12.4a1 1 0 0 0-.8-.4H2a2 2 0 0 1-2-2zm5 4a1 1 0 1 0-2 0 1 1 0 0 0 2 0m4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                                    </svg>
                            </a>
                            |
                            <a href="../pages/admin-client.php?booking_id=<?php echo $booking['booking_id']; ?>&action=approve" class="btn-approve">Approve</a>
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