<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Υπολογισμός Κόστους Φυσικού Αερίου</title>
    <script src="calculate.js"></script>
<!-- Styling gia to logout-->
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
          /* Κοινό στυλ για τα link */
          a {
              text-decoration: none;
              color: #333;
          }

          /* Στυλ για την κεντρική ενότητα */
          #user-menu {
              font-family: 'Arial', sans-serif;
              background-color: #f2f2f2;
              padding: 10px;
              border: 1px solid #ddd;
              border-radius: 5px;
              display: inline-block;
          }

          /* Στυλ για το κουμπί "Μενού" */
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

          /* Στυλ για τις επιλογές του μενού */
          .user-menu-collapsed ul {
              display: none;
              list-style-type: none;
              padding: 0;
          }

          .user-menu-collapsed ul li {
              margin-bottom: 5px;
          }

          /* Στυλ για το κουμπί "Αποσύνδεση" */
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

          /* Στυλ για τα links σύνδεσης και εγγραφής */
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

  <script>
    document.querySelector('.hamburger').addEventListener('click', function() {
      document.querySelector('.menu').classList.toggle('open');
    });
  </script>

      <h1>Καλωσήρθατε στη σελίδα για τον υπολογισμό του κόστους των μεταφορικών σας!</h1>

<p class="parr">Το τελικό ποσό χρέωσης για τα μεταφορικά σας υπολογίζεται σύμφωνα με τους παρακάτω πίνακες.</p>






<!--Enswmatomeno css gia ta tables -->
<style>
  /* Table 1 */
  .table1 {
    width: 100%;
    border-collapse: collapse;
    background-color: #b1c4d6;
  }

  .table1 th,
  .table1 td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }

  .table1 th {
    background-color: #f2f2f2;
  }

  /* Table 2 */
  .table2 {
    width: 100%;
    border-collapse: collapse;
    background-color: #b1c4d6;
  }

  .table2 th,
  .table2 td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }

  .table2 th {
    background-color: #f2f2f2;
  }
</style>

<!--Tables gia na deiksoume ston xristi tis xrewseis -->

<!-- Table 1-->
<h2>Πίνακας 1 - Χρεώσεις εντός Ελλάδας</h2>
  <table class="table1">
    <tr>
      <th>Χιλιομετρική Απόσταση (Χλμ)</th>
      <th>Κόστος</th>
    </tr>
    <tr>
      <td>0-50 Χιλιόμετρα</td>
      <td>Δωρεάν</td>
    </tr>
    <tr>
      <td>51-150 Χιλιόμετρα</td>
      <td>1.5 €</td>
    </tr>
    <tr>
      <td>>151</td>
      <td>2.5 € </td>
    </tr>
  </table>



  <!-- Table 1-->
<h2>Πίνακας 2 - Χρεώσεις εκτός Ελλάδας</h2>
  <table class="table1">
    <tr>
      <th>Χιλιομετρική Απόσταση (Χλμ)</th>
      <th>Κόστος</th>
    </tr>
    <tr>
      <td> 20.000 - 30.000 Χιλιόμετρα</td>
      <td> 15 €</td>
    </tr>
    <tr>
      <td>31.000-80.000 Χιλιόμετρα</td>
      <td> 25 €</td>
    </tr>
    <tr>
      <td>>81.000</td>
      <td> 50€ </td>
    </tr>
  </table>













<!--Form gia ypologismo kostous-->

<div class="form-container">
  <h2 class="h2">Υπολογισμός κόστους μεταφορικών</h2>
  <form id="calc">
    <div class="form-group">
      <label for="xlm">Χιλιομετρική Απόσταση:</label>
      <input type="number" id="xlm" name="xlm" required>
    </div>
    <div class="form-group">
      <button id="submit" class="btn" onclick="showAlert()">Υπολογισμός</button>
      
    </div>
  </form>
</div>

<!--Enswmatomeno css gia to form -->
<style>

  .btn {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    text-decoration: none;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 4px;
   
  }
  
  .btn:hover {
    background-color: #45a049;
    cursor: pointer;
  }
  
  .btn:active {
    background-color: #3e8e41;
  }

.form-container {
    max-width: 400px;
    margin: 0 auto;
    border-radius: 22px;
    background-color: #b1c4d6;
}

.form-group {
  margin-bottom: 20px;
}

.form-group label {
  display: block;
  font-weight: bold;
}

.form-group input[type="text"],
.form-group input[type="number"] {
  width: 100%;
  padding: 5px;
  font-size: 16px;
}

.form-group input[type="submit"] {
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  border: none;
  cursor: pointer;
  font-size: 16px;
}

input[type="submit"]:hover{
  background-color: #000000;
}
 .h2{
  text-decoration: none;
  padding-top: 20px;
 }
</style>











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