<?php
    header('Content-Type: text/xml');
    include_once("../connect.php");
    include("../classes/game.php");
 
    // Récupération du code de la partie
    $game = unserialize($_SESSION['game']);
    $code = $game->get_id();
    $host = $game->get_conteur();
    $_SESSION['game'] = serialize($game);

    // Récupération des objets du conteur
    $rq = "SELECT * FROM Game WHERE gameId = '".$code."'";
    $res = mysqli_query($db, $rq);
    if (mysqli_num_rows($res) == 1) {
        while ($row = mysqli_fetch_assoc($res)) {
            $obj1 = $row["obj1"];
            $obj2 = $row["obj2"];
            $obj3 = $row["obj3"];
            $obj4 = $row["obj4"];
            $obj5 = $row["obj5"];
        }
    }

    $obj = array($obj1, $obj2, $obj3, $obj4, $obj5);
    
    if ($host != $_SESSION['userId']) {
        echo '<?xml version="1.0" encoding="ISO-8859-1"?>
        <Objets>';
        for ($i = 0; $i < 5; $i++) {
            $tag = $i + 1;
            echo "<Objet><Nom>".$obj[$i]."</Nom></Objet>";
        }
        echo "</Objets>";
    } else echo "";
?>