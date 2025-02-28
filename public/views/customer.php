  
<?php
    require_once '../model/server.php';
    include_once 'nav/header.php';

    try {
        $connector = new Connector();
        
        // Fetch unique customers
        $sql = "SELECT DISTINCT booking_fullname, booking_email, booking_number 
                FROM booking_tb 
                GROUP BY booking_fullname, booking_email, booking_number
                ORDER BY booking_fullname";
        
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

        
        </style>
        <!-- New Table -->
            <div class="w-full overflow-hidden">
                <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3 ">Customers Name</th>
                        <th class="px-4 py-3 ">Booking Email</th>
                        <th class="px-4 py-3 text-center">Contact Number</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <?php foreach ($bookings as $booking): ?>
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 "><?php echo htmlspecialchars($booking['booking_fullname']); ?></td>
                                <td class="px-4 py-3 "><?php echo htmlspecialchars($booking['booking_email']); ?></td>
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