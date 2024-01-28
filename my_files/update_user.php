<?php


require_once __DIR__ . '/vendor/autoload.php';

use MongoDB\Client;

//data base connection
$conn = new MongoDB\Client('mongodb://localhost:27017');
$db = $conn->myDb;
$collection = $db->users;

if (isset($_POST['updateUser'])) {
    $originalEmail = $_POST['original_email'];
    $editedUsername = $_POST['edited_username'];
    $editedPassword = $_POST['edited_password'];
    $editedEmail = $_POST['edited_email'];

    // checking for existing user with the same email
    $existingUser = $collection->findOne(['email' => $editedEmail]);

    if ($existingUser && $editedEmail !== $originalEmail) {
        // show alert msg
        echo '<script>
            alert("Υπάρχει ήδη χρήστης με το επεξεργασμένο email.");
            window.location.href = "admin_panel.php"; 
        </script>';
    } else {
        // update user
        $updateResult = $collection->updateOne(
            ['email' => $originalEmail],
            ['$set' => ['username' => $editedUsername, 'password' => $editedPassword, 'email' => $editedEmail]]
        );

        if ($updateResult->getModifiedCount() > 0) {
            // alert msg for success update
            echo '<script>
                alert("Ο χρήστης ενημερώθηκε με επιτυχία.");
                window.location.href = "admin_panel.php";
            </script>';
        } else {
            // alert msg for failed update
            echo '<script>
                alert("Δεν έγιναν αλλαγές στον χρήστη.");
                window.location.href = "admin_panel.php";
            </script>';
        }
    }
}
?>
