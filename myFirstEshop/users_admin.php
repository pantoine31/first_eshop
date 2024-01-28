<?php
require_once __DIR__ . '/vendor/autoload.php';

use MongoDB\Client;

$conn = new MongoDB\Client('mongodb://localhost:27017');
$db = $conn->myDb;
$collection = $db->users;

// finding all users of the collection users
$users = $collection->find();

// reading data
$userData = [];
foreach ($users as $user) {
    $userData[] = [
        'name' => $user['username'],
        'email' => $user['email'],
    ];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Λίστα Χρηστών</title>
</head>
<body>

<div class="container mt-5">
    <h2>Λίστα Χρηστών</h2>
    
    <table class="table">
        <thead>
            <tr>
                <th>Όνομα</th>
                <th>Email</th>
                <th>Ενέργειες</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($userData as $user): ?>
                <tr>
                    <td><?= $user['name'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <!--delete choice-->
                    <td>
                        <a href='delete_user.php?id=<?= $user['email'] ?>' class='btn btn-danger'>Διαγραφή</a>
                    </td>
                    <!-- edit -->
                    <td>
                        <a href='edit_user.php?email=<?= $user['email'] ?>' class='btn btn-warning'>Επεξεργασία</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- form for adding new user -->
    <form action='add_user.php' method='post' class='mt-3'>
        <h2>Προσθήκη Νέου Χρήστη</h2>
        <div class='form-group'>
            <label for='newUsername'>Όνομα Χρήστη:</label>
            <input type='text' class='form-control' id='newUsername' name='newUsername' required>
        </div>
        <div class='form-group'>
            <label for='newPassword'>Κωδικός Πρόσβασης:</label>
            <input type='password' class='form-control' id='newPassword' name='newPassword' required>
        </div>
        <div class='form-group'>
            <label for='newEmail'>Email:</label>
            <input type='text' class='form-control' id='newEmail' name='newEmail' required>
        </div>
        <button type='submit' class='btn btn-primary' name='addUser'>Προσθήκη</button>
        
        <!-- back button -->
        <a href='admin_panel.php' class='btn btn-primary ml-2'>Επιστροφή στο Admin Panel</a>
    </form>
</div>

</body>
</html>
