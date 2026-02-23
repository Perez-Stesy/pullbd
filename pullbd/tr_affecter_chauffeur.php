<?php
include 'connexion.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_id = intval($_POST['course_id']);
    $chauffeur_id = intval($_POST['chauffeur_id']);
    
    $stmt = $connexion->prepare("UPDATE courses SET chauffeur_id = ?, statut = 'en cours' WHERE cource_id = ?");
    $stmt->bind_param("ii", $chauffeur_id, $course_id);
    
    if($stmt->execute()) {
        header("Location: affecter_chauffeur.php?success=1");
    } else {
        header("Location: affecter_chauffeur.php?error=1");
    }
    $stmt->close();
} else {
    header("Location: index.php");
}
exit();
?>