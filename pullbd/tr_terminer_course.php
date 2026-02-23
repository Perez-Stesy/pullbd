<?php
include 'connexion.php';

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['course_id'])) {
    $course_id = intval($_POST['course_id']);
    
    $stmt = $connexion->prepare("UPDATE courses SET statut='terminée' WHERE cource_id = ?");
    $stmt->bind_param("i", $course_id);
    
    if($stmt->execute()) {
        header("Location: terminer_course.php?success=1");
    } else {
        header("Location: terminer_course.php?error=1");
    }
    $stmt->close();
} else {
    header("Location: index.php");
}
exit();
?>