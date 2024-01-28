<?php
require_once __DIR__ . '/vendor/autoload.php';

use MongoDB\Client;

$conn = new MongoDB\Client('mongodb://localhost:27017');
$db = $conn->myDb;
$collection = $db->products;

if (isset($_POST['addProduct'])) {
    $newname = $_POST['newname'];
    $newprice = $_POST['newprice'];
    $newDescription = $_POST['newdescription'];


    $targetDir = "xrisima_stoixeia/products";
    $targetFile = $targetDir . basename($_FILES["photo"]["name"]);
    move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile);
    $photoPath = $targetFile;


    $existingProduct = $collection->findOne(['name' => $newname]);

    if ($existingProduct) {
        echo '<script>
            alert("Υπάρχει ήδη το προϊόν αυτό.");
            window.location.href = "products_edit.php"; 
        </script>';
    } else {
        $collection->insertOne(['name' => $newname, 'price' => $newprice,'description' => $newDescription, 'photo'=> $photoPath]);
    

        echo '<script>
            alert("Το προϊόν προστέθηκε με επιτυχία.");
            window.location.href = "products_edit.php"; 
            </script>';
    }
}

?>
