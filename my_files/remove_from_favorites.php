<?php
require_once __DIR__ . '/vendor/autoload.php';

use MongoDB\Client;

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // mongoDb connection with my database
    $conn = new MongoDB\Client('mongodb://localhost:27017');
    $db = $conn->myDb;
    $collection = $db->fav;

    $username = $_SESSION['username'];
    $productName = $_POST["productName"];

    // delete the product
    $result = $collection->deleteOne(['username' => $username, 'productName' => $productName]);

    //show messages

    if ($result->getDeletedCount() > 0) {
        echo "Το προϊόν αφαιρέθηκε από τα Αγαπημένα!";
    } else {
        echo "Η αφαίρεση απέτυχε. Παρακαλούμε δοκιμάστε ξανά.";
    }
}
?>
