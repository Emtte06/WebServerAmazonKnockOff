<?php
include "auth.php";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "amazon";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT id, category_name FROM categories";
$result = $conn->query($sql);
?>

<link rel="stylesheet" href="header.css">

<div class="header">
  <div class="Head">
    <div class="container-fluid d-flex justify-content-between align-items-center">


      <div class="d-flex align-items-center" style="flex-grow: 1;">
        <a href="index.php" class="btn btn-success btn-lg mx-2">Home</a>
        <button class="btn btn-success btn-lg flex-grow-1 mx-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-label="Toggle navigation">
          More
        </button>
        <?php if (!isLoggedIn()): ?>
          <a href="loginForm.php" class="btn btn-success btn-lg mx-2">Login</a>
        <?php endif;?>
        <?php if (isLoggedIn()): ?>
          <a href="logout.php" class="btn btn-success btn-lg mx-2">Logout</a>
        <?php endif;?>
      </div>

      <div class="d-flex align-items-center">
      <form class="form-inline my-2 my-lg-0 d-flex me-2" method="get" action="index.php">
          <input class="form-control form-control-lg mx-2" type="search" name="search" placeholder="Search for items" aria-label="Search">
          <button class="btn btn-success btn-lg mx-2" type="submit">Search</button>
      </form>
        
        <button class="btn btn-success btn-lg mx-2" onclick="toggleBasket()">Basket</button>

        <?php if (isAdmin()): ?>
          <a href="adminlanding.php" class="btn btn-success btn-lg mx-2">Admin</a>
        <?php endif;?>
      </div>

    </div>
  </div>
</div>



<div class="nav">
  <div class="collapse" id="navbarToggleExternalContent" data-bs-theme="dark" style="width: 100%; margin: auto; background-color: #07ad1c;">
    <div class="p-2">
      <div class="d-grid gap-2" style="max-width: 90%; margin: auto;">
        <div class="bg-body-tertiary border rounded-3" 
            style="height: 200px; display: flex; flex-wrap: wrap; gap: 10px; padding: 10px; align-items: flex-start; justify-content: flex-start; overflow-y: auto;">

          <?php
           if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo '<a href="index.php?category_id=' . $row["id"] . '" class="btn btn-light">' . htmlspecialchars($row["category_name"]) . '</a>';
              }
            } 
            else {
              echo "<p>No categories found</p>";
            }
          $conn->close();
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<div style="width: 100%; height: auto; position: relative;">
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
<div id="basket-window" class="basket-window" style="display: none;">
    <h3>Your Basket</h3>
    <div id="basket-items">
        <?php if (isset($_SESSION['basket']) && count($_SESSION['basket']) > 0): ?>
            <?php foreach ($_SESSION['basket'] as $item): ?>
                <div class="basket-item">
                    <p><?php echo htmlspecialchars($item['name']); ?> (x<?php echo intval($item['quantity']); ?>)</p>
                    <p>Price: $<?php echo number_format($item['price'] * $item['quantity'], 2); ?></p>
                    <a href="basket.php?remove_from_basket=<?php echo intval($item['id']); ?>">Remove</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Your basket is empty.</p>
        <?php endif; ?>
    </div>
    <p><strong>Total: <span id="basket-total">
      <?php 
        $total = 0;
        if (isset($_SESSION['basket'])) {
            foreach ($_SESSION['basket'] as $item) {
                $total += $item['price'] * $item['quantity'];
            }
        }
        echo '$' . number_format($total, 2);
      ?>
    </span></strong></p>
    <button class="checkout-button" onclick="window.location.href='checkoutpage.php'">Checkout</button>
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

<?php // comment to fix this shit ?>