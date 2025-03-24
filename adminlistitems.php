<?php
// Include the database connection and the header
include('db.php');
include('header.php');
// requireAdmin();

// Handle item deletion
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Delete item query
    $delete_query = "DELETE FROM items WHERE id = '$delete_id'";

    if (mysqli_query($connection, $delete_query)) {
        echo "<div class='alert alert-success'>Item deleted successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($connection) . "</div>";
    }
}

// Fetch all items from the database
$query = "SELECT * FROM items";
$result = mysqli_query($connection, $query);
?>
<body class="bg-light d-flex flex-column min-vh-100">
    <main class="flex-grow-1">
        <h2>Items List</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Item Name</th>
                    <th>Category</th>
                    <th>Manufacturer</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($item = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?php echo $item['id']; ?></td>
                        <td><?php echo htmlspecialchars($item['item_name']); ?></td>
                        <td>
                            <?php
                            // Fetch category name
                            $category_id = $item['category_id'];
                            $category_query = "SELECT category_name FROM categories WHERE id = '$category_id'";
                            $category_result = mysqli_query($connection, $category_query);
                            $category = mysqli_fetch_assoc($category_result);
                            echo $category['category_name'];
                            ?>
                        </td>
                        <td><?php echo htmlspecialchars($item['manufacturer']); ?></td>
                        <td><?php echo htmlspecialchars($item['price']); ?> USD</td>
                        <td><?php echo htmlspecialchars($item['in_stock']); ?></td>
                        <td>
                            <!-- Edit Button -->
                            <a href="edititem.php?id=<?php echo $item['id']; ?>" class="btn btn-warning btn-sm">Edit</a>

                            <!-- Delete Button (with confirmation) -->
                            <a href="?delete_id=<?php echo $item['id']; ?>" class="btn btn-danger btn-sm" 
                            onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>
</body>

<?php
// Include the footer
include('footer.php');
?>

<?php // comment to fix this shit ?>