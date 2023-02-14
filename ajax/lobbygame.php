<?php
    include_once("../connect.php");
    include("../classes/game.php");

    // Récupération du code entré et de l'état de partie
    $code = $_GET["code"];
    $start = $_GET["start"];
    // Nombre de joueurs
    $nbJ = 0;

    // Recherche de tous les joueurs entrés dans la partie
    $rq = "SELECT * FROM User WHERE gameId = '".$code."'";
    $res = mysqli_query($db, $rq);
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $nbJ++; 
            // Ajout des joueurs dans la partie
            $game = unserialize($_SESSION['game']);
            $game->ajoutJoueur($row["pseudo"]);
            $_SESSION['game'] = serialize($game);
        }
    }

    // Commencement de la partie pour le joueur hôte
    if ($start == "yes") {
        $nbJ = 100;
        $rq = "UPDATE Game SET mission=1 WHERE gameId='".$code."'";
        $res = mysqli_query($db, $rq);
    }

    //Commencement de la partie pour tous les joueurs
    $rq = "SELECT * FROM Game WHERE gameId = '".$code."'";
    $res = mysqli_query($db, $rq);
    if (mysqli_num_rows($res) == 1) {
        while ($row = mysqli_fetch_assoc($res)) {
            if ($row["mission"] == 1) {
                $nbJ = 100;
                // Changement de la mission dans la partie
                $game = unserialize($_SESSION['game']);
                $game->set_mission(1);
                $_SESSION['game'] = serialize($game);
            }
        }
    }  
    echo $nbJ; 
?>
