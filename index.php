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
                        echo "<li style='float:right'><a href='deconnexion.php'>Déconnexion</a></li>";
                        echo "<li style='float:right'><a href='profile.php'>Profil</a></li>";
                    }
                ?>
            </ul>
        </nav>
        <div class="content">
            <h2>Explications</h2>
            <button id="create">Créer une partie</button>
            <button id="join">Rejoindre une partie</button>
        </div>

        <script type="text/javascript" src="js/index.js"></script>
    </body>
</html>


