<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une course</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('connexion.php'); ?>
    <?php include('menu.php'); ?>
    
    <div class="container mt-5">
        <h2>Ajouter une course</h2>

<?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success">Course ajoutée!</div>
<?php elseif(isset($_GET['error'])): ?>
    <div class="alert alert-danger">Erreur lors de l'ajout</div>
<?php endif; ?>

        <form action="tr_ajouter_course.php" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label>Départ:</label>
        <input type="text" name="point_depart" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Arrivée:</label>
        <input type="text" name="point_arrivee" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Date et heure:</label>
        <input type="datetime-local" name="date_heure" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Image du véhicule:</label>
        <input type="file" name="image_vehicule" class="form-control" accept="image/*">
    </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>