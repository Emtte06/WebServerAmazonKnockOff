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
                <div class="rating">
                    <span class="text-warning">★★★★☆</span>
                    <span class="text-muted"></span>
                </div>
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
                    <li><strong>:</strong></li>
                    <li><strong></strong></li>
                    <li><strong></strong></li>
                    <li><strong></strong></li>
                </ul>
            </div>
        </div>
    </div>

        <?php include 'footer.php';?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </div>
</body>
</html>