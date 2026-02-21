<?php include('connexion.php'); ?>
<?php include('menu.php'); ?>

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
                <th>Chauffeur</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT c.*, ch.nom, ch.prenom 
                    FROM courses c 
                    LEFT JOIN chauffeurs ch ON c.chauffeur_id = ch.id 
                    ORDER BY c.date_heure DESC";
            $resultat = mysqli_query($connexion, $sql);

            while($course = mysqli_fetch_assoc($resultat)):
                // Déterminer la classe badge selon le statut
                if($course['statut'] == 'en_attente') {
                    $badge = 'warning';
                } elseif($course['statut'] == 'en_cours') {
                    $badge = 'success';
                } else {
                    $badge = 'secondary';
                }
            ?>
            <tr>
                <td><?= $course['id'] ?></td>
                <td><?= htmlspecialchars($course['depart']) ?></td>
                <td><?= htmlspecialchars($course['arrivee']) ?></td>
                <td><?= $course['date_heure'] ?></td>
                <td>
                    <?= $course['nom'] 
                        ? $course['prenom'].' '.$course['nom'] 
                        : 'Non assigné' ?>
                </td>
                <td>
                    <span class="badge bg-<?= $badge ?>">
                        <?= $course['statut'] ?>
                    </span>
                </td>
                <td>
                    <a href="supprimer_course.php?id=<?= $course['id'] ?>" 
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
</body>
</html>