<?php
  include_once './nav/header.php';
  require_once '../model/connector.php';

  // Instantiate the Connector class
  $connector = new Connector();

  // Fetch all bookings that are pending approval
  $sql = "SELECT booking_id, booking_name, booking_email, booking_number, booking_date, booking_time, booking_status FROM booking_tb WHERE booking_status IN ('pending', 'approved','completed')";

  $bookings = $connector->executeQuery($sql);
?>

    <script>
        // Check the URL for the "approved" query parameter
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const approved = urlParams.get('approved');
            
            // Show the alert if the 'approved' parameter is set to true
            if (approved === 'true') {
                alert('Booking has been approved!');
                clearUrlParams();
            } else if (approved === 'false') {
                alert('There was an error approving the booking.');
                clearUrlParams();
            }
        });

        // Function to clear URL parameters
        function clearUrlParams() {
            const url = window.location.href.split('?')[0];
            window.history.replaceState({}, document.title, url);
        }
    </script>
<!-- New Table -->
<div class="w-full overflow-hidden rounded-lg shadow-xs">
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Booking ID</th>
                    <th class="px-4 py-3">Booking Name</th>
                    <th class="px-4 py-3">Booking Email</th>
                    <th class="px-4 py-3">Booking Number</th>
                    <th class="px-4 py-3">Booking Date</th>
                    <th class="px-4 py-3">Booking Time</th>
                    <th class="px-4 py-3">Booking Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                <?php foreach ($bookings as $bookings): ?>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3"><?php echo htmlspecialchars($bookings['booking_id']); ?></td>
                    <td class="px-4 py-3"><?php echo htmlspecialchars($bookings['booking_name']); ?></td>
                    <td class="px-4 py-3"><?php echo htmlspecialchars($bookings['booking_email']); ?></td>
                    <td class="px-4 py-3"><?php echo htmlspecialchars($bookings['booking_number']); ?></td>
                    <td class="px-4 py-3"><?php echo htmlspecialchars($bookings['booking_date']); ?></td>
                    <td class="px-4 py-3"><?php echo htmlspecialchars($bookings['booking_time']); ?></td>
                    <td class="px-4 py-3"><?php echo htmlspecialchars($bookings['booking_status']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>