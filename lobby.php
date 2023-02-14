<?php
    include_once("connect.php");
    include("./classes/game.php");

    if (!isset($_SESSION['pseudo'])) {
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
    <title>Club des Aventuriers</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" href="assets/logo.jpg" type="image/icon type" />
    <link rel="stylesheet" media="screen" type="text/css" charset="utf8" href="css/style.css" />
    <script type="text/javascript" src="js/lobby.js"></script>
    </head>
    <body>
        <nav class="menu">
            <ul>
                <li><img class="banniere" src="assets/banniere.jpg" /></li>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="rules.php">Règles</a></li>
                <?php
                    if (!isset($_SESSION['pseudo'])) {
                        echo "<li style='float:right'><a href='inscription.php'>Inscription</a></li>";
                        echo "<li style='float:right'><a href='connexion.php'>Connexion</a></li>";
                    } else {
                        echo "<li style='float:right'><a href='deconnexion.php?pseudo=".$_SESSION['pseudo']."'>Déconnexion</a></li>";
                    }
                ?>
            </ul>
        </nav>
        <div class="content">
            <h2>Préparation</h2>
            <?php
                $game = unserialize($_SESSION['game']);
            ?>
            <p>Nombre de joueurs : <?php
                    echo $game->get_nb();
            ?></p>
            <p>Aventure : <?php
                    echo $game->get_aventure();
                ?></p>
            <p>Code de la partie : </p>
            <p id="code">
                <?php
                    echo $game->get_id();
                ?>
            </p>
            <p>Joueurs :</p>
            <?php
                $joueurs = $game->get_joueurs(); 
                $nbJ = count($joueurs);
                echo "<p id='nbJ' hidden>".$nbJ."</p>";
                for ($i = 0; $i < $nbJ; $i++) {
                    echo "<p>".$joueurs[$i]."</p>";
                }
                $host = $game->get_conteur();
                $nb= $game->get_nb();
                if ($host == $_SESSION['userId'] && $nbJ == $nb) {
                    echo "<button id='game'>Commencer</button>";
                }
            ?>
        </div>
    </body>
</html>
