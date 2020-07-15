<?php
session_start(); // Zapneme session
session_destroy(); // Smažeme všechna session 'login'
header("Location: index.php"); // Přesměruje na přihlašovací stránku
exit;
?>