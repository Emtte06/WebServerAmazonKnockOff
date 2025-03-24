<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized");
}

$review_id = intval($_GET['review_id']);
$item_id = intval($_GET['item_id']);

// Verify user owns this review
$check_query = "SELECT * FROM user_reviews 
               WHERE review_id = $review_id 
               AND user_id = {$_SESSION['user_id']}";
$check_result = mysqli_query($connection, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    // Delete the review
    $delete_query = "DELETE FROM user_reviews WHERE review_id = $review_id";
    mysqli_query($connection, $delete_query);
}

header("Location: productpage.php?id=$item_id");
exit();
?>