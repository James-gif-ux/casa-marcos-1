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
        h1{
            color: rgb(188, 117, 36);
            font-size: 50px;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .form-group {
            position: relative;
        }
        input {
            width: 50%;
            padding: 20px;
            text-align: center;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 25px;
            background-color: rgb(129, 124, 121);
            position: relative;
            left: 50%;
            transform: translateX(-50%);
            display: block;
        }
        ::placeholder{
            color: black;
            font-family: 'Roboto', sans-serif;
            font-weight: bold;
        }
        input::placeholder {
            transition: transform 0.2s ease-out;
        }
        input:focus::placeholder {
            transform: translateY(-20px);
            font-size: 0.8em;
            color: #f9f9f9;
            font-weight: bold;
        }
        .form-group {
            position: relative;
        }
        .form-group label {
            position: absolute;
            left: 8px;
            top: 50%;
            transform: translateY(-50%);
            transition: all 0.3s ease;
            pointer-events: none;
            color: #d71010;
            background: transparent;
            z-index: 1;
        }
        input:focus + label,
        input:not(:placeholder-shown) + label {
            top: -5px;
            font-size: 12px;
            color: #4CAF50;
            background: white;
            padding: 0 5px;
        }
        button {
            width: 60%;
            padding: 10px;
            background-color: rgb(129, 124, 121);
            color: white;
            border: none;
            border-radius: 25px; 
            cursor: pointer;
            display: block;
            margin: 0 auto;
            font-size: large;
            font-weight: bold;
            position: relative;
            left: 0%;
            transform: translateX(-1%);
            display: block;
           
        }
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap');
        
        h2 {
            color: #fffcfc;
            margin-bottom: 20px;
            text-align: left;
            margin-left: -30px;
        }
        
       
        
        .form-group label {
            color: #666;
            font-size: 0.9em;
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