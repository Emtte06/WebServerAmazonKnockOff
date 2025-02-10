<?php
include 'db.php';

// Get product ID from URL
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($product_id <= 0) {
    die("Invalid product ID");
}

// Fetch product details
$product_query = "SELECT * FROM items WHERE id = $product_id";
$product_result = mysqli_query($connection, $product_query);

if (!$product_result || mysqli_num_rows($product_result) === 0) {
    die("Product not found");
}

$product = mysqli_fetch_assoc($product_result);

// Fetch reviews and average rating
$reviews = [];
$average_rating = 0;

$reviews_query = "SELECT u.username, ur.rating, ur.review_text 
                  FROM user_reviews ur
                  JOIN users u ON ur.user_id = u.id
                  WHERE ur.item_id = $product_id
                  ORDER BY ur.created_at DESC";
                  
$reviews_result = mysqli_query($connection, $reviews_query);

if ($reviews_result) {
    while ($row = mysqli_fetch_assoc($reviews_result)) {
        $reviews[] = $row;
    }
}

// Calculate average rating
$rating_query = "SELECT AVG(rating) as avg_rating FROM user_reviews WHERE item_id = $product_id";
$rating_result = mysqli_query($connection, $rating_query);
if ($rating_result) {
    $rating_row = mysqli_fetch_assoc($rating_result);
    $average_rating = number_format($rating_row['avg_rating'] ?? 0, 1);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['item_name']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-image { max-width: 100%; height: auto; }
        .product-info { padding: 20px; }
        .product-options { margin-top: 20px; }
        .rating { color: gold; font-size: 20px; }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    
    <div class="container mt-5">
        <div class="row">
            <!-- Product Image -->
            <div class="col-md-6">
                <img src="<?= htmlspecialchars($product['picture_path']) ?>" 
                     alt="<?= htmlspecialchars($product['item_name']) ?>" 
                     class="product-image">
            </div>
            
            <!-- Product Details -->
            <div class="col-md-6 product-info">
                <h1><?= htmlspecialchars($product['item_name']) ?></h1>
                <?php if ($product['manufacturer']): ?>
                    <p class="text-muted">Manufacturer: <?= htmlspecialchars($product['manufacturer']) ?></p>
                <?php endif; ?>
                <hr>
                <h3>$<?= number_format($product['price'], 2) ?></h3>
                <p><strong>In Stock:</strong> <?= $product['in_stock'] ?> units</p>
                
                <div class="product-options">
                    <form action="add_to_cart.php" method="post">
                        <input type="hidden" name="item_id" value="<?= $product_id ?>">
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" 
                               min="1" max="10" value="1">
                        <button type="submit" class="btn btn-primary">Add to Basket</button>
                        <button type="submit" class="btn btn-success" name="buy_now">Buy Now</button>
                    </form>
                </div>
                
                <hr>
                <p><strong>Delivery:</strong> FREE delivery</p>
                <p><strong>Returns:</strong> Returnable within 30 days of receipt</p>
            </div>
        </div>

        <!-- Product Description -->
        <div class="row mt-4">
            <div class="col-12">
                <h2>About this item</h2>
                <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
            </div>
        </div>

        <!-- Reviews Section -->
        <div class="row mt-5">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Average Rating</h3>
                        <p class="display-4"><?= $average_rating ?> <small class="text-muted">/ 5</small></p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8 mt-4">
                <h3>Customer Reviews</h3>
                <?php if (empty($reviews)): ?>
                    <p>No reviews yet. Be the first to review this product!</p>
                <?php else: ?>
                    <?php foreach ($reviews as $review): ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($review['username']) ?></h5>
                                <div class="rating mb-2">
                                    <?= str_repeat('★', $review['rating']) . str_repeat('☆', 5 - $review['rating']) ?>
                                </div>
                                <p class="card-text"><?= htmlspecialchars($review['review_text']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>