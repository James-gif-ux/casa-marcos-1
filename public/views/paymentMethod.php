<?php
      session_start();
      require_once '../model/server.php';
      include_once '../model/reservationModel.php';
  
      $model = new Reservation_Model();
      $reservationModel = new Reservation_Model();
      $connector = new Connector(); // Initialize connector before using it
  
      // Add this at the top of the file after session_start()
      $checkin_date = isset($_SESSION['checkin']) ? $_SESSION['checkin'] : '';
      $checkout_date = isset($_SESSION['checkout']) ? $_SESSION['checkout'] : '';

      // Get specific service based on URL parameter
      if (isset($_GET['service_id'])) {
          $service_id = $_GET['service_id'];
          $sql = "SELECT * FROM services_tb WHERE services_id = :service_id";
          $stmt = $connector->getConnection()->prepare($sql);
          $stmt->execute([':service_id' => $service_id]);
          $service = $stmt->fetch(PDO::FETCH_ASSOC);
          
          if (!$service) {
              header("Location: books.php");
              exit();
          }
      } else {
          // Redirect back to books.php if no service_id is provided
          header("Location: books.php");
          exit();
      }
  
      // Get all services
      $services = $reservationModel->get_service();
  
      // Include the Connector class
      require_once '../model/server.php';
      $connector = new Connector();
  
      // Fetch all bookings that are pending approval
      $sql = "SELECT reservation_id, name, email, phone, checkin, checkout, message FROM reservations WHERE status = 'pending'";
      $reservations = $connector->executeQuery($sql);
  

          // Fetch all bookings that are pending approval
  

  // Get all services
  $services = $reservationModel->get_service();

  // Include the Connector class
  require_once '../model/server.php';
  $connector = new Connector();

  // Fetch all bookings that are pending approval
  $sql = "SELECT reservation_id, name, email, phone, checkin, checkout, message FROM reservations WHERE status = 'pending'";
  $reservations = $connector->executeQuery($sql);

  // Handle form submission
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      try {
          $connector = new Connector();
          
          // Updated SQL to include res_services_id
          $sql = "INSERT INTO reservations (name, email, phone, checkin, checkout, message, status, res_services_id) 
                  VALUES (:name, :email, :phone, :checkin, :checkout, :message, 'pending', :service_id)";
          
          $stmt = $connector->getConnection()->prepare($sql);
          $result = $stmt->execute([
              ':name' => $_POST['name'],
              ':email' => $_POST['email'],
              ':phone' => $_POST['phone'],
              ':checkin' => $_POST['checkin'],
              ':checkout' => $_POST['checkout'],
              ':message' => $_POST['message'],
              ':service_id' => $_POST['service_id'] // This gets the hidden service_id field value
          ]);

          if ($result) {
              echo "<script>alert('Reservation submitted successfully!');</script>";
          }
          
      } catch (PDOException $e) {
          echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
      }
  }
?>
<html>
    <title>Payment Method</title>
    <head>
        <!-- Keep the existing head content unchanged -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
        <script src="https://unpkg.com/unlazy@0.11.3/dist/unlazy.with-hashing.iife.js" defer init></script>
        <!-- Keep your existing tailwind config and styles -->
    </head>
    <body class="bg-gray-50">
        
<div class="max-w-7xl mx-auto p-6" style="background-color:rgb(189, 213, 224); margin-top: 250px; padding: 50px;">
    <div class="grid md:grid-cols-2 gap-8">
        <!-- Left Column - Order Summary -->
        <div class="bg-background rounded-lg shadow-md p-6" style="background-color: white;">
            <h2 class="text-2xl font-bold text-foreground mb-6">Reservation Summary</h2>
            <?php if (isset($service)): ?>
                <div class="flex items-center">
                    <div class="w-full">
                        <h3 class="text-lg font-semibold"><?php echo htmlspecialchars($service['services_name']); ?></h3>
                        <div>
                            <img src="../images/<?php echo htmlspecialchars($service['services_image']); ?>" alt="">
                        </div>
                        <div class="mt-4 space-y-2">
                            
                            <li><strong>Check-in Date:</strong> <?= $_SESSION['check_in'] ?? 'N/A' ?></li>
                            <li><strong>Check-out Date:</strong> <?= $_SESSION['check_out'] ?? 'N/A' ?></li>
                            <?php
                            if ($checkin_date && $checkout_date) {
                                $checkin = new DateTime($checkin_date);
                                $checkout = new DateTime($checkout_date);
                                $nights = $checkout->diff($checkin)->days;
                                $total = $nights * $service['price'];
                            ?>
                                <div class="flex justify-between">
                                    <span class="text-muted-foreground">Number of Nights</span>
                                    <span class="font-medium"><?php echo $nights; ?></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-muted-foreground">Price per Night</span>
                                    <span class="font-medium">₱<?php echo number_format($service['price'], 2); ?></span>
                                </div>
                                <div class="flex justify-between border-t pt-2 mt-4">
                                    <span class="font-semibold">Total Amount</span>
                                    <span class="font-bold">₱<?php echo number_format($total, 2); ?></span>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Right Column - Payment Options --> 
        <div class="bg-background rounded-lg shadow-md p-6" style="background-color: white;">
            <h2 class="text-2xl font-bold text-foreground mb-6">Payment Method</h2>
            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <button class="flex items-center justify-center border border-border rounded-lg hover:bg-secondary hover:text-secondary-foreground transition-colors" style="font-size: 30px; font-weight: bold;">
                        <img src="../images/bdo.png" alt="Touch n' go" class="mr-2" style="width: 40px;"/>
                        BDO
                    </button>
                    <button class="flex items-center justify-center p-4 border border-border rounded-lg hover:bg-secondary hover:text-secondary-foreground transition-colors" style="font-size: 30px; font-weight: bold;">
                        <img src="../images/gcash.png" alt="GCash" class="mr-2" style="width: 40px;" />
                        GCash
                    </button>
                <textarea 
                    name="message" 
                    placeholder="Enter a message (optional)" 
                    class=" mt-4 p-4 border border-border rounded-lg resize-none focus:outline-none focus:ring-2 focus:ring-primary"
                    rows="3" style="width: 525px;"></textarea>
                </div>
                
                <button class="mt-6 w-full bg-primary text-primary-foreground p-4 rounded-lg hover:bg-primary/80 transition-colors font-medium" style="background-color: black; color: white;">
                    Pay S$ 1,250.00
                </button>
            </div>
        </div>
    </div>
</div>

    </body>
</html>
