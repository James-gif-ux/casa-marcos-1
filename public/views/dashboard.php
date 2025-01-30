<?php
  include_once 'nav/header.php';
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
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                  </svg>
                </div>
                <div>
                  <p
                    class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Customers</p>
                  <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">0.00</p>
                </div>
              </div>
              <!-- Card -->
              <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 11.93V14a1 1 0 11-2 0v-.07a3.001 3.001 0 01-1.995-2.829A1 1 0 019 10h2a1 1 0 110 2H9.5a1.5 1.5 0 000 3h1a1.5 1.5 0 000-3H10a1 1 0 110-2h1a3.001 3.001 0 011.995 2.829A1 1 0 0111 13.93z" ></path>
                  </svg>
                </div>
                <div>
                  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Payments</p>
                  <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">0.00</p>
                </div>
              </div>
              <!-- Card -->
              <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
                  </svg>
                </div>
                <div>
                  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Sales
                  </p>
                  <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    0.00
                  </p>
                </div>
              </div>
              <!-- Card -->
              <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd"></path>
                  </svg>
                </div>
                <div>
                  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Pending bookings
                  </p>
                  <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    0.00
                  </p>
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
                    Revenue
                  <canvas id="barChart"></canvas>
                  <script>
                    var ctx = document.getElementById('barChart').getContext('2d');
                    var barChart = new Chart(ctx, {
                      type: 'bar',
                      data: {
                        labels: ['Customers', 'Sales', 'Payments'],
                        datasets: [{
                          label: 'Revenue',
                          data: [12, 19, 3],
                          backgroundColor: [
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)'
                          ],
                          borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                          ],
                          borderWidth: 1
                        }]
                      },
                      options: {
                        scales: {
                          y: {
                            beginAtZero: true
                          }
                        }
                      }
                    });
                  </script>
          
                  <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
                      <!-- Chart legend -->
                      <div class="flex items-center">
                        <span class="inline-block w-3 h-3 mr-1 bg-blue-500 rounded-full"></span>
                        <span>Customers</span>
                      </div>
                      <div class="flex items-center">
                        <span class="inline-block w-3 h-3 mr-1 bg-teal-600 rounded-full"></span>
                        <span>Sales</span>
                      </div>
                      <div class="flex items-center">
                        <span class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"></span>
                        <span>Payments</span>
                      </div>
                  </div>
                </div>
              <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                  Total
                </h4>
                <canvas id="line"></canvas>
                <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
                  <!-- Chart legend -->
                  <div class="flex items-center">
                    <span class="inline-block w-3 h-3 mr-1 bg-teal-600 rounded-full"></span>
                    <span>Totat Sales</span>
                  </div>
                  <div class="flex items-center">
                    <span class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"></span>
                    <span>Total bookings</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
  </body>
</html>
