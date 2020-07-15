<?php
session_start();
if($_SESSION["login"]=="admin" and isset($_POST["edit"])) {

  //Pripojeni k databazi
  include "connect.php";
  $conn = new mysqli($db_server, $db_login, $db_password, $db_name);
  $conn->set_charset("utf8") or die ("koding"); 

  //Odeslani clanku
  if(isset($_GET["art"])) {
      $sql = "UPDATE `articles` SET `title` = ?, `content` = ? WHERE `articles`.`id_art` = ?;";
      $art = $_GET["art"]; 
      $res = mysqli_prepare($conn, $sql);  
      mysqli_stmt_bind_param($res, "sss", $title, $content, $art);
  } else {
      $sql = "INSERT INTO articles(title, content) VALUES (?, ?)";
      $res = mysqli_prepare($conn, $sql);  
      mysqli_stmt_bind_param($res, "ss", $title, $content);
  }
  
  $title = $_POST["title"];
  $content = $_POST["content"];
  
  mysqli_stmt_execute($res);   
  
  $conn->close();

} 

header("Location: index.php");
?>