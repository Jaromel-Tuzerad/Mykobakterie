<?php include "header.php";?>

<?php

if(!isset($_SESSION["login"])) {header("Location: login.php"); exit(0);}

include "connect.php";
$conn = new mysqli($db_server, $db_login, $db_password, $db_name);
$conn->set_charset("utf8") or die("koding");

    //Nezapsane objednavky
?>
<h1>Odeslané objednávky</h1>
<table>
  <tr>
    <td><strong>ID</strong></td>
    <td><strong>Jmeno</strong></td>
    <td><strong>Adresa</strong></td>
    <td><strong>Poznámka</strong></td>
    <td><strong>Datum odeslání</strong></td>
  </tr>
  
<?php
$sql = "SELECT id_order, name, adress, comment, DATE(timestamp) AS 'date' FROM orders WHERE resolved = 0 AND orders.nick = '" . $_SESSION["login"] . "' ORDER BY date, id_order";
$res = $conn->query($sql);
while($row = mysqli_fetch_array($res)) {
  echo "<tr><td>" . $row["id_order"] . "</td><td>" . $row["name"] . "</td><td>" . $row["adress"] . "</td><td>" . $row["comment"] . "</td><td>" . $row["date"] . "</td></tr>";
  echo "<br>";
}
?>
</table>

<h1>Výsledky testů</h1>
<table>
  <tr>
    <td><strong>ID</strong></td>
    <td><strong>Adresa místa testování</strong></td>
    <td><strong>Datum měření</strong></td>
    <td><strong>Zdroj</strong></td>
    <td><strong>Procento bakterii</strong></td>
  </tr>

<?php
$sql = "SELECT records.id_record, records.date, records.address, records.source_of_water, records.bacteria_percentage FROM records, orders WHERE records.id_record = orders.id_order AND orders.nick = '" . $_SESSION["login"] . "'";
$res = $conn->query($sql);
while($row = mysqli_fetch_array($res)) {
  echo "<tr><td>" . $row["id_record"] . "</td><td>" . $row["address"] . "</td><td>" . $row["date"] . "</td><td>" . $row["source_of_water"] . "</td><td>" . $row["bacteria_percentage"] . "</td></tr>";
  echo "<br>";
}
$conn->close();
?>    
</table>


<?php include "footer.php";?>                                                                            