<?php

    // connect with base
    require_once __DIR__ . '/vendor/autoload.php';

    use MongoDB\Client;

    if (isset($_POST['register'])) {




    $conn = new MongoDB\Client('mongodb://localhost:27017');

    $db = $conn->myDb;

    $collection = $db->users;

    // reading data from the form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // checking if the user already exists
    $existingUser = $collection->findOne(['email' => $email]);

    if ($existingUser) {
        // show an error message for the existing user
        echo '<script>alert("Σφάλμα: Ένας χρήστης με αυτό το email υπάρχει ήδη. Παρακαλώ δοκιμάστε ξανά.");</script>';
    } else {
        //saving data to the database
        $document = array(
            'username' => $username,
            'password' => $password,
            'email' => $email,
        );

        // saving data into database and into our collection
        $collection->insertOne($document);

        echo '<script>alert("Εγγραφήκατε με επιτυχία!");</script>';
        echo '<script type="text/javascript">  location="inter1.php"; </script>';


        exit();
    }

    //redirecting to the first page
    echo '<script type="text/javascript">  location="inter1.php"; </script>';

    }
?>
