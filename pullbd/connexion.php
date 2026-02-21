<?php
$serveur = "localhost";
$utilisateur = "root";
$motdepasse = "";
$base = "pullbd";

$connexion = mysqli_connect($serveur, $utilisateur, $motdepasse, $base);

if (!$connexion) {
    die("Connexion échouée: " . mysqli_connect_error());
}
?>