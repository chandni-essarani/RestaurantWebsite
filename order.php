<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Place Order | Chandni's Kitchen</title>
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
            height: 200px;
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

        .price {
            color: #d4af37;
            font-weight: bold;
            font-size: 16px;
        }

        /* Form elements */
        label {
            display: block;
            margin: 5px 0;
        }

        .quantity-selector {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 10px 0;
        }

        input[type="number"] {
            width: 60px;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        textarea, input[type="text"], input[type="tel"], input[type="email"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-top: 5px;
        }

        .addon-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 8px 0;
            padding: 8px;
            background: #f9f9f9;
            border-radius: 4px;
        }

        .addon-info {
            display: flex;
            align-items: center;
            gap: 10px;
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

        .payment-options {
            margin: 15px 0;
        }
        
        .payment-options label {
            display: flex;
            align-items: center;
            margin: 10px 0;
            cursor: pointer;
        }
        
        .payment-options input[type="radio"] {
            width: auto;
            margin: 0;
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
                height: 250px;
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

    <div class="content">
        <h1>Place Your Order</h1>

        <?php if (isset($_SESSION['logged_in'])): ?>
            <div style="background-color: #e8f5e9; color: #2a5c40; padding: 15px; border-radius: 4px; margin-bottom: 20px; text-align: center;">
                <i class="fas fa-star"></i> You're logged in as a member and will receive 10% discount on your order!
            </div>
        <?php endif; ?>

        <form action="order_confirmation.php" method="POST">
            <!-- Main Courses Section -->
            <h2>Main Courses</h2>

            <!-- Butter Chicken -->
            <div class="dish">
                <img src="dish1.jpg" alt="Butter Chicken">
                <div class="dish-info">
                    <h3>Butter Chicken</h3>
                    <p>Tender chicken in a creamy tomato gravy.</p>

                    <div class="quantity-selector">
                        <label><strong>Half Portion (£8.99):</strong></label>
                        <input type="number" name="butter_chicken_half" min="0" value="0">
                    </div>

                    <div class="quantity-selector">
                        <label><strong>Full Portion (£12.99):</strong></label>
                        <input type="number" name="butter_chicken_full" min="0" value="0">
                    </div>

                    <h4 style="margin-top: 15px; color: #2a5c40;">Add-ons:</h4>
                    <div class="addon-item">
                        <div class="addon-info">
                            <input type="number" name="butter_chicken_rice_qty" min="0" value="0">
                            <span>Rice (£2.50 each)</span>
                        </div>
                    </div>
                    <div class="addon-item">
                        <div class="addon-info">
                            <input type="number" name="butter_chicken_naan_qty" min="0" value="0">
                            <span>Naan (£1.50 each)</span>
                        </div>
                    </div>
                    <div class="addon-item">
                        <div class="addon-info">
                            <input type="number" name="butter_chicken_salad_qty" min="0" value="0">
                            <span>Salad (£1.00 each)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vegetable Biryani -->
            <div class="dish">
                <img src="dish2.jpg" alt="Vegetable Biryani">
                <div class="dish-info">
                    <h3>Vegetable Biryani</h3>
                    <p>Fragrant rice cooked with seasonal vegetables, spices and special biryani masala.</p>

                    <div class="quantity-selector">
                        <label><strong>Half Portion (£7.50):</strong></label>
                        <input type="number" name="vegetable_biryani_half" min="0" value="0">
                    </div>

                    <div class="quantity-selector">
                        <label><strong>Full Portion (£10.99):</strong></label>
                        <input type="number" name="vegetable_biryani_full" min="0" value="0">
                    </div>

                    <h4 style="margin-top: 15px; color: #2a5c40;">Add-ons:</h4>
                    <div class="addon-item">
                        <div class="addon-info">
                            <input type="number" name="vegetable_biryani_raita_qty" min="0" value="0">
                            <span>Raita (£1.00 each)</span>
                        </div>
                    </div>
                    <div class="addon-item">
                        <div class="addon-info">
                            <input type="number" name="vegetable_biryani_papadum_qty" min="0" value="0">
                            <span>Papadum (£0.80 each)</span>
                        </div>
                    </div>
                    <div class="addon-item">
                        <div class="addon-info">
                            <input type="number" name="vegetable_biryani_salad_qty" min="0" value="0">
                            <span>Salad (£1.00 each)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chicken Biryani -->
            <div class="dish">
                <img src="dish3.jpg" alt="Chicken Biryani">
                <div class="dish-info">
                    <h3>Chicken Biryani</h3>
                    <p>Fragrant rice cooked with chicken, spices and special biryani masala.</p>

                    <div class="quantity-selector">
                        <label><strong>Half Portion (£10.50):</strong></label>
                        <input type="number" name="chicken_biryani_half" min="0" value="0">
                    </div>

                    <div class="quantity-selector">
                        <label><strong>Full Portion (£14.99):</strong></label>
                        <input type="number" name="chicken_biryani_full" min="0" value="0">
                    </div>

                    <h4 style="margin-top: 15px; color: #2a5c40;">Add-ons:</h4>
                    <div class="addon-item">
                        <div class="addon-info">
                            <input type="number" name="chicken_biryani_rice_qty" min="0" value="0">
                            <span>Rice (£2.50 each)</span>
                        </div>
                    </div>
                    <div class="addon-item">
                        <div class="addon-info">
                            <input type="number" name="chicken_biryani_naan_qty" min="0" value="0">
                            <span>Naan (£1.50 each)</span>
                        </div>
                    </div>
                    <div class="addon-item">
                        <div class="addon-info">
                            <input type="number" name="chicken_biryani_salad_qty" min="0" value="0">
                            <span>Salad (£1.00 each)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Roasted Chicken -->
            <div class="dish">
                <img src="dish4.jpg" alt="Roasted Chicken">
                <div class="dish-info">
                    <h3>Roasted Chicken</h3>
                    <p>Marinated and oven-roasted to perfection with Indian herbs.</p>

                    <div class="quantity-selector">
                        <label><strong>Half Portion (£7.99):</strong></label>
                        <input type="number" name="roasted_chicken_half" min="0" value="0">
                    </div>

                    <div class="quantity-selector">
                        <label><strong>Full Portion (£11.99):</strong></label>
                        <input type="number" name="roasted_chicken_full" min="0" value="0">
                    </div>

                    <h4 style="margin-top: 15px; color: #2a5c40;">Add-ons:</h4>
                    <div class="addon-item">
                        <div class="addon-info">
                            <input type="number" name="roasted_chicken_gravy_qty" min="0" value="0">
                            <span>Gravy (£2.00 each)</span>
                        </div>
                    </div>
                    <div class="addon-item">
                        <div class="addon-info">
                            <input type="number" name="roasted_chicken_salad_qty" min="0" value="0">
                            <span>Salad (£1.00 each)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chicken Curry -->
            <div class="dish">
                <img src="dish5.jpg" alt="Chicken Curry">
                <div class="dish-info">
                    <h3>Chicken Curry</h3>
                    <p>Classic chicken curry with a rich onion-tomato base and bold spices.</p>

                    <div class="quantity-selector">
                        <label><strong>Half Portion (£7.99):</strong></label>
                        <input type="number" name="chicken_curry_half" min="0" value="0">
                    </div>

                    <div class="quantity-selector">
                        <label><strong>Full Portion (£11.49):</strong></label>
                        <input type="number" name="chicken_curry_full" min="0" value="0">
                    </div>

                    <h4 style="margin-top: 15px; color: #2a5c40;">Add-ons:</h4>
                    <div class="addon-item">
                        <div class="addon-info">
                            <input type="number" name="chicken_curry_rice_qty" min="0" value="0">
                            <span>Rice (£2.50 each)</span>
                        </div>
                    </div>
                    <div class="addon-item">
                        <div class="addon-info">
                            <input type="number" name="chicken_curry_naan_qty" min="0" value="0">
                            <span>Naan (£1.50 each)</span>
                        </div>
                    </div>
                    <div class="addon-item">
                        <div class="addon-info">
                            <input type="number" name="chicken_curry_salad_qty" min="0" value="0">
                            <span>Salad (£1.00 each)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Drinks Section -->
            <h2>Cans (330ml) - £1.20 each</h2>
            <div class="dish">
                <img src="cans.jpg" alt="Soft Drink Cans">
                <div class="dish-info">
                    <h3>Soft Drink Cans</h3>
                    <p>Choice of chilled soft drinks in cans</p>
                    
                    <div class="quantity-selector">
                        <label><strong>Coke:</strong></label>
                        <input type="number" name="coke_cans" min="0" value="0">
                    </div>
                    
                    <div class="quantity-selector">
                        <label><strong>Diet Coke:</strong></label>
                        <input type="number" name="diet_coke_cans" min="0" value="0">
                    </div>
                    
                    <div class="quantity-selector">
                        <label><strong>Sprite:</strong></label>
                        <input type="number" name="sprite_cans" min="0" value="0">
                    </div>
                    
                    <div class="quantity-selector">
                        <label><strong>Fanta:</strong></label>
                        <input type="number" name="fanta_cans" min="0" value="0">
                    </div>
                    
                    <div class="quantity-selector">
                        <label><strong>Ice (per can):</strong></label>
                        <input type="number" name="can_ice_qty" min="0" value="0">
                        <span>(£0.30 each)</span>
                    </div>
                </div>
            </div>

            <h2>Bottles (500ml) - £1.80 each</h2>
            <div class="dish">
                <img src="bottles.jpg" alt="Soft Drink Bottles">
                <div class="dish-info">
                    <h3>Soft Drink Bottles</h3>
                    <p>Choice of chilled soft drinks in bottles</p>
                    
                    <div class="quantity-selector">
                        <label><strong>Coke:</strong></label>
                        <input type="number" name="coke_bottles" min="0" value="0">
                    </div>
                    
                    <div class="quantity-selector">
                        <label><strong>Diet Coke:</strong></label>
                        <input type="number" name="diet_coke_bottles" min="0" value="0">
                    </div>
                    
                    <div class="quantity-selector">
                        <label><strong>Sprite:</strong></label>
                        <input type="number" name="sprite_bottles" min="0" value="0">
                    </div>
                    
                    <div class="quantity-selector">
                        <label><strong>Fanta:</strong></label>
                        <input type="number" name="fanta_bottles" min="0" value="0">
                    </div>
                    
                    <div class="quantity-selector">
                        <label><strong>Ice (per bottle):</strong></label>
                        <input type="number" name="bottle_ice_qty" min="0" value="0">
                        <span>(£0.30 each)</span>
                    </div>
                </div>
            </div>

            <!-- Delivery Option -->
            <h2>Delivery Options</h2>
            <div class="dish">
                <div class="dish-info">
                    <label><strong>Select Delivery Method:</strong></label>
                    <label><input type="radio" name="delivery" value="Pickup" required checked> Pickup (Free)</label>
                    <label><input type="radio" name="delivery" value="Delivery"> Home Delivery (£3.50 delivery fee)</label>

                    <div id="delivery-address" style="display:none; margin-top:15px;">
                        <label><strong>Delivery Address:</strong></label>
                        <textarea name="delivery_address" rows="3" placeholder="Enter your full delivery address"></textarea>
                    </div>
                </div>
            </div>

            <!-- Payment Method -->
            <h2>Payment Method</h2>
            <div class="dish">
                <div class="dish-info">
                    <div class="payment-options">
                        <label style="display: block; margin-bottom: 15px;">
                            <input type="radio" name="payment_method" value="cash" required checked>
                            <span style="margin-left: 10px; font-weight: bold;">Cash Payment</span>
                        </label>
                        <p style="margin-left: 25px; margin-bottom: 15px;">
                            <?php if (isset($_POST['delivery']) && $_POST['delivery'] == 'Delivery'): ?>
                                Pay the driver in cash upon delivery
                            <?php else: ?>
                                Pay with cash when collecting your order
                            <?php endif; ?>
                        </p>
                        
                        <label style="display: block;">
                            <input type="radio" name="payment_method" value="card">
                            <span style="margin-left: 10px; font-weight: bold;">Card Payment</span>
                        </label>
                        <p style="margin-left: 25px;">
                            Pay with card when collecting your order (card machine available)
                        </p>
                    </div>
                </div>
            </div>

            <!-- Customer Information -->
            <h2>Your Information</h2>
            <div class="dish">
                <div class="dish-info">
                    <label><strong>Full Name:</strong></label>
                    <input type="text" name="customer_name" required>
                    
                    <label style="margin-top: 15px;"><strong>Phone Number:</strong></label>
                    <input type="tel" name="customer_phone" required>
                    
                    <label style="margin-top: 15px;"><strong>Email:</strong></label>
                    <input type="email" name="customer_email">
                    
                    <label style="margin-top: 15px;"><strong>Special Instructions:</strong></label>
                    <textarea name="special_instructions" rows="3" placeholder="Any special requests or dietary restrictions?"></textarea>
                </div>
            </div>

            <!-- Hidden field for member status -->
            <input type="hidden" name="is_member" value="<?php echo isset($_SESSION['logged_in']) ? '1' : '0'; ?>">

            <!-- Submit Button -->
            <div style="text-align:center; margin: 40px;">
                <button type="submit" class="button">Confirm Order</button>
            </div>
        </form>
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

    <script>
        // Show/hide delivery address field based on selection
        document.querySelectorAll('input[name="delivery"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.getElementById('delivery-address').style.display = 
                    this.value === 'Delivery' ? 'block' : 'none';
            });
        });

        // Validate that at least one item is ordered
        document.querySelector('form').addEventListener('submit', function(e) {
            let hasOrder = false;
            
            // Check all quantity inputs
            const quantityInputs = document.querySelectorAll('input[type="number"]');
            quantityInputs.forEach(input => {
                if (parseInt(input.value) > 0) {
                    hasOrder = true;
                }
            });
            
            if (!hasOrder) {
                e.preventDefault();
                alert('Please select at least one item to order.');
            }
        });
    </script>
</body>
</html>