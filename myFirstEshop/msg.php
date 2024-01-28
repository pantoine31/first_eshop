<?php

require_once __DIR__ . '/vendor/autoload.php';

use MongoDB\Client;

$conn = new MongoDB\Client('mongodb://localhost:27017');

$db = $conn->myDb;

$collection = $db->messages;




$name = $_POST["name"];
$phone = $_POST["phone"];
$department = $_POST["department"];
$email = $_POST["email"];
$subject = $_POST["subject"];
$message = $_POST["message"];








if (isset($_POST['send'])) {

    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $department = $_POST["department"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    $data = [
        "name" => $name,
        "phone" => $phone,
        "department" => $department,
        "email" => $email,
        "subject" => $subject,
        "message" => $message
    ];

    $collection->insertOne($data);

    echo '<script>alert("Το μήνυμα σας στάλθηκε με επιτυχία!");</script>';

    echo '<script type="text/javascript">  location="inter4.php"; </script>';



}
?>
