<?php
session_start();
if(isset($_SESSION["login"]) and isset($_POST["email_new"])) {
    
  include "connect.php";           
  $conn = new mysqli($db_server, $db_login, $db_password, $db_name);
  $conn->set_charset("utf8") or die("koding");
        
  $sql = "UPDATE users SET `email` = ? WHERE login = '" . $_SESSION["login"] . "'";
  $stmt = mysqli_prepare($conn, $sql);  
  mysqli_stmt_bind_param($stmt, "s", $email_new);
  $email_new = $_POST["email_new"];
  
  if(mysqli_stmt_execute($stmt)) {$_SESSION["cm_err"] = "Email byl uspesne zmenen"; $_SESSION["user_email"] = $_POST["email_new"];}
  else {$_SESSION["cm_err"] = mysqli_error($conn);}
     
  mysqli_stmt_close($stmt);
  $conn->close();  
    
}
header("Location: change_mail.php");
exit(0);
?>