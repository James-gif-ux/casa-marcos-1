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
        line-height: 1.4;
        font-size: 16px;
    }

    header {
        position: fixed;
        padding: 1.5rem;
        width: 100%;
        display: flex;
        justify-content: center;
        z-index: 1000;
        background-color: transparent;
        transition: background-color 0.5s ease;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    header.scrolled {
        background-color: #2c3e50;
    }

    nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
    }

    .logo h1 {
        color: rgb(102, 67, 35);
        font-size: 3.8rem;
        font-family: impact;
        letter-spacing: 1px;
    }

    nav ul {
        display: flex;
        list-style: none;
        gap: 1.5rem;
    }

    nav ul li {
        position: relative;
    }

    nav ul li a {
        color: rgb(102, 67, 35);
        text-decoration: none;
        padding: 0.8rem 1.5rem;
        font-size: 1rem;
        font-family: impact;
        text-transform: uppercase;
        transition: background-color 0.3s, transform 0.3s;
        border-radius: 4px;
    }

    nav ul li a:hover {
        background-color: #34495e;
        color: #fff;
        transform: scale(1.05);
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background-color: #fff;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        border-radius: 4px;
        z-index: 1;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease-in-out, visibility 0s 0.3s;
    }

    .dropdown-menu a {
        color: rgb(163, 99, 15);
        padding: 0.7rem 1.2rem;
        text-decoration: none;
        display: block;
        transition: background-color 0.3s;
    }

    .dropdown-menu a:hover {
        background-color: #34495e;
        color: #fff;
    }

    nav ul li:hover .dropdown-menu {
        display: block;
        opacity: 1;
        visibility: visible;
        transition: opacity 0.3s ease-in-out;
    }

    .hero {
        text-align: center;
        padding: 13rem;
        background-image: url('../images/11.jpg');
        background-size: cover;
        background-position: center;
        color: white;
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
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
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
      
    }

    input, select {
        font-family: 'Arial', sans-serif;
        padding: 0.8rem;
        border-radius: 4px;
        width: 100%;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    input:focus, select:focus {
        border-color: rgb(163, 99, 15);
        outline: none;
    }

    button {
        display: inline-block;
        padding: 1rem 2.5rem;
        background-color: #2c3e50;
        color: white;
        border: none;
        border-radius: 25px;
        font-size: 1.1rem;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.3s;
    }

    button:hover {
        background-color: #c0392b;
        transform: translateY(-2px);
    }

    .search-box {
        max-width: 600px;
        margin: 4rem auto;
        background-color: #fff;
        padding: 3rem;
        border-radius: 8px;
        box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .search-box h2 {
        margin-bottom: 1.5rem;
        font-size: 1.8rem;
        color: #2c3e50;
    }

    .search-box div {
        margin-bottom: 1.5rem;
        text-align: left;
    }

    .search-box div label {
        display: block;
        font-size: 1rem;
        margin-bottom: 0.5rem;
        color: #555;
    }

    .search-box div input,
    .search-box div select {
        font-size: 1rem;
        padding: 1rem;
        width: 100%;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #fafafa;
        transition: border-color 0.3s;
    }

    .search-box div input:focus,
    .search-box div select:focus {
        border-color: #2c3e50;
        outline: none;
    }

    .cta-button {
        width: 100%;
        padding: 1rem 2.5rem;
        background-color: #2c3e50;
        color: #fff;
        text-decoration: none;
        border-radius: 25px;
        font-size: 1.1rem;
        margin-top: 1.5rem;
        transition: background-color 0.3s, transform 0.3s;
    }

    .cta-button:hover {
        background-color: #c0392b;
        transform: scale(1.05);
    }

</style>

<body>
    <header>
        <nav>
            <ul style="width: 100%; align-items: center;">
                <li>
                    <a href="#">Our Rooms</a>
                </li>
                <li>
                    <a href="#">Offer</a>
                    <div class="dropdown-menu">
                        <a href="/menu">Menu</a>
                        <a href="/specials">Special Offers</a>
                        <a href="/events">Events</a>
                    </div>
                </li>
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
        <section class="hero">
        <div class="search-box">
            <h2>Book Your Stay</h2>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                <div class="mb-4">
                    <label for="checkin">Check-in *</label>
                    <input type="date" id="checkin" required />
                </div>
                <div class="mb-4">
                    <label for="checkout">Check-out *</label>
                    <input type="date" id="checkout" required />
                </div>
                <div class="mb-4">
                    <label for="guests">Guests</label>
                    <select id="guests">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>
            <button class="cta-button">Search</button>
        </div>
        </section>


    </main>

    <footer>
        <p>&copy; 2025 Casa Marcos. All rights reserved.</p>
    </footer>

    <script>
        window.addEventListener('scroll', function() {
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>
