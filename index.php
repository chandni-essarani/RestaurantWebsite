<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Chandni's Kitchen | Authentic Indian Cuisine</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: #f8f8f8;
            color: #333;
        }

        header {
            background-color: #2a5c40;
            color: white;
            padding: 15px 0;
            position: relative;
        }

        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #fff;
            text-decoration: none;
        }

        nav ul {
            display: flex;
            list-style: none;
        }

        nav ul li {
            margin-left: 30px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            color: #d4af37;
        }

        .slider-container {
            position: relative;
            max-width: 100%;
            overflow: hidden;
            height: 500px;
        }

        .slider {
            display: flex;
            transition: transform 0.5s ease-in-out;
            height: 100%;
        }

        .slide {
            min-width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .slide-content {
            position: absolute;
            bottom: 50px;
            left: 50px;
            background-color: rgba(42, 92, 64, 0.8);
            color: white;
            padding: 20px;
            max-width: 400px;
        }

        .slide-content h2 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .slider-nav {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
        }

        .slider-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.5);
            margin: 0 5px;
            cursor: pointer;
        }

        .slider-dot.active {
            background-color: white;
        }

        .menu-preview {
            padding: 60px 20px;
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .menu-preview h2 {
            color: #2a5c40;
            font-size: 32px;
            margin-bottom: 40px;
        }

        .menu-items {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .menu-item {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }

        .menu-item:hover {
            transform: translateY(-5px);
        }

        .menu-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .menu-item-content {
            padding: 20px;
        }

        .menu-item h3 {
            color: #2a5c40;
            margin-bottom: 10px;
        }

        .menu-item p {
            color: #666;
            margin-bottom: 15px;
        }

        .price {
            font-weight: bold;
            color: #d4af37;
            font-size: 18px;
        }

        .btn {
            display: inline-block;
            background-color: #2a5c40;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #1e4530;
        }

        footer {
            background-color: #2a5c40;
            color: white;
            padding: 40px 20px;
            text-align: center;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            text-align: left;
        }

        .footer-column h3 {
            font-size: 20px;
            margin-bottom: 20px;
            color: #d4af37;
        }

        .footer-column p, .footer-column a {
            margin-bottom: 10px;
            display: block;
            color: #eee;
            text-decoration: none;
        }

        .footer-column a:hover {
            color: #d4af37;
        }

        .copyright {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                text-align: center;
            }

            nav ul {
                margin-top: 20px;
                flex-wrap: wrap;
                justify-content: center;
            }

            nav ul li {
                margin: 0 10px 10px;
            }

            .slider-container {
                height: 400px;
            }

            .slide-content {
                left: 20px;
                bottom: 20px;
                max-width: 80%;
            }
        }
    </style>
</head>
<body>
<!-- Header -->
<header>
    <div class="header-container">
        <a href="index.php" class="logo">Chandni's Kitchen</a>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="order.php">Order</a></li> <!-- Added Order link for all users -->
                <li><a href="reservation.php">Reservation</a></li>
                <?php if (isset($_SESSION['logged_in'])): ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>

    <!-- Hero Slider -->
    <div class="slider-container">
        <div class="slider">
            <div class="slide" style="background-image: url('kitchen1.jpg');">
                <div class="slide-content">
                    <h2>Authentic Indian Cuisine</h2>
                    <p>Experience the rich flavors and spices of traditional Indian cooking</p>
                </div>
            </div>
            <div class="slide" style="background-image:url('kitchen2.jpg');">
                <div class="slide-content">
                    <h2>Fresh Ingredients</h2>
                    <p>We use only the freshest ingredients prepared daily</p>
                </div>
            </div>
            <div class="slide" style="background-image: url('kitchen3.jpg');">
                <div class="slide-content">
                    <h2>Family Recipes</h2>
                    <p>Generations of family recipes passed down with love</p>
                </div>
            </div>
        </div>
        <div class="slider-nav">
            <div class="slider-dot active"></div>
            <div class="slider-dot"></div>
            <div class="slider-dot"></div>
        </div>
    </div>

    <!-- Menu Preview Section -->
    <section class="menu-preview">
        <h2>Our Popular Dishes</h2>
        <div class="menu-items">
            <div class="menu-item">
                <img src="dish1.jpg" alt="Butter Chicken">
                <div class="menu-item-content">
                    <h3>Butter Chicken</h3>
                    <p>Tender chicken in a rich, creamy tomato sauce with aromatic spices</p>
                    <div class="portion">
                        <span class="portion-type">Half:</span>
                        <span class="price">£8.99</span>
                    </div>
                    <div class="portion">
                        <span class="portion-type">Full:</span>
                        <span class="price">£12.99</span>
                    </div>
                </div>
            </div>
            <div class="menu-item">
                <img src="dish2.jpg" alt="Vegetable Biryani">
                <div class="menu-item-content">
                    <h3>Vegetable Biryani</h3>
                    <p>Fragrant basmati rice cooked with mixed vegetables and exotic spices</p>
                    <div class="portion">
                        <span class="portion-type">Half:</span>
                        <span class="price">£7.50</span>
                    </div>
                    <div class="portion">
                        <span class="portion-type">Full:</span>
                        <span class="price">£10.99</span>
                    </div>
                </div>
            </div>
            <div class="menu-item">
                <img src="dish3.jpg" alt="Chicken Biryani">
                <div class="menu-item-content">
                    <h3>Chicken Biryani</h3>
                    <p>Fragrant rice cooked with chicken, spices and special biryani masala.</p>
                    <div class="portion">
                        <span class="portion-type">Half:</span>
                        <span class="price">£10.50</span>
                    </div>
                    <div class="portion">
                        <span class="portion-type">Full:</span>
                        <span class="price">£14.99</span>
                    </div>
                </div>
            </div>
        </div>
        <a href="menu.php" class="btn">View Full Menu</a>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-column">
                <h3>Contact Us</h3>
                <p><i class="fas fa-map-marker-alt"></i> 123 Food Street, London, UK</p>
                <p><i class="fas fa-phone"></i> +44 1234 567890</p>
                <p><i class="fas fa-envelope"></i> info@chandniskitchen.com</p>
            </div>
            <div class="footer-column">
                <h3>Opening Hours</h3>
                <p>Monday - Friday: 11am - 10pm</p>
                <p>Saturday: 11am - 11pm</p>
                <p>Sunday: 12pm - 9pm</p>
            </div>
            <div class="footer-column">
                <h3>Quick Links</h3>
                <a href="index.php">Home</a>
                <a href="menu.php">Menu</a>
                <a href="reservation.php">Reservation</a>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; <?php echo date("Y"); ?> Chandni's Kitchen. All rights reserved.</p>
        </div>
    </footer>

    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.slider-dot');
        const totalSlides = slides.length;

        function showSlide(index) {
            if (index >= totalSlides) {
                currentSlide = 0;
            } else if (index < 0) {
                currentSlide = totalSlides - 1;
            } else {
                currentSlide = index;
            }

            document.querySelector('.slider').style.transform = `translateX(-${currentSlide * 100}%)`;

            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === currentSlide);
            });
        }

        setInterval(() => {
            showSlide(currentSlide + 1);
        }, 5000);

        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => {
                showSlide(i);
            });
        });
    </script>
</body>
</html>