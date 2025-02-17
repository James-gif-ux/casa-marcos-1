<?php
  include_once 'nav/header.php';
?>

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
                <th class="px-4 py-3 text-center">Customers Name</th>
                <th class="px-4 py-3 text-center">Booking Email</th>
                <th class="px-4 py-3 text-center">Contact Number</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                <?php foreach ($bookings as $booking): ?>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($booking['booking_fullname']); ?></td>
                        <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($booking['booking_email']); ?></td>
                        <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($booking['booking_number']); ?></td>
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