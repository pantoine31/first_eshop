<?php
require_once __DIR__ . '/vendor/autoload.php';

use MongoDB\Client;

$conn = new MongoDB\Client('mongodb://localhost:27017');
$db = $conn->myDb;
$collection = $db->messages;

if (isset($_GET['id'])) {
    $messageId = $_GET['id'];

    $collection->deleteOne(['email' => $messageId]);

    header("Location: messages_admin.php"); 
    exit();
}
?>
