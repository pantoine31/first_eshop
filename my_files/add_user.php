<?php
require_once __DIR__ . '/vendor/autoload.php';

use MongoDB\Client;

$conn = new MongoDB\Client('mongodb://localhost:27017');
$db = $conn->myDb;
$collection = $db->users;

if (isset($_POST['addUser'])) {
    $newUsername = $_POST['newUsername'];
    $newPassword = $_POST['newPassword'];
    $newEmail = $_POST['newEmail'];

    $existingUser = $collection->findOne(['email' => $newEmail]);

    if ($existingUser) {
        echo '<script>
        alert("User with the same email already exists.");
        window.location.href = "users_admin.php"; // Ορίστε τον προορισμό του redirect εδώ
      </script>';

              

    } else {
        $collection->insertOne(['username' => $newUsername, 'password' => $newPassword, 'email' => $newEmail]);

        header("Location: users_admin.php");

    }

    
}
?>
