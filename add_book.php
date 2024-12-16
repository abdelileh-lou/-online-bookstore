<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "zaki", "louhichi25", "online_bookstore", 3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted via POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate the input fields
    $title = $conn->real_escape_string(trim($_POST['title'])); // Updated to match 'title'
    $author = $conn->real_escape_string(trim($_POST['author']));
    $price = floatval($_POST['price']);
    $book_cover = $conn->real_escape_string(trim($_POST['book_cover'])); // Make sure this matches your column name

    // Validate required fields
    if (empty($title) || empty($author) || empty($price)) {
        die("Error: Missing fields");
    }

    // Insert the book into the database (make sure to use the correct column name for book cover)
    $sql = "INSERT INTO book (tittle, author, price, urlimage) VALUES (?, ?, ?, ?)";  // Or use `image_url` if that's what your table uses
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters, make sure to match the correct types: s = string, d = double
    $stmt->bind_param("ssds", $title, $author, $price, $book_cover); // Ensure 'cover_url' exists in your table

    if ($stmt->execute()) {
        echo "Record inserted successfully";
    } else {
        die("Error inserting record: " . $stmt->error);
    }

    $stmt->close();
} else {
    echo "Form not submitted via POST";
    exit();
}

// Close the database connection
$conn->close();
?>