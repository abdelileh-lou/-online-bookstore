<?php
session_start();
$conn = new mysqli("localhost", "zaki", "louhichi25", "online_bookstore", 3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add debugging output
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['user_id'])) {
    $id = intval($_GET['user_id']);
    
    // Debug: Print the received user_id
    echo "Received user_id: " . $id . "<br>";
    
    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("i", $id);
    $result = $stmt->execute();
    
    if ($result === false) {
        die("Execution failed: " . $stmt->error);
    } else {
        // Debug: Confirm deletion
        echo "User deleted successfully. Rows affected: " . $stmt->affected_rows;
        header("Location: adminDashboard.php");
        exit();
    }
    
    $stmt->close();
} else {
    // Debug: Show why no user_id was detected
    echo "No user_id received. Check your link/form.<br>";
    echo "GET parameters: " . print_r($_GET, true);
    header("Location: adminDashboard.php?error=no_user_id");
    exit();
}

$conn->close();
?>