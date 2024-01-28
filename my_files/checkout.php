
<?php
    session_start();
    require_once __DIR__ . '/vendor/autoload.php';

    use MongoDB\Client;

    $conn = new MongoDB\Client('mongodb://localhost:27017');
    $db = $conn->myDb;
    $collection = $db->checkout;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            $productName = $_POST['productName'];
            $productPrice = $_POST['productPrice'];

            $collection->insertOne([
                'username' => $username,
                'productName' => $productName,
                'productPrice' => $productPrice,
            ]);

            echo 'Τα δεδομένα αποθηκεύτηκαν με επιτυχία!';
        } else {
            echo 'Πρέπει να είστε συνδεδεμένοι για να προσθέσετε στο Καλάθι.';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Περιεχόμενα Καλαθιού</title>
    <!-- Εισαγωγή Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Περιεχόμενα Καλαθιού</h2>
    
    <?php
        require_once __DIR__ . '/vendor/autoload.php';

        $conn = new MongoDB\Client('mongodb://localhost:27017');
        $db = $conn->myDb;
        $collection = $db->checkout;

        $cursor = $collection->find(['username' => $_SESSION['username']]);

        $totalPrice = 0;

        foreach ($cursor as $document) {
            echo '<div class="card mt-3">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">Username: ' . $document['username'] . '</h5>';
            echo '<p class="card-text">Product Name: ' . $document['productName'] . '</p>';
            echo '<p class="card-text">Product Price: ' . $document['productPrice'] . '</p>';
            echo '<form action="remove_cart.php" method="post" class="d-inline">';
                echo '<input type="hidden" name="productName" value="' . $document['productName'] . '">';
                echo '<button type="submit" class="btn btn-danger">Αφαίρεση</button>';
            echo '</form>';
            echo '</div>';
            echo '</div>';

            $totalPrice += $document['productPrice'];
        }

        echo '<div class="mt-3">Συνολικό Ποσό: ' . $totalPrice . '</div>';
    ?>

    <form class="g" action="order.php" method="post" id="orderForm">
        <div class="mb-3">
            <label for="address" class="form-label">Διεύθυνση:</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Τηλέφωνο Επικοινωνίας:</label>
            <input type="tel" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="mb-3">
            <label for="fullname" class="form-label">Ονοματεπώνυμο:</label>
            <input type="text" class="form-control" id="fullname" name="fullname" required>
        </div>
        <button type="submit" class="btn btn-success" name="order">Ολοκλήρωση Παραγγελίας</button>
    </form>

    <a href="products.php" class="btn btn-primary mt-3">Επιστροφή στα Προϊόντα</a>

</div>


<style>
.g{
    margin-top: 130px;
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('orderForm').addEventListener('submit', function (event) {
            event.preventDefault(); 

            if (<?php echo $totalPrice; ?> === 0) {
                alert('Το καλάθι είναι άδειο. Δεν μπορεί να πραγματοποιηθεί παραγγελία.');
                window.location.href = 'products.php';

            } else {
                alert('Η παραγγελία έχει σταλθεί!');

                window.location.href = 'products.php';
            }
        });
    });
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
