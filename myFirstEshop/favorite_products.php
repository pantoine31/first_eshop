<?php
require_once __DIR__ . '/vendor/autoload.php';

use MongoDB\Client;

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Αν δεν είναι συνδεδεμένος, τον κατευθύνουμε στη σελίδα σύνδεσης
    exit;
}

$conn = new MongoDB\Client('mongodb://localhost:27017');
$db = $conn->myDb;
$collection = $db->fav;

$username = $_SESSION['username'];
$favoriteProducts = $collection->find(['username' => $username]);



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $productName = $_POST["productName"];

    $existingProduct = $collection->findOne(['username' => $username, 'productName' => $productName]);

    if ($existingProduct) {
        echo "already_in_favorites";
    } else {
        $result = $collection->insertOne([
            'username' => $username,
            'productName' => $productName,
            'productPrice' => $_POST["productPrice"],
            'productDescription' => $_POST["productDescription"],
            'productPhoto' => $_POST["productPhoto"],
        ]);

        echo "Το προϊόν προστέθηκε με επιτυχία!";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Αγαπημένα Προϊόντα</title>
</head>
<body>

<div class="container mt-5">
    <h2>Τα Αγαπημένα σας Προϊόντα</h2>

    <div class="row">
        <?php foreach ($favoriteProducts as $product): ?>
            <div class="col-md-4">
                <div class="card mt-3" style="width: 100%;">
                    <img src="<?= $product['productPhoto'] ?>" class="card-img-top" alt="Product Photo">
                    <div class="card-body">
                        <h5 class="card-title"><?= $product['productName'] ?></h5>
                        <p class="card-text"><?= $product['productDescription'] ?></p>
                        <p class="card-text">Τιμή: <?= $product['productPrice'] ?>€</p>
                        <button class="btn btn-danger" onclick="removeFromFavorites('<?= $product['productName'] ?>')">Αφαίρεση από τα Αγαπημένα</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <a href="products.php" class="btn btn-primary mt-3">Επιστροφή στα Προϊόντα</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script>
    function removeFromFavorites(productName) {
        fetch('remove_from_favorites.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'productName=' + encodeURIComponent(productName),
        })
        .then(response => response.text())
        .then(result => {
            alert(result);
            location.reload();
        })
        .catch(error => {
            console.error('Σφάλμα:', error);
        });
    }
</script>

</body>
</html>