<?php include "header.php";?>

<?php if(!isset($_SESSION["login"])) {header("Location: login.php"); $_SESSION["login_err"] = "K vytvoření objednávky je nutné být přihlášen!"; exit(0);}?>

    <p>Zde si můžete objednat sadu na testování vody. Zásilka Vám bude doručena do 5 pracovních dnů (Po - Pá) zásilkovou službou. Pokud v poznámce neupřesníte vhodnou dobu k vyzvednutí, bude doručena mezi 16. a 18. hodinou. Potvrzení objednávky Vám bude doručeno na email, který máte spojený s Vaším účtem (více informací <a href="account.php">zde</a>). Cena je vždy na dobírku, ve výši 150,- Kč, vč. DPH.</p>

  <form action="finish_order.php" method="post">
    Jméno:   <input type="text" name="firstname" value="<?php if(isset($_SESSION["firstname"])){echo $_SESSION["firstname"]; unset($_SESSION["firstname"]);}?>" required><br>
    Příjmení:<input type="text" name="secondname" value="<?php if(isset($_SESSION["secondname"])){echo $_SESSION["secondname"]; unset($_SESSION["secondname"]);}?>" required><br>
    Adresa:  <input type="text" name="adress" value="<?php if(isset($_SESSION["adress"])){echo $_SESSION["adress"]; unset($_SESSION["adress"]);}?>" required><br>
    PSČ:     <input type="text" name="postcode" value="<?php if(isset($_SESSION["postcode"])){echo $_SESSION["postcode"]; unset($_SESSION["postcode"]);}?>" required><br>
    Město:   <input type="text" name="city" value="<?php if(isset($_SESSION["city"])){echo $_SESSION["city"]; unset($_SESSION["city"]);}?>" required><br>
    <input type="submit" value="Pokračovat" name="confirm">
  </form> 

<?php include "footer.php";?>