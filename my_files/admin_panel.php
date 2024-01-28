<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>

<div class="container mt-5">
    <h1>Διαχειριστικό Πάνελ</h1>
    <ul class="list-group">
        <li class="list-group-item"><a href="users_admin.php">Επεξεργασία Χρηστών</a></li>
        <li class="list-group-item"><a href="products_edit.php">Επεξεργασία Προϊόντων</a></li>
        <li class="list-group-item"><a href="messages_admin.php">Επεξεργασία Μηνυμάτων</a></li>
    </ul>
    <form action="logout.php" method="post">
        <button class="btn btn-danger mt-3" type="submit" name="logout">Αποσύνδεση</button>
    </form>
</div>

</body>
</html>