<?php
session_start();
if(isset($_GET["art"], $_POST["confirm"], $_SESSION["login"]) and $_SESSION["login"] == "admin") {

  include "connect.php";
  $conn = new mysqli($db_server, $db_login, $db_password, $db_name);
  $conn->set_charset("utf8") or die ("koding");
   
  $sql = "DELETE FROM articles WHERE articles.id_art = ?";
  $stmt = mysqli_prepare($conn, $sql);  
  mysqli_stmt_bind_param($stmt, "s", $art_num);
  
  $art_num = $_GET["art"];
  
  mysqli_stmt_execute($stmt);
  
  mysqli_stmt_close($stmt);
  mysqli_close($conn);

}
header("Location: index.php");
exit(0);

?>