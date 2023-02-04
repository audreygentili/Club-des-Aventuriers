<?php
    include_once("connect.php");

    // Récupération du code de partie du joueur
    $rq = "SELECT gameId FROM User WHERE pseudo = '".$_GET['pseudo']."'";
    $res = mysqli_query($db, $rq);
    if (mysqli_num_rows($res) == 1) {
        while ($row = mysqli_fetch_assoc($res)) {
            $code = $row["gameId"];
            echo $code;
        }
    } 

    // Réinitialisation du code de partie du joueur
    $rq = "UPDATE User SET gameId='0' WHERE pseudo = '".$_SESSION['pseudo']."'";
    $res = mysqli_query($db, $rq);

    // Suppression de la partie si partie créée
    if ($code != 0) {
        $rq1 = "DELETE FROM Game WHERE gameId = '".$code."'";
        $res1 = mysqli_query($db, $rq1);
        if ($res1 === TRUE) {
            echo "Suppression réussie";
        } else {
            echo mysqli_error($db);
        }
    }

    // Destruction de la session et redirection vers la page d'accueil
    session_destroy();
    header("Location: ./index.php");
?>