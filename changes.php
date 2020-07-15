<?php
session_start();
if(isset($_SESSION["login"])){

include "connect.php";
$conn =new mysqli($db_server, $db_login, $db_password, $db_name);
    $conn->set_charset("utf8") or die ("koding");
    
  if(isset($_POST["topasschange"]) or isset($newpasssend)){
    if(isset($_POST["submit"])) {
      $login=$_SESSION["login"];
      $pass_old = ($_POST["pass_old"]);
      $pass_new = ($_POST["pass_new"]);
      $hash_old_pass = hash("sha512", $pass_old);
      $hash_new_pass = hash("sha512", $pass_new);
      $dotaz = mysqli_query($conn, "select * from users where heslo = '$hash_old_pass'");
      $overeni = mysqli_num_rows($dotaz);
      $row = mysqli_fetch_array($dotaz);
          if($overeni == 1){
              $sql = "UPDATE users SET `heslo` = \"" . $hash_new_pass . "\" WHERE login=\"" . $_SESSION["login"] . "\"";
              $result=mysqli_query($conn, $sql);   
                if($result){
                  echo "update";
                }
                else{
                    echo "fuck";
                    echo "<br>";
                    echo mysqli_error($conn);
                }
          }
    else{
      echo "Špatné staré heslo";
    }
  }

  else{
  ?>

  <center>
  <h1>Změna hesla</h1>
  <form method="POST" action="">                    
  Staré heslo <input type="password" placeholder="" name="pass_old" required></p>
  Nové heslo  <input type="password" placeholder="" name="pass_new" required></p>
             <input type="submit" name="submit" value="Odeslat">
  <?php $newpasssend="";?>
   </form>
  </center>
  <?php
    }
  }
  
  else if(isset($_POST["tomailchange"])){
    if(isset($_POST["SUBMIT"])){
      $newemail=$_POST["email"];
      $hass_pass=hash("sha512", $_POST["password"]);
      $dotaz = mysqli_query($conn, "select * from users where login='".$_SESSION["login"]."' and heslo = '$hass_pass'");
      $overeni = mysqli_num_rows($dotaz);
      $row = mysqli_fetch_array($dotaz);
          if($overeni == 1){
            $sql = "UPDATE users SET `email` = \"" . $newemail . "\" WHERE login=\"" . $_SESSION["login"] . "\"";
              $result=mysqli_query($conn, $sql);   
                if($result){
                  echo "update";
                }
                else{
                    echo "fuck";
                    echo "<br>";
                    echo mysqli_error($conn);
                }
          }
    else{
    echo "Špatmé heslo";
    }
    }
  ?>
  <center>
  <h1>Změna emailu</h1>
  <form action="" method="post">
  Heslo <input type="password" name="password" required></p>
  Nový Email:<input type="email" name="email" required></p>
      <input type="submit" name="SUBMIT" value="Odeslat">
  </form>
  </center>
  <?php
  }
}
else {
header("Location: index.php");
}
?>
