<?php
include('connexion.php');

if(isset($_POST['point_depart']) && isset($_POST['point_arrivee']) && isset($_POST['date_heure'])) {
    $point_depart = trim($_POST['point_depart']);
    $point_arrivee = trim($_POST['point_arrivee']);
    $date_heure = $_POST['date_heure'];
    $image_vehicule = '';
    
    // Traitement du fichier image
    if(isset($_FILES['image_vehicule']) && $_FILES['image_vehicule']['size'] > 0) {
        $upload_dir = 'uploads/';
        
        // Créer le dossier s'il n'existe pas
        if(!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        
        $file_name = basename($_FILES['image_vehicule']['name']);
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_ext = array('jpg', 'jpeg', 'png', 'gif', 'webp');
        
        if(in_array($file_ext, $allowed_ext)) {
            // Générer un nom unique
            $unique_name = time() . '_' . rand(1000, 9999) . '.' . $file_ext;
            $upload_path = $upload_dir . $unique_name;
            
            if(move_uploaded_file($_FILES['image_vehicule']['tmp_name'], $upload_path)) {
                $image_vehicule = $upload_path;
            }
        }
    }
    
    $stmt = $connexion->prepare("INSERT INTO courses (point_depart, point_arrivee, date_heure, image_vehicule, statut) VALUES (?, ?, ?, ?, 'en attentte')");
    $stmt->bind_param("ssss", $point_depart, $point_arrivee, $date_heure, $image_vehicule);
    
    if($stmt->execute()) {
        header('Location: ajouter_course.php?success=1');
    } else {
        header('Location: ajouter_course.php?error=1');
    }
    $stmt->close();
} else {
    header('Location: ajouter_course.php');
}
exit();
?>