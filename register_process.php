<?php
session_start();

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: register.php");
    exit();
}

// Check CSRF token
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    $_SESSION['register_error'] = "Security token mismatch. Please try again.";
    header("Location: register.php");
    exit();
}

require_once 'db_config.php';

// Get and sanitize inputs
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$password_confirm = trim($_POST['confirm_password']);

// Validate inputs
if (empty($name) || empty($email) || empty($password) || empty($password_confirm)) {
    $_SESSION['register_error'] = "All fields are required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['register_error'] = "Invalid email format.";
} elseif ($password !== $password_confirm) {
    $_SESSION['register_error'] = "Passwords do not match.";
} elseif (strlen($password) < 8 || !preg_match("/[A-Z]/", $password) || !preg_match("/[0-9]/", $password)) {
    $_SESSION['register_error'] = "Password must be 8+ characters with uppercase and number.";
} else {
    try {
        // Check if email exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->fetch()) {
            $_SESSION['register_error'] = "Email already registered.";
        } else {
            // Create new user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password, is_active) VALUES (?, ?, ?, 1)");
            
            if ($stmt->execute([$name, $email, $hashed_password])) {
                $_SESSION['register_success'] = "Registration successful! You can now log in.";
                header("Location: register.php");
                exit();
            } else {
                $_SESSION['register_error'] = "Registration failed. Please try again.";
            }
        }
    } catch (PDOException $e) {
        $_SESSION['register_error'] = "Database error. Please try again later.";
    }
}

header("Location: register.php");
exit();