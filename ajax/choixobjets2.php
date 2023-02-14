<?php
    header('Content-Type: text/xml');
    include_once("../connect.php");
    include("../classes/game.php");
 
    // Récupération des paramètres
    $obj1 = $_GET['obj1'];
    $obj2 = $_GET['obj2'];

    // Ajout des objets choisis dans la base de données
    $game = unserialize($_SESSION['game']);
    $code = $game->get_id();
    $_SESSION['game'] = serialize($game);

    $rq = "UPDATE Game SET objG1 = '".$obj1."', objG2 = '".$obj2."' WHERE gameId = '".$code."'";
    $res = mysqli_query($db, $rq);
?>