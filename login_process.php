<?php
session_start();
require 'db_config.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['error'] = "Invalid request method.";
    header("Location: order.php");
    exit();
}

// Sanitize and validate inputs
$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

if (empty($email) || empty($password)) {
    $_SESSION['error'] = "Both email and password are required.";
    header("Location: order.php");
    exit();
}

try {
    // Verify database connection
    if (!isset($pdo)) {
        throw new Exception("Database connection not established");
    }

    // Prepare and execute query
    $stmt = $pdo->prepare("SELECT id, name, email, password, is_member FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user['password'])) {
            // Login successful - set session variables
            $_SESSION = [
                'user_id' => $user['id'],
                'user_name' => $user['name'],
                'user_email' => $user['email'],
                'is_member' => $user['is_member'],
                'logged_in' => true
            ];
            
            // Regenerate session ID for security
            session_regenerate_id(true);
            
            // Clear any previous errors
            unset($_SESSION['error']);
            
            // Redirect to order page
            header("Location: order.php");
            exit();
        } else {
            $_SESSION['error'] = "Invalid password.";
        }
    } else {
        $_SESSION['error'] = "No account found with that email.";
    }
} catch (PDOException $e) {
    $_SESSION['error'] = "Database error. Please try again later.";
    error_log("Login error: " . $e->getMessage());
} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();
    error_log("Login error: " . $e->getMessage());
}

// If we get here, login failed - redirect back to order page
header("Location: order.php");
exit();
?>