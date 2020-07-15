<?php
session_start();

if(!isset($_SESSION["login"]) and isset($_POST['submit'], $_POST["nickname"], $_POST["password"], $_POST["pass_again"], $_POST["email"])) {
  
  include "connect.php";
  $conn = new mysqli($db_server, $db_login, $db_password, $db_name);
  $conn->set_charset("utf8") or die ("koding");
    
  //Check if the nickname is available
    $sql = "SELECT login FROM users WHERE login = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $login);
    
    $login = $_POST["nickname"];
    
    mysqli_stmt_execute($stmt);  
    $res = mysqli_stmt_get_result($stmt);
    
    //0 -> available, 1 -> not available
    $user_check = mysqli_num_rows($res);
  
  //Check if the email is available
    $sql = "SELECT email FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    
    $email = $_POST["email"];
    
    mysqli_stmt_execute($stmt);  
    $res = mysqli_stmt_get_result($stmt);
    
    //0 -> available, 1 -> not available
    $email_check = mysqli_num_rows($res);
   
  //Error check, if there is at least one, user will be redirected to register.php, where the errors will be shown
    $err_level = 0;
    if($user_check) {
      $_SESSION["nickname_err"]="Tuto přezdívku již používá jiný uživatel.";
      $err_level += 1;
    }   
    if($_POST['password'] != $_POST['pass_again']) {
      $_SESSION["password_err"] = "Vyplněná hesla se neshodují.";
      $err_level += 1;
    }
    if($email_check) {
      $_SESSION["email_err"] = "Tento email již používá jiný uživatel.";
      $err_level += 1;
    }
    if($err_level > 0) {
      mysqli_close($conn);
      $_SESSION["nickname"] = $_POST["nickname"];
      $_SESSION["email"] = $_POST["email"];
      header("Location: register.php"); 
      exit;  
    }
    
  //Registering the user into the database
    $sql = "INSERT INTO users(login, password, email) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $login, $password, $email);
    
    $password = hash("sha512", $_POST['password']);
    
    mysqli_stmt_execute($stmt);  
  
  //Sending email to confirm registration
    $mailto = $_POST['email'];
    $mailSub = "Potvrzení registrace MYKOBAKTERIE Testing";
    $mailMsg = "Vážený uživateli,<br> byl jste uspěšně zaregistrován na stránce MYKOBAKTERIE Testing.<p>Uživatelké jméno: <strong>".$_POST['nickname']."</strong></p><p>Heslo: <strong>".$_POST['password']."</strong></p><p>Doufáme, že s
    našimi službami budete spokojeni.</p><p>Tým MYKOBAKTERIE Testing</p>"; 
    require "send_mail.php";
    
  mysqli_close($conn);
  $_SESSION["login_err"] = "Registrace byla úspěšná, přihlašte se níže";
  header("Location: login.php");
  exit;

} else {header("Location: index.php"); exit;}
?>