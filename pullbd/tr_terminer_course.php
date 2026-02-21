<?php
include 'connexion.php';

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['course_id'])) {
    $course_id = mysqli_real_escape_string($connexion, $_POST['course_id']);
    
    $sql = "UPDATE courses SET statut='terminee' WHERE id='$course_id'";
    
    if(mysqli_query($connexion, $sql)) {
        header("Location: terminer_course.php?success=1");
    } else {
        header("Location: terminer_course.php?error=1");
    }
} else {
    header("Location: index.php");
}
exit();
?>