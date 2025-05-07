<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Menu | Chandni's Kitchen</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Global styles */
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

        /* Header & Navbar */
        header {
            background-color: #2a5c40;
            color: white;
            padding: 15px 0;
        }

        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
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

        /* Menu Content */
        .content {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }

        h1 {
            color: #2a5c40;
            margin-bottom: 30px;
            text-align: center;
        }

        h2 {
            color: #2a5c40;
            margin-top: 40px;
            border-bottom: 2px solid #d4af37;
            padding-bottom: 10px;
        }

        .dish {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            display: flex;
            overflow: hidden;
            transition: transform 0.3s;
        }

        .dish:hover {
            transform: translateY(-5px);
        }

        .dish img {
            width: 200px;
            object-fit: cover;
        }

        .dish-info {
            padding: 20px;
            flex: 1;
        }

        .dish-info h3 {
            color: #2a5c40;
            margin-top: 0;
            font-size: 20px;
        }

        .dish-info p {
            color: #666;
            margin: 10px 0;
        }

        .portion-options {
            display: flex;
            gap: 20px;
            margin: 10px 0;
        }

        .portion {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .portion-type {
            font-weight: bold;
            color: #2a5c40;
        }

        .price {
            color: #d4af37;
            font-weight: bold;
            font-size: 16px;
        }

        .extra-items {
            color: #888;
            font-style: italic;
            margin-top: 10px;
            font-size: 14px;
        }
        
        .button {
        padding: 10px 20px;
        background-color: #2a5c40;
        color: white;
        font-size: 18px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #1e4530;
        }

        /* Footer */
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

            .dish {
                flex-direction: column;
            }

            .dish img {
                width: 100%;
                height: 200px;
            }

            .portion-options {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
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
    <div class="content">
        <h1>Our Full Menu</h1>

        <!-- Main Course Section -->
        <h2>Main Courses</h2>

        <div class="dish">
            <img src="dish1.jpg" alt="Butter Chicken">
            <div class="dish-info">
                <h3>Butter Chicken</h3>
                <p>Tender chicken in a creamy tomato gravy.</p>
                <div class="portion-options">
                    <div class="portion">
                        <span class="portion-type">Half:</span>
                        <span class="price">£8.99</span>
                    </div>
                    <div class="portion">
                        <span class="portion-type">Full:</span>
                        <span class="price">£12.99</span>
                    </div>
                </div>
                <div class="extra-items">
                    <p>Add-ons: Rice (£2.50), Naan (£1.50), Salad (£1.00)</p>
                </div>
            </div>
        </div>

        <div class="dish">
            <img src="dish2.jpg" alt="Vegetable Biryani">
            <div class="dish-info">
                <h3>Vegetable Biryani</h3>
                <p>Fragrant rice cooked with seasonal vegetables, spices and special biryani masala.</p>
                <div class="portion-options">
                    <div class="portion">
                        <span class="portion-type">Half:</span>
                        <span class="price">£7.50</span>
                    </div>
                    <div class="portion">
                        <span class="portion-type">Full:</span>
                        <span class="price">£10.99</span>
                    </div>
                </div>
                <div class="extra-items">
                    <p>Add-ons: Raita (£1.00), Papadum (£0.80), Salad (£1.00)</p>
                </div>
            </div>
        </div>

        <div class="dish">
            <img src="dish3.jpg" alt="Chicken Biryani">
            <div class="dish-info">
                <h3>Chicken Biryani</h3>
                <p>Fragrant rice cooked with chicken, spices and special biryani masala.</p>
                <div class="portion-options">
                    <div class="portion">
                        <span class="portion-type">Half:</span>
                        <span class="price">£10.50</span>
                    </div>
                    <div class="portion">
                        <span class="portion-type">Full:</span>
                        <span class="price">£14.99</span>
                    </div>
                </div>
                <div class="extra-items">
                    <p>Add-ons: Rice (£2.50), Naan (£1.50), Salad (£1.00)</p>
                </div>
            </div>
        </div>

        <div class="dish">
            <img src="dish4.jpg" alt="Roasted Chicken">
            <div class="dish-info">
                <h3>Roasted Chicken</h3>
                <p>Marinated and oven-roasted to perfection with Indian herbs.</p>
                <div class="portion-options">
                    <div class="portion">
                        <span class="portion-type">Half:</span>
                        <span class="price">£7.99</span>
                    </div>
                    <div class="portion">
                        <span class="portion-type">Full:</span>
                        <span class="price">£11.99</span>
                    </div>
                </div>
                <div class="extra-items">
                    <p>Add-ons: Gravy (£2.00), Salad (£1.00)</p>
                </div>
            </div>
        </div>

        <div class="dish">
            <img src="dish5.jpg" alt="Chicken Curry">
            <div class="dish-info">
                <h3>Chicken Curry</h3>
                <p>Classic chicken curry with a rich onion-tomato base and bold spices.</p>
                <div class="portion-options">
                    <div class="portion">
                        <span class="portion-type">Half:</span>
                        <span class="price">£7.99</span>
                    </div>
                    <div class="portion">
                        <span class="portion-type">Full:</span>
                        <span class="price">£11.49</span>
                    </div>
                </div>
                <div class="extra-items">
                    <p>Add-ons: Rice (£2.50), Naan (£1.50), Salad (£1.00)</p>
                </div>
            </div>
        </div>

        <!-- Drinks Section -->
        <h2>Drinks</h2>

        <div class="dish">
            <img src="cans.jpg" alt="Soft Drink Cans">
            <div class="dish-info">
                <h3>Cans</h3>
                <p>Choice of Coke, Diet Coke, Sprite, Fanta, etc.</p>
                <div class="price">£1.20</div>
                <div class="extra-items">
                    <p>Add-ons: Ice (£0.30)</p>
                </div>
            </div>
        </div>

        <div class="dish">
            <img src="bottles.jpg" alt="Soft Drink Bottles">
            <div class="dish-info">
                <h3>Bottles</h3>
                <p>500ml bottles of chilled soft drinks.</p>
                <div class="price">£1.80</div>
                <div class="extra-items">
                    <p>Add-ons: Ice (£0.30)</p>
                </div>
            </div>
        </div>
    </div>

  
    <div style="text-align: center; margin-top: 40px; margin-bottom: 40px;">
        <a href="order.php" class="button">Place an Order</a>
    </div>

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
</body>
</html>
