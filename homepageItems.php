<?php
include 'db.php'; // Include your database connection file

// Get the category_id from the URL if it's set
$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : '';

// Get the search query from the URL if it's set
$search_query = isset($_GET['search']) ? mysqli_real_escape_string($connection, $_GET['search']) : '';

// Base query to fetch items, optionally filtered by category and search term
$query = "SELECT items.id, items.item_name, items.price, items.picture_path, categories.category_name 
          FROM items 
          JOIN categories ON items.category_id = categories.id";

// If a category_id is provided, filter by category
if ($category_id != '') {
    $query .= " WHERE items.category_id = " . (int)$category_id;
}

// If a search query is provided, filter by item name
if ($search_query != '') {
    if ($category_id != '') {
        $query .= " AND items.item_name LIKE '%$search_query%'";
    } else {
        $query .= " WHERE items.item_name LIKE '%$search_query%'";
    }
}

$result = mysqli_query($connection, $query);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}
?>

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
    <h1 class="text-center mb-4">Items in Stock</h1>
    <div class="row">
        <?php if (mysqli_num_rows($result) > 0): ?>
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
        <?php else: ?>
            <p>No items found</p>
        <?php endif; ?>
    </div>
</div>

<?php
// Close the connection
mysqli_close($connection);
?>
