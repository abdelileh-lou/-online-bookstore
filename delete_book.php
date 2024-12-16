<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "zaki", "louhichi25", "online_bookstore", 3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if id is provided in the query string
if (isset($_GET['id'])) {
    // Sanitize and validate the id
    $book_id = intval($_GET['id']); // Convert to integer to prevent SQL injection

    // Prepare the DELETE statement
    $stmt = $conn->prepare("DELETE FROM book WHERE id = ?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error); // Check for preparation errors
    }

    // Bind the book_id parameter to the statement
    $stmt->bind_param("i", $book_id);

    // Execute the statement
    $result = $stmt->execute();
    if ($result === false) {
        die("Execution failed: " . $stmt->error); // Check for execution errors
    } else {
        // Redirect back to the admin dashboard or book list
        header("Location: adminDashboard.php?message=book_deleted");
        exit();
    }

    // Close the statement
    $stmt->close();
} else {
    // If id is not set, redirect with an error message
    header("Location: adminDashboard.php?error=no_book_id");
    exit();
}

// Close the database connection
$conn->close();
?>