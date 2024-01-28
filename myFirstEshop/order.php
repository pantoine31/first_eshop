<?php
    session_start();
    require_once __DIR__ . '/vendor/autoload.php';

    use MongoDB\Client;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // checking if the user is logged in

        if (isset($_SESSION['username'])) {
            $conn = new MongoDB\Client('mongodb://localhost:27017');
            $db = $conn->myDb;
            $checkoutCollection = $db->checkout;
            $ordersCollection = $db->orders;

            // finding data from the collection "checkout"
            $cursor = $checkoutCollection->find(['username' => $_SESSION['username']]);

            // reading data from the form
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $fullname = $_POST['fullname'];

            // insert data into collection "orders"
            foreach ($cursor as $document) {
                $ordersCollection->insertOne([
                    'username' => $document['username'],
                    'productName' => $document['productName'],
                    'productPrice' => $document['productPrice'],
                    'address' => $address,
                    'phone' => $phone,
                    'fullname' => $fullname,
                ]);
            }

            // delete products from collection "checkout" after order
            $checkoutCollection->deleteMany(['username' => $_SESSION['username']]);
            header("Location: products.php");


        } else {
            echo 'Πρέπει να είστε συνδεδεμένοι για να προσθέσετε στο Καλάθι.';
        }
    }
?>
