<?php
include 'connexion.php';

if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($connexion, $_GET['id']);
    mysqli_query($connexion, "DELETE FROM courses WHERE id='$id'");
    header("Location: index.php?success=1");
} else {
    header("Location: index.php");
}
exit();
?>