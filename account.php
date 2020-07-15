<?php include "header.php";?>

<?php

include "connect.php";
$conn =new mysqli($db_server, $db_login, $db_password, $db_name);
$conn->set_charset("utf8") or die ("koding");

if(isset($_SESSION["login"])) {
  
?>

  <h2>Účet</h2>
  <p>Přezdívka: <?php echo $_SESSION["login"];?></p>
  <p>Email: <?php echo $_SESSION["user_email"];?></p>
  
  <a href="change_pass.php">Změna hesla</a><br>
  <a href="change_mail.php">Změna e-mailu</a><br>
  <a href="order_history.php">Vaše předešlé objednávky</a>

<?php
} else {
    header("Location: login.php");  
}
?>

<?php include "footer.php";?>