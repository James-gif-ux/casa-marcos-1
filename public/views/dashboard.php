<?php
  
  require_once '../model/server.php';
  include_once 'nav/header.php';

  try {
      $connector = new Connector();
      
      // Fetch all bookings
      // Modify the initial SQL query at the top of the file
            $sql = "SELECT b.*, s.services_name 
                    FROM booking_tb b 
                    LEFT JOIN services_tb s ON b.booking_services_id = s.services_id 
                    WHERE b.booking_status IN ('pending', 'approved', 'completed')";
      
      $stmt = $connector->executeQuery($sql);
      $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
  }
  ?>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
          <main class="h-full overflow-y-auto">
            <div class="container px-6 mx-auto grid">
              <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Dashboard
              </h2>
              <!-- Cards -->
              <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-5">
                <!-- Card -->
                <a href="../pages/admin_dashboard.php?sub_page=customer"  class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                  <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                  </svg>
                  </div>
                  <div>
                  <p
                    class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Customers
                  </p>
                    <?php
                    // Count unique customers by using array_unique on booking_fullname
                    $uniqueCustomers = array_unique(array_column($bookings, 'booking_id'));
                    $customerCount = count($uniqueCustomers);
                    ?>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"><?php echo $customerCount; ?></p>
                  </div>
                </a>


                <!-- Card -->
                <a href="../pages/admin_dashboard.php?sub_page=booking" class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                  <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hourglass-split" viewBox="0 0 16 16">
                  <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z"/>
                  </svg>
                  </div>
                  <div>
                  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Pending bookings
                  </p>
                    <?php
                    $pendingCount = count(array_filter($bookings, function($booking) {
                    return $booking['booking_status'] === 'pending';
                    }));
                    ?>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"><?php echo $pendingCount; ?></p>
                  </div>
                </a>
                

                
                <!-- Card -->
                <a href="../pages/admin_dashboard.php?sub_page=booking" class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                  <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                  <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                  <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
                  </svg>
                  </div>
                  <div>
                  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Complete Bookings
                  </p>
                    <?php
                    $completedCount = count(array_filter($bookings, function($booking) {
                    return $booking['booking_status'] === 'completed';
                    }));
                    ?>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"><?php echo $completedCount; ?></p>
                  </div>
                </a>


                <!-- Card -->
                  <a href="../pages/admin_dashboard.php?sub_page=messages" class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                    <div class="p-3 mr-4 <?php echo $unreadCount > 0 ? 'text-red-500 bg-red-100 dark:text-red-100 dark:bg-red-500' : 'text-teal-500 bg-teal-100 dark:text-teal-100 dark:bg-teal-500'; ?> rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="<?php echo $unreadCount > 0 ? '#EF4444' : '#14B8A6'; ?>" class="bi bi-chat-dots" viewBox="0 0 16 16">
                    <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                      <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2"/>
                    </svg>
                    </div>
                    <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                      New Messages
                    </p>
                    <?php
                    // Count unread messages from messages table
                    $sql = "SELECT COUNT(*) as unread_count FROM messages WHERE status = 'unread'";
                    $stmt = $connector->executeQuery($sql);
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    $unreadCount = $result['unread_count'];
                    ?>
                    <p class="text-lg font-semibold <?php echo $unreadCount > 0 ? 'text-red-600 dark:text-red-400 animate-pulse' : 'text-gray-700 dark:text-gray-200'; ?>">
                      <?php echo $unreadCount; ?>
                    </p>
                    </div>
                  </a>


                  <!-- Card -->
                  <a href="../pages/admin_dashboard.php?sub_page=reservedBooking" class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                    <div class="p-3 mr-4 <?php echo $pendingCount > 0 ? 'text-red-500 bg-red-100 dark:text-red-100 dark:bg-red-500' : 'text-teal-500 bg-teal-100 dark:text-teal-100 dark:bg-teal-500'; ?> rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="<?php echo $pendingCount > 0 ? '#EF4444' : '#14B8A6'; ?>" class="bi bi-calendar-check" viewBox="0 0 16 16">
                    <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                    </svg>
                    </div>
                    <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Reservations
                    </p>
                    <?php
                    // Fetch reservations from the database
                    $sql = "SELECT COUNT(*) as reservation_count FROM reservations WHERE status IN ('pending')";
                    $stmt = $connector->executeQuery($sql);
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    $reservationCount = $result['reservation_count'];
                    ?>
                    <p class="text-lg font-semibold <?php echo $reservationCount > 0 ? 'text-red-600 dark:text-red-400 animate-pulse' : 'text-gray-700 dark:text-gray-200'; ?>">
                      <?php echo $reservationCount; ?>
                    </p>
                    </div>
                  </a>


                  <!-- Card -->
                  <a href="../pages/admin_dashboard.php?sub_page=payment" class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                  <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                    <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                    <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2"/>
                    </svg>
                  </div>
                  <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Payments
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">0</p>
                  </div>
                  </a>
                </div>
              

              <!-- Charts -->
              <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Charts
              </h2>
                <div class="grid gap-6 mb-8 md:grid-cols-2">
                <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                  <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                  <canvas id="barChart"></canvas>
                  <script>
                  var ctx = document.getElementById('barChart').getContext('2d');
                  var barChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                    labels: ['Customers', 'Complete Bookings'],
                    datasets: [{ 
                      data: [<?php echo $customerCount; ?>, <?php echo count(array_filter($bookings, function($booking) { return $booking['booking_status'] === 'completed'; })); ?>],
                      backgroundColor: [
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(75, 192, 192, 0.2)'
                      ],
                      borderColor: [
                      'rgba(54, 162, 235, 1)',
                      'rgba(75, 192, 192, 1)'
                      ],
                      borderWidth: 1
                    }]
                    },
                    options: {
                    scales: {
                      y: {
                      beginAtZero: true
                      }
                    },
                    plugins: {
                      legend: {
                      display: false
                      }
                    }
                    }
                  });
                  </script>
                  </div>
                  <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                      Monthly Overview
                      </h4>
                      <canvas id="line"></canvas>
                      <script>
                      <?php
                      // Get customer and booking counts per month
                      $monthlyCustomers = array_fill(0, 12, 0);
                      $monthlyBookings = array_fill(0, 12, 0);
                      foreach ($bookings as $booking) {
                        $month = date('n', strtotime($booking['booking_status'])) - 1; // 0-11
                        $monthlyCustomers[$month]++;
                        if ($booking['booking_status'] === 'completed') {
                        $monthlyBookings[$month]++;
                        }
                      }
                      ?>
                      var lineCtx = document.getElementById('line').getContext('2d');
                      var lineChart = new Chart(lineCtx, {
                      type: 'line',
                      data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        datasets: [{
                        label: 'Customers',
                        data: [<?php echo $customerCount; ?>, <?php echo count(array_filter($bookings, function($booking) { return $booking['booking_status'] === 'completed'; })); ?>],
                        borderColor: 'rgb(124, 58, 237)',
                        tension: 0.3
                        },
                        {
                        label: 'Complete Bookings',
                        data: <?php echo json_encode($monthlyBookings); ?>,
                        borderColor: 'rgb(52, 211, 153)',
                        tension: 0.3
                        }]
                      },
                      options: {
                        responsive: true,
                        scales: {
                        y: {
                        beginAtZero: true
                        }
                        }
                      }
                      });
                      </script>
                      </div>
              </div>
            </div>
          </main>
        </div>
      </div>
      <footer class="text-center py-4 text-gray-600 text-sm">
        <p> ThemeWagon Inc &copy; 2025</p>
      </footer>
    </body>
</html>
