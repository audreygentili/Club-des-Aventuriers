<?php
    if (!session_id()) session_start();

    $servername = "localhost";
    $username = "gaudrey";
    $password = "eiyohR2y";
    $database = "gaudrey";
    
    // Connexion à la base de données
    $db = new mysqli($servername, $username, $password, $database);
    
    // Vérification de la connexion
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
?>