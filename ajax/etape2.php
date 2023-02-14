<?php
    header('Content-Type: text/xml');
    include_once("../connect.php");
    include("../classes/game.php");

    // Passage à l'étape suivante
    $game = unserialize($_SESSION['game']);
    $code = $game->get_id();
    $host = $game->get_conteur();
    $etape = $game->get_etape();

    if ($etape == 0) {
        $e = 1;
    } else if ($etape == 1) {
        $e = 2;
    } else if ($etape == 2) {
        $e = 0;
    }
    if ($host != $_SESSION['userId']) {
        $rq1 = "UPDATE Game SET etape = '".$e."' WHERE gameId='".$code."'";
        $res1 = mysqli_query($db, $rq1);
    }

    $rq = "SELECT * FROM Game WHERE gameId = '".$code."'";
    $res = mysqli_query($db, $rq);
    if (mysqli_num_rows($res) == 1) {
        while ($row = mysqli_fetch_assoc($res)) {
            $etapeDB = $row["etape"];
        }
    }

    $etape = $game->get_etape();
    if ($etapeDB == $etape) {
        echo "ok";
    } else {
        if ($etape == 0) {
            $game->set_etape(1);
        } else if ($etape == 1) {
            $game->set_etape(2);
        } else if ($etape == 2) {
            $game->set_etape(0);
        }
        echo $game->get_etape();
    }
    $_SESSION['game'] = serialize($game);
?>