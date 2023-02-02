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
    <link rel="stylesheet" media="screen" type="text/css" charset="utf8" href="css/style.css" />    </head>
    <body>
        <nav class="menu">
            <ul>
                <li><img class="banniere" src="assets/banniere.jpg" /></li>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="rules.php">Règles</a></li>
                <li style="float:right"><a href="profile.php">Profil</a></li>
                <li style="float:right"><a class="active" href="inscription.php">Inscription</a></li>
                <li style="float:right"><a href="connexion.php">Connexion</a></li>
            </ul>
        </nav>
        <div class="content">

            <form id="inscription" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                <legend>Inscription</legend>
                <label for="pseudo" >Pseudo</label>
                <input type="text" name="pseudo" id="pseudo" maxlength="50" />
                <label for="mail" >E-mail</label>
                <input type="text" name="mail" id="mail" maxlength="80" />
                <label for="mdp" >Mot de passe</label>
                <input type="password" name="mdp" id="mdp" maxlength="50" />
                <label for="mdp" >Confirmation du mot de passe</label>
                <input type="password" name="mdp1" id="mdp1" maxlength="50" />
                <input type="submit" name="submit" id="submit" value="S'inscrire" />
            </form>
        </div>

        <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $rq = "SELECT * from User WHERE pseudo = '".$_POST['pseudo']."'";
                $res = mysqli_query($db, $rq);
                mysqli_error($db);
                if (mysqli_num_rows($res) == 0) {
                    $rq1 = "INSERT INTO User(pseudo, email, mdp) VALUES ('".$_POST['pseudo']."', '".$_POST['mail']."', '".$_POST['mdp']."')";
                    $res1 = mysqli_query($db, $rq1);
                    if ($res1 === TRUE) {
                        echo "<p>Inscription effectuée</p>";
                    }
                } else {
                    echo "<p>Ce pseudo existe déjà !</p>";
                }
            }
        ?>
    </body>
    <script type="text/javascript" src="js/inscription.js"></script>
</html>

