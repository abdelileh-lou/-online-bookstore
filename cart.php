<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update quantity
    if (isset($_POST['book_id'], $_POST['quantity'])) {
        $book_id = intval($_POST['book_id']);
        $new_quantity = intval($_POST['quantity']);
        
        foreach ($_SESSION['cart'] as &$cart_item) {
            if ($cart_item['id'] == $book_id) {
                $cart_item['quantity'] = $new_quantity;
                break;
            }
        }
        
        header("Location: cart.php");
        exit();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Remove item from cart
    if (isset($_GET['book_id'])) {
        $book_id = intval($_GET['book_id']);
        
        foreach ($_SESSION['cart'] as $index => $cart_item) {
            if ($cart_item['id'] == $book_id) {
                unset($_SESSION['cart'][$index]);
                break;
            }
        }
        
        // Re-index the array
        $_SESSION['cart'] = array_values($_SESSION['cart']);
        
        header("Location: shoppingCart.php");
        exit();
    }
}