<?php
include('connexion.php');

if(isset($_POST['depart']) && isset($_POST['arrivee']) && isset($_POST['date_heure'])) {
    $depart = mysqli_real_escape_string($connexion, trim($_POST['depart']));
    $arrivee = mysqli_real_escape_string($connexion, trim($_POST['arrivee']));
    $date_heure = mysqli_real_escape_string($connexion, $_POST['date_heure']);
    
    $sql = "INSERT INTO courses (depart, arrivee, date_heure, statut) 
            VALUES ('$depart', '$arrivee', '$date_heure', 'en_attente')";
    
    if(mysqli_query($connexion, $sql)) {
        header('Location: ajouter_course.php?success=1');
    } else {
        header('Location: ajouter_course.php?error=1');
    }
} else {
    header('Location: ajouter_course.php');
}
exit();
?>