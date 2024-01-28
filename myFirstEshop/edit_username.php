<?php
session_start(); 

require_once __DIR__ . '/vendor/autoload.php';

use MongoDB\Client;

$conn = new MongoDB\Client('mongodb://localhost:27017');
$db = $conn->myDb;
$collection = $db->users;

if (!isset($_SESSION['username'])) {
    header("Location: login.php"); 
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newUsername = $_POST["newUsername"];

    $existingUser = $collection->findOne(['username' => $newUsername]);

    if ($existingUser) {
        echo '<script>
                alert("Username already exists. Please choose a different one.");
              </script>';
    } else {
        $updateQuery = [
            'username' => $_SESSION['username'],
        ];

        $updateData = [
            '$set' => ['username' => $newUsername],
        ];

        $result = $collection->updateOne($updateQuery, $updateData);

        if ($result->getModifiedCount() > 0) {
            $_SESSION['username'] = $newUsername;

            echo '<div class="alert alert-success" role="alert">
                    Username updated successfully.
                  </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
                    Error updating username.
                  </div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Επεξεργασία Username</title>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Επεξεργασία Username
                </div>
                <div class="card-body">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="form-group">
                            <label for="newUsername">Νέο Username:</label>
                            <input type="text" class="form-control" id="newUsername" name="newUsername" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Αλλαγή Username</button>
                    </form>
                    <a href="inter1.php" class="btn btn-secondary mt-3">Επιστροφή</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
