<?php
// Include the database connection and the header
include('db.php');
include('header.php');
// requireAdmin();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_name = $_POST['category_name'];

    $query = "INSERT INTO categories (category_name) VALUES ('$category_name')";
    
    if (mysqli_query($connection, $query)) {
        echo "<div class='alert alert-success'>Category added successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($connection) . "</div>";
    }
}

?>

<!-- Category Add Form -->
<body class="bg-light d-flex flex-column min-vh-100">
    <main class="flex-grow-1">
        <form method="POST">
            <div class="mb-3">
                <label for="category_name" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="category_name" name="category_name" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Add Category</button>
        </form>
    </main>
</body>

<?php
// Include the footer
include('footer.php');
?>

<?php // comment to fix this shit ?>