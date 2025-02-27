<!-- checkout.html -->
<!DOCTYPE html>
    <html>
    <head>
        <title>Payment Method</title>
    </head>
        <body>
            <h1>Pay with Gcash</h1>
            <?php if (isset($error)): ?>
                <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
            <form method="POST" action="../pages/process_payment.php">
                <label for="amount">Amount (PHP):</label>
                <input type="number" id="amount" name="amount" required step="0.01"><br><br>

                <label for="gcash_number">GCash Number:</label>
                <input type="text" id="gcash_number" name="gcash_number" required><br><br>

                <button type="submit">Pay with GCash</button>
            </form>
        </body>
    </html>