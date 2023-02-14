<?php
    include_once("../connect.php");
    include("../classes/game.php");
    
    $code = $_GET["code"];
    $nb = $_GET["nb"];
    $aventure = $_GET["aventure"];
    echo $code;

    $rq = "SELECT userId FROM User WHERE pseudo = '".$_SESSION['pseudo']."'";
    $res = mysqli_query($db, $rq);
    if (mysqli_num_rows($res) == 1) {
        while ($row = mysqli_fetch_assoc($res)) {
            $conteur = $row["userId"];
        }
    }   

    $rq1 = "SELECT * FROM Game WHERE gameId = '".$code."'";
    $res1 = mysqli_query($db, $rq1);
    if (mysqli_num_rows($res1) == 0) {
        $rq1 = "INSERT INTO Game(gameId, nb, aventure, mission, etape, vies, conteur, obj1, obj2, obj3, obj4, obj5, objG1, objG2) VALUES ('".$code."', '".$nb."', '".$aventure."', '0', '0', '3', '".$conteur."', '', '', '', '', '', '', '')";
        $res1 = mysqli_query($db, $rq1);
        if ($res1 === TRUE) {
            echo "<p>Partie créée !</p>";
        }
    } else {
        echo "<p>Erreur</p>";
    }

    $rq = "UPDATE User SET gameId='".$code."' WHERE pseudo = '".$_SESSION['pseudo']."'";
    $res = mysqli_query($db, $rq);

    $game = new Game($code, $nb, $aventure, $conteur);
    $_SESSION['game'] = serialize($game);
?>
