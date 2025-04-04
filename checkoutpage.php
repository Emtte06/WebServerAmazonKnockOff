<?php
session_start(); // Make sure session is started

// Check if the basket is empty
if (empty($_SESSION['basket'])) {
    header("Location: index.php"); // Redirect to homepage if the cart is empty
    exit();
}

// Function to calculate total cost of the basket
function calculateTotal($basket) {
    $total = 0;
    foreach ($basket as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    return $total;
}

// Calculate the total cost
$total_cost = calculateTotal($_SESSION['basket']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="checkout.css">
    <script>
        function showThankYouPopup() {
            // Show the thank you message popup
            alert("Thank you for your purchase!");
            // Redirect to homepage after 2 seconds
            setTimeout(function() {
                window.location.href = "index.php"; // Redirect to homepage
            }, 2000); // 2000ms = 2 seconds
        }
    </script>
</head>
<body>
    <div class="checkout-container">
        <!-- Order Summary Section -->
        <div class="checkout-summary">
            <h2>Order Summary</h2>
            <?php foreach ($_SESSION['basket'] as $item): ?>
                <div class="basket-item">
                    <span><?php echo htmlspecialchars($item['name']); ?> (x<?php echo $item['quantity']; ?>)</span>
                    <span>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></span>
                </div>
            <?php endforeach; ?>
            <div class="total">
                <strong>Total: $<?php echo number_format($total_cost, 2); ?></strong>
            </div>
        </div>

        <!-- Payment Information Section -->
        <div class="payment-form">
            <h2>Payment Information</h2>
            <form action="process_payment.php" method="POST" onsubmit="event.preventDefault(); showThankYouPopup();">
                <div class="form-group">
                    <label for="card-number">Card Number</label>
                    <input type="text" id="card-number" name="card_number" placeholder="1234 5678 9012 3456" required>
                </div>

                <div class="form-group">
                    <label for="card-expiry">Expiration Date</label>
                    <input type="text" id="card-expiry" name="card_expiry" placeholder="MM/YY" required>
                </div>

                <div class="form-group">
                    <label for="card-cvc">CVC</label>
                    <input type="text" id="card-cvc" name="card_cvc" placeholder="123" required>
                </div>

                <div class="form-group">
                    <label for="card-name">Name on Card</label>
                    <input type="text" id="card-name" name="card_name" placeholder="John Doe" required>
                </div>

                <button type="submit">Place Order</button>
            </form>
        </div>
    </div>
</body>
</html>
