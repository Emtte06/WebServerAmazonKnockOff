<?php


// Om varukorgen är tom, omdirigera till startsidan
if (empty($_SESSION['basket'])) {
    header('Location: index.php');
    exit;
}

// Funktion för att beräkna totalpriset
function calculateTotal($basket) {
    $total = 0;
    foreach ($basket as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    return $total;
}

$total_cost = calculateTotal($_SESSION['basket']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="checkout.css">
      
</head>
<body>
    <div class="checkout-container">
        <!-- Sammanfattning av varukorgen -->
        <div class="checkout-summary">
            <h2>Order Summary</h2>
            <?php foreach ($_SESSION['basket'] as $item): ?>
                <div class="basket-item">
                    <span><?php echo $item['name']; ?> (x<?php echo $item['quantity']; ?>)</span>
                    <span>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></span>
                </div>
            <?php endforeach; ?>
            <div class="total">
                Total: $<?php echo number_format($total_cost, 2); ?>
            </div>
        </div>

        <!-- Betalningsformulär -->
        <div class="payment-form">
            <h2>Payment Information</h2>
            <form action="process_payment.php" method="POST">
                <label for="card-number">Card Number</label>
                <input type="text" id="card-number" name="card_number" placeholder="1234 5678 9012 3456" required>

                <label for="card-expiry">Expiration Date</label>
                <input type="text" id="card-expiry" name="card_expiry" placeholder="MM/YY" required>

                <label for="card-cvc">CVC</label>
                <input type="text" id="card-cvc" name="card_cvc" placeholder="123" required>

                <label for="card-name">Name on Card</label>
                <input type="text" id="card-name" name="card_name" placeholder="John Doe" required>

                <button type="submit">Place Order</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php // comment to fix this shit ?>