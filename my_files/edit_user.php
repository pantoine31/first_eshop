<?php
require_once __DIR__ . '/vendor/autoload.php';

use MongoDB\Client;

$conn = new MongoDB\Client('mongodb://localhost:27017');
$db = $conn->myDb;
$collection = $db->users;

if (isset($_GET['email'])) {
    $userEmail = $_GET['email'];

    $user = $collection->findOne(['email' => $userEmail]);

    if (!$user) {
        echo "Ο χρήστης δεν βρέθηκε.";
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
    <title>Επεξεργασία Χρήστη</title>
</head>
<body>

<div class="container mt-5">
    <h2>Επεξεργασία Χρήστη</h2>
    
    <form action='update_user.php' method='post'>
        <input type='hidden' name='original_email' value='<?= $user['email'] ?>'>
        <div class='form-group'>
            <label for='edited_username'>Όνομα Χρήστη:</label>
            <input type='text' class='form-control' id='edited_username' name='edited_username' value='<?= $user['username'] ?>' required>
        </div>
        <div class='form-group'>
            <label for='edited_password'>Κωδικός Πρόσβασης:</label>
            <input type='password' class='form-control' id='edited_password' name='edited_password' >
        </div>
        <div class='form-group'>
            <label for='edited_email'>Email:</label>
            <input type='text' class='form-control' id='edited_email' name='edited_email' value='<?= $user['email'] ?>' required>
        </div>
        <button type='submit' class='btn btn-primary' name='updateUser'>Ενημέρωση</button>
        <a href='admin_panel.php' class='btn btn-primary ml-2'>Επιστροφή στο Admin Panel</a>
    </form>
</div>

</body>
</html>
<?php
}
?>
