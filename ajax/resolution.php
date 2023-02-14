<?php
    header('Content-Type: text/xml');
    include_once("../connect.php");
    include("../classes/game.php");
 
    // Récupération du code de la partie
    $game = unserialize($_SESSION['game']);
    $code = $game->get_id();
    $host = $game->get_conteur();

    // Récupération des objets
    $rq = "SELECT * FROM Game WHERE gameId = '".$code."'";
    $res = mysqli_query($db, $rq);
    if (mysqli_num_rows($res) == 1) {
        while ($row = mysqli_fetch_assoc($res)) {
            $obj1 = $row["obj1"];
            $obj2 = $row["obj2"];
            $objG1 = $row["objG1"];
            $objG2 = $row["objG2"];
            $mission = $row["mission"];
            $vies = $row["vies"];
            $conteur = $row["conteur"]; 
        }

        // Changement des paramètres
        if ($host == $_SESSION['userId']) {
            $mission++;
            $rq = "UPDATE Game SET mission = '".$mission."' WHERE gameId = '".$code."'";
            $res = mysqli_query($db, $rq); 
        }
        if ($host != $_SESSION['userId']) {
            $rq = "UPDATE Game SET conteur = '".$_SESSION['userId']."' WHERE gameId = '".$code."'";
            $res = mysqli_query($db, $rq);        
        }       
        if (($obj1 == $objG1 && $obj2 == $objG2) || ($obj1 == $objG2 && $obj2 == $objG1)) {
            if ($host == $_SESSION['userId']) {
                echo "gagne";
            } else {
                echo "gagne1";
            }
        } else {
            if ($host == $_SESSION['userId']) {
                $vies--;
                $rq = "UPDATE Game SET vies = '".$vies."' WHERE gameId = '".$code."'";
                $res = mysqli_query($db, $rq); 
                echo "perdu"; 
            } else {
                echo "perdu1";
            }
        }
    }

    // Récupération des nouveaux paramètres
    $rq = "SELECT * FROM Game WHERE gameId = '".$code."'";
    $res = mysqli_query($db, $rq);
    if (mysqli_num_rows($res) == 1) {
        while ($row = mysqli_fetch_assoc($res)) {
            $game->set_mission($row["mission"]);
            $game->set_vies($row["vies"]);
            $game->set_conteur($row["conteur"]); 
        }
    }
    $_SESSION['game'] = serialize($game);
?>