<?php
    include_once("connect.php");
?>

<!DOCTYPE html>
<html>
    <head>
    <title>Club des Aventuriers</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" href="assets/logo.jpg" type="image/icon type" />
    <link rel="stylesheet" media="screen" type="text/css" charset="utf8" href="css/style.css" />
    </head>
    <body>
        <nav class="menu">
            <ul>
                <li><img class="banniere" src="assets/banniere.jpg" /></li>
                <li><a class="active" href="index.php">Accueil</a></li>
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
            <p>Avez-vous déjà combattu un requin, armé d'une loupe et
                d'un tube de rouge à lèvres ? Ou réparé un moteur avec un
                chewing-gum et une tapette à souris ? Non ? Alors, il est
                grand temps de vous y mettre ! <br/>
                Soyez les bienvenus au CLUB DES AVENTURIERS !
                <br/>
                Ensemble, vous vivrez des aventures extraordinaires et vous
                devrez tenter de sortir de situations pittoresques grâce à vos
                idées loufoques et perspicaces. De l'imagination, de la logique
                et un petit grain de folie seront les clefs du succès.</p>
            <h2>Objectif</h2>
            <p>Partez ensemble à l’aventure et surmontez les pièges en
            trouvant des solutions inhabituelles que les autres
            devront réussir à deviner. Bonne chance !</p>
            <h2>Jeu</h2>
            <p>Le Club des Aventuriers est un jeu Piatnik Vienna développé par Spaan & Havighorst, 2022.</p>
            <?php
                    if (!isset($_SESSION['pseudo'])) {
                        echo "<a href='inscription.php'>Inscription</a><br/>";
                        echo "<a href='connexion.php'>Connexion</a>";
                    } else {
                        echo "<button id='create'>Créer une partie</button><br/>";
                        echo "<button id='join'>Rejoindre une partie</button>";
                    }
                ?>
        </div>

        <script type="text/javascript" src="js/index.js"></script>
    </body>
</html>


