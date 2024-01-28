<?php
    session_start();
    require_once __DIR__ . '/vendor/autoload.php';

    use MongoDB\Client;

    // connection with my database
    
    $conn = new MongoDB\Client('mongodb://localhost:27017');
    $db = $conn->myDb;
    $collection = $db->checkout;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_SESSION['username'])) {
            $productName = $_POST['productName'];
            $username = $_SESSION['username'];

            // delete the product by the name
            $collection->deleteOne(['productName' => $productName, 'username' => $username]);

            echo '<script>alert("Το προϊόν αφαιρέθηκε με επιτυχία!"); 
            window.location.href = "checkout.php";</script>';
        } else {
            echo 'Πρέπει να είστε συνδεδεμένοι για να αφαιρέσετε προϊόντα.';
        }
    }
?>
