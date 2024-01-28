<?php
require_once __DIR__ . '/vendor/autoload.php';

use MongoDB\Client;

$conn = new MongoDB\Client('mongodb://localhost:27017');
$db = $conn->myDb;
$collection = $db->comments;

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['username'])) {
        if (isset($_POST['productName']) && isset($_POST['comment'])) {
            $productName = $_POST['productName'];
            $comment = $_POST['comment'];
            $username = $_SESSION['username'];

            $product = $db->products->findOne(['name' => $productName]);

            if ($product) {
                $result = $collection->insertOne([
                    'username' => $username,
                    'productName' => $productName,
                    'comment' => $comment,
                ]);

                if ($result->getInsertedCount() > 0) {
                    echo "Το σχόλιο αποθηκεύτηκε επιτυχώς.";
                } else {
                    echo "Προέκυψε κάποιο πρόβλημα κατά την αποθήκευση του σχολίου.";
                }
            } else {
                echo "Το προϊόν με το όνομα: $productName δεν βρέθηκε.";
                $allProducts = $db->products->find();
                foreach ($allProducts as $p) {
                    echo "Διαθέσιμο προϊόν: " . $p['name'] . " (ID: " . $p['_id'] . ")<br>";
                }
            }
        } else {
            echo "Λάθος δεδομένα από τη φόρμα.";
        }
    } else {
        echo "Πρέπει να συνδεθείτε πρώτα.";
    }
} else {
    echo "Μη έγκυρο αίτημα.";
}
?>
