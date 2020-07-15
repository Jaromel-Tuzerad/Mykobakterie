<?php
session_start();

if(isset($_POST["submit"], $_SESSION["login"]) and $_SESSION["login"] == "admin") {  
  include "connect.php";
  $conn = new mysqli($db_server, $db_login, $db_password, $db_name);
  $conn->set_charset("utf8") or die ("koding");
  $sql = "INSERT INTO records(id_record, address, source_of_water, water_flow, date, bacteria_percentage, temperature) VALUES (?, ?, ?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($conn, $sql);  
  mysqli_stmt_bind_param($stmt, "sssssss", $id_record, $address, $source_of_water, $water_flow, $date, $bacteria_percentage, $temperature);
  
  $id_record = $_POST["id_record"];
  $address = $_POST["address"];
  $source_of_water = $_POST["source_of_water"];
  $water_flow = $_POST["water_flow"];
  $date = $_POST["date"];
  $bacteria_percentage = $_POST["bacteria_percentage"];
  $temperature = $_POST["temperature"];
 
  if(mysqli_stmt_execute($stmt)) {
    $_SESSION["ar_err"] = "Záznam byl úspěšně přidán.<br>";
  } else {$_SESSION["ar_err"] = mysqli_error($conn);}
  
  $sql = "UPDATE orders SET resolved = '1' WHERE orders.id_order = ?;";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "s", $id_record);
  
  if(mysqli_stmt_execute($stmt)) {
    if(mysqli_stmt_affected_rows($stmt) == 1) {
        $_SESSION["co_err"] = "Objednávka číslo " . $_POST["id_record"] . " byla označena jako vyřešena.";
    }
    else {
        if(mysqli_stmt_affected_rows($stmt) > 1) {$_SESSION["co_err"] = "VAROVÁNÍ: více objednávek bylo označeno jako vyřešené.";}
        else {$_SESSION["co_err"] = "VAROVÁNÍ: žádná objednávka nebyla označena jako vyřešena.";}
    }     
  } else {$_SESSION["co_err"] = mysqli_error($conn);} 
  
  mysqli_stmt_close($stmt);
  $conn->close();
}

header("Location: add_record.php");
exit(0);
?>