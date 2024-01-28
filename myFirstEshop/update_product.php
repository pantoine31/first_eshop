<?php
require_once __DIR__ . '/vendor/autoload.php';

// connect to mongodb

use MongoDB\Client;

$conn = new MongoDB\Client('mongodb://localhost:27017');
$db = $conn->myDb;
$collection = $db->products;

if (isset($_POST['updateProduct'])) {
    $originalName = $_POST['original_name'];
    $editedName = $_POST['edited_name'];
    $editedPrice = $_POST['edited_price'];
    $editedDescription = $_POST['edited_description'];

    // checking for existing product
    $existingProduct = $collection->findOne(['name' => $editedName]);

    if ($existingProduct && $editedName !== $originalName) {
        // show alert for existing product
        echo '<script>
            alert("Υπάρχει ήδη προϊόν με το επεξεργασμένο όνομα.");
            window.location.href = "admin_panel.php"; 
        </script>';
    } else {

        // checking for photo
        if (!empty($_FILES["edited_photo"]["name"])) {
            $targetDir = __DIR__ . "/xrisima_stoixeia/products/";
            $targetFile = $targetDir . basename($_FILES["edited_photo"]["name"]);
            move_uploaded_file($_FILES["edited_photo"]["tmp_name"], $targetFile);
            $editedPhoto = $targetFile;

            $updateResult = $collection->updateOne(
                ['name' => $originalName],
                ['$set' => [
                    'name' => $editedName,
                    'price' => $editedPrice,
                    'description' => $editedDescription,
                    'photo' => $editedPhoto  
                ]]
            );
        } else {
            // update without photo
            $updateResult = $collection->updateOne(
                ['name' => $originalName],
                ['$set' => [
                    'name' => $editedName,
                    'price' => $editedPrice,
                    'description' => $editedDescription
                ]]
            );

            if ($updateResult->getModifiedCount() > 0) {
                // if update success , show alert
                echo '<script>
                    alert("Το προϊόν ενημερώθηκε με επιτυχία.");
                    window.location.href = "admin_panel.php";
                </script>';
            } else {
                // if update fail , show alert
                echo '<script>
                    alert("Δεν έγιναν αλλαγές στο προϊόν.");
                    window.location.href = "admin_panel.php";
                </script>';
            }
        }
    }
}
?>
