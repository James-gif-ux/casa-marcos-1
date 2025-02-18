<?php
// process_payment.php
// 1.  Configuration (Replace with your actual GCash API credentials)
$gcash_api_endpoint = "YOUR_GCASH_API_ENDPOINT"; // e.g., "https://api.gcash.com/payments"
$gcash_api_key = "YOUR_GCASH_API_KEY";
$gcash_merchant_id = "YOUR_GCASH_MERCHANT_ID";
$gcash_callback_url = "YOUR_GCASH_CALLBACK_URL"; // URL to handle the GCash webhook

// 2.  Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 3.  Get form data and validation
    $amount = isset($_POST["amount"]) ? floatval($_POST["amount"]) : 0;
    $gcash_number = isset($_POST["gcash_number"]) ? htmlspecialchars($_POST["gcash_number"]) : "";

    if ($amount <= 0 || !is_numeric($amount)) {
        $error = "Invalid amount. Please enter a valid positive number.";
    } elseif (empty($gcash_number)) {
        $error = "Please enter your GCash number.";
    } else {
        // 4. Prepare the API request (This is a placeholder -- ADJUST THIS BASED ON THE GCASH API)
        $payment_data = [
            "merchant_id" => $gcash_merchant_id,
            "amount" => $amount,
            "gcash_number" => $gcash_number,
            "currency" => "PHP", // Or whatever is appropriate
            "reference_id" => uniqid(), // Unique transaction identifier
            "callback_url" => $gcash_callback_url,
            // Add any other required parameters as per the GCash API documentation
        ];

        $payload = json_encode($payment_data);

        // 5.  Make the API call (using cURL for example)
        $ch = curl_init($gcash_api_endpoint);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer " . $gcash_api_key, // Or however you authenticate with GCash
        ]);

        $response = curl_exec($ch);
        $http_status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        // 6.  Handle the API Response
        if ($response === false) {
            $error = "API request failed: " . curl_error($ch);
        } else {
            $response_data = json_decode($response, true); // Decode JSON

            if ($http_status_code >= 200 && $http_status_code < 300) {  // Assuming 2xx is success

                // Success: Process the response (e.g., get payment ID, redirect URL)
                // THIS IS HIGHLY DEPENDENT ON THE GCASH API.
                // You need to check the structure of $response_data based on their documentation.
                if (isset($response_data['payment_id'])) { // Example
                    // Consider redirecting the user to a GCash payment page or display confirmation.
                    //  This *depends on* the GCash API - some redirect, some use webhooks.
                    //  Example:  header("Location:  " . $response_data['redirect_url']);
                    header("Location: ../views/success.php");
                    exit();

                } else {
                    $error = "Payment successful, but couldn't find the payment ID or redirect URL.";
                }

            } else {
                // API Error: Handle error codes and messages
                $error = "Payment failed. API returned: " . $http_status_code . " - " . json_encode($response_data);
            }
        }
    }
}

//  7. Display Errors or Render the Form Again
if (isset($error)) {
    include "../views/checkout.php"; // Re-display the checkout form with the error
} else {
    // If no error and form isn't submitted, display the form
    include "../views/checkout.php";
}

?>