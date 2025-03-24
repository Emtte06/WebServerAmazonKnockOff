
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .custom-container {
            max-width: 500px;
            margin: 2rem auto;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .form-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .btn-custom {
            width: 100%;
            margin-top: 1rem;
        }
    </style>
</head>
<body class="bg-light d-flex flex-column min-vh-100">
    <main class="flex-grow-1">
        <?php include('header.php'); ?>
        
        <div class="my-5 pt-2"></div>

        <div class="container">
            <div class="custom-container bg-white">
                <div class="form-header">
                    <h2 class="mb-3">Welcome Back!</h2>
                    <p class="text-muted">Please login to continue</p>
                </div>
                
                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" id="email" 
                            placeholder="Enter your email" required>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" 
                            placeholder="Enter your password" required>
                    </div>

                    <button type="submit" class="btn btn-success btn-custom">Login</button>
                    
                    <div class="text-center mt-3">
                        <p class="text-muted">Don't have an account? 
                            <a href="signupForm.php" class="btn btn-link p-0">Sign Up</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <?php include('footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<?php // comment to fix this shit ?>