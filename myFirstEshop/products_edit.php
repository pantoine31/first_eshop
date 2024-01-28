
<?php
require_once __DIR__ . '/vendor/autoload.php';

use MongoDB\Client;

// db connection

$conn = new MongoDB\Client('mongodb://localhost:27017');
$db = $conn->myDb;
$collection = $db->products;

// fiding all products
$Prs = $collection->find([]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Λίστα Προϊόντων</title>
</head>
<body>

<div class="container mt-5">
    <h2>Λίστα Προϊόντων</h2>
    
    <!--table of showing products-->
    <table class="table">
        <thead>
            <tr>
                <th>Όνομα Προϊόντος</th>
                <th>Τιμή</th>
                <th>Εικόνα</th>
                <th>Περιγραφή</th>
                <th>Ενέργειες</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($Prs as $pr): ?>
                <tr>
                    <td><?= $pr['name'] ?></td>
                    <td><?= $pr['price'] ?></td>
                     <td>
                        
                        <img src="<?= $pr['photo'] ?>" alt="photo" width="50">
                        
                    </td> 
                    <td><?= $pr['description'] ?></td> 
                    <td>
                        <a href='delete_product.php?id=<?= $pr['name'] ?>' class='btn btn-danger'>Διαγραφή</a>
                    </td>
                    <td>
                        <a href='edit_product.php?name=<?= $pr['name'] ?>' class='btn btn-warning'>Επεξεργασία</a>
                    </td>
                </tr>
        <?php endforeach; ?>

        </tbody>
    </table>

   <!-- form for adding a new product -->
    <form action='add_product.php' method='post' enctype='multipart/form-data' class='mt-3'>
            <h2>Προσθήκη Νέου Προϊόντος</h2>
            <div class='form-group'>
                <label for='newname'>Όνομα Προϊόντος:</label>
                <input type='text' class='form-control' id='newname' name='newname' required>
            </div>
            <div class='form-group'>
                <label for='newprice'>Τιμή:</label>
                <input type='number' class='form-control' id='newprice' name='newprice' required>
            </div>
            <!-- input for choosing img -->
            <div class='form-group'>
                <label for='file'>Εικόνα:</label>
                <input type='file' class='form-control-file' id='file' name='photo' accept='image/*'>
            </div>
            <!-- input for description -->
            <div class='form-group'>
                <label for='newdescription'>Περιγραφή:</label>
                <textarea class='form-control' id='newdescription' name='newdescription' rows='3' required></textarea>
            </div>

            <button type='submit' class='btn btn-primary' name='addProduct'>Προσθήκη</button>
            <!-- back tο Admin Panel btn -->
            <a href='admin_panel.php' class='btn btn-primary ml-2'>Επιστροφή</a>
    </form>

</div>
</body>
</html>

