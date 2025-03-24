<?php

if (empty($_SESSION['basket'])) {
    header('Location: index.php');
    exit;
}

$total_cost = calculateTotal($_SESSION['basket']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="header.css">
</head>
<body>
    <h1>Checkout</h1>
    <p>Total: $<?php echo number_format($total_cost, 2); ?></p>
    <!-- Add your checkout form here -->
</body>
</html>

<?php // comment to fix this shit ?>