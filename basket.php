<?php
session_start();

// Initialize the basket if it doesn't exist
if (!isset($_SESSION['basket'])) {
    $_SESSION['basket'] = [];
}

// Function to calculate the total cost of the basket
function calculateTotal($basket) {
    $total = 0;
    foreach ($basket as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    return $total;
}

// Add a product to the basket (example)
if (isset($_POST['add_to_basket'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $quantity = $_POST['quantity'];

    $_SESSION['basket'][] = [
        'id' => $product_id,
        'name' => $product_name,
        'price' => $product_price,
        'quantity' => $quantity
    ];
}

// Remove a product from the basket (example)
if (isset($_GET['remove_from_basket'])) {
    $product_id = $_GET['remove_from_basket'];
    foreach ($_SESSION['basket'] as $key => $item) {
        if ($item['id'] == $product_id) {
            unset($_SESSION['basket'][$key]);
            break;
        }
    }
}

$total_cost = calculateTotal($_SESSION['basket']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basket</title>
    
</head>
<body>
    <div class="basket-window">
        <h3>Your Basket</h3>
        <?php if (empty($_SESSION['basket'])): ?>
            <p>Your basket is empty.</p>
        <?php else: ?>
            <?php foreach ($_SESSION['basket'] as $item): ?>
                <div class="basket-item">
                    <p><?php echo $item['name']; ?> (x<?php echo $item['quantity']; ?>)</p>
                    <p>Price: $<?php echo number_format($item['price'] * $item['quantity'], 2); ?></p>
                    <a href="basket.php?remove_from_basket=<?php echo $item['id']; ?>">Remove</a>
                </div>
            <?php endforeach; ?>
            <p><strong>Total: $<?php echo number_format($total_cost, 2); ?></strong></p>
            <a href="checkoutpage.php"><button class="checkout-button">Checkout</button></a>
        <?php endif; ?>
    </div>
</body>
</html>

<?php // comment to fix this shit ?>