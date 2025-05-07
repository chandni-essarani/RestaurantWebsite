-- Create the database
CREATE DATABASE chandnis_kitchen;
USE chandnis_kitchen;

-- Users table for authentication
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    is_active TINYINT(1) DEFAULT 1,
    is_member TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Reservations table
CREATE TABLE IF NOT EXISTS reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    contact_number VARCHAR(20) NOT NULL,
    reservation_date DATE NOT NULL,
    reservation_time TIME NOT NULL,
    number_of_people INT NOT NULL,
    special_requests TEXT,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Orders table
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    customer_name VARCHAR(100) NOT NULL,
    customer_email VARCHAR(100),
    customer_phone VARCHAR(20) NOT NULL,
    delivery_method ENUM('Pickup', 'Delivery') NOT NULL,
    delivery_address TEXT,
    payment_method ENUM('cash', 'card') NOT NULL,
    special_instructions TEXT,
    subtotal DECIMAL(10,2) NOT NULL,
    delivery_fee DECIMAL(10,2) DEFAULT 0,
    discount DECIMAL(10,2) DEFAULT 0,
    total DECIMAL(10,2) NOT NULL,
    status ENUM('received', 'preparing', 'ready', 'delivered', 'completed', 'cancelled') DEFAULT 'received',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Order items table
CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    item_name VARCHAR(100) NOT NULL,
    item_type ENUM('main', 'side', 'drink') NOT NULL,
    portion_size VARCHAR(20),
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    notes TEXT
);

-- Menu items table
CREATE TABLE IF NOT EXISTS menu_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    category ENUM('main', 'side', 'drink') NOT NULL,
    half_price DECIMAL(10,2),
    full_price DECIMAL(10,2),
    single_price DECIMAL(10,2),
    is_available TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Add some sample menu items
INSERT INTO menu_items (name, description, category, half_price, full_price) VALUES
('Butter Chicken', 'Tender chicken in a creamy tomato gravy', 'main', 8.99, 12.99),
('Vegetable Biryani', 'Fragrant rice cooked with seasonal vegetables, spices and special biryani masala', 'main', 7.50, 10.99),
('Chicken Biryani', 'Fragrant rice cooked with chicken, spices and special biryani masala', 'main', 10.50, 14.99),
('Roasted Chicken', 'Marinated and oven-roasted to perfection with Indian herbs', 'main', 7.99, 11.99),
('Chicken Curry', 'Classic chicken curry with a rich onion-tomato base and bold spices', 'main', 7.99, 11.49);

INSERT INTO menu_items (name, description, category, single_price) VALUES
('Rice', 'Basmati rice', 'side', 2.50),
('Naan', 'Traditional Indian bread', 'side', 1.50),
('Salad', 'Fresh garden salad', 'side', 1.00),
('Raita', 'Yogurt with cucumber and spices', 'side', 1.00),
('Papadum', 'Crispy lentil wafers', 'side', 0.80),
('Gravy', 'Extra gravy', 'side', 2.00),
('Coke Can', '330ml can', 'drink', 1.20),
('Diet Coke Can', '330ml can', 'drink', 1.20),
('Sprite Can', '330ml can', 'drink', 1.20),
('Fanta Can', '330ml can', 'drink', 1.20),
('Coke Bottle', '500ml bottle', 'drink', 1.80),
('Diet Coke Bottle', '500ml bottle', 'drink', 1.80),
('Sprite Bottle', '500ml bottle', 'drink', 1.80),
('Fanta Bottle', '500ml bottle', 'drink', 1.80),
('Ice', 'For drinks', 'side', 0.30);