<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Σελίδα Διαχείρισης</title>


    
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

      <!--LOGIN FORM-->

      <h1>Καλωσήρθατε στην σελίδα του Διαχειριστή</h1>
      <div class="container">
 
        <form form action="inter5.php" method="post">
 
            
            <label for="username" >Όνομα Χρήστη:</label>
            <input required type="text" id="username" name="username"><br>
    
            <label for="name" required>Κωδικός Πρόσβασης:</label>
            <input required type="password" id="password" name="password"><br>
            <button class="btnLogin" type="submit" name="login">Σύνδεση Διαχειριστή</button>
         
        </form>
      </div>
      
     
      <?php

      
    
      if (isset($_POST['login'])) {
          $username = $_POST['username'];
          $password = $_POST['password'];

          if ($username === 'admin' && $password === '123') {
              header('Location: admin_panel.php');
              exit;
          } else {
              echo '<script>alert("Λυπούμαστε, δεν είστε διαχειριστής της διαδικτυακής εφαρμογής.");</script>';
              echo '<script type="text/javascript">  location="inter5.php"; </script>';
          }
      }
      ?>

















  <style>

    


  .btnLogin{
    display: inline-block;
    padding: 10px 20px;
    background-color: #337ab7;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    font-weight: bold;
  }

  .btnLogin:hover{
    cursor: pointer;
    background-color: #477093;

  }

      
  
  table {
    width: 100%;
    border-collapse: collapse;
    background-color: #b1c4d6;
    margin-bottom: 10px;
    margin-top: 10px;
  }

  table th,
  table td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }

  table th {
    background-color: #f2f2f2;
  }



   .container {
  width: 300px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f2f2f2;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
  margin-bottom: 24px;
}

h1 {
  text-align: center;
}

.form-group {
  margin-bottom: 15px;
}

label {
  font-weight: bold;
  text-align: left;
}

input[type="text"],
input[type="password"] {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

input[type="submit"] {
  width: 100%;
  padding: 10px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #45a049;
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