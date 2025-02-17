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
            <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
              <!-- Card -->
              <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800" >
                <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                </svg>
                </div>
                <div>
                  <p
                    class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Customers</p>
                    <?php
                    // Count unique customers by using array_unique on booking_fullname
                    $uniqueCustomers = array_unique(array_column($bookings, 'booking_id'));
                    $customerCount = count($uniqueCustomers);
                    ?>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"><?php echo $customerCount; ?></p>
                </div>
              </div>
              <!-- Card -->
              <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
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
              </div>
              <!-- Card -->
              <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                  <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                  <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
                </svg>
                </div>
                <div>
                  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Approved bookings
                  </p>
                    <?php
                    $pendingCount = count(array_filter($bookings, function($booking) {
                      return $booking['booking_status'] === 'approved';
                    }));
                    ?>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"><?php echo $pendingCount; ?></p>
                </div>
              </div>
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
                  labels: ['Customers', 'Approved Bookings'],
                  datasets: [{ 
                    data: [<?php echo $customerCount; ?>, <?php echo count(array_filter($bookings, function($booking) { return $booking['booking_status'] === 'approved'; })); ?>],
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
                    // Get counts per month
                    $monthlyData = array_fill(0, 12, ['customers' => 0, 'pending' => 0, 'approved' => 0]);
                    foreach ($bookings as $booking) {
                        $month = date('n', strtotime($booking['booking_date'])) - 1; // 0-11
                        $monthlyData[$month]['customers']++;
                        if ($booking['booking_status'] === 'pending') {
                            $monthlyData[$month]['pending']++;
                        }
                        if ($booking['booking_status'] === 'approved') {
                            $monthlyData[$month]['approved']++;
                        }
                    }
                    
                    $customers = array_column($monthlyData, 'customers');
                    $pending = array_column($monthlyData, 'pending');
                    $approved = array_column($monthlyData, 'approved');
                  ?>
                  var lineCtx = document.getElementById('line').getContext('2d');
                  var lineChart = new Chart(lineCtx, {
                    type: 'line',
                    data: {
                      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                      datasets: [{
                        label: 'Customers',
                        data: <?php echo json_encode($customers); ?>,
                        borderColor: 'rgb(124, 58, 237)',
                        backgroundColor: 'rgba(124, 58, 237, 0.5)',
                        tension: 0.3,
                        fill: false
                      },
                      {
                        label: 'Pending',
                        data: <?php echo json_encode($pending); ?>,
                        borderColor: 'rgb(234, 179, 8)',
                        backgroundColor: 'rgba(234, 179, 8, 0.5)',
                        tension: 0.3,
                        fill: false
                      },
                      {
                        label: 'Approved',
                        data: <?php echo json_encode($approved); ?>,
                        borderColor: 'rgb(34, 197, 94)',
                        backgroundColor: 'rgba(34, 197, 94, 0.5)',
                        tension: 0.3,
                        fill: false
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
  </body>
</html>
