<?php
$db_server = 'localhost'; /* Název serveru, ke kterému se budeme připojovat */
$db_login = 'tymovky02'; /* Jméno uživatele do DB */
$db_password = '3L9nNsgn'; /* Heslo uživatele do DB */
$db_name = 'tymovky02'; /* Název databáze, ve které jsme si vytvořili tabulku "uzivatele" */

$conn = new mysqli($db_server, $db_login, $db_password, $db_name);
$conn->set_charset("utf8") or die ("koding"); 
?>