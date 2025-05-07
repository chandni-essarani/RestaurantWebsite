<?php 
session_start();
require_once 'db_config.php';

// Process the order and save to database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Begin transaction
        $pdo->beginTransaction();

        // Calculate totals
        $subtotal = 0;
        $delivery_fee = 0;
        
        // Calculate subtotal from all items
        // Main Courses - Butter Chicken
        if (isset($_POST['butter_chicken_half']) && $_POST['butter_chicken_half'] > 0) {
            $subtotal += 8.99 * $_POST['butter_chicken_half'];
        }
        if (isset($_POST['butter_chicken_full']) && $_POST['butter_chicken_full'] > 0) {
            $subtotal += 12.99 * $_POST['butter_chicken_full'];
        }
        // Butter Chicken Add-ons
        if (isset($_POST['butter_chicken_rice_qty']) && $_POST['butter_chicken_rice_qty'] > 0) {
            $subtotal += 2.50 * $_POST['butter_chicken_rice_qty'];
        }
        if (isset($_POST['butter_chicken_naan_qty']) && $_POST['butter_chicken_naan_qty'] > 0) {
            $subtotal += 1.50 * $_POST['butter_chicken_naan_qty'];
        }
        if (isset($_POST['butter_chicken_salad_qty']) && $_POST['butter_chicken_salad_qty'] > 0) {
            $subtotal += 1.00 * $_POST['butter_chicken_salad_qty'];
        }
        
        // Vegetable Biryani
        if (isset($_POST['vegetable_biryani_half']) && $_POST['vegetable_biryani_half'] > 0) {
            $subtotal += 7.50 * $_POST['vegetable_biryani_half'];
        }
        if (isset($_POST['vegetable_biryani_full']) && $_POST['vegetable_biryani_full'] > 0) {
            $subtotal += 10.99 * $_POST['vegetable_biryani_full'];
        }
        // Vegetable Biryani Add-ons
        if (isset($_POST['vegetable_biryani_raita_qty']) && $_POST['vegetable_biryani_raita_qty'] > 0) {
            $subtotal += 1.00 * $_POST['vegetable_biryani_raita_qty'];
        }
        if (isset($_POST['vegetable_biryani_papadum_qty']) && $_POST['vegetable_biryani_papadum_qty'] > 0) {
            $subtotal += 0.80 * $_POST['vegetable_biryani_papadum_qty'];
        }
        if (isset($_POST['vegetable_biryani_salad_qty']) && $_POST['vegetable_biryani_salad_qty'] > 0) {
            $subtotal += 1.00 * $_POST['vegetable_biryani_salad_qty'];
        }
        
        // Chicken Biryani
        if (isset($_POST['chicken_biryani_half']) && $_POST['chicken_biryani_half'] > 0) {
            $subtotal += 10.50 * $_POST['chicken_biryani_half'];
        }
        if (isset($_POST['chicken_biryani_full']) && $_POST['chicken_biryani_full'] > 0) {
            $subtotal += 14.99 * $_POST['chicken_biryani_full'];
        }
        // Chicken Biryani Add-ons
        if (isset($_POST['chicken_biryani_rice_qty']) && $_POST['chicken_biryani_rice_qty'] > 0) {
            $subtotal += 2.50 * $_POST['chicken_biryani_rice_qty'];
        }
        if (isset($_POST['chicken_biryani_naan_qty']) && $_POST['chicken_biryani_naan_qty'] > 0) {
            $subtotal += 1.50 * $_POST['chicken_biryani_naan_qty'];
        }
        if (isset($_POST['chicken_biryani_salad_qty']) && $_POST['chicken_biryani_salad_qty'] > 0) {
            $subtotal += 1.00 * $_POST['chicken_biryani_salad_qty'];
        }
        
        // Roasted Chicken
        if (isset($_POST['roasted_chicken_half']) && $_POST['roasted_chicken_half'] > 0) {
            $subtotal += 7.99 * $_POST['roasted_chicken_half'];
        }
        if (isset($_POST['roasted_chicken_full']) && $_POST['roasted_chicken_full'] > 0) {
            $subtotal += 11.99 * $_POST['roasted_chicken_full'];
        }
        // Roasted Chicken Add-ons
        if (isset($_POST['roasted_chicken_gravy_qty']) && $_POST['roasted_chicken_gravy_qty'] > 0) {
            $subtotal += 2.00 * $_POST['roasted_chicken_gravy_qty'];
        }
        if (isset($_POST['roasted_chicken_salad_qty']) && $_POST['roasted_chicken_salad_qty'] > 0) {
            $subtotal += 1.00 * $_POST['roasted_chicken_salad_qty'];
        }
        
        // Chicken Curry
        if (isset($_POST['chicken_curry_half']) && $_POST['chicken_curry_half'] > 0) {
            $subtotal += 7.99 * $_POST['chicken_curry_half'];
        }
        if (isset($_POST['chicken_curry_full']) && $_POST['chicken_curry_full'] > 0) {
            $subtotal += 11.49 * $_POST['chicken_curry_full'];
        }
        // Chicken Curry Add-ons
        if (isset($_POST['chicken_curry_rice_qty']) && $_POST['chicken_curry_rice_qty'] > 0) {
            $subtotal += 2.50 * $_POST['chicken_curry_rice_qty'];
        }
        if (isset($_POST['chicken_curry_naan_qty']) && $_POST['chicken_curry_naan_qty'] > 0) {
            $subtotal += 1.50 * $_POST['chicken_curry_naan_qty'];
        }
        if (isset($_POST['chicken_curry_salad_qty']) && $_POST['chicken_curry_salad_qty'] > 0) {
            $subtotal += 1.00 * $_POST['chicken_curry_salad_qty'];
        }
        
        // Drinks - Cans
        if (isset($_POST['coke_cans']) && $_POST['coke_cans'] > 0) {
            $subtotal += 1.20 * $_POST['coke_cans'];
        }
        if (isset($_POST['diet_coke_cans']) && $_POST['diet_coke_cans'] > 0) {
            $subtotal += 1.20 * $_POST['diet_coke_cans'];
        }
        if (isset($_POST['sprite_cans']) && $_POST['sprite_cans'] > 0) {
            $subtotal += 1.20 * $_POST['sprite_cans'];
        }
        if (isset($_POST['fanta_cans']) && $_POST['fanta_cans'] > 0) {
            $subtotal += 1.20 * $_POST['fanta_cans'];
        }
        
        // Drinks - Bottles
        if (isset($_POST['coke_bottles']) && $_POST['coke_bottles'] > 0) {
            $subtotal += 1.80 * $_POST['coke_bottles'];
        }
        if (isset($_POST['diet_coke_bottles']) && $_POST['diet_coke_bottles'] > 0) {
            $subtotal += 1.80 * $_POST['diet_coke_bottles'];
        }
        if (isset($_POST['sprite_bottles']) && $_POST['sprite_bottles'] > 0) {
            $subtotal += 1.80 * $_POST['sprite_bottles'];
        }
        if (isset($_POST['fanta_bottles']) && $_POST['fanta_bottles'] > 0) {
            $subtotal += 1.80 * $_POST['fanta_bottles'];
        }
        
        // Ice Add-ons
        if (isset($_POST['can_ice_qty']) && $_POST['can_ice_qty'] > 0) {
            $subtotal += 0.30 * $_POST['can_ice_qty'];
        }
        if (isset($_POST['bottle_ice_qty']) && $_POST['bottle_ice_qty'] > 0) {
            $subtotal += 0.30 * $_POST['bottle_ice_qty'];
        }
        
        // Delivery fee
        if (isset($_POST['delivery']) && $_POST['delivery'] == 'Delivery') {
            $delivery_fee = 3.50;
        }
        
        $total_before_discount = $subtotal + $delivery_fee;
        $discount = 0;
        
        // Check if member (logged in)
        $is_member = isset($_POST['is_member']) && $_POST['is_member'] == '1';
        if ($is_member) {
            $discount = $total_before_discount * 0.10; // 10% discount
        }
        
        $total = $total_before_discount - $discount;
        
        // Get user ID if logged in
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        
        // Insert order into orders table
        $stmt = $pdo->prepare("INSERT INTO orders (
            user_id, 
            customer_name, 
            customer_email, 
            customer_phone, 
            delivery_method, 
            delivery_address, 
            payment_method, 
            special_instructions, 
            subtotal, 
            delivery_fee, 
            discount, 
            total, 
            status
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->execute([
            $user_id,
            $_POST['customer_name'],
            $_POST['customer_email'] ?? null,
            $_POST['customer_phone'],
            $_POST['delivery'],
            $_POST['delivery_address'] ?? null,
            $_POST['payment_method'],
            $_POST['special_instructions'] ?? null,
            $subtotal,
            $delivery_fee,
            $discount,
            $total,
            'received' // initial status
        ]);
        
        $order_id = $pdo->lastInsertId();
        
        // Function to add order items
        function addOrderItem($pdo, $order_id, $item_name, $item_type, $portion_size, $quantity, $price, $notes = null) {
            if ($quantity > 0) {
                $stmt = $pdo->prepare("INSERT INTO order_items (
                    order_id, 
                    item_name, 
                    item_type, 
                    portion_size, 
                    quantity, 
                    price, 
                    notes
                ) VALUES (?, ?, ?, ?, ?, ?, ?)");
                
                $stmt->execute([
                    $order_id,
                    $item_name,
                    $item_type,
                    $portion_size,
                    $quantity,
                    $price,
                    $notes
                ]);
            }
        }
        
        // Add all order items to order_items table
        
        // Main Courses - Butter Chicken
        if (isset($_POST['butter_chicken_half']) && $_POST['butter_chicken_half'] > 0) {
            addOrderItem($pdo, $order_id, 'Butter Chicken', 'main', 'half', $_POST['butter_chicken_half'], 8.99);
        }
        if (isset($_POST['butter_chicken_full']) && $_POST['butter_chicken_full'] > 0) {
            addOrderItem($pdo, $order_id, 'Butter Chicken', 'main', 'full', $_POST['butter_chicken_full'], 12.99);
        }
        // Butter Chicken Add-ons
        if (isset($_POST['butter_chicken_rice_qty']) && $_POST['butter_chicken_rice_qty'] > 0) {
            addOrderItem($pdo, $order_id, 'Rice', 'side', null, $_POST['butter_chicken_rice_qty'], 2.50, 'Add-on for Butter Chicken');
        }
        if (isset($_POST['butter_chicken_naan_qty']) && $_POST['butter_chicken_naan_qty'] > 0) {
            addOrderItem($pdo, $order_id, 'Naan', 'side', null, $_POST['butter_chicken_naan_qty'], 1.50, 'Add-on for Butter Chicken');
        }
        if (isset($_POST['butter_chicken_salad_qty']) && $_POST['butter_chicken_salad_qty'] > 0) {
            addOrderItem($pdo, $order_id, 'Salad', 'side', null, $_POST['butter_chicken_salad_qty'], 1.00, 'Add-on for Butter Chicken');
        }
        
        // Vegetable Biryani
        if (isset($_POST['vegetable_biryani_half']) && $_POST['vegetable_biryani_half'] > 0) {
            addOrderItem($pdo, $order_id, 'Vegetable Biryani', 'main', 'half', $_POST['vegetable_biryani_half'], 7.50);
        }
        if (isset($_POST['vegetable_biryani_full']) && $_POST['vegetable_biryani_full'] > 0) {
            addOrderItem($pdo, $order_id, 'Vegetable Biryani', 'main', 'full', $_POST['vegetable_biryani_full'], 10.99);
        }
        // Vegetable Biryani Add-ons
        if (isset($_POST['vegetable_biryani_raita_qty']) && $_POST['vegetable_biryani_raita_qty'] > 0) {
            addOrderItem($pdo, $order_id, 'Raita', 'side', null, $_POST['vegetable_biryani_raita_qty'], 1.00, 'Add-on for Vegetable Biryani');
        }
        if (isset($_POST['vegetable_biryani_papadum_qty']) && $_POST['vegetable_biryani_papadum_qty'] > 0) {
            addOrderItem($pdo, $order_id, 'Papadum', 'side', null, $_POST['vegetable_biryani_papadum_qty'], 0.80, 'Add-on for Vegetable Biryani');
        }
        if (isset($_POST['vegetable_biryani_salad_qty']) && $_POST['vegetable_biryani_salad_qty'] > 0) {
            addOrderItem($pdo, $order_id, 'Salad', 'side', null, $_POST['vegetable_biryani_salad_qty'], 1.00, 'Add-on for Vegetable Biryani');
        }
        
        // Chicken Biryani
        if (isset($_POST['chicken_biryani_half']) && $_POST['chicken_biryani_half'] > 0) {
            addOrderItem($pdo, $order_id, 'Chicken Biryani', 'main', 'half', $_POST['chicken_biryani_half'], 10.50);
        }
        if (isset($_POST['chicken_biryani_full']) && $_POST['chicken_biryani_full'] > 0) {
            addOrderItem($pdo, $order_id, 'Chicken Biryani', 'main', 'full', $_POST['chicken_biryani_full'], 14.99);
        }
        // Chicken Biryani Add-ons
        if (isset($_POST['chicken_biryani_rice_qty']) && $_POST['chicken_biryani_rice_qty'] > 0) {
            addOrderItem($pdo, $order_id, 'Rice', 'side', null, $_POST['chicken_biryani_rice_qty'], 2.50, 'Add-on for Chicken Biryani');
        }
        if (isset($_POST['chicken_biryani_naan_qty']) && $_POST['chicken_biryani_naan_qty'] > 0) {
            addOrderItem($pdo, $order_id, 'Naan', 'side', null, $_POST['chicken_biryani_naan_qty'], 1.50, 'Add-on for Chicken Biryani');
        }
        if (isset($_POST['chicken_biryani_salad_qty']) && $_POST['chicken_biryani_salad_qty'] > 0) {
            addOrderItem($pdo, $order_id, 'Salad', 'side', null, $_POST['chicken_biryani_salad_qty'], 1.00, 'Add-on for Chicken Biryani');
        }
        
        // Roasted Chicken
        if (isset($_POST['roasted_chicken_half']) && $_POST['roasted_chicken_half'] > 0) {
            addOrderItem($pdo, $order_id, 'Roasted Chicken', 'main', 'half', $_POST['roasted_chicken_half'], 7.99);
        }
        if (isset($_POST['roasted_chicken_full']) && $_POST['roasted_chicken_full'] > 0) {
            addOrderItem($pdo, $order_id, 'Roasted Chicken', 'main', 'full', $_POST['roasted_chicken_full'], 11.99);
        }
        // Roasted Chicken Add-ons
        if (isset($_POST['roasted_chicken_gravy_qty']) && $_POST['roasted_chicken_gravy_qty'] > 0) {
            addOrderItem($pdo, $order_id, 'Gravy', 'side', null, $_POST['roasted_chicken_gravy_qty'], 2.00, 'Add-on for Roasted Chicken');
        }
        if (isset($_POST['roasted_chicken_salad_qty']) && $_POST['roasted_chicken_salad_qty'] > 0) {
            addOrderItem($pdo, $order_id, 'Salad', 'side', null, $_POST['roasted_chicken_salad_qty'], 1.00, 'Add-on for Roasted Chicken');
        }
        
        // Chicken Curry
        if (isset($_POST['chicken_curry_half']) && $_POST['chicken_curry_half'] > 0) {
            addOrderItem($pdo, $order_id, 'Chicken Curry', 'main', 'half', $_POST['chicken_curry_half'], 7.99);
        }
        if (isset($_POST['chicken_curry_full']) && $_POST['chicken_curry_full'] > 0) {
            addOrderItem($pdo, $order_id, 'Chicken Curry', 'main', 'full', $_POST['chicken_curry_full'], 11.49);
        }
        // Chicken Curry Add-ons
        if (isset($_POST['chicken_curry_rice_qty']) && $_POST['chicken_curry_rice_qty'] > 0) {
            addOrderItem($pdo, $order_id, 'Rice', 'side', null, $_POST['chicken_curry_rice_qty'], 2.50, 'Add-on for Chicken Curry');
        }
        if (isset($_POST['chicken_curry_naan_qty']) && $_POST['chicken_curry_naan_qty'] > 0) {
            addOrderItem($pdo, $order_id, 'Naan', 'side', null, $_POST['chicken_curry_naan_qty'], 1.50, 'Add-on for Chicken Curry');
        }
        if (isset($_POST['chicken_curry_salad_qty']) && $_POST['chicken_curry_salad_qty'] > 0) {
            addOrderItem($pdo, $order_id, 'Salad', 'side', null, $_POST['chicken_curry_salad_qty'], 1.00, 'Add-on for Chicken Curry');
        }
        
        // Drinks - Cans
        if (isset($_POST['coke_cans']) && $_POST['coke_cans'] > 0) {
            addOrderItem($pdo, $order_id, 'Coke Can', 'drink', '330ml', $_POST['coke_cans'], 1.20);
        }
        if (isset($_POST['diet_coke_cans']) && $_POST['diet_coke_cans'] > 0) {
            addOrderItem($pdo, $order_id, 'Diet Coke Can', 'drink', '330ml', $_POST['diet_coke_cans'], 1.20);
        }
        if (isset($_POST['sprite_cans']) && $_POST['sprite_cans'] > 0) {
            addOrderItem($pdo, $order_id, 'Sprite Can', 'drink', '330ml', $_POST['sprite_cans'], 1.20);
        }
        if (isset($_POST['fanta_cans']) && $_POST['fanta_cans'] > 0) {
            addOrderItem($pdo, $order_id, 'Fanta Can', 'drink', '330ml', $_POST['fanta_cans'], 1.20);
        }
        
        // Drinks - Bottles
        if (isset($_POST['coke_bottles']) && $_POST['coke_bottles'] > 0) {
            addOrderItem($pdo, $order_id, 'Coke Bottle', 'drink', '500ml', $_POST['coke_bottles'], 1.80);
        }
        if (isset($_POST['diet_coke_bottles']) && $_POST['diet_coke_bottles'] > 0) {
            addOrderItem($pdo, $order_id, 'Diet Coke Bottle', 'drink', '500ml', $_POST['diet_coke_bottles'], 1.80);
        }
        if (isset($_POST['sprite_bottles']) && $_POST['sprite_bottles'] > 0) {
            addOrderItem($pdo, $order_id, 'Sprite Bottle', 'drink', '500ml', $_POST['sprite_bottles'], 1.80);
        }
        if (isset($_POST['fanta_bottles']) && $_POST['fanta_bottles'] > 0) {
            addOrderItem($pdo, $order_id, 'Fanta Bottle', 'drink', '500ml', $_POST['fanta_bottles'], 1.80);
        }
        
        // Ice Add-ons
        if (isset($_POST['can_ice_qty']) && $_POST['can_ice_qty'] > 0) {
            addOrderItem($pdo, $order_id, 'Ice', 'side', null, $_POST['can_ice_qty'], 0.30, 'For cans');
        }
        if (isset($_POST['bottle_ice_qty']) && $_POST['bottle_ice_qty'] > 0) {
            addOrderItem($pdo, $order_id, 'Ice', 'side', null, $_POST['bottle_ice_qty'], 0.30, 'For bottles');
        }
        
        // Commit transaction
        $pdo->commit();
        
    } catch (Exception $e) {
        // Rollback transaction if something failed
        $pdo->rollBack();
        die("Error processing order: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation | Chandni's Kitchen</title>
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

        /* Content */
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

        .confirmation-box {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
        }

        .order-summary {
            margin-top: 20px;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-name {
            font-weight: bold;
        }

        .item-price {
            color: #d4af37;
        }

        .total-section {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px solid #2a5c40;
            font-size: 18px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
        }

        .customer-info {
            margin-top: 30px;
        }

        .info-row {
            display: flex;
            margin-bottom: 10px;
        }

        .info-label {
            width: 150px;
            font-weight: bold;
        }

        .info-value {
            flex: 1;
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
            margin-top: 20px;
        }

        .button:hover {
            background-color: #1e4530;
        }

        .button-container {
            text-align: center;
            margin-top: 30px;
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

            .info-row {
                flex-direction: column;
            }

            .info-label {
                width: 100%;
                margin-bottom: 5px;
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

    <div class="content">
        <h1>Order Confirmation</h1>
        
        <div class="confirmation-box">
            <h2 style="color: #2a5c40; text-align: center;">Thank you for your order!</h2>
            <p style="text-align: center; margin-top: 10px;">Your order has been received and is being prepared.</p>
            
            <?php if ($is_member): ?>
                <div style="background-color: #e8f5e9; color: #2a5c40; padding: 15px; border-radius: 4px; margin-bottom: 20px; text-align: center;">
                    <i class="fas fa-star"></i> Member Discount Applied (10%)
                </div>
            <?php endif; ?>
            
            <div class="order-summary">
                <h3 style="color: #2a5c40; margin-bottom: 15px;">Order Summary</h3>
                
                <?php
                // Display order items from the form submission
                // Main Courses - Butter Chicken
                if (isset($_POST['butter_chicken_half']) && $_POST['butter_chicken_half'] > 0) {
                    $qty = $_POST['butter_chicken_half'];
                    $price = 8.99 * $qty;
                    echo '<div class="order-item">';
                    echo '<span class="item-name">Butter Chicken (Half) x ' . $qty . '</span>';
                    echo '<span class="item-price">£' . number_format($price, 2) . '</span>';
                    echo '</div>';
                }
                
                if (isset($_POST['butter_chicken_full']) && $_POST['butter_chicken_full'] > 0) {
                    $qty = $_POST['butter_chicken_full'];
                    $price = 12.99 * $qty;
                    echo '<div class="order-item">';
                    echo '<span class="item-name">Butter Chicken (Full) x ' . $qty . '</span>';
                    echo '<span class="item-price">£' . number_format($price, 2) . '</span>';
                    echo '</div>';
                }
                
                // Butter Chicken Add-ons
                if (isset($_POST['butter_chicken_rice_qty']) && $_POST['butter_chicken_rice_qty'] > 0) {
                    $qty = $_POST['butter_chicken_rice_qty'];
                    $price = 2.50 * $qty;
                    echo '<div class="order-item">';
                    echo '<span class="item-name">- Rice Add-on x ' . $qty . '</span>';
                    echo '<span class="item-price">£' . number_format($price, 2) . '</span>';
                    echo '</div>';
                }
                
                if (isset($_POST['butter_chicken_naan_qty']) && $_POST['butter_chicken_naan_qty'] > 0) {
                    $qty = $_POST['butter_chicken_naan_qty'];
                    $price = 1.50 * $qty;
                    echo '<div class="order-item">';
                    echo '<span class="item-name">- Naan Add-on x ' . $qty . '</span>';
                    echo '<span class="item-price">£' . number_format($price, 2) . '</span>';
                    echo '</div>';
                }
                
                if (isset($_POST['butter_chicken_salad_qty']) && $_POST['butter_chicken_salad_qty'] > 0) {
                    $qty = $_POST['butter_chicken_salad_qty'];
                    $price = 1.00 * $qty;
                    echo '<div class="order-item">';
                    echo '<span class="item-name">- Salad Add-on x ' . $qty . '</span>';
                    echo '<span class="item-price">£' . number_format($price, 2) . '</span>';
                    echo '</div>';
                }
                
                // Vegetable Biryani
                if (isset($_POST['vegetable_biryani_half']) && $_POST['vegetable_biryani_half'] > 0) {
                    $qty = $_POST['vegetable_biryani_half'];
                    $price = 7.50 * $qty;
                    echo '<div class="order-item">';
                    echo '<span class="item-name">Vegetable Biryani (Half) x ' . $qty . '</span>';
                    echo '<span class="item-price">£' . number_format($price, 2) . '</span>';
                    echo '</div>';
                }
                
                if (isset($_POST['vegetable_biryani_full']) && $_POST['vegetable_biryani_full'] > 0) {
                    $qty = $_POST['vegetable_biryani_full'];
                    $price = 10.99 * $qty;
                    echo '<div class="order-item">';
                    echo '<span class="item-name">Vegetable Biryani (Full) x ' . $qty . '</span>';
                    echo '<span class="item-price">£' . number_format($price, 2) . '</span>';
                    echo '</div>';
                }
                
                // Vegetable Biryani Add-ons
                if (isset($_POST['vegetable_biryani_raita_qty']) && $_POST['vegetable_biryani_raita_qty'] > 0) {
                    $qty = $_POST['vegetable_biryani_raita_qty'];
                    $price = 1.00 * $qty;
                    echo '<div class="order-item">';
                    echo '<span class="item-name">- Raita Add-on x ' . $qty . '</span>';
                    echo '<span class="item-price">£' . number_format($price, 2) . '</span>';
                    echo '</div>';
                }
                
                if (isset($_POST['vegetable_biryani_papadum_qty']) && $_POST['vegetable_biryani_papadum_qty'] > 0) {
                    $qty = $_POST['vegetable_biryani_papadum_qty'];
                    $price = 0.80 * $qty;
                    echo '<div class="order-item">';
                    echo '<span class="item-name">- Papadum Add-on x ' . $qty . '</span>';
                    echo '<span class="item-price">£' . number_format($price, 2) . '</span>';
                    echo '</div>';
                }
                
                if (isset($_POST['vegetable_biryani_salad_qty']) && $_POST['vegetable_biryani_salad_qty'] > 0) {
                    $qty = $_POST['vegetable_biryani_salad_qty'];
                    $price = 1.00 * $qty;
                    echo '<div class="order-item">';
                    echo '<span class="item-name">- Salad Add-on x ' . $qty . '</span>';
                    echo '<span class="item-price">£' . number_format($price, 2) . '</span>';
                    echo '</div>';
                }
                
                // Chicken Biryani
                if (isset($_POST['chicken_biryani_half']) && $_POST['chicken_biryani_half'] > 0) {
                    $qty = $_POST['chicken_biryani_half'];
                    $price = 10.50 * $qty;
                    echo '<div class="order-item">';
                    echo '<span class="item-name">Chicken Biryani (Half) x ' . $qty . '</span>';
                    echo '<span class="item-price">£' . number_format($price, 2) . '</span>';
                    echo '</div>';
                }
                
                if (isset($_POST['chicken_biryani_full']) && $_POST['chicken_biryani_full'] > 0) {
                    $qty = $_POST['chicken_biryani_full'];
                    $price = 14.99 * $qty;
                    echo '<div class="order-item">';
                    echo '<span class="item-name">Chicken Biryani (Full) x ' . $qty . '</span>';
                    echo '<span class="item-price">£' . number_format($price, 2) . '</span>';
                    echo '</div>';
                }
                
                // Chicken Biryani Add-ons
                if (isset($_POST['chicken_biryani_rice_qty']) && $_POST['chicken_biryani_rice_qty'] > 0) {
                    $qty = $_POST['chicken_biryani_rice_qty'];
                    $price = 2.50 * $qty;
                    echo '<div class="order-item">';
                    echo '<span class="item-name">- Rice Add-on x ' . $qty . '</span>';
                    echo '<span class="item-price">£' . number_format($price, 2) . '</span>';
                    echo '</div>';
                }
                
                if (isset($_POST['chicken_biryani_naan_qty']) && $_POST['chicken_biryani_naan_qty'] > 0) {
                    $qty = $_POST['chicken_biryani_naan_qty'];
                    $price = 1.50 * $qty;
                    echo '<div class="order-item">';
                    echo '<span class="item-name">- Naan Add-on x ' . $qty . '</span>';
                    echo '<span class="item-price">£' . number_format($price, 2) . '</span>';
                    echo '</div>';
                }
                
                if (isset($_POST['chicken_biryani_salad_qty']) && $_POST['chicken_biryani_salad_qty'] > 0) {
                    $qty = $_POST['chicken_biryani_salad_qty'];
                    $price = 1.00 * $qty;
                    echo '<div class="order-item">';
                    echo '<span class="item-name">- Salad Add-on x ' . $qty . '</span>';
                    echo '<span class="item-price">£' . number_format($price, 2) . '</span>';
                    echo '</div>';
                }
                
                // Roasted Chicken
                if (isset($_POST['roasted_chicken_half']) && $_POST['roasted_chicken_half'] > 0) {
                    $qty = $_POST['roasted_chicken_half'];
                    $price = 7.99 * $qty;
                    echo '<div class="order-item">';
                    echo '<span class="item-name">Roasted Chicken (Half) x ' . $qty . '</span>';
                    echo '<span class="item-price">£' . number_format($price, 2) . '</span>';
                    echo '</div>';
                }
                
                if (isset($_POST['roasted_chicken_full']) && $_POST['roasted_chicken_full'] > 0) {
                    $qty = $_POST['roasted_chicken_full'];
                    $price = 11.99 * $qty;
                    echo '<div class="order-item">';
                    echo '<span class="item-name">Roasted Chicken (Full) x ' . $qty . '</span>';
                    echo '<span class="item-price">£' . number_format($price, 2) . '</span>';
                    echo '</div>';
                }
                
                // Roasted Chicken Add-ons
                if (isset($_POST['roasted_chicken_gravy_qty']) && $_POST['roasted_chicken_gravy_qty'] > 0) {
                    $qty = $_POST['roasted_chicken_gravy_qty'];
                    $price = 2.00 * $qty;
                    echo '<div class="order-item">';
                    echo '<span class="item-name">- Gravy Add-on x ' . $qty . '</span>';
                    echo '<span class="item-price">£' . number_format($price, 2) . '</span>';
                    echo '</div>';
                }
                
                if (isset($_POST['roasted_chicken_salad_qty']) && $_POST['roasted_chicken_salad_qty'] > 0) {
                    $qty = $_POST['roasted_chicken_salad_qty'];
                    $price = 1.00 * $qty;
                    echo '<div class="order-item">';
                    echo '<span class="item-name">- Salad Add-on x ' . $qty . '</span>';
                    echo '<span class="item-price">£' . number_format($price, 2) . '</span>';
                    echo '</div>';
                }
                
                // Chicken Curry
                if (isset($_POST['chicken_curry_half']) && $_POST['chicken_curry_half'] > 0) {
                    $qty = $_POST['chicken_curry_half'];
                    $price = 7.99 * $qty;
                    echo '<div class="order-item">';
                    echo '<span class="item-name">Chicken Curry (Half) x ' . $qty . '</span>';
                    echo '<span class="item-price">£' . number_format($price, 2) . '</span>';
                    echo '</div>';
                }
                
                if (isset($_POST['chicken_curry_full']) && $_POST['chicken_curry_full'] > 0) {
                    $qty = $_POST['chicken_curry_full'];
                    $price = 11.49 * $qty;
                    echo '<div class="order-item">';
                    echo '<span class="item-name">Chicken Curry (Full) x ' . $qty . '</span>';
                    echo '<span class="item-price">£' . number_format($price, 2) . '</span>';
                    echo '</div>';
                }
                
                // Chicken Curry Add-ons
                if (isset($_POST['chicken_curry_rice_qty']) && $_POST['chicken_curry_rice_qty'] > 0) {
                    $qty = $_POST['chicken_curry_rice_qty'];
                    $price = 2.50 * $qty;
                    echo '<div class="order-item">';
                    echo '<span class="item-name">- Rice Add-on x ' . $qty . '</span>';
                    echo '<span class="item-price">£' . number_format($price, 2) . '</span>';
                    echo '</div>';
                }
                
                if (isset($_POST['chicken_curry_naan_qty']) && $_POST['chicken_curry_naan_qty'] > 0) {
                    $qty = $_POST['chicken_curry_naan_qty'];
                    $price = 1.50 * $qty;
                    echo '<div class="order-item">';
                    echo '<span class="item-name">- Naan Add-on x ' . $qty . '</span>';
                    echo '<span class="item-price">£' . number_format($price, 2) . '</span>';
                    echo '</div>';
                }
                
                if (isset($_POST['chicken_curry_salad_qty']) && $_POST['chicken_curry_salad_qty'] > 0) {
                    $qty = $_POST['chicken_curry_salad_qty'];
                    $price = 1.00 * $qty;
                    echo '<div class="order-item">';
                    echo '<span class="item-name">- Salad Add-on x ' . $qty . '</span>';
                    echo '<span class="item-price">£' . number_format($price, 2) . '</span>';
                    echo '</div>';
                }
                
                // Drinks - Cans
                if (isset($_POST['coke_cans']) && $_POST['coke_cans'] > 0) {
                    $qty = $_POST['coke_cans'];
                    $price = 1.20 * $qty;
                    echo '<div class="order-item">';
                    echo '<span class="item-name">Coke Can x ' . $qty . '</span>';
                    echo '<span class="item-price">£' . number_format($price, 2) . '</span>';
                    echo '</div>';
                }
                
                if (isset($_POST['diet_coke_cans']) && $_POST['diet_coke_cans'] > 0) {
                    $qty = $_POST['diet_coke_cans'];
                    $price = 1.20 * $qty;
                    echo '<div class="order-item">';
                    echo '<span class="item-name">Diet Coke Can x ' . $qty . '</span>';
                    echo '<span class="item-price">£' . number_format($price, 2) . '</span>';
                    echo '</div>';
                }
                
                if (isset($_POST['sprite_cans']) && $_POST['sprite_cans'] > 0) {
                    $qty = $_POST['sprite_cans'];
                    $price = 1.20 * $qty;
                    echo '<div class="order-item">';
                    echo '<span class="item-name">Sprite Can x ' . $qty . '</span>';
                    echo '<span class="item-price">£' . number_format($price, 2) . '</span>';
                    echo '</div>';
                }
                
                if (isset($_POST['fanta_cans']) && $_POST['fanta_cans'] > 0) {
                    $qty = $_POST['fanta_cans'];
                    $price = 1.20 * $qty;
                    echo '<div class="order-item">';
                    echo '<span class="item-name">Fanta Can x ' . $qty . '</span>';
                    echo '<span class="item-price">£' . number_format($price, 2) . '</span>';
                    echo '</div>';
                }
                
                // Drinks - Bottles
                if (isset($_POST['coke_bottles']) && $_POST['coke_bottles'] > 0) {
                    $qty = $_POST['coke_bottles'];
                    $price = 1.80 * $qty;
                    echo '<div class="order-item">';
                    echo '<span class="item-name">Coke Bottle x ' . $qty . '</span>';
                    echo '<span class="item-price">£' . number_format($price, 2) . '</span>';
                    echo '</div>';
                }
                
                if (isset($_POST['diet_coke_bottles']) && $_POST['diet_coke_bottles'] > 0) {
                    $qty = $_POST['diet_coke_bottles'];
                    $price = 1.80 * $qty;
                    echo '<div class="order-item">';
                    echo '<span class="item-name">Diet Coke Bottle x ' . $qty . '</span>';
                    echo '<span class="item-price">£' . number_format($price, 2) . '</span>';
                    echo '</div>';
                }
                
                if (isset($_POST['sprite_bottles']) && $_POST['sprite_bottles'] > 0) {
                    $qty = $_POST['sprite_bottles'];
                    $price = 1.80 * $qty;
                    echo '<div class="order-item">';
                    echo '<span class="item-name">Sprite Bottle x ' . $qty . '</span>';
                    echo '<span class="item-price">£' . number_format($price, 2) . '</span>';
                    echo '</div>';
                }
                
                if (isset($_POST['fanta_bottles']) && $_POST['fanta_bottles'] > 0) {
                    $qty = $_POST['fanta_bottles'];
                    $price = 1.80 * $qty;
                    echo '<div class="order-item">';
                    echo '<span class="item-name">Fanta Bottle x ' . $qty . '</span>';
                    echo '<span class="item-price">£' . number_format($price, 2) . '</span>';
                    echo '</div>';
                }
                
                // Ice Add-ons
                if (isset($_POST['can_ice_qty']) && $_POST['can_ice_qty'] > 0) {
                    $qty = $_POST['can_ice_qty'];
                    $price = 0.30 * $qty;
                    echo '<div class="order-item">';
                    echo '<span class="item-name">Ice for Cans x ' . $qty . '</span>';
                    echo '<span class="item-price">£' . number_format($price, 2) . '</span>';
                    echo '</div>';
                }
                
                if (isset($_POST['bottle_ice_qty']) && $_POST['bottle_ice_qty'] > 0) {
                    $qty = $_POST['bottle_ice_qty'];
                    $price = 0.30 * $qty;
                    echo '<div class="order-item">';
                    echo '<span class="item-name">Ice for Bottles x ' . $qty . '</span>';
                    echo '<span class="item-price">£' . number_format($price, 2) . '</span>';
                    echo '</div>';
                }
                
                // Delivery fee
                if (isset($_POST['delivery']) && $_POST['delivery'] == 'Delivery') {
                    echo '<div class="order-item">';
                    echo '<span class="item-name">Delivery Fee</span>';
                    echo '<span class="item-price">£' . number_format($delivery_fee, 2) . '</span>';
                    echo '</div>';
                }
                
                if ($is_member) {
                    echo '<div class="order-item">';
                    echo '<span class="item-name">Subtotal:</span>';
                    echo '<span class="item-price">£' . number_format($total_before_discount, 2) . '</span>';
                    echo '</div>';
                    echo '<div class="order-item" style="color: #2a5c40; font-weight: bold;">';
                    echo '<span class="item-name">Member Discount (10%):</span>';
                    echo '<span class="item-price">-£' . number_format($discount, 2) . '</span>';
                    echo '</div>';
                }
                ?>
                
                <div class="total-section">
                    <span>Total:</span>
                    <span>£<?php echo number_format($total, 2); ?></span>
                </div>
            </div>
            
            <div class="customer-info">
                <h3 style="color: #2a5c40; margin-bottom: 15px;">Customer Information</h3>
                
                <div class="info-row">
                    <div class="info-label">Name:</div>
                    <div class="info-value"><?php echo htmlspecialchars($_POST['customer_name'] ?? ''); ?></div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Phone:</div>
                    <div class="info-value"><?php echo htmlspecialchars($_POST['customer_phone'] ?? ''); ?></div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Email:</div>
                    <div class="info-value"><?php echo htmlspecialchars($_POST['customer_email'] ?? ''); ?></div>
                </div>
                
                <?php if (isset($_POST['delivery']) && $_POST['delivery'] == 'Delivery' && !empty($_POST['delivery_address'])): ?>
                <div class="info-row">
                    <div class="info-label">Delivery Address:</div>
                    <div class="info-value"><?php echo nl2br(htmlspecialchars($_POST['delivery_address'])); ?></div>
                </div>
                <?php else: ?>
                <div class="info-row">
                    <div class="info-label">Collection:</div>
                    <div class="info-value">Pickup from restaurant</div>
                </div>
                <?php endif; ?>
                
                <?php if (!empty($_POST['special_instructions'])): ?>
                <div class="info-row">
                    <div class="info-label">Special Instructions:</div>
                    <div class="info-value"><?php echo nl2br(htmlspecialchars($_POST['special_instructions'])); ?></div>
                </div>
                <?php endif; ?>
            </div>

            <div class="info-row" style="margin-top: 20px;">
                <div class="info-label">Payment Method:</div>
                <div class="info-value" style="color: #2a5c40; font-weight: bold;">
                        <?php 
                        $payment_method = $_POST['payment_method'] ?? 'cash';
                        echo ucfirst($payment_method) . ' Payment';
                        ?>
                        <br>
                        <span style="font-size: 14px; color: #666;">
                            <?php if ($payment_method == 'cash'): ?>
                                <?php if (isset($_POST['delivery']) && $_POST['delivery'] == 'Delivery'): ?>
                                    (Pay the driver upon delivery)
                                <?php else: ?>
                                    (Pay when collecting your order)
                                <?php endif; ?>
                            <?php else: ?>
                                (Pay with card when collecting)
                            <?php endif; ?>
                        </span>
                </div>
            </div>
            
            
            <div class="info-row" style="margin-top: 20px;">
                <div class="info-label">Order Status:</div>
                <div class="info-value" style="color: #2a5c40; font-weight: bold;">Received - Being Prepared</div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Estimated Time:</div>
                <div class="info-value">30-45 minutes</div>
            </div>
            
            <div class="info-row" style="margin-top: 20px;">
                <div class="info-label">Order Number:</div>
                <div class="info-value" style="color: #2a5c40; font-weight: bold;">#<?php echo $order_id; ?></div>
            </div>
        </div>
        
        <div class="button-container">
            <a href="menu.php" class="button">Back to Menu</a>
        </div>
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