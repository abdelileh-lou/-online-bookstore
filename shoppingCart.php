<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "zaki", "louhichi25", "online_bookstore", 3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: login.php");
    exit();
}

// Initialize cart in session if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add book to cart if book_id is provided
if (isset($_GET['book_id'])) {
    $book_id = intval($_GET['book_id']);
    
    // Check if book exists in database
    $sql = "SELECT id, tittle, author, price, urlimage FROM book WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
        
        // Check if book already in cart
        $book_exists = false;
        foreach ($_SESSION['cart'] as &$cart_item) {
            if ($cart_item['id'] == $book_id) {
                $cart_item['quantity']++;
                $book_exists = true;
                break;
            }
        }
        
        // If book not in cart, add it
        if (!$book_exists) {
            $book['quantity'] = 1;
            $_SESSION['cart'][] = $book;
        }
    }
    
    $stmt->close();
}

// Calculate total
$total = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <style>
    /* General styles */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f8f9fa;
        color: #333;
    }

    /* Container styling */
    .container {
        max-width: 800px;
        margin: 30px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    /* Heading styling */
    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    /* Table styling */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    thead {
        background-color: #007bff;
        color: #fff;
    }

    th,
    td {
        padding: 10px;
        text-align: center;
        border: 1px solid #ddd;
    }

    th {
        font-weight: bold;
    }

    tbody tr:hover {
        background-color: #f1f1f1;
    }

    tfoot {
        font-weight: bold;
        background-color: #f9f9f9;
    }

    /* Image styling */
    img {
        max-height: 50px;
        border-radius: 4px;
    }

    /* Form styling */
    form {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    input[type="number"] {
        width: 50px;
        padding: 5px;
        border: 1px solid #ddd;
        border-radius: 4px;
        text-align: center;
    }

    button {
        padding: 5px 10px;
        border: none;
        background-color: #00c6ff;
        color: #fff;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #00c6ff;
    }

    /* Link styling */
    a {
        color: #0072ff;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    /* Empty cart message */
    p {
        text-align: center;
        color: #666;
        font-size: 18px;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2>Your Shopping Cart</h2>

        <?php if (empty($_SESSION['cart'])): ?>
        <p>Your cart is empty.</p>
        <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Book</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                <tr>
                    <td>
                        <img src="../miniProject/images/<?php echo htmlspecialchars($item['urlimage']); ?>" width="50">
                        <?php echo htmlspecialchars($item['tittle']); ?>
                    </td>
                    <td>$<?php echo number_format($item['price'], 2); ?></td>
                    <td>
                        <form method="post" action="update_cart.php">
                            <input type="hidden" name="book_id" value="<?php echo $item['id']; ?>">
                            <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1">
                            <button type="submit">Update</button>
                        </form>
                    </td>
                    <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                    <td>
                        <a href="cart.php?book_id=<?php echo $item['id']; ?>">Remove</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">Total</td>
                    <td>$<?php echo number_format($total, 2); ?></td>
                </tr>
            </tfoot>
        </table>
        <?php endif; ?>
    </div>
</body>

</html>