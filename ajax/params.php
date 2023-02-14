<?php
    header('Content-Type: text/xml');
    include_once("../connect.php");
    include("../classes/game.php");
 
    // Récupération du code de la partie
    $game = unserialize($_SESSION['game']);
    $code = $game->get_id();
    $_SESSION['game'] = serialize($game);

    // Récupération des paramètres de la partie
    $rq = "SELECT * FROM Game WHERE gameId = '".$code."'";
    $res = mysqli_query($db, $rq);
    if (mysqli_num_rows($res) == 1) {
        while ($row = mysqli_fetch_assoc($res)) {
            $aventure = $row["aventure"];
            $mission = $row["mission"];
            $vies = $row["vies"];
        }
    }
    // Transmission XML des paramètres
    echo '<?xml version="1.0" encoding="ISO-8859-1"?>
    <Params><Param><Aventure>'.$aventure.'</Aventure>
    <Mission>'.$mission.'</Mission>
    <Vies>'.$vies.'</Vies></Param></Params>';
?>