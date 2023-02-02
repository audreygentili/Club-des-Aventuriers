<?php
    include_once("connect.php");
    include("classes/user.php");
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
                <li><a href="rules.php">Règles</a></li>
                <li style="float:right"><a href="profile.php">Profil</a></li>
                <li style="float:right"><a href="inscription.php">Inscription</a></li>
                <li style="float:right"><a class="active" href="connexion.php">Connexion</a></li>
            </ul>
        </nav>
        <div class="content">
        <form id="inscription" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                <legend>Inscription</legend>
                <label for="pseudo" >Pseudo</label>
                <input type="text" name="pseudo" id="pseudo" maxlength="50" />
                <label for="mdp" >Mot de passe</label>
                <input type="password" name="mdp" id="mdp" maxlength="50" />
                <input type="submit" name="submit" id="submit" value="Se connecter" />
            </form>
        </div>

        <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $rq = "SELECT * from User WHERE pseudo = '".$_POST['pseudo']."' AND mdp = '".$_POST['mdp']."'";
                $res = mysqli_query($db, $rq);
                mysqli_error($db);
                if (mysqli_num_rows($res) == 1) {
	                $_SESSION["pseudo"]= $_POST['pseudo'];
                    $_SESSION["mdp"]= $_POST['mdp'];
                    echo "<p>Bienvenue ".$_SESSION["pseudo"]."</p>";
                } else {
                    echo "<p>Identifiants incorrects</p>";
                }
            }
        ?>
    </body>
    <script type="text/javascript" src="js/connexion.js"></script>
</html>
