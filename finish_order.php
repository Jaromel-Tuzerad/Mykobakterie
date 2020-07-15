<?php include "header.php";?>

<?php

if(!isset($_SESSION["login"]) or !isset($_POST["confirm"])) {header("Location: index.php"); exit;}

  $_SESSION["firstname"]=$_POST["firstname"];
  $_SESSION["secondname"]=$_POST["secondname"];
  $_SESSION["adress"]=$_POST["adress"];
  $_SESSION["postcode"]=$_POST["postcode"];
  $_SESSION["city"]=$_POST["city"];
  echo "<h4>Dokončení objednávky:</h4>";
  echo "<p><strong>Jméno a příjmení: </strong>".$_SESSION["firstname"]." ".$_SESSION["secondname"]."</p>";
  echo "<p><strong>Adresa: </strong>".$_SESSION["adress"].", ".$_SESSION["city"]." ".$_SESSION["postcode"];
?>
  <form action="order.php" method="post">
      <input type="submit" value="Zpět" name="back">
  </form>
  <form action="s_submit_order.php" method="post">
      <input type="submit" value="Odeslat" name="submit">
  </form>

<?php include "footer.php";?>