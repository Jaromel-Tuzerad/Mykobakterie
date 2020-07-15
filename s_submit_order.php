<?php
session_start();
if(!isset($_POST["submit"]) or !isset($_SESSION["login"])) {header("Location: index.php"); exit;}

include "connect.php";
$conn = new mysqli($db_server, $db_login, $db_password, $db_name);
$conn->set_charset("utf8") or die ("koding");
 
$sql = "INSERT INTO orders (nick, name, adress) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);  
mysqli_stmt_bind_param($stmt, "sss", $nick, $name, $adress);

$nick = $_SESSION["login"];
$name = ($_SESSION["firstname"] . " " . $_SESSION["secondname"]);
$adress = ($_SESSION["adress"] . ", "  . $_SESSION["city"] . ", " . $_SESSION["postcode"]);

mysqli_stmt_execute($stmt);

$mailto=$_SESSION["userMail"];
$mailSub="Potvrzení objednávky MYKOBAKTERIE Testing";
$mailMsg="Vážený uživateli,<p> potvrzujeme Vaši objednávku.</p><p></p><br>Jméno objednávajícího: <strong>".$_SESSION["firstname"]." ".$_SESSION["secondname"]."</strong>
                                                                      <br>Adresa objednávky: <strong>".$_SESSION["adress"]." ".$_SESSION["city"].", ".$_SESSION["postcode"]."</strong>
                                                                      <br>Tým MYKOBAKTERIE Testing";
require "send_mail.php";  
unset($_SESSION["firstname"]);
unset($_SESSION["secondname"]);
unset($_SESSION["adress"]);
unset($_SESSION["city"]);
unset($_SESSION["postcode"]);

mysqli_stmt_close($stmt);
mysqli_close($conn);

?>