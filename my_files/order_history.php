<?php
    session_start();
    require_once __DIR__ . '/vendor/autoload.php';

    use MongoDB\Client;

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    $conn = new MongoDB\Client('mongodb://localhost:27017');
    $db = $conn->myDb;
    $ordersCollection = $db->orders;

    $username = $_SESSION['username'];
    $cursor = $ordersCollection->find(['username' => $username]);

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ιστορικό Παραγγελιών</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Ιστορικό Παραγγελιών</h2>

    <?php
        $orderNumber = 1;
        foreach ($cursor as $document) {
            echo '<div class="card mt-3">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">Παραγγελία ' . $orderNumber . '</h5>';
            echo '<p class="card-text">Όνομα Χρήστη: ' . $document['username'] . '</p>';
            echo '<p class="card-text">Διεύθυνση: ' . $document['address'] . '</p>';
            echo '<p class="card-text">Τηλέφωνο Επικοινωνίας: ' . $document['phone'] . '</p>';
            echo '<p class="card-text">Ονοματεπώνυμο: ' . $document['fullname'] . '</p>';
            echo '<p class="card-text">Προϊόν: ' . $document['productName'] . '</p>';
            echo '<p class="card-text">Τιμή: ' . $document['productPrice'] . ' €</p>';

            echo '</p>';
            echo '</div>';
            echo '</div>';

            $orderNumber++;
        }
    ?>

    <a href="products.php" class="btn btn-primary mt-3">Επιστροφή στα Προϊόντα</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
