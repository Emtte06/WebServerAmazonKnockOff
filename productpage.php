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

// Fetch reviews and ratings data
$reviews = [];
$average_rating = 0;
$review_count = 0; // Initialize review count

// Fetch all reviews for this product
$reviews_query = "SELECT u.username, ur.rating, ur.review_text, ur.created_at 
                 FROM user_reviews ur
                 JOIN users u ON ur.user_id = u.id
                 WHERE ur.item_id = $product_id
                 ORDER BY ur.created_at DESC";
$reviews_result = mysqli_query($connection, $reviews_query);

if ($reviews_result) {
    $reviews = mysqli_fetch_all($reviews_result, MYSQLI_ASSOC);
    $review_count = count($reviews); // Get count from the result set
}

// Calculate average rating (optimized version)
$rating_query = "SELECT 
                 AVG(rating) as avg_rating,
                 COUNT(*) as review_count 
                 FROM user_reviews 
                 WHERE item_id = $product_id";
$rating_result = mysqli_query($connection, $rating_query);

// Check if current user has already reviewed this product
$user_review = [];
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $check_review_query = "SELECT * FROM user_reviews 
                          WHERE user_id = $user_id AND item_id = $product_id";
    $check_review_result = mysqli_query($connection, $check_review_query);
    $user_review = mysqli_fetch_assoc($check_review_result);
}

if ($rating_result) {
    $rating_data = mysqli_fetch_assoc($rating_result);
    $average_rating = number_format($rating_data['avg_rating'] ?? 0, 1);
    $review_count = $rating_data['review_count'] ?? 0; // More accurate count
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
                    <input type="number" id="quantity" name="quantity" min="1" max="10" value="1">
                    <button type="submit" class="btn btn-success" name="add_to_cart">Add to Basket</button>
                    <button type="submit" class="btn btn-primary" name="buy_now">Buy Now</button>
                </form>


                                                <!-- Dynamic Review Button -->
                            <button type="button" class="btn btn-warning" 
                                    style="background-color:rgb(229, 255, 0); border-radius: 8px;" 
                                    data-bs-toggle="modal" data-bs-target="#reviewModal">
                                <?= empty($user_review) ? 'Write a Review' : 'View/Edit Review' ?>
                            </button>

                        <!-- Review Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel">
                    <?= empty($user_review) ? 'Write a Review' : 'Edit Your Review' ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="submit_review.php" method="post">
                    <input type="hidden" name="item_id" value="<?= $product_id ?>">
                    
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating (1-5):</label>
                        <input type="number" class="form-control" name="rating" 
                               min="1" max="5" required
                               value="<?= $user_review['rating'] ?? '' ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="review_text" class="form-label">Your Review:</label>
                        <textarea class="form-control" name="review_text" rows="3" required><?= 
                            htmlspecialchars($user_review['review_text'] ?? '') 
                        ?></textarea>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">
                            <?= empty($user_review) ? 'Submit Review' : 'Update Review' ?>
                        </button>
                        
                        <?php if (!empty($user_review)): ?>
                            <a href="delete_review.php?review_id=<?= $user_review['review_id'] ?>&item_id=<?= $product_id ?>" 
                               class="btn btn-danger"
                               onclick="return confirm('Are you sure you want to delete this review?')">
                                Delete Review
                            </a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
                        <div class="average-rating">
                            <span class="stars"><?= str_repeat('★', round($average_rating)) . str_repeat('☆', 5 - round($average_rating)) ?></span>
                            <p class="display-4"><?= $average_rating ?> <small class="text-muted">/ 5</small></p>
                            <small class="text-muted">(<?= $review_count ?> reviews)</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8 mt-4">
                <h3>Customer Reviews</h3>
                <?php if (empty($reviews)): ?>
                    <p>No reviews yet. Be the first to review this product!</p>
                <?php else: ?>
                    <div class="review-list">
                        <?php foreach ($reviews as $review): ?>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($review['username']) ?></h5>
                                    <div class="rating mb-2">
                                        <?= str_repeat('★', $review['rating']) . str_repeat('☆', 5 - $review['rating']) ?>
                                    </div>
                                    <p class="card-text"><?= nl2br(htmlspecialchars($review['review_text'])) ?></p>
                                    <small class="text-muted">
                                        Posted on <?= date('F j, Y', strtotime($review['created_at'])) ?>
                                    </small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php include 'bot.html'; ?>
<?php include 'footer.php'; ?> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
