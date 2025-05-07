<?php
session_start();
require 'db_config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Chandni's Kitchen | Reservation</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        /* Reservation form */
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h2 {
            color: #2a5c40;
            text-align: center;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        textarea {
            resize: vertical;
        }

        button {
            width: 100%;
            background-color: #2a5c40;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            margin-top: 25px;
            cursor: pointer;
        }

        button:hover {
            background-color: #1e4530;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
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

            .container {
                margin: 30px 20px;
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
                <li><a href="order.php">Order</a></li>
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

<div class="container">
    <h2>Book a Table</h2>

    <?php
    if (isset($_GET['success']) && isset($_SESSION['reservation_success'])) {
        echo "<div class='alert-success'>Your table has been successfully reserved!</div>";
        unset($_SESSION['reservation_success']);
    }
    ?>

    <form action="submit_reservation.php" method="POST" onsubmit="return validateForm()">
        <label for="name">Full Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="email">Email Address:</label>
        <input type="email" name="email" id="email" required>

        <label for="contact">Contact Number:</label>
        <input type="tel" name="contact" id="contact" required pattern="[0-9]{10}" placeholder="1234567890">

        <label for="date">Reservation Date:</label>
        <input type="date" name="date" id="date" required min="<?php echo date('Y-m-d'); ?>">

        <label for="time">Time:</label>
        <select name="time" id="time" required>
            <option value="">Select time</option>
            <?php for ($i = 11; $i <= 22; $i++): ?>
                <option><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?>:00</option>
            <?php endfor; ?>
        </select>

        <label for="people">Number of People:</label>
        <input type="number" name="people" id="people" min="1" max="20" required>

        <label for="special_requests">Special Requests:</label>
        <textarea name="special_requests" id="special_requests" rows="4" placeholder="E.g., Window seat, high chair for baby, allergy notice..."></textarea>

        <button type="submit">Reserve Now</button>
    </form>
</div>

<footer>
    <div class="footer-container">
        <div class="footer-column">
            <h3>Contact Us</h3>
            <p>123 Food Street, London, UK</p>
            <p>+44 1234 567890</p>
            <p>info@chandniskitchen.com</p>
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
function validateForm() {
    const dateField = document.getElementById('date');
    const today = new Date().toISOString().split('T')[0];
    if (dateField.value < today) {
        alert("Please select a valid future date.");
        return false;
    }
    return true;
}
</script>

</body>
</html>
