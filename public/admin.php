<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-image: url(./images/logo.jpg);
            background-size: 100% 100%;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            font-family: 'Roboto', sans-serif;
        }
        .login-container {
            display: flex;
            max-width: 600px;
            padding: 50px;
            border-radius: 5px;
            backdrop-filter: blur(1px);
        }
        .left-column {
            flex: 1;
            padding-right: 20px;
            border-right: 1px solid #ccc;
        }
        .right-column h2 {
            flex: 1;
            padding-left: 20px;
        }
        h1 {
            color: rgb(188, 117, 36);
            font-size: 50px;
            font-family: 'Impact', sans-serif;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
            text-align: left;
            position: relative;
        }
        input {
            width: 60%;
            padding: 20px;
            text-align: center;
            margin-top: 10px;
            border: 2px solid rgba(129, 124, 121, 0.5);
            border-radius: 25px;
            background-color: rgba(129, 124, 121, 0.9);
            position: relative;
            left: 50%;
            transform: translateX(-50%);
            display: block;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        input:focus {
            background-color: rgba(129, 124, 121, 1);
            border-color: rgb(188, 117, 36);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
        }
        ::placeholder {
            color: rgba(0, 0, 0, 0.7);
            font-family: 'Roboto', sans-serif;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        input:focus::placeholder {
            transform: translateY(-20px);
            font-size: 0.8em;
            color: #ffffff;
            opacity: 0.8;
        }
        button {
            width: 65%;
            padding: 15px;
            background-color: rgb(188, 117, 36);
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            display: block;
            margin: 25px auto;
            font-size: 18px;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }
        button:hover {
            background-color: rgb(216, 134, 41);
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.3);
        }
        h2 {
            color: #ffffff;
            margin-bottom: 25px;
            text-align: left;
            margin-left: -30px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <form action="./pages/authentication.php?function=login" method="POST">
            <div class="form-group">
                <div class="right-column">
                    <h1>ADMINISTRATOR</h1>
                </div>
                <input type="text" 
                       id="user" 
                       placeholder="Username" 
                       name="user" 
                       required>
            </div>
            <div class="form-group">
                <input type="password" 
                       id="password" 
                       placeholder="Password" 
                       name="password" 
                       required>
            </div>
            <button type="submit">Login</button>
            <?php 
            if(isset($_SESSION['error'])): ?>
                <div class="error" style="color: red; text-align: center; margin-top: 10px;">
                    <?php 
                        echo $_SESSION['error']; 
                        unset($_SESSION['error']); 
                    ?>
                </div>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>