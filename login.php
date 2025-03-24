<?php
include('db.php');
include('auth.php');

// Error message initialization
$error = '';

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form inputs
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = $_POST['password'];

    // Query to find the user by email
    $query = "SELECT id, username, password, isAdmin FROM users WHERE email = '$email'";
    $result = mysqli_query($connection, $query);

    // Check if the user exists
    if (mysqli_num_rows($result) > 0) {
        // Fetch the user data
        $user = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Password is correct, start the session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['isAdmin'] = $user['isAdmin'];


            // Redirect to the dashboard or home page
            header('Location: index.php'); // CAN BE CHANGED LATER
            exit();
        } else {
            // Incorrect password
            $error = 'Invalid email or password';
        }
    } else {
        // User not found
        $error = 'Invalid email or password';
    }
}
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Error</title>
</head>
<body>
    
    <h2>Login Failed</h2>

    <?php if ($error) { echo "<p style='color:red;'>$error</p>"; } ?>

    <p><a href="loginForm.php">Go back to login page</a></p> <!-- byt login.php till den som faktiskt ska användas -->

</body>
</html>
