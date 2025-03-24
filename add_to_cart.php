<?php
session_start();

// Kontrollera om formuläret har skickats
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Hämta produkt-ID och antal från formuläret
    $item_id = isset($_POST['item_id']) ? intval($_POST['item_id']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    // Validera produkt-ID och antal
    if ($item_id <= 0 || $quantity <= 0) {
        die("Invalid product ID or quantity.");
    }

    // Hämta produktinformation från databasen
    include 'db.php';
    $query = "SELECT * FROM items WHERE id = $item_id";
    $result = mysqli_query($connection, $query);

    if (!$result || mysqli_num_rows($result) === 0) {
        die("Product not found.");
    }

    $product = mysqli_fetch_assoc($result);

    // Lägg till produkten i varukorgen
    if (!isset($_SESSION['basket'])) {
        $_SESSION['basket'] = [];
    }

    // Kontrollera om produkten redan finns i varukorgen
    $found = false;
    foreach ($_SESSION['basket'] as &$item) {
        if ($item['id'] == $item_id) {
            $item['quantity'] += $quantity; // Uppdatera antalet
            $found = true;
            break;
        }
    }

    // Om produkten inte finns i varukorgen, lägg till den
    if (!$found) {
        $_SESSION['basket'][] = [
            'id' => $item_id,
            'name' => $product['item_name'],
            'price' => $product['price'],
            'quantity' => $quantity,
            'picture_path' => $product['picture_path']
        ];
    }

    // Omdirigera till checkout-sidan om "Buy Now" klickades
    if (isset($_POST['buy_now'])) {
        header('Location: checkoutpage.php');
        exit;
    }

    // Omdirigera tillbaka till produktsidan om "Add to Basket" klickades
    header('Location: product.php?id=' . $item_id);
    exit;
}
?>

<?php // comment to fix this shit ?>