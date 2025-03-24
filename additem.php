<?php
// Include the database connection and the header
include('db.php');
include('header.php');
// requireAdmin();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_name = $_POST['item_name'];
    $category_id = $_POST['category_id'];
    $manufacturer = $_POST['manufacturer'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $picture_path = $_POST['picture_path']; // Assuming the image path is input directly
    
    $in_stock = $_POST['in_stock'];

    $query = "INSERT INTO items (item_name, category_id, manufacturer, price, description, picture_path, in_stock)
              VALUES ('$item_name', '$category_id', '$manufacturer', '$price', '$description', '$picture_path', '$in_stock')";
    
    if (mysqli_query($connection, $query)) {
        echo "<div class='alert alert-success'>Item added successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($connection) . "</div>";
    }
}

?>

<!-- Item Add Form -->
<body class="bg-light d-flex flex-column min-vh-100">
    <main class="flex-grow-1">
        <form method="POST">
            <div class="mb-3">
                <label for="item_name" class="form-label">Item Name</label>
                <input type="text" class="form-control" id="item_name" name="item_name" required>
            </div>
            
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <?php
                    // Fetch categories from the database
                    $category_query = "SELECT * FROM categories";
                    $categories = mysqli_query($connection, $category_query);
                    while ($category = mysqli_fetch_assoc($categories)) {
                        echo "<option value='" . $category['id'] . "'>" . $category['category_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="manufacturer" class="form-label">Manufacturer</label>
                <input type="text" class="form-control" id="manufacturer" name="manufacturer" required>
            </div>
            
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="picture_path" class="form-label">Picture Path</label>
                <input type="text" class="form-control" id="picture_path" name="picture_path">
            </div>
            
            <div class="mb-3">
                <label for="in_stock" class="form-label">In Stock</label>
                <input type="number" class="form-control" id="in_stock" name="in_stock" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Add Item</button>
        </form>
    </main>
</body>
<?php
// Include the footer
include('footer.php');
?>
