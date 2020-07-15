<?php include("header.php");?>

<?php
if(isset($_SESSION["login"], $_GET["art"]) and $_SESSION["login"] == "admin") {
?>   

    <p>Jste si jist že chcete smazat èlánek s ID <?php echo $_GET["art"]?>?;<p>
    
    <form action="s_delete_art.php?art=<?php echo $_GET["art"];?>" method="post">
        <input type="submit" value="Ano" name="confirm">
    </form>
    <form action="index.php" method="post">
        <input type="submit" value="Ne">
    </form>

<?php
} else {header("Location: index.php"); exit(0);}

include("footer.php");
?>