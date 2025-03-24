<?php
session_start();
include('db.php');

// Error message initialization
$error = '';

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form inputs
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        $error = 'Passwords do not match.';
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if email or username already exists in the database
        $query = "SELECT id FROM users WHERE email = '$email' OR username = '$username'";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0) {
            $error = 'Username or email already exists.';
        } else {
            // Insert new user into the database
            $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
            if (mysqli_query($connection, $query)) {
                // Redirect to the login page
                header('Location: loginForm.php');
                exit();
            } else {
                $error = 'Error: ' . mysqli_error($connection);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - Error</title>
</head>
<body>

    <h2>Signup Failed</h2>

    <?php if ($error) { echo "<p style='color:red;'>$error</p>"; } ?>

    <p><a href="signupForm.php">Go back to signup page</a></p>

</body>
</html>

<?php // comment to fix this shit ?>