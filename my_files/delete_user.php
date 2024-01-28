<?php
require_once __DIR__ . '/vendor/autoload.php';

use MongoDB\Client;

$conn = new MongoDB\Client('mongodb://localhost:27017');
$db = $conn->myDb;
$collection = $db->users;

if (isset($_GET['id'])) {
    $userEmail = $_GET['id'];

    $collection->deleteOne(['email' => $userEmail]);

    header("Location: users_admin.php"); 
    exit();
}
?>


