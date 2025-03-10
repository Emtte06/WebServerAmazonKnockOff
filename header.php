<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Header with Basket</title>
  <link rel="stylesheet" href="header.css">
  
</head>
<body>
  <!-- Header -->
  <div class="header">
    <div class="Head">
      <div class="container-fluid d-flex justify-content-between align-items-center">
        <a href="index.php" class="btn btn-success me-2">Home</a>
        <button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-label="Toggle navigation">
          More
        </button>
        <a href="loginForm.php" class="btn btn-success me-2">Login</a>
        <a href="adminlanding.php" class="btn btn-success me-2">Admin</a>
        <form class="form-inline my-2 my-lg-0 d-flex">
          <input class="form-control me-3" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-success" type="submit">Search</button>
        </form>
        <!-- Basket-knapp -->
        <button class="btn btn-success" onclick="toggleBasket()">Basket</button>
      </div>
    </div>
  </div>

  <!-- Navbar (befintlig) -->
  <div class="nav">
    <div class="collapse" id="navbarToggleExternalContent" data-bs-theme="dark" style="width: 100%; margin: auto; background-color: #07ad1c;">
      <div class="p-2">
        <div class="d-grid gap-2" style="max-width: 90%; margin: auto;">
          <div class="bg-body-tertiary border rounded-3" style="height: 200px;"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- Waves (befintlig) -->
  <div>
    <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
      <defs>
        <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
      </defs>
      <g class="parallax">
        <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(7, 200, 31,0.7)" />
        <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(7, 200, 128,0.5)" />
        <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(79, 200, 7,0.3)" />
        <use xlink:href="#gentle-wave" x="48" y="7" fill="#07ad1c" />
      </g>
    </svg>
  </div>

  <!-- Varukorgsfönster -->
  <div id="basket-window" class="basket-window">
    <h3>Your Basket</h3>
    <div id="basket-items">
      <!-- Här visas produkterna dynamiskt -->
      <p>Your basket is empty.</p>
    </div>
    <p><strong>Total: <span id="basket-total">$0.00</span></strong></p>
    <button class="checkout-button" onclick="window.location.href='checkout.php'">Checkout</button>
  </div>

  <!-- JavaScript för att visa/dölja varukorgen -->
  <script>
    function toggleBasket() {
      var basketWindow = document.getElementById('basket-window');
      if (basketWindow.style.display === 'none' || basketWindow.style.display === '') {
        basketWindow.style.display = 'block';
      } else {
        basketWindow.style.display = 'none';
      }
    }
  </script>
</body>
</html>