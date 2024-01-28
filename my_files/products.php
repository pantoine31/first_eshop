<?php
require_once __DIR__ . '/vendor/autoload.php';

use MongoDB\Client;

// database connection
$conn = new MongoDB\Client('mongodb://localhost:27017');
$db = $conn->myDb;
$collection = $db->products;

// fiding 
$users = $collection->find();

?>

<!DOCTYPE html>
<html lang="en">
  
<head>
    <link rel="stylesheet" href="style.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="calculate.js"></script>
    <title>Αρχική Σελίδα</title>


    <!-- Styling gia to logout-->
    <style>
        .user-account {
            padding: 10px;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-right: 10px;
        }

        .user-account span {
            font-weight: bold;
        }

        .logout-link, .login-link, .register-link {
            margin-left: 10px;
            text-decoration: none;
            color: #333;
            padding: 5px 10px;
            border: 1px solid #333;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .logout-link:hover, .login-link:hover, .register-link:hover {
            background-color: #333;
            color: #fff;
        }
          a {
              text-decoration: none;
              color: #333;
          }

          #user-menu {
              font-family: 'Arial', sans-serif;
              background-color: #f2f2f2;
              padding: 10px;
              border: 1px solid #ddd;
              border-radius: 5px;
              display: inline-block;
          }

          #toggle-menu-btn {
              display: block;
              margin-bottom: 10px;
              margin-top: 10px;
              padding: 7px;
              margin-left: 71px;
              background-color: #4CAF50;
              color: white;
              border: none;
              border-radius: 5px;
              cursor: pointer;
          }

          .user-menu-collapsed ul {
              display: none;
              list-style-type: none;
              padding: 0;
          }

          .user-menu-collapsed ul li {
              margin-bottom: 5px;
          }

          .logout-link {
              margin-top: 10px;
              display: inline-block;
              padding: 5px 10px;
              background-color: #333;
              color: white;
              text-decoration: none;
              border-radius: 5px;
              transition: background-color 0.3s, color 0.3s;
              margin-left: 40px;
          }

          .logout-link:hover {
              background-color: #555;
          }

          #login-register a {
              display: inline-block;
              margin-top: 10px;
              text-align: center;
              padding: 5px 10px;
              text-decoration: none;
              border: 1px solid #333;
              border-radius: 5px;
              transition: background-color 0.3s, color 0.3s;
          }

          #login-register a:hover {
              background-color: #333;
              color: #fff;
          }



</style>

<!--php gia tin emfanisi tou account se kathe selida-->

<?php
session_start();




if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // user menu
    echo '<div id="user-menu" class="user-menu-collapsed">';
    echo '   <div class="user-account">';
    echo '      Καλώς ήρθες, <span>' . $username . '</span>!';
    echo '   </div>';
    echo '   <button id="toggle-menu-btn">Μενού</button>';
    echo '   <ul>';
    echo '      <li><a href="edit_username.php">Επεξεργασία ονόματος Προφίλ</a></li>';
    echo '      <li><a href="change_password.php">Αλλαγή Κωδικού</a></li>';
    echo '      <li><a href="change_email.php">Αλλαγή Email</a></li>';
    echo '      <li><a href="order_history.php">Ιστορικό Παραγγελιών</a></li>';
    echo '      <li><a href="favorite_products.php">Αγαπημένα Προϊόντα</a></li>';
    echo '   </ul>';
    echo '<a class="logout-link" href="logout.php">Αποσύνδεση</a>';
    echo '</div>';
} else {
    // if user is not loged in , showing login and register
    echo '<div id="login-register">';
    echo '   <a class="login-link" href="form.html"><i class="fas fa-sign-in-alt"></i>Login</a>';
    echo '   <br>'; 
    echo '   <a class="register-link" href="form.html"><i class="fas fa-user-plus"></i>Register</a>';
    echo '</div>';
}
?>





</head>

<body>


<nav class="site-logo">
  <a class="navbar-brand" href="#">
    <img src="xrisima_stoixeia/logos/logo.png" alt="MyFriends Logo" height="30">
    MyFriends
  </a>

</nav>
  <!-- Navigation Menu-->


 
  <nav class="menu">
        <div class="hamburger">
          <div class="hamburger-line"></div>
          <div class="hamburger-line"></div>
          <div class="hamburger-line"></div>
        </div>
        <ul>
          <li><a href="inter1.php">Αρχικη Σελιδα</a></li>
          <li><a href="inter2.php">Προφιλ Καταστήματος</a></li>
          <li><a href="inter3.php">Υπολογισμος Κοστους Μεταφορικών Εξόδων</a></li>
          <li><a href="products.php">Τα προϊόντα μας</a></li>
          <li><a href="inter4.php">Επικοινωνια</a></li>
          <li><a href="inter5.php">Σελιδα Διαχειρισης</a></li>
          <li><a href="checkout.php">checkout</a></li>
        </ul>
      </nav>




      <?php foreach ($users as $user): ?>
        <div class="product-container container mt-4">
        <h3><?= $user['name'] ?></h3>
        <p>Περιγραφή: <?= $user['description'] ?></p>
        <p>Τιμή: <?= $user['price'] ?>€</p>

        <!-- product image -->
        <?php if (isset($user['photo'])) : ?>
            <img src="<?= $user['photo'] ?>" alt="photo" class="img-fluid" style="max-width: 200px;">
        <?php else: ?>
            <p>No image available</p>
        <?php endif; ?>

        <!-- favorite and cart buttons -->
        <?php if (isset($_SESSION['username'])) : ?>
            <div class="btn-group mt-3">
                <button class="btn btn-success favorite-btn"
                    onclick="addToFavorites('<?= $user['name'] ?>', '<?= $user['price'] ?>', '<?= $user['description'] ?>', '<?= $user['photo'] ?>')">
                    Προσθήκη στα Αγαπημένα
                </button>

                <script>
                    function addToFavorites(productName, productPrice, productDescription, productPhoto) {
                        // use of Fetch API to send data in php file
                        fetch('favorite_products.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: new URLSearchParams({
                                'username': '<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>',
                                'productName': productName,
                                'productPrice': productPrice,
                                'productDescription': productDescription,
                                'productPhoto': productPhoto
                            }),
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Σφάλμα κατά την αποστολή των δεδομένων.');
                            }
                            return response.text();
                        })
                        .then(data => {
                            console.log(data);

                            // checking if product is already in favorites
                            if (data.includes('already_in_favorites')) {
                                // if is already in favorites, show alert
                                alert('Το προϊόν είναι ήδη στα αγαπημένα σας!');
                            } else {
                                // if adding in favorites success, show alert
                                alert('Το προϊόν προστέθηκε με επιτυχία στα αγαπημένα σας!');
                            }
                        })
                        .catch(error => {
                            console.error('Σφάλμα:', error);

                            alert('Σφάλμα κατά την αποστολή των δεδομένων.');
                        });
                    }
                </script>

                <!-- adding to cart -->
               <button class="btn btn-primary add-to-cart-btn"
                    onclick="addToCart('<?= $user['name'] ?>', '<?= $user['price'] ?>')">
                    Προσθήκη στο Καλάθι
                </button>
            </div>

                <script>
                    function addToCart(productName, productPrice) {
                        // Fetch API 
                        fetch('checkout.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: new URLSearchParams({
                                'username': '<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>',
                                'productName': productName,
                                'productPrice': productPrice,
                            }),
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Σφάλμα κατά την αποστολή των δεδομένων.');
                            }
                            return response.text();
                        })
                        .then(data => {
                            console.log(data);

                            alert('Το προϊόν προστέθηκε με επιτυχία στο Καλάθι σας!');
                        })
                        .catch(error => {
                            console.error('Σφάλμα:', error);

                            alert('Σφάλμα κατά την αποστολή των δεδομένων.');
                        });
                    }
                </script>
                            <!-- comments -->
                <form method="post" action="comments.php" class="mt-3">
                    <div class="form-group">
                        <label for="comment">Σχόλιο:</label>
                        <textarea class="form-control" id="comment" name="comment"></textarea>
                    </div>
                    <input type="hidden" name="productId" value="<?= $user['_id'] ?>">
                    <button type="submit" class="btn btn-primary" name="submitComment">Υποβολή Σχολίου</button>
                </form>

            </div>


        <?php endif; ?>
    </div>
<?php endforeach; ?>




    <!--ENSWMATOSH CSS-->
    <style>

        .img-fluid {
            margin-bottom: -10px;
        }

.favorite-btn {
    background-color: #007bff;
    color: #fff;
    border: 1px solid #007bff;
    transition: background-color 0.3s, color 0.3s;
}

.favorite-btn:hover {
    background-color: #0056b3;
}

.add-to-cart-btn {
    background-color: #28a745;
    color: #fff;
    border: 1px solid #28a745;
    transition: background-color 0.3s, color 0.3s;
}

.add-to-cart-btn:hover {
    background-color: #218838;
}

#comment {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    resize: vertical;
}

.btn-primary {
    background-color: #007bff;
    color: #fff;
    border: 1px solid #007bff;
    transition: background-color 0.3s, color 0.3s;
    margin-top: 10px;
}

.btn-primary:hover {
    background-color: #0056b3;
}


    .product-container {
        text-align: center;
        margin: 20px; 
        display: inline-block;
        margin-left: 22%;
    }

    .product-container img {
        max-width: 100%; 
        height: auto;
    }

    .btn {
        margin-top: 10px;
    }
</style>

<script>
    document.querySelector('.hamburger').addEventListener('click', function() {
      document.querySelector('.menu').classList.toggle('open');
    });
</script>
  




        <!--Vazw css mesa se html-->
        <form style="margin-bottom:80px"> </form>
       

      <!--Footer stathero gia kathe html page-->
      <footer>
        <div class="cont">
          <div class="gr2">
            <div class="col">
              <h3>Στοιχεία Επικοινωνίας</h3>
              <ul class="c">
                <li><a  href="tel:6986680496">Τηλέφωνο: 6986680496</a></li>
                <li><a  href="mailto:myFriendsShop@eshop.com">Email: myFriendsShop@eshop.com</a></li>
              </ul>
            </div>
            <div class="col">
              <h4>Χάρτης</h4>
              <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3145.5409907289077!2d23.696532576491315!3d37.964502301207325!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14a1bcf6b6876267%3A0xd3eda5fbbbcffe97!2zzqfPgc-Fz4POv8-Dz4TPjM68zr_PhSDOo868z43Pgc69zrfPgiAxNywgzqTOsc-Nz4HOv8-CIM6Rz4TPhM65zrrOrs-CIDE3NyA3OA!5e0!3m2!1sel!2sgr!4v1684270196121!5m2!1sel!2sgr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
            </div>
          </div>
        </div>
        <p class="f">© 2023 My Webpage for University. All rights reserved to Antonis Papakonstantinou.</p>
      </footer>
    
    <!--script gia na anoigei to menu tou xristi-->

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const userMenu = document.getElementById('user-menu');
            const toggleMenuBtn = document.getElementById('toggle-menu-btn');

            toggleMenuBtn.addEventListener('click', function () {
                userMenu.classList.toggle('user-menu-collapsed');
            });
        });
</script>

    
</body>
</html>