<?php
include 'db.php'; // Include your database connection file

// Get the category ID from the URL (example: category.php?id=1)
$category_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Query to select items from the selected category
$query = "SELECT items.id, items.item_name, items.price, items.picture_path, categories.category_name 
          FROM items 
          JOIN categories ON items.category_id = categories.id 
          WHERE categories.id = $category_id"; 

$result = mysqli_query($connection, $query);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}

// Fetch the category name to display on the page
$category_query = "SELECT category_name FROM categories WHERE id = $category_id";
$category_result = mysqli_query($connection, $category_query);
$category_name = mysqli_fetch_assoc($category_result)['category_name'];

?>

<!-- HTML and CSS for displaying items -->
<style>
    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: scale(1.05);
    }
    .card-img-top {
        height: 200px;
        object-fit: cover;
    }
    .category-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 14px;
    }
</style>

<div class="container mt-5">
    <h1 class="text-center mb-4">Items in Category: <?php echo htmlspecialchars($category_name); ?></h1>
    <div class="row">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow">
                    <!-- Item Image -->
                    <img src="<?php echo htmlspecialchars($row['picture_path']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['item_name']); ?>">
                    <!-- Category Badge -->
                    <div class="category-badge">
                        <?php echo htmlspecialchars($row['category_name']); ?>
                    </div>
                    <div class="card-body">
                        <!-- Item Name -->
                        <h5 class="card-title"><?php echo htmlspecialchars($row['item_name']); ?></h5>
                        <!-- Item Price -->
                        <p class="card-text">$<?php echo htmlspecialchars($row['price']); ?></p>
                        <a href="productpage.php?id=<?php echo $row['id']; ?>">
                            <button class="btn btn-success" style="background-color: #07ad1c; color: white;">More Details</button>
                        </a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php
// Close the connection
mysqli_close($connection);
?>
