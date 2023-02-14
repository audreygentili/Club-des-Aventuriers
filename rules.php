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
                <li><a href="index.php">Accueil</a></li>
                <li><a class="active" href="rules.php">Règles</a></li>
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
        <h2>Déroulement</h2>
        <p>Une partie se joue à 2 joueurs et correspond à l’aventure choisie. Elle se joue en plusieurs manches. Une manche se déroule comme
        suit :</p>
        <ol>
            <li>Ecoute du chapitre : Les joueurs écoutent le chapitre et prennent
                 connaissance de la mission correspondante.</li>
            <li>Choix des objets par le conteur : Le joueur désigné conteur pour ce chapitre
                 sélectionne exactement 2 de ses objets, qui selon lui sont les plus adaptés pour 
                 accomplir la mission. Les objets sélectionnés possèdent une couleur de fond verte. 
                 <br/>Il sélectionne ensuite 3 autres objets, qui selon lui sont les moins adaptés pour accomplir la mission. Les objets sélectionnés sont, eux, de couleur rouge.
                 Une fois cette étape effectuée, il valide ses choix à l'aide du bouton Valider.
            </li>
            <li>Accomplissement de la mission : L'autre joueur essaie maintenant de deviner
                quels sont les deux objets adaptés à la mission et choisis par le conteur.
                <br/>SI C’EST LA BONNE RÉPONSE :
                Si le joueur trouve les deux objets, la mission est accomplie et l'aventure 
                continue avec le chapitre suivant. Félicitations !
                <br/>
                SI C’EST LA MAUVAISE RÉPONSE :
                Si le joueurs n'a trouvé aucun objet, ou un seul, la mission n’est pas accomplie, 
                et le groupe perd une vie, représentée par un pion jaune sur le plateau. L'aventure continue tout de même vers la mission suivante.</li>
            <li>Fin de la manche : Le joueur suivant devient le conteur pour 
                la prochaine mission.</li>
        </ol>
        <p>Fin du jeu : Le jeu peut se terminer de deux façons différentes.</p>
        <ul>
            <li>Trois erreurs : Si vous avez mal deviné et qu’il ne reste plus de pion vie sur le
                plateau, vous avez malheureusement perdu ! Mais rassurez-vous, vous pouvez réessayer !</li>
            <li>Si le pion atteint le dernier échelon de l’échelle de corde, 
                vous avez réussi l'aventure ! Bravo ! Vous êtes une équipe de choc 
                qui mérite bien de faire partie du CLUB DES AVENTURIERS !
                Oserez-vous partir dès maintenant pour l’aventure suivante ?</li>
        </ul>
        </div>
    </body>
</html>
