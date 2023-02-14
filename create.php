<?php
    include_once("connect.php");

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
    <script type="text/javascript" src="js/create.js"></script>
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
            <h2>Créer une partie</h2>

            <p>Paramètres de la partie</p>
            <p>Nombre de joueurs : </p><input type="number" name="nb" id="nb" min="2" max="2" value="2"/>
            <p>Aventure : </p>
            <select name="aventure" id="aventure">
                <option value="1" selected="selected">Aventure 1</option>
                <option value="8">Aventure 8</option>
            </select>
            <br/>
            <br/>
            <button id="lobby">Créer</button>
        </div>
    </body>
</html>
