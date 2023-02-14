<?php
    include_once("connect.php");
    include("classes/game.php");

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
    <script type="text/javascript" src="js/partie.js"></script>
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
            <canvas class="plateau" id='plateau'></canvas>
            <div class="aventure" id="aventure">
                <?php
                    $game = unserialize($_SESSION['game']);
                    $aventure = $game->get_aventure();
                    echo "<h2 id='aventureT'>Aventure ".$aventure."</h2>";
                ?>
                
                <audio id="audio" controls type="audio/mp3"></audio>
                <p id="p1"></p>
            </div>
            <?php
                $etape = $game->get_etape();
                $mission = $game->get_mission();
                $host = $game->get_conteur();
                echo "<p id='etape' hidden>".$etape."</p>";
                if ($mission < 6) {
                    if ($etape == 0) {
                        if ($host == $_SESSION['userId']) {
                            echo "<p id='consigne'>Vous êtes le conteur !</p>";
                            echo "<div class='objets' id='objets'></div>";
                            echo "<button id='valider'>Valider</button>";
                        } else {
                            echo "<p>Le conteur est en train de choisir ses objets...</p>";
                        }
                    } else if ($etape == 1) {
                        if ($host == $_SESSION['userId']) {
                            echo "<p>Le joueur tente de trouver les objets adaptés pour réussir la mission !</p>";
                        } else {
                            echo "<p id='consigne'>Vous devez essayer de trouver les <b>2 objets adaptés</b> à la mission, choisis par le conteur !</p>";
                            echo "<div class='objets' id='objets'></div>";
                            echo "<button id='validerChoix'>Valider</button>";
                        }
                    } else if ($etape == 2) {
                        echo "<p id='rep'></p><br/>";
                        if ($host != $_SESSION['userId']) {
                            echo "<button id='missionSuivante'>Mission suivante</button>";
                        }
                    }
                } else {
                    echo "<p>Bravo, vous avez terminé l'aventure !</p>";
                    echo"<a href='./index.php'>Retour à l'accueil</button>";
                }
            ?>
        </div>
    </body>
</html>
