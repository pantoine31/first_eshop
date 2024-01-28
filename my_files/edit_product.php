<?php
        require_once __DIR__ . '/vendor/autoload.php';

        use MongoDB\Client;

        $conn = new MongoDB\Client('mongodb://localhost:27017');
        $db = $conn->myDb;
        $collection = $db->products;

        if (isset($_GET['name'])) {
            $productName = $_GET['name'];

            $product = $collection->findOne(['name' => $productName]);

            if (!$product) {
                echo "Το προϊόν δεν βρέθηκε.";
                exit();
            }

        ?>
        <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                    <title>Επεξεργασία Προϊόντος</title>
                </head>
                <body>

                <div class="container mt-5">
                    <h2>Επεξεργασία Προϊόντος</h2>
                    
                    <form action='update_product.php' method='post'>
                        <input type='hidden' name='original_name' value='<?= $product['name'] ?>'>
                        <div class='form-group'>
                            <label for='edited_name'>Όνομα Προϊόντος:</label>
                            <input type='text' class='form-control' id='edited_name' name='edited_name' value='<?= $product['name'] ?>' >
                        </div>
                        <div class='form-group'>
                            <label for='edited_price'>Τιμή:</label>
                            <input type='number' class='form-control' id='edited_price' name='edited_price' value='<?= $product['price'] ?>' >
                        </div>
                        <div class='form-group'>
                            <label for='edited_photo'>Φωτογραφία:</label>
                            <input type='file' class='form-control-file' id='edited_photo' name='edited_photo' accept='image/*'>
                        </div>
                        <div class='form-group'>
                            <label for='newdescription'>Περιγραφή:</label>
                            <textarea class='form-control' id='newdescription' name='edited_description' rows='3' ></textarea>
                        </div>
                        <button type='submit' class='btn btn-primary' name='updateProduct'>Ενημέρωση</button>
                        <a href='admin_panel.php' class='btn btn-primary ml-2'>Επιστροφή </a>
                    </form>
                </div>

                </body>
                </html>
                <?php
                }
?>
