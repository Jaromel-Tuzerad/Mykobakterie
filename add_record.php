<?php include "header.php"; ?>

<?php 
if(!isset($_SESSION["login"]) or $_SESSION["login"] != "admin") {header("Location: index.php"); exit(0);}
if(isset($_SESSION["ar_err"])) {echo $_SESSION["ar_err"]; unset($_SESSION["ar_err"]);}
if(isset($_SESSION["co_err"])) {echo $_SESSION["co_err"]; unset($_SESSION["co_err"]);}
?> 
<h1>Přidání záznamu z testování vody</h1>
<form action="s_add_record.php" method="post">
  ID objednávky: <input type="text" name="id_record" required><br>
  Adresa místa testování: <input type="text" name="address" required><br>
  Typ vody: &nbsp; 
    studená <input type="radio" name="temperature" value="cold" required>
    teplá <input type="radio" name="temperature" value="warm" required><br>
  Zdroj vody: <input type="text" name="source_of_water" required><br>
  Průtok vody za hodinu: <input type="number" name="water_flow" required>m^3<br>
  Datum pořízení vzorku: <input type="date" name="date" required><br>
  Množství mykobakterií ve vodě: <input type="number" name="bacteria_percentage" required>%<br>
  <input type="submit" name="submit" value="Vytvorit">
</form>

<?php
include "connect.php";
$conn = new mysqli($db_server, $db_login, $db_password, $db_name);
$conn->set_charset("utf8") or die ("koding");
$sql = "SELECT AVG(water_flow) AS flow, (SELECT AVG(bacteria_percentage) FROM records WHERE temperature = 'warm') AS bacs_warm, (SELECT AVG(bacteria_percentage) FROM records WHERE temperature = 'cold') AS bacs_cold, AVG(bacteria_percentage) AS bacs FROM records;";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);

echo "
<p>Průměrný průtok vody: <strong>" . $row["flow"] . "</strong></p>
<p>Průměrné procento bakterií (teplá): <strong>" . $row["bacs_warm"] . "</strong></p>
<p>Průměrné procento bakterií (studená): <strong>" . $row["bacs_cold"] . "</strong></p>
<p>Průměrné procento bakterií (celkem): <strong>" . $row["bacs"] . "</strong></p>
";

$conn->close();
?>

<?php include "footer.php"?>