<?php
session_start();
include('db.php');

// Error message initialization
$error = '';

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form inputs
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the SQL query to find the user by email
    $query = 'SELECT id, username, password FROM users WHERE email = :email';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Password is correct, start the session and store user details
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // Redirect to the dashboard or home page
        header('Location: dashboard.php');
        exit();
    } else {
        // Invalid credentials
        $error = 'Invalid email or password';
    }
}
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

    <p><a href="login.php">Go back to login page</a></p> <!-- byt login.php till den som faktiskt ska användas -->

</body>
</html>
