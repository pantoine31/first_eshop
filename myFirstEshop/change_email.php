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
    $newEmail = $_POST["newEmail"];

    $existingUser = $collection->findOne(['email' => $newEmail]);

    if ($existingUser) {
        echo '<script>
                alert("User with the same email already exists.");
                window.location.href = "inter1.php"; // Επιστροφή στην σελίδα Inter1
              </script>';
        exit(); 
    }

    $updateQuery = [
        'username' => $_SESSION['username'],
    ];

    $updateData = [
        '$set' => ['email' => $newEmail],
    ];

    $result = $collection->updateOne($updateQuery, $updateData);

    if ($result->getModifiedCount() > 0) {
        echo '<div class="alert alert-success" role="alert">
                Email updated successfully.
              </div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">
                Error updating email.
              </div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Αλλαγή Email</title>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                Αλλαγή Email
                </div>
                <div class="card-body">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="form-group">
                            <label for="newEmail">Νέο Email:</label>
                            <input type="email" class="form-control" id="newEmail" name="newEmail" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Αλλαγή Email</button>
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
