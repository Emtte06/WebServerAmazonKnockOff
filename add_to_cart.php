<?php
session_start();
include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_id = isset($_POST['item_id']) ? intval($_POST['item_id']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    if ($item_id <= 0 || $quantity <= 0) {
        die("Invalid product ID or quantity.");
    }

    // Get product details from database
    $query = "SELECT * FROM items WHERE id = $item_id";
    $result = mysqli_query($connection, $query);

    if (!$result || mysqli_num_rows($result) === 0) {
        die("Product not found.");
    }

    $product = mysqli_fetch_assoc($result);

    // Initialize basket if not set
    if (!isset($_SESSION['basket'])) {
        $_SESSION['basket'] = [];
    }

    // Check if product is already in basket and update quantity
    $found = false;
    foreach ($_SESSION['basket'] as &$item) {
        if ($item['id'] == $item_id) {
            $item['quantity'] += $quantity;
            $found = true;
            break;
        }
    }

    // If not found, add it to the basket
    if (!$found) {
        $_SESSION['basket'][] = [
            'id' => $item_id,
            'name' => $product['item_name'],
            'price' => $product['price'],
            'quantity' => $quantity,
            'picture_path' => $product['picture_path']
        ];
    }
    
    // Redirect to checkout or product page
    if (isset($_POST['buy_now'])) {
        header('Location: checkoutpage.php');
        exit;
    } else {
        header('Location: productpage.php?id=' . $item_id);
        exit;
    }
}
