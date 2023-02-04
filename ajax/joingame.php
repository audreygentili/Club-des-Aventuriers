<?php
    include_once("./connect.php");
    include("./classes/game.php");

    // Récupération du code entré
    $code = $_GET["code"];

    // Si la partie existe : changement de code de partie du joueur
    $rq = "SELECT * FROM Game WHERE gameId = '".$code."'";
    $res = mysqli_query($db, $rq);
    if (mysqli_num_rows($res) == 1) {
        while ($row = mysqli_fetch_assoc($res)) {
            $rq1 = "UPDATE User SET gameId='".$code."' WHERE pseudo = '".$_SESSION['pseudo']."'";
            $res1 = mysqli_query($db, $rq1);
            $nb = $row["nb"];
            $aventure = $row["aventure"];
            $conteur = $row["conteur"];

            // Création de la partie et redirection
            $game = new Game($code, $nb, $aventure, $conteur);
            $_SESSION['game'] = serialize($game);
            echo "ok";
        }
    } else {
        echo "error";
    }  
?>
