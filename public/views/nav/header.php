<?php
require_once '../model/server.php';

// Initialize unreadCount variable
$unreadCount = 0; // Default value

try {
    $connector = new Connector();
    $sql = "SELECT COUNT(*) as unread FROM messages WHERE status = 'unread'";
    $result = $connector->executeQuery($sql);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $unreadCount = $row['unread'];
} catch (Exception $e) {
    // Handle any exceptions if necessary
    $unreadCount = 0; // Reset to 0 on error
}

// Add this at the top of the file
$active_page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>

<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../assets/css/tailwind.output.css" />
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="../assets/js/init-alpine.js"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"
    />
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
      defer
    ></script>
    <script src="../assets/js/charts-lines.js" defer></script>
    <script src="../assets/js/charts-pie.js" defer></script>
  </head>
  <style>
    
    /* General styles for the buttons */
.btn-approve, .btn-danger {
    padding: 10px 15px; /* Padding for buttons */
    border: none; /* No border */
    border-radius: 5px; /* Rounded corners */
    text-align: center; /* Center the text */
    text-decoration: none; /* Remove underline */
    font-weight: bold; /* Bold font */
    transition: background-color 0.3s ease; /* Smooth background color transition */
}

/* Style specifically for the approve button */
.btn-approve {
    background-color: #4CAF50; /* Green background */
    color: white; /* White text */
}

/* Style specifically for the delete button */
.btn-danger {
    background-color: #f44336; /* Red background */
    color: white; /* White text */
}

/* Hover effects for buttons */
.btn-approve:hover {
    background-color: #45a049; /* Darker green on hover */
}

.btn-danger:hover {
    background-color: #e53935; /* Darker red on hover */
}

/* Responsive design for smaller screens */
@media (max-width: 600px) {
    .btn-approve, .btn-danger {
        padding: 8px 12px; /* Adjust padding */
        font-size: 14px; /* Smaller font */
    }
}

.menu-item.active {
    background-color: rgba(107, 70, 193, 0.1);
}

.menu-item.active a {
    color: #6B46C1;
}

.active-indicator {
    animation: slideIn 0.3s ease-out;
}

@keyframes slideIn {
    from { transform: translateX(-100%); }
    to { transform: translateX(0); }
}

.menu-item.active {
    background-color: rgba(107, 70, 193, 0.1);
}

.menu-item.active a {
    color: #1a1c23 !important; /* Dark text color */
}

.menu-item.active svg {
    color: #6B46C1; /* Purple icon color */
}

.active-indicator {
    animation: slideIn 0.3s ease-out;
}

@keyframes slideIn {
    from { transform: translateX(-100%); }
    to { transform: translateX(0); }
}
  </style>
  <body>
    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen }"
    >
      <!-- Desktop sidebar -->
      <aside
        class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0"
        >
              <div class="py-4 text-gray-500 dark:text-gray-400">
                <a
                  class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
                  href="#"
                >
                  CASA MARCOS
                </a>
                <ul class="mt-6">
                  <?php $current_page = basename($_SERVER['PHP_SELF']); ?>
                  
                  <li class="relative px-6 py-3 menu-item" data-page="dashboard">
                    <?php if($current_page == 'dashboard.php'): ?>
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg active-indicator" aria-hidden="true"></span>
                    <?php endif; ?>
                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?php echo $current_page == 'dashboard.php' ? 'text-gray-800 dark:text-gray-100' : ''; ?>"
                      href="../pages/admin_dashboard.php?sub_page=dashboard">
                      <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                      </svg>
                      <span class="ml-4 text-gray-500 dark:text-gray-400 ">Dashboard</span>
                    </a>
                  </li>

                  <li class="relative px-6 py-3 menu-item" data-page="booking">
                    <?php if($current_page == 'booking.php'): ?>
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg active-indicator" aria-hidden="true"></span>
                    <?php endif; ?>
                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?php echo $current_page == 'booking.php' ? 'text-gray-800 dark:text-gray-100' : ''; ?>"
                      href="../pages/admin_dashboard.php?sub_page=booking">
                      <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                      </svg>
                      <span class="ml-4 text-gray-500 dark:text-gray-400 ">Booking</span>
                    </a>
                  </li>

                  <!-- Repeat similar pattern for other menu items -->
                  <!-- Example for Customers -->
                  <li class="relative px-6 py-3 menu-item" data-page="customer">
                    <?php if($current_page == 'customer.php'): ?>
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg active-indicator" aria-hidden="true"></span>
                    <?php endif; ?>
                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?php echo $current_page == 'customer.php' ? 'text-gray-800 dark:text-gray-100' : ''; ?>"
                      href="../pages/admin_dashboard.php?sub_page=customer">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z"/>
                      </svg>
                      <span class="ml-4 text-gray-500 dark:text-gray-400">Customers</span>
                    </a>
                  </li>
                  <li class="relative px-6 py-3 menu-item" data-page="messages">
                    <?php if($current_page == 'messages.php'): ?>
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg active-indicator" aria-hidden="true"></span>
                    <?php endif; ?>
                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?php echo $current_page == 'messages.php' ? 'text-gray-800 dark:text-gray-100' : ''; ?>"
                      href="../pages/admin_dashboard.php?sub_page=messages">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-square" viewBox="0 0 16 16">
                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                      </svg>
                      <span class="ml-4 text-gray-500 dark:text-gray-400">Inquiries</span>
                        <?php if (isset($unread_count) && $unread_count > 0): ?>
                            <span class="ml-2 text-xs font-semibold text-red-500"><?php echo $unread_count; ?></span>
                        <?php endif; ?>
                    </a>
                  </li>
                  <!-- Example for payments -->
                  <li class="relative px-6 py-3 menu-item" data-page="payment">
                    <?php if($current_page == 'payment.php'): ?>
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg active-indicator" aria-hidden="true"></span>
                    <?php endif; ?>
                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?php echo $current_page == 'payment.php' ? 'text-gray-800 dark:text-gray-100' : ''; ?>"
                      href="../pages/admin_dashboard.php?sub_page=payment">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
                        <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z"/>
                      </svg>
                      <span class="ml-4 text-gray-500 dark:text-gray-400">Payments</span>
                    </a>
                  </li>
                  <hr>
                  <!-- Example for payments -->
                <li class="relative px-6 py-3 menu-item" data-page="reservedBooking">
                    <?php if($current_page == 'reservedBooking.php'): ?>
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg active-indicator" aria-hidden="true"></span>
                    <?php endif; ?>
                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?php echo $current_page == 'reservedBooking.php' ? 'text-gray-800 dark:text-gray-100' : ''; ?>"
                      href="../pages/admin_dashboard.php?sub_page=reservedBooking">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-check" viewBox="0 0 16 16">
                        <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                      </svg>
                      <span class="ml-4 text-gray-500 dark:text-gray-400">Reserved Booking</span>
                    </a>
                  </li>
                  <!-- Continue same pattern for remaining menu items -->
                </ul>
                   
              </ul>
        </div>
      </aside>
      <!-- Mobile sidebar -->
      <!-- Backdrop -->
      <div
        x-show="isSideMenuOpen"
        x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
      ></div>
      <aside
        class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden"
        x-show="isSideMenuOpen"
        x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0 transform -translate-x-20"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0 transform -translate-x-20"
        @click.away="closeSideMenu"
        @keydown.escape="closeSideMenu"
      >
        <div class="py-4 text-gray-500 dark:text-gray-400">
          <h1>CASA MARCOS</h1>
            <ul class="mt-6">
              <ul class="mt-6">
                <?php $current_page = basename($_SERVER['PHP_SELF']); ?>
                
                <li class="relative px-6 py-3 menu-item" data-page="dashboard">
                  <?php if($current_page == 'dashboard.php'): ?>
                  <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg active-indicator" aria-hidden="true"></span>
                  <?php endif; ?>
                  <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?php echo $current_page == 'dashboard.php' ? 'text-gray-800 dark:text-gray-100' : ''; ?>"
                    href="../pages/admin_dashboard.php">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                      <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="ml-4">Dashboard</span>
                  </a>
                </li>

                <li class="relative px-6 py-3 menu-item" data-page="booking">
                  <?php if($current_page == 'booking.php'): ?>
                  <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg active-indicator" aria-hidden="true"></span>
                  <?php endif; ?>
                  <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?php echo $current_page == 'booking.php' ? 'text-gray-800 dark:text-gray-100' : ''; ?>"
                    href="../pages/admin_dashboard.php?sub_page=booking">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                      <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span class="ml-4">Booking</span>
                  </a>
                </li>

                <!-- Repeat similar pattern for other menu items -->
                <!-- Example for Customers -->
                <li class="relative px-6 py-3 menu-item" data-page="customer">
                  <?php if($current_page == 'customer.php'): ?>
                  <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg active-indicator" aria-hidden="true"></span>
                  <?php endif; ?>
                  <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?php echo $current_page == 'customer.php' ? 'text-gray-800 dark:text-gray-100' : ''; ?>"
                    href="../pages/admin_dashboard.php?sub_page=customer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                      <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z"/>
                    </svg>
                    <span class="ml-4">Customers</span>
                  </a>
                </li>
                <li class="relative px-6 py-3 menu-item" data-page="messages">
                    <?php if($current_page == 'messages.php'): ?>
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg active-indicator" aria-hidden="true"></span>
                    <?php endif; ?>
                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?php echo $current_page == 'messages.php' ? 'text-gray-800 dark:text-gray-100' : ''; ?>"
                      href="../pages/admin_dashboard.php?sub_page=messages">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-square" viewBox="0 0 16 16">
                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                      </svg>
                      <span class="ml-4">Inquiries</span>
                        <?php if (isset($unread_count) && $unread_count > 0): ?>
                            <span class="ml-2 text-xs font-semibold text-red-500"><?php echo $unread_count; ?></span>
                        <?php endif; ?>
                    </a>
                  </li>
                <!-- Example for payments -->
                <li class="relative px-6 py-3 menu-item" data-page="payment">
                    <?php if($current_page == 'payment.php'): ?>
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg active-indicator" aria-hidden="true"></span>
                    <?php endif; ?>
                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?php echo $current_page == 'payment.php' ? 'text-gray-800 dark:text-gray-100' : ''; ?>"
                      href="../pages/admin_dashboard.php?sub_page=payment">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
                        <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z"/>
                      </svg>
                      <span class="ml-4">Payments</span>
                    </a>
                  </li>
                  <!-- Example for payments -->
                <li class="relative px-6 py-3 menu-item" data-page="reservedBooking">
                    <?php if($current_page == 'reservedBooking.php'): ?>
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg active-indicator" aria-hidden="true"></span>
                    <?php endif; ?>
                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?php echo $current_page == 'reservedBooking.php' ? 'text-gray-800 dark:text-gray-100' : ''; ?>"
                      href="../pages/admin_dashboard.php?sub_page=reservedBooking">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-check" viewBox="0 0 16 16">
                        <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                      </svg>
                      <span class="ml-4">Reserved Booking</span>
                    </a>
                  </li>
                
                <!-- Continue same pattern for remaining menu items -->
              </ul>
            </ul>
          </div>
          </aside>
          <div class="flex flex-col flex-1 w-full">
          <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
            <div
            class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300"
            >
            <!-- Mobile hamburger -->
            <button
              class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple"
              @click="toggleSideMenu"
              aria-label="Menu"
            >
              <svg
              class="w-6 h-6"
              aria-hidden="true"
              fill="currentColor"
              viewBox="0 0 20 20"
              >
              <path
                fill-rule="evenodd"
                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                clip-rule="evenodd"
              ></path>
              </svg>
            </button>
            <!-- Search input -->
            <div class="flex justify-center flex-1 lg:mr-32">
              <div
                class="relative w-full max-w-xl mr-6 focus-within:text-purple-500"
              >
                <div class="absolute inset-y-0 flex items-center pl-2">
                
                    <path
                      fill-rule="evenodd"
                      d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                      clip-rule="evenodd"
                    ></path>
                  </svg>
                </div>
               
              </div>
            </div>
            <ul class="flex items-center flex-shrink-0 space-x-6">
              <!-- Theme toggler -->
              <li class="flex">
              <button
                class="rounded-md focus:outline-none focus:shadow-outline-purple"
                @click="toggleTheme"
                aria-label="Toggle color mode"
              >
                <template x-if="!dark">
                    <svg
                      class="w-5 h-5"
                      aria-hidden="true"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                    >
                      <path
                        d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"
                      ></path>
                    </svg>
                  </template>
                  <template x-if="dark">
                    <svg
                      class="w-5 h-5"
                      aria-hidden="true"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                        clip-rule="evenodd"
                      ></path>
                    </svg>
                  </template>
                </button>
              </li>
              <!-- Profile menu -->
              <li class="relative">
                <button
                  class="align-middle rounded-full focus:shadow-outline-purple focus:outline-none"
                  @click="toggleProfileMenu"
                  @keydown.escape="closeProfileMenu"
                  aria-label="Account"
                  aria-haspopup="true"
                >
                  <img
                    class="object-cover w-8 h-8 rounded-full"
                    src="../images/logo.jpg"
                    alt=""
                    aria-hidden="true"
                  />
                </button>
                <template x-if="isProfileMenuOpen">
                  <ul
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    @click.away="closeProfileMenu"
                    @keydown.escape="closeProfileMenu"
                    class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700"
                    aria-label="submenu"
                  >
                    <li class="flex">
                      <a
                        class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                        href="../pages/authentication.php?sub_page=login"
                      >
                        <svg
                          class="w-4 h-4 mr-3"
                          aria-hidden="true"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"
                          ></path>
                        </svg>
                        <span>Log out</span>
                      </a>
                    </li>
                  </ul>
                </template>
              </li>
            </ul>
          </div>
        </header>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuItems = document.querySelectorAll('.menu-item');
    
    function setActiveMenuItem(item) {
        // Remove active class from all items
        menuItems.forEach(menuItem => {
            menuItem.classList.remove('active');
            menuItem.querySelector('a').classList.remove('text-gray-800', 'dark:text-gray-100');
            const indicator = menuItem.querySelector('.active-indicator');
            if (indicator) indicator.remove();
        });

        // Add active class to clicked item
        item.classList.add('active');
        item.querySelector('a').classList.add('text-gray-800', 'dark:text-gray-100');
        
        // Add indicator
        const indicator = document.createElement('span');
        indicator.className = 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg active-indicator';
        item.insertBefore(indicator, item.firstChild);
        
        // Store active state
        localStorage.setItem('activeMenuItem', item.dataset.page);
    }

    // Add click handlers
    menuItems.forEach(item => {
        item.addEventListener('click', function() {
            setActiveMenuItem(this);
        });
    });

    // Set active state on page load
    const activeMenuId = localStorage.getItem('activeMenuItem');
    if (activeMenuId) {
        const activeItem = document.querySelector(`[data-page="${activeMenuId}"]`);
        if (activeItem) setActiveMenuItem(activeItem);
    }
});

new Vue({
    el: '#notificationApp', // bind to your app's root element
    data: {
        unreadCount: <?php echo $unreadCount; ?>,
        isNotificationsOpen: false
    },
    methods: {
        toggleNotifications() {
            this.isNotificationsOpen = !this.isNotificationsOpen;
        },
        closeNotifications() {
            this.isNotificationsOpen = false;
        }
    }
});
</script>
</body>
</html>
