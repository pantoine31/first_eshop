<?php
            // mongoDB connection
            require_once __DIR__ . '/vendor/autoload.php';

            use MongoDB\Client;

            $conn = new MongoDB\Client('mongodb://localhost:27017');

            $db = $conn->myDb;

            $collection = $db->nletter;

            // reading data from the form
            $number = $_POST['number'];
            $name = $_POST['name'];
            $email = $_POST['email'];

            // checking for existing email
            $existingUser = $collection->findOne(['email' => $email]);

            if ($existingUser) {
                // if email already exists, show alert
                echo '<script>alert("Σφάλμα: Ένας χρήστης με αυτό το email υπάρχει ήδη. Παρακαλώ δοκιμάστε ξανά.");</script>';
            } else {
                // inserting data into the database
                $document = array(
                    'number' => $number,
                    'name' => $name,
                    'email' => $email,
                );

              
                $collection->insertOne($document);

                echo '<script>alert("Εγγραφήκατε με επιτυχία!");</script>';
                // redirect to home page
                echo '<script type="text/javascript">  location="inter1.php"; </script>';

                exit();
            }

            echo '<script type="text/javascript">  location="inter1.php"; </script>';

?>
