<?php
session_start();  
if(!isset($_SESSION["login"]) and isset($_POST["submit"], $_POST["nickname"], $_POST["password"])) {

  include "connect.php";
  $conn = new mysqli($db_server, $db_login, $db_password, $db_name);
  $conn->set_charset("utf8") or die ("koding");
  
  $sql = "SELECT id_user, email FROM users WHERE login = ? AND password = ?";
  $stmt = mysqli_prepare($conn, $sql); 
    
  mysqli_stmt_bind_param($stmt, "ss", $login, $password);
  
  $login = $_POST["nickname"];
  $password = hash("sha512", $_POST["password"]);
  
  mysqli_stmt_execute($stmt);
  
  $res = mysqli_stmt_get_result($stmt);
  $check = mysqli_num_rows($res);
  $row = mysqli_fetch_array($res);
  
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
  
  if($check) {
  
    /* Zde se vytváří SESSION 'login', kterou se budeme prokazovat jako přihlášení */
    $_SESSION['login'] = stripslashes($login);     
    $_SESSION['id'] = $row["id_user"];
    $_SESSION['user_email']=$row["email"];
    
  } else {
    $_SESSION["login_err"] = "Zadal jsi špatný login nebo heslo!";
    header("Location: login.php");
    exit;
  } 
} 
header("Location: index.php");
exit;
?>