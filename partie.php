<?php
    include_once("connect.php");
    include("classes/game.php");
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
                        echo "<li style='float:right'><a href='profile.php'>Profil</a></li>";
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
                $host = $game->get_conteur();
                if ($host == $_SESSION['userId']) {
                    echo "<p>Vous êtes le conteur !</p>";
                    echo "<div class='jeu' id='objets'>
                            <img id='obj1' src='assets/objects/30.png'/>
                            <img id='obj2' src='assets/objects/77.png'/>
                            <img id='obj3' src='assets/objects/43.png'/>
                            <img id='obj4' src='assets/objects/2.png'/>
                            <img id='obj5' src='assets/objects/90.png'/>
                            <img id='obj6' src='assets/objects/7.png'/>
                            <img id='obj7' src='assets/objects/32.png'/>
                            <img id='obj8' src='assets/objects/74.png'/>
                            <img id='obj9' src='assets/objects/87.png'/>
                            <img id='obj10' src='assets/objects/3.png'/> 
                        </div>";
                } else {
                    echo "<p>Le conteur est en train de choisir ses objets...</p>";
                }
            ?>
            <button id="next">Valider</button>
        </div>
    </body>
</html>
