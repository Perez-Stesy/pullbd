<?php
include 'connexion.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sécuriser les données avec mysqli_real_escape_string
    $course_id = mysqli_real_escape_string($connexion, $_POST['course_id']);
    $chauffeur_id = mysqli_real_escape_string($connexion, $_POST['chauffeur_id']);
    
    // Mettre à jour la course avec le chauffeur ET changer le statut à "en_cours"
    $sql = "UPDATE courses 
            SET chauffeur_id = '$chauffeur_id', 
                statut = 'en_cours' 
            WHERE id = '$course_id'";
    
    if(mysqli_query($connexion, $sql)) {
        header("Location: affecter_chauffeur.php?success=1");
    } else {
        header("Location: affecter_chauffeur.php?error=1");
    }
} else {
    header("Location: index.php");
}
exit();
?>