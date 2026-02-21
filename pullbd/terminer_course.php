<?php include('connexion.php'); ?>
<?php include('menu.php'); ?>

<h2>Terminer une course</h2>

<?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show">
        Course terminée avec succès!
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php elseif(isset($_GET['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show">
        Erreur lors de la mise à jour
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<form method="POST" action="tr_terminer_course.php">
    <div class="mb-3">
        <label class="form-label"><strong>Sélectionner la course à terminer :</strong></label>
        <select name="course_id" class="form-control" required>
            <option value="">-- Choisir une course en cours --</option>
            
            <?php
            $sql = "SELECT c.*, ch.nom, ch.prenom 
                    FROM courses c 
                    LEFT JOIN chauffeurs ch ON c.chauffeur_id = ch.id 
                    WHERE c.statut = 'en_cours' 
                    ORDER BY c.date_heure ASC";
            $resultat = mysqli_query($connexion, $sql);
            
            if(mysqli_num_rows($resultat) > 0):
                while($course = mysqli_fetch_assoc($resultat)):
            ?>
            <option value="<?= $course['id'] ?>">
                #<?= $course['id'] ?> - <?= htmlspecialchars($course['depart']) ?> → 
                <?= htmlspecialchars($course['arrivee']) ?> 
                (Chauffeur: <?= $course['nom'] ? $course['prenom'].' '.$course['nom'] : 'Non assigné' ?>)
            </option>
            <?php 
                endwhile;
            else:
            ?>
            <option value="" disabled>Aucune course en cours</option>
            <?php endif; ?>
        </select>
        <small class="text-muted">Seules les courses en cours sont affichées</small>
    </div>
    
    <button type="submit" class="btn btn-success">Terminer la course</button>
    <a href="index.php" class="btn btn-secondary">Retour à l'accueil</a>
</form>

<!-- Tableau des courses en cours -->
<h3 class="mt-5">Courses en cours</h3>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Départ</th>
            <th>Arrivée</th>
            <th>Date/Heure</th>
            <th>Chauffeur</th>
            <th>Statut</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT c.*, ch.nom, ch.prenom 
                FROM courses c 
                LEFT JOIN chauffeurs ch ON c.chauffeur_id = ch.id 
                WHERE c.statut = 'en_cours' 
                ORDER BY c.date_heure ASC";
        $resultat = mysqli_query($connexion, $sql);
        
        if(mysqli_num_rows($resultat) > 0):
            while($course = mysqli_fetch_assoc($resultat)):
        ?>
        <tr>
            <td><?= $course['id'] ?></td>
            <td><?= htmlspecialchars($course['depart']) ?></td>
            <td><?= htmlspecialchars($course['arrivee']) ?></td>
            <td><?= date('d/m/Y H:i', strtotime($course['date_heure'])) ?></td>
            <td><?= $course['nom'] ? $course['prenom'].' '.$course['nom'] : 'Non assigné' ?></td>
            <td><span class="badge bg-success">en cours</span></td>
        </tr>
        <?php 
            endwhile;
        else:
        ?>
        <tr>
            <td colspan="6" class="text-center">Aucune course en cours</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

    </div>
</body>
</html>