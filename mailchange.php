<center><h1>Změna mailu</h1></center>
<?php
session_start();
if(isset($_SESSION["login"])){
  
  include "connect.php";
  $conn = new mysqli($db_server, $db_login, $db_password, $db_name);
  $conn->set_charset("utf8") or die ("koding");
  
  if(isset($_POST["SUBMIT"])) {
    $login=$_SESSION["login"];
    $email_old = ($_POST["email_old"]);
    $email_new = ($_POST["email_new"]);
    
    $dotaz = mysqli_query($conn, "SELECT * FROM users WHERE email = '" . $email_old . "'");
    $overeni = mysqli_num_rows($dotaz);
    $row = mysqli_fetch_array($dotaz);
    if($overeni == 1) {
      
      $sql = "UPDATE users SET `email` = \"" . $email_new . "\" WHERE login=\"" . $_SESSION["login"] . "\"";
      $result=mysqli_query($conn, $sql);   
      if($result) {
        echo "update";
      }
      else {
        echo "duck";
        echo "<br>";
        echo mysqli_error($conn);
      }
    }
    else {
        echo "Špatný starý email";
    } 
  }   
?>  
  <center>
  <form method="POST" action="">                    
    Starý email <input type="text" placeholder="" name="email_old" required></p>
    Nový email  <input type="text" placeholder="" name="email_new" required></p>
    <input type="submit" name="SUBMIT">
  </form>
  <form method="POST" action="index.php">
    <input type="submit" value="Domovská stránka">
  </form>
<?php
}
else {
header("Location: index.php");
}
?>
