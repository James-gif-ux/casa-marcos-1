<?php
require_once '../model/server.php';
require 'PHPMailer-master/src/PHPMailer.php'; // Adjust the path as necessary
require 'PHPMailer-master/src/SMTP.php'; // Adjust the path as necessary
require 'PHPMailer-master/src/Exception.php'; // Adjust the path as necessary

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_GET['booking_id']) && isset($_GET['action'])) {
    $booking_id = $_GET['booking_id'];
    $action = $_GET['action'];
    $connector = new Connector();
    $email_sent = false; // Flag for tracking if email was sent

    if ($action === 'approve') {
        $sql = "UPDATE booking_tb SET booking_status = 'approved' WHERE booking_id = :booking_id";
        
        if ($connector->executeUpdate($sql, [':booking_id' => $booking_id])) {
            // Send an email upon approval
            $email_sent = sendEmail($booking_id, 'approved');
            header("Location: ../views/booking.php?approved=true&email_sent=" . ($email_sent ? '1' : '0'));
        } else {
            header("Location: ../views/booking.php?approved=false");
        }
    } elseif ($action === 'delete') {
        $sql = "DELETE FROM booking_tb WHERE booking_id = :booking_id";

        if ($connector->executeUpdate($sql, [':booking_id' => $booking_id])) {
            // Send an email upon deletion
            $email_sent = sendEmail($booking_id, 'deleted');
            header("Location: ../views/booking.php?deleted=true&email_sent=" . ($email_sent ? '1' : '0'));
        } else {
            header("Location: ../views/booking.php?deleted=false");
        }
    }
    exit();
}

function sendEmail($booking_id, $action) {
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.example.com'; // Set the SMTP server to send through
        $mail->SMTPAuth   = true; 
        $mail->Username   = 'your_email@example.com'; // SMTP username
        $mail->Password   = 'your_email_password'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port       = 587; 
        
        // Recipients
        $mail->setFrom('your_email@example.com', 'Your Name');
        $mail->addAddress('recipient_email@example.com'); // Add a recipient
        $mail->addReplyTo('your_email@example.com', 'Your Name'); // Add a reply-to address

        // Content
        if ($action === 'approved') {
            $mail->Subject = 'Booking Approved';
            $mail->Body    = "Your booking with ID $booking_id has been approved.";
        } elseif ($action === 'deleted') {
            $mail->Subject = 'Booking Deleted';
            $mail->Body    = "Your booking with ID $booking_id has been deleted.";
        }

        $mail->send();
        return true; // Successfully sent email
    } catch (Exception $e) {
        error_log("Email could not be sent. Mailer Error: {$mail->ErrorInfo}");
        return false; // Email not sent
    }
}
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
                    <th class="px-4 py-3 text-center">Booking ID</th>
                    <th class="px-4 py-3 text-center">Booking Name</th>
                    <th class="px-4 py-3 text-center">Booking Email</th>
                    <th class="px-4 py-3 text-center">Booking Number</th>
                    <th class="px-4 py-3 text-center">Booking Date</th>
                    <th class="px-4 py-3 text-center">Booking Status</th>
                    <th class="px-4 py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                <?php foreach ($bookings as $bookings): ?>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($bookings['booking_services_id']); ?></td>
                    <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($bookings['booking_fullname']); ?></td>
                    <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($bookings['booking_email']); ?></td>
                    <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($bookings['booking_number']); ?></td>
                    <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($bookings['booking_date']); ?></td>
                    <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($bookings['booking_status']); ?></td>
                    <td style="display: flex; justify-content: center; align-items: center; padding: 10px;">
                        <a href="../pages/admin-client.php?booking_id=<?php echo $bookings['booking_id']; ?>&action=approve" class="btn-approve" onclick="return confirm('Are you sure you want to approve this booking?');">Approve</a>
                        |
                        <a href="../pages/admin-client.php?booking_id=<?php echo $bookings['booking_id']; ?>&action=delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this booking?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>