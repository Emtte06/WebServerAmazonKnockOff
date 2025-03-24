<?php
include('header.php');
requireAdmin();
?>

<body class="bg-light d-flex flex-column min-vh-100">
    <main class="flex-grow-1">
        <div class="container mt-5">
            <h2>Admin Dashboard</h2>
            <p>Welcome to the Admin Dashboard. Choose an action below:</p>

            <div class="row">
                <div class="col-md-4 mb-4">
                    <a href="additem.php" class="btn btn-success btn-lg btn-block">Add Item</a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="adminlistitems.php" class="btn btn-primary btn-lg btn-block">List Items</a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="addcategory.php" class="btn btn-info btn-lg btn-block">Add Category</a>
                </div>
            </div>
        </div>
    </main>
</body>

<?php
// Include the footer
include('footer.php');
?>

<?php // comment to fix this shit ?>