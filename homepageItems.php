<?php
include 'db.php'; // Include your database connection file

// Query to select items from the database
$query = "SELECT item_name, price, picture_path FROM items"; // Include picture_path in the query
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
</style>
<div class="container mt-5">
    <h1 class="text-center mb-4">Items in Stock</h1>
    <div class="row">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow">
                    <!-- Item Image -->
                    <img src="<?php echo htmlspecialchars($row['picture_path']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['item_name']); ?>">
                    <div class="card-body">
                        <!-- Item Name -->
                        <h5 class="card-title"><?php echo htmlspecialchars($row['item_name']); ?></h5>
                        <!-- Item Price -->
                        <p class="card-text">$<?php echo htmlspecialchars($row['price']); ?></p>
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