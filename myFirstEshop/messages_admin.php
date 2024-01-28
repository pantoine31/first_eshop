<?php
require_once __DIR__ . '/vendor/autoload.php';

use MongoDB\Client;

$conn = new MongoDB\Client('mongodb://localhost:27017');
$db = $conn->myDb;
$collection = $db->messages;

$messages = $collection->find();

$messageData = [];
foreach ($messages as $message) {
    $messageData[] = [
        'name' => $message['name'],
        'email' => $message['email'],
        'subject' => $message['subject'],
        'content' => $message['message']
    ];
}

echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "<head>";
echo "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>";
echo "<meta charset='UTF-8'>";
echo "<meta http-equiv='X-UA-Compatible' content='IE=edge'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<title>Επεξεργασία Μηνυμάτων</title>";
echo "</head>";
echo "<body>";

echo "<div class='container mt-5'>";
echo "<h2>Επεξεργασία Μηνυμάτων</h2>";

if (count($messageData) > 0) {
    echo "<ul class='list-group'>";
    foreach ($messageData as $message) {
        echo "<li class='list-group-item'>";
        echo "<strong>Αποστολέας: </strong>" . $message['name'] . "<br>";
        echo "<strong>Email: </strong>" . $message['email'] . "<br>";
        echo "<strong>Θέμα: </strong>" . $message['subject'] . "<br>";
        echo "<strong>Περιεχόμενο: </strong>" . $message['content'] . "<br>";
        echo "<a href='delete_msg_admin.php?id=" . $message['email'] . "' class='btn btn-danger'>Διαγραφή</a>";
        echo "</li>";
    }
    echo "</ul>";
} else {
    echo "<h1 class='text-center'>Δεν υπάρχουν διαθέσιμα μηνύματα προς ανάγνωση!</h1>";
}

echo "<a href='admin_panel.php' class='btn btn-primary mt-3'>Επιστροφή στο Admin Panel</a>";

echo "</div>";

echo "</body>";
echo "</html>";
?>
