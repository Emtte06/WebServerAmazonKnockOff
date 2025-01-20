<?php
session_start(); // Startar sessionen
include 'db.php'; // Kopplar till databasen

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Hämta användarnamn och lösenord från formuläret
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = $_POST['password']; // Ingen hashing här, det kommer jämföras med password_verify()

    // Hämta användarens data från databasen
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        // Jämför inskrivet lösenord med det hashade lösenordet i databasen
        if (password_verify($password, $user['password'])) {
            // Lösenordet är korrekt, sätt sessionsvariabler
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $user['username'];

            header('Location: movies.php'); // Skicka användaren vidare
            exit;
        } else {
            // Fel lösenord
            $_SESSION['login_error'] = 'Invalid username or password!';
            header('Location: login.php');
            exit;
        }
    } else {
        // Användaren hittades inte
        $_SESSION['login_error'] = 'Invalid username or password!';
        header('Location: login.php');
        exit;
    }
}
?>
