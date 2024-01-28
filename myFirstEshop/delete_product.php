<?php
require_once __DIR__ . '/vendor/autoload.php';

use MongoDB\Client;

$conn = new MongoDB\Client('mongodb://localhost:27017');
$db = $conn->myDb;
$collection = $db->products;

if (isset($_GET['id'])) {
    $productName = $_GET['id'];

    $deleteResult = $collection->deleteOne(['name' => $productName]);

    if ($deleteResult->getDeletedCount() > 0) {
        echo "<script>
            alert('Το προϊόν διαγράφηκε με επιτυχία.');
            window.location.href = 'products_edit.php';
        </script>";
    } else {
        echo "<script>
            alert('Η διαγραφή απέτυχε. Το προϊόν δεν βρέθηκε.');
            window.location.href = 'products_edit.php';
        </script>";
    }


}
?>
