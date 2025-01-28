<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
    :root {
        --primary:rgb(88, 74, 61));
        --secondary: #4ecdc4;
        --bg-gradient: linear-gradient(45deg,rgb(218, 191, 156),rgb(88, 74, 61));
        --glass-bg: rgba(255, 255, 255, 0.1);
        --glass-border: rgba(255, 255, 255, 0.2);
        --text-primary: #2d3436;
        --text-secondary: #636e72;
        --error-color: #ff4757;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', system-ui, sans-serif;
    }

    body {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--bg-gradient);
        padding: 20px;
    }

    .background-shapes {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: -1;
    }

    .shape {
        position: absolute;
        background: var(--glass-bg);
        border-radius: 50%;
        animation: float 20s infinite linear;
    }

    .shape:nth-child(1) {
        width: 200px;
        height: 200px;
        top: 10%;
        left: 10%;
        animation-delay: -2s;
    }

    .shape:nth-child(2) {
        width: 300px;
        height: 300px;
        top: 60%;
        right: 10%;
        animation-delay: -4s;
    }

    .shape:nth-child(3) {
        width: 150px;
        height: 150px;
        bottom: 10%;
        left: 30%;
        animation-delay: -6s;
    }

    @keyframes float {
        0% { transform: translate(0, 0) rotate(0deg); }
        50% { transform: translate(100px, 100px) rotate(180deg); }
        100% { transform: translate(0, 0) rotate(360deg); }
    }

    .container {
        width: 100%;
        max-width: 900px;
        height: 600px;
        display: flex;
        border-radius: 20px;
        overflow: hidden;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid var(--glass-border);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.2);
    }

    .left-panel {
        flex: 1;
        padding: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        background: rgba(255, 255, 255, 0.05);
    }

    .brand-content {
        text-align: center;
        color: white;
    }

    .brand-content h1 {
        font-size: 3em;
        margin-bottom: 20px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }

    .form-container {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .login-form {
        flex: 1;
        padding: 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background: rgba(255, 255, 255, 0.9);
    }

    h2 {
        color:rgb(73, 63, 57);
        font-size: 2em;
        margin-bottom: 30px;
        font-weight: 600;
        font-family: impact;
    }

    .input-group {
        margin-bottom: 25px;
        position: relative;
    }

    input {
        width: 100%;
        padding: 15px;
        border: 2px solid transparent;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 12px;
        font-size: 16px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    input:focus {
        outline: none;
        border-color: var(--primary);
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    button {
        background: var(--bg-gradient);
        color: white;
        border: none;
        padding: 15px;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .forgot-password {
        text-align: right;
        margin: 15px 0 25px;
    }

    .forgot-password a {
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .forgot-password a:hover {
        color: var(--secondary);
    }

    .error-message {
        background: rgba(255, 71, 87, 0.1);
        color: var(--error-color);
        padding: 12px;
        border-radius: 8px;
        margin-top: 15px;
        text-align: center;
        font-size: 14px;
        border: 1px solid rgba(255, 71, 87, 0.2);
    }
    .brand-logo {
    margin-bottom: 30px;
    }

    .brand-logo img {
        max-width: 150px;  /* Adjust this value based on your image size */
        height: auto;
        /* Add a subtle glow effect to make the logo stand out */
        filter: drop-shadow(0 0 10px rgba(255, 255, 255, 0.3));
    }

    /* Enhance the existing left-panel styles */
    .left-panel {
        flex: 1;
        padding: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        background: rgba(255, 255, 255, 0.05);
        /* Add a subtle gradient overlay */
        background-image: linear-gradient(
            rgba(255, 255, 255, 0.05),
            rgba(255, 255, 255, 0.1)
        );
        }
        .left-panel {
        flex: 1;
        padding: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        background: url('./images/11.jpg') center center/cover;
    }

    .panel-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4); /* Darkens the image for better text readability */
        backdrop-filter: blur(2px);      /* Adds a slight blur effect */
    }

    .brand-content {
        position: relative;  /* Ensures content stays above the overlay */
        z-index: 1;         /* Places content above the overlay */
    }
    </style>
</head>
<body>
    <div class="background-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="container">
        <div class="left-panel">
            <div class="brand-content">
            </div>
        </div>
        <div class="form-container">
        <form method="POST" action="./pages/authentication.php?sub_page=login" class="login-form">
                <?php
                    // Generate and store CSRF token in session
                    if (!isset($_SESSION['csrf_token'])) {
                        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                    }
                ?>
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                <h2>ADMINISTRATOR</h2>
                <div class="input-group">
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit">Log in</button>
                
                <?php if(isset($_SESSION['error'])): ?>
                    <div class="error-message">
                        <?php 
                            echo htmlspecialchars($_SESSION['error']); 
                            unset($_SESSION['error']); 
                        ?>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</body>
</html>