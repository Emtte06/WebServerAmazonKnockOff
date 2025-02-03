<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div>
        <?php include 'header.php';?>

    <style>
        .product-image {
            max-width: 100%;
            height: auto;
        }
        .product-info {
            padding: 20px;
        }
        .product-options {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <!-- Product Image -->
            <div class="col-md-6">
                <img src="path_to_your_image.jpg" alt="Product Image" class="product-image">
            </div>
            <!-- Product Details -->
            <div class="col-md-6 product-info">
                <h1></h1>
                <p class="text-muted"></p>
                <hr>
                <h3></h3>
                <p><strong>Style:</strong> </p>
                <p><strong>Color:</strong> </p>
                <p><strong>Material:</strong> </p>
                <p><strong>Special Feature:</strong> </p>
                <div class="product-options">
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" min="1" max="10" value="1">
                    <button class="btn btn-primary">Add to Basket</button>
                    <button class="btn btn-success">Buy Now</button>
                </div>
                <hr>
                <p><strong>Delivery:</strong> FREE delivery</p>
                <p><strong>Sold by:</strong> </p>
                <p><strong>Returns:</strong> Returnable within 30 days of receipt</p>
            </div>
        </div>
        <!-- Product Description -->
        <div class="row mt-4">
            <div class="col-12">
                <h2>About this item</h2>
                <ul>
                    <li><strong></strong></li>
                    <li><strong></strong></li>
                    <li><strong></strong></li>
                    <li><strong></strong></li>
                    <li><strong></strong></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Reviews Section -->
<div class="container mt-5">
    <h2>Customer Reviews</h2>
    <div class="row">
        <!-- Average Rating -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Average Rating</h3>
                    <p class="display-4"><?php echo number_format($average_rating, 1); ?> <small class="text-muted">/ 5</small></p>
                </div>
            </div>
        </div>

    <!-- Individual Reviews -->
    <div class="mt-4">
        <h3>Customer Reviews</h3>
        <?php if (empty($reviews)): ?>
            <p>No reviews yet. Be the first to review this product!</p>
        <?php else: ?>
            <?php foreach ($reviews as $review): ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($review['user_name']); ?></h5>
                        <div class="rating mb-2">
                            <?php echo str_repeat('★', $review['rating']) . str_repeat('☆', 5 - $review['rating']); ?>
                        </div>
                        <p class="card-text"><?php echo htmlspecialchars($review['review_text']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Add this CSS for the reviews section -->
<style>
    .graph {
        display: flex;
        align-items: flex-end;
        height: 150px;
        gap: 5px;
        margin-top: 20px;
    }
    .bar {
        flex: 1;
        background-color: #007bff;
        border-radius: 3px;
    }
    .rating {
        color: gold;
        font-size: 20px;
    }
    .card {
        margin-bottom: 10px;
    }
</style>
        <?php include 'footer.php';?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </div>
</body>
</html>