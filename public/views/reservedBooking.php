    <?php
    require_once '../model/server.php';
    include_once 'nav/header.php';

    try {
        $connector = new Connector();
        
        // Fetch all bookings
        // Update the SQL query
        $sql = "SELECT reservation_id, r.*, s.services_name 
                FROM reservations r 
                LEFT JOIN services_tb s ON r.res_services_id = s.services_id 
                WHERE r.status IN ('pending', 'confirmed', 'cancelled')";
        
        $stmt = $connector->executeQuery($sql);
        $reservation = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3 text-center">Rooms Name</th>
                        <th class="px-4 py-3 text-center">Customers Name</th>
                        <th class="px-4 py-3 text-center">Booking Email</th>
                        <th class="px-4 py-3 text-center">Contact Number</th>
                        <th class="px-4 py-3 text-center">Booking Date</th>
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
                                <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($res['date']); ?></td>
                                <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($res['message']); ?></td>
                                <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($res['status']); ?></td>
                                <td style="display: flex; justify-content: center; align-items: center; padding: 10px; gap: 8px;">
                                    <?php if (isset($res['reservation_id'])): ?>
                                        <?php if ($res['status'] === 'pending'): ?>
                                            <a href="../pages/approvedBooking.php?reservation_id=<?php echo htmlspecialchars($res['reservation_id']); ?>&action=approve" 
                                            class="btn-approve">Confirm</a>
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

    <?php
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>