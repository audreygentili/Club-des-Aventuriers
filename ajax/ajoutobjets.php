<?php
    header('Content-Type: text/xml');
    include_once("../connect.php");
    include("../classes/game.php");
 
    // Ajout des 10 objets pour le conteur
    $game = unserialize($_SESSION['game']);
    $host = $game->get_conteur();
    if ($host == $_SESSION['userId']) {
        $nbobj = $game->nbObjets();
        while ($nbobj < 10) {
            $game->ajoutObjet();
            $nbobj = $game->nbObjets();
        }

        $obj = $game->get_objets();
    
        echo '<?xml version="1.0" encoding="ISO-8859-1"?>
        <Objets>';
        for ($i = 0; $i < 10; $i++) {
            $tag = $i + 1;
            echo "<Objet><Nom>".$obj[$i]."</Nom></Objet>";
        }
        echo "</Objets>";
    } else echo "";
    $_SESSION['game'] = serialize($game);
?>