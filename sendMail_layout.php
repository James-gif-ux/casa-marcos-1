<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Email</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            animation: gradientBackground 10s ease infinite;
            background: linear-gradient(-45deg, rgb(218, 191, 156), rgb(85, 59, 23));
            background-size: 200% 200%;
        }

        @keyframes gradientBackground {
            0% {
                background-position: 0% 50%;
            }
            100% {
                background-position: 100% 50%;
            }
        }

        .container {
            max-width: 650px;
            margin: 80px auto;
            background-color: #ffffff;
            border-radius: 12px;
            padding: 100px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 20px;
            color: #333;
            font-family: 'impact';
        }

        label {
            font-size: 16px;
            font-weight: 600;
            color: #444;
            margin-bottom: 5px;
            display: block;
        }

        input[type="email"],
        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }

        input[type="email"]:focus,
        input[type="text"]:focus,
        textarea:focus {
            border-color: rgb(218, 191, 156);
            outline: none;
        }

        textarea {
            height: 150px;
            resize: vertical;
        }

        .error-message {
            color: red;
            font-size: 12px;
            margin-bottom: 10px;
        }

        button[type="submit"] {
            background-color: rgb(85, 59, 23);
            color: white;
            padding: 14px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: rgb(218, 191, 156);
        }

        /* Responsive design for small screens */
        @media (max-width: 480px) {
            .container {
                padding: 20px;
            }

            h2 {
                font-size: 24px;
            }

            button[type="submit"] {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Confirmation Message</h2>
        <form action="send_mail.php" method="post">
            <label for="email">Recipient Email:</label>
            <input type="email" name="email" required>
            <div class="error-message"></div>

            <label for="subject">Subject:</label>
            <input type="text" name="subject" required>
            <div class="error-message"></div>

            <label for="message">Message:</label>
            <textarea name="message" required></textarea>
            <div class="error-message"></div>

            <button type="submit">Send Email</button>
        </form>
    </div>
</body>
</html>
