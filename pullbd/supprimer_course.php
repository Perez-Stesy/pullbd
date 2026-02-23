<?php
include 'connexion.php';

if(isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    $stmt = $connexion->prepare("DELETE FROM courses WHERE cource_id = ?");
    $stmt->bind_param("i", $id);
    
    if($stmt->execute()) {
        header("Location: index.php?success=1");
    } else {
        header("Location: index.php?error=1");
    }
    $stmt->close();
} else {
    header("Location: index.php");
}
exit();
?>