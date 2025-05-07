<?php
session_start();
require 'db_config.php';

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verify database connection
if (!isset($pdo)) {
    die("Database connection not established. Please check your db_config.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate required fields
    $required = ['name', 'email', 'contact', 'date', 'time', 'people'];
    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            $_SESSION['reservation_error'] = "Error: $field is required";
            header("Location: reservation.php?error=1");
            exit();
        }
    }

    // Sanitize inputs
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $contact = htmlspecialchars(trim($_POST['contact']));
    $date = htmlspecialchars(trim($_POST['date']));
    $time = htmlspecialchars(trim($_POST['time']));
    $people = intval($_POST['people']);
    $special_requests = isset($_POST['special_requests']) ? htmlspecialchars(trim($_POST['special_requests'])) : '';

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['reservation_error'] = "Invalid email format";
        header("Location: reservation.php?error=1");
        exit();
    }

    // Validate date is in the future
    $today = new DateTime();
    $reservationDate = new DateTime($date);
    if ($reservationDate < $today) {
        $_SESSION['reservation_error'] = "Reservation date must be in the future";
        header("Location: reservation.php?error=1");
        exit();
    }

    // Check if user is logged in
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    try {
        // Prepare SQL statement
        $sql = "INSERT INTO reservations (user_id, name, email, contact_number, 
                reservation_date, reservation_time, number_of_people, special_requests) 
                VALUES (:user_id, :name, :email, :contact, :rdate, :rtime, :people, :requests)";
        
        $stmt = $pdo->prepare($sql); // Use $pdo here
        
        // Bind parameters
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':contact', $contact, PDO::PARAM_STR);
        $stmt->bindParam(':rdate', $date, PDO::PARAM_STR);
        $stmt->bindParam(':rtime', $time, PDO::PARAM_STR);
        $stmt->bindParam(':people', $people, PDO::PARAM_INT);
        $stmt->bindParam(':requests', $special_requests, PDO::PARAM_STR);

        // Execute
        if ($stmt->execute()) {
            $_SESSION['reservation_success'] = true;
            header("Location: reservation.php?success=1");
            exit();
        } else {
            throw new Exception("Database error: Failed to execute query");
        }
    } catch (PDOException $e) {
        error_log("Reservation PDO error: " . $e->getMessage());
        $_SESSION['reservation_error'] = "Database error. Please try again later.";
        header("Location: reservation.php?error=1");
        exit();
    } catch (Exception $e) {
        error_log("Reservation error: " . $e->getMessage());
        $_SESSION['reservation_error'] = "An error occurred. Please try again.";
        header("Location: reservation.php?error=1");
        exit();
    }
} else {
    header("Location: reservation.php");
    exit();
}
?>
