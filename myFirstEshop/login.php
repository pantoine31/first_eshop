<?php
session_start(); 

require_once __DIR__ . '/vendor/autoload.php';

use MongoDB\Client;

if (isset($_POST['login'])) {
   
    $conn = new MongoDB\Client('mongodb://localhost:27017');
    $db = $conn->myDb;
    $collection = $db->users;


    $username = $_POST['loginUsername'];
    $password = $_POST['loginPassword'];

    $user = $collection->findOne(['username' => $username, 'password' => $password]);

    if ($user) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];

        echo '<script>alert("Επιτυχής σύνδεση!");</script>';
        echo '<script type="text/javascript">  location="inter1.php"; </script>';
    } else {
        echo '<script>alert("Σφάλμα: Λανθασμένο όνομα χρήστη ή κωδικός πρόσβασης. Παρακαλώ δοκιμάστε ξανά.");</script>';
        echo '<script type="text/javascript">  location="inter1.php"; </script>';

    }
}
?>
