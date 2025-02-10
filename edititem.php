<?php
// Include the database connection and the header
include('auth.php');
include('db.php');
include('header.php');
// requireAdmin();

// Check if item ID is provided
$item_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the existing item data from the database
$query = "SELECT * FROM items WHERE id = '$item_id'";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) == 0) {
    echo "<div class='alert alert-danger'>Item not found.</div>";
    exit;
}

$item = mysqli_fetch_assoc($result);

// Handle form submission to update the item
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_name = $_POST['item_name'];
    $category_id = $_POST['category_id'];
    $manufacturer = $_POST['manufacturer'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $picture_path = $_POST['picture_path']; // Assuming image path input
    $in_stock = $_POST['in_stock'];

    $update_query = "UPDATE items SET 
                        item_name = '$item_name',
                        category_id = '$category_id',
                        manufacturer = '$manufacturer',
                        price = '$price',
                        description = '$description',
                        picture_path = '$picture_path',
                        in_stock = '$in_stock'
                    WHERE id = '$item_id'";

    if (mysqli_query($connection, $update_query)) {
        echo "<div class='alert alert-success'>Item updated successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($connection) . "</div>";
    }
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<!-- Item Edit Form -->
<body class="bg-light d-flex flex-column min-vh-100">
    <main class="flex-grow-1">
        <form method="POST">
            <div class="mb-3">
                <label for="item_name" class="form-label">Item Name</label>
                <input type="text" class="form-control" id="item_name" name="item_name" value="<?php echo htmlspecialchars($item['item_name']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <?php
                    // Fetch categories from the database
                    $category_query = "SELECT * FROM categories";
                    $categories = mysqli_query($connection, $category_query);
                    while ($category = mysqli_fetch_assoc($categories)) {
                        $selected = $category['id'] == $item['category_id'] ? 'selected' : '';
                        echo "<option value='" . $category['id'] . "' $selected>" . $category['category_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="manufacturer" class="form-label">Manufacturer</label>
                <input type="text" class="form-control" id="manufacturer" name="manufacturer" value="<?php echo htmlspecialchars($item['manufacturer']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($item['price']); ?>" step="0.01" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required><?php echo htmlspecialchars($item['description']); ?></textarea>
            </div>

            <div class="mb-3">
                <label for="picture_path" class="form-label">Picture Path</label>
                <input type="text" class="form-control" id="picture_path" name="picture_path" value="<?php echo htmlspecialchars($item['picture_path']); ?>">
            </div>

            <div class="mb-3">
                <label for="in_stock" class="form-label">In Stock</label>
                <input type="number" class="form-control" id="in_stock" name="in_stock" value="<?php echo htmlspecialchars($item['in_stock']); ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Item</button>
        </form>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<?php
// Include the footer
include('footer.php');
?>
