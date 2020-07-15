<?php
session_start();
if(isset($_SESSION["login"]) and isset($_POST["pass_old"]) and isset($_POST["pass_new"])) {
    
  include "connect.php";         
  $conn = new mysqli($db_server, $db_login, $db_password, $db_name);
  $conn->set_charset("utf8") or die("koding");
  
  $hash_pass_old = hash("sha512", $_POST["pass_old"]);  
  
  $sql = "SELECT password FROM users WHERE login = '" . $_SESSION["login"] . "'";
  $res = mysqli_query($conn, $sql);  
  $row = mysqli_fetch_array($res);
  
  if($row["password"] == $hash_pass_old) {
        
    $sql = "UPDATE users SET `password` = ? WHERE login = '" . $_SESSION["login"] . "'";
    $stmt = mysqli_prepare($conn, $sql);  
    mysqli_stmt_bind_param($stmt, "s", $hash_pass_new);
    $hash_pass_new = hash("sha512", $_POST["pass_new"]);
      
    if(mysqli_stmt_execute($stmt)) {$_SESSION["cp_err"] = "Heslo bylo uspesne zmeneno";}
    else {$_SESSION["cp_err"] = mysqli_error($conn);}
    
  } else {$_SESSION["cp_err"] = "Špatné staré heslo";} 
  
  mysqli_stmt_close($stmt);
  $conn->close();
    
}
header("Location: change_pass.php");
?>