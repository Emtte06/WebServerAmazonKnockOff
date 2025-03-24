<?php
session_start();
include 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to submit a review");
}

// Get form data
$user_id = $_SESSION['user_id'];
$item_id = $_POST['item_id'];
$rating = intval($_POST['rating']);
$review_text = mysqli_real_escape_string($connection, $_POST['review_text']);

// Validate input
if ($rating < 1 || $rating > 5) {
    die("Rating must be between 1 and 5");
}

// Insert review into database (modified for your exact table structure)
$query = "INSERT INTO user_reviews (rating, review_text, user_id, item_id) 
          VALUES ($rating, '$review_text', $user_id, $item_id)";

if (mysqli_query($connection, $query)) {
    // Redirect back to product page
    header("Location: productpage.php?id=$item_id");
    exit();
} else {
    die("Error submitting review: " . mysqli_error($connection));
}
?>