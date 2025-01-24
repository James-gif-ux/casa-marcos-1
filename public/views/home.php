<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casa Marcos - Welcome</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
        font-size: 16px;
    }

    header {
        position: fixed;
        padding: 1.5rem;
        width: 100%;
        display: flex;
        justify-content: center;
        z-index: 1000;
    }

    nav {
      
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
    }

    .logo h1 {
        color: rgb(163, 99, 15);
        font-size: 2rem;
    }

    nav ul {
        display: flex;
        list-style: none;
        gap: 1rem;
    }

    nav ul li a {
        color:rgb(163, 99, 15) ;
        text-decoration: none;
        padding: 0.7rem 1.2rem;
        transition: background-color 0.3s;
        border-radius: 4px;
    }

    nav ul li a:hover {
        background-color: #34495e;
    }

    .hero {
        text-align: center;
        padding: 28rem;
        background-color: #f8f9fa;
    }

    .cta-button {
        display: inline-block;
        padding: 1rem 2.5rem;
        background-color: #2c3e50;
        color: #fff;
        text-decoration: none;
        border-radius: 25px;
        margin-top: 2rem;
        transition: background-color 0.3s;
    }

    .cta-button:hover {
        background-color: #c0392b;
    }

    .features {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 3rem;
        padding: 5rem 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .feature {
        text-align: center;
        padding: 2.5rem;
        background-color: #fff;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        border-radius: 8px;
        transition: transform 0.3s;
    }

    .feature:hover {
        transform: translateY(-5px);
    }

    footer {
        background-color: #2c3e50;
        color: #fff;
        text-align: center;
        padding: 1.5rem;
        margin-top: 2rem;
    }
</style>

<body>
    <header>
        <nav>
            <ul style="width: 100%; align-items: center;">
                <li><a href="/">Our Rooms</a></li>
                <li><a href="/menu">Offer</a></li>
                <div class="logo" style="margin: 0 2rem;">
                    <h1 style="text-align: center; line-height: 1.2;">CASA MARCOS
                        <span style="display: block; font-size: 1rem;">RESORT AND VILLAS</span>
                    </h1>
                </div>
                <li><a href="/reservations">About Us</a></li>
                <li><a href="/contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="hero" style="background-image: url('../images/11.jpg'); background-size: cover; background-position: center; color: white;">
            <h2>Welcome to Casa Marcos</h2>
            <p>Experience authentic Spanish cuisine in a warm, family atmosphere</p>
            <a href="/reservations" class="cta-button">Make a Reservation</a>
        </section>

        <section class="features">
            <div class="feature">
                <h3>Our Menu</h3>
                <p>Discover our traditional Spanish dishes</p>
            </div>
            <div class="feature">
                <h3>Special Events</h3>
                <p>Host your next celebration with us</p>
            </div>
            <div class="feature">
                <h3>Location</h3>
                <p>Find us in the heart of the city</p>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Casa Marcos. All rights reserved.</p>
    </footer>
</body>
</html>
