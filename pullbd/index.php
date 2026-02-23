<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Courses</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('connexion.php'); ?>
    <?php include('menu.php'); ?>

    <div class="container mt-5">
        <h2>Liste des courses</h2>

    <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success">Opération réussie!</div>
    <?php endif; ?>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Départ</th>
                <th>Arrivée</th>
                <th>Date/Heure</th>
                <th>Image</th>
                <th>Chauffeur</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT c.*, ch.nom, ch.prenoms 
                    FROM courses c 
                    LEFT JOIN chauffeurs ch ON c.chauffeur_id = ch.chauffeur_id
                    ORDER BY c.date_heure DESC";
            $resultat = mysqli_query($connexion, $sql);

            while($course = mysqli_fetch_assoc($resultat)):
                // Déterminer la classe badge selon le statut
                if($course['statut'] == 'en attentte') {
                    $badge = 'warning';
                } elseif($course['statut'] == 'en cours') {
                    $badge = 'success';
                } else {
                    $badge = 'secondary';
                }
            ?>
            <tr>
                <td><?= $course['cource_id'] ?></td>
                <td><?= htmlspecialchars($course['point_depart']) ?></td>
                <td><?= htmlspecialchars($course['point_arrivee']) ?></td>
                <td><?= $course['date_heure'] ?></td>
                <td>
                    <?php if(!empty($course['image_vehicule'])): ?>
                        <img src="<?= htmlspecialchars($course['image_vehicule']) ?>" class="img-thumbnail" style="max-width: 100px; max-height: 100px;" alt="Véhicule">
                    <?php else: ?>
                        <span class="text-muted">Aucune image</span>
                    <?php endif; ?>
                </td>
                <td>
                    <?php 
                    if(!empty($course['nom'])) {
                        echo htmlspecialchars($course['prenoms'].' '.$course['nom']);
                    } else {
                        echo 'Non assigné';
                    }
                    ?>
                </td>
                <td>
                    <span class="badge bg-<?= $badge ?>">
                        <?= $course['statut'] ?>
                    </span>
                </td>
                <td>
                    <a href="supprimer_course.php?id=<?= $course['cource_id'] ?>" 
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Êtes-vous sûr?')">
                       Supprimer
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>