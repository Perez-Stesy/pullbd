<?php include('connexion.php'); ?>
<?php include('menu.php'); ?>

<h2>Affecter un chauffeur à une course</h2>

<!-- Affichage des messages de succès/erreur -->
<?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Chauffeur affecté avec succès!
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php elseif(isset($_GET['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Erreur lors de l'affectation
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<form action="tr_affecter_chauffeur.php" method="POST">
    <div class="row">
        <!-- Sélection de la course -->
        <div class="col-md-6 mb-3">
            <label class="form-label"><strong>Course à affecter :</strong></label>
            <select name="course_id" class="form-control" required>
                <option value="">-- Choisir une course en attente --</option>
                
                <?php
                // Récupérer uniquement les courses en attente
                $sql_courses = "SELECT * FROM courses WHERE statut = 'en_attente' ORDER BY date_heure ASC";
                $resultat_courses = mysqli_query($connexion, $sql_courses);
                
                if(mysqli_num_rows($resultat_courses) > 0):
                    while($course = mysqli_fetch_assoc($resultat_courses)):
                ?>
                <option value="<?= $course['id'] ?>">
                    <?= htmlspecialchars($course['depart']) ?> → 
                    <?= htmlspecialchars($course['arrivee']) ?> 
                    (<?= date('d/m/Y H:i', strtotime($course['date_heure'])) ?>)
                </option>
                <?php 
                    endwhile;
                else:
                ?>
                <option value="" disabled>Aucune course en attente</option>
                <?php endif; ?>
            </select>
            <small class="text-muted">Seules les courses en attente sont affichées</small>
        </div>
        
        <!-- Sélection du chauffeur -->
        <div class="col-md-6 mb-3">
            <label class="form-label"><strong>Chauffeur à affecter :</strong></label>
            <select name="chauffeur_id" class="form-control" required>
                <option value="">-- Choisir un chauffeur --</option>
                
                <?php
                // Récupérer tous les chauffeurs
                $sql_chauffeurs = "SELECT * FROM chauffeurs ORDER BY nom, prenom";
                $resultat_chauffeurs = mysqli_query($connexion, $sql_chauffeurs);
                
                while($chauffeur = mysqli_fetch_assoc($resultat_chauffeurs)):
                ?>
                <option value="<?= $chauffeur['id'] ?>">
                    <?= htmlspecialchars($chauffeur['prenom'] . ' ' . $chauffeur['nom']) ?> 
                    (📞 <?= htmlspecialchars($chauffeur['telephone']) ?>)
                </option>
                <?php endwhile; ?>
            </select>
        </div>
    </div>
    
    <div class="mt-3">
        <button type="submit" class="btn btn-primary">Affecter le chauffeur</button>
        <a href="index.php" class="btn btn-secondary">Retour à l'accueil</a>
    </div>
</form>

<!-- Tableau des courses en attente pour visualisation -->
<h3 class="mt-5">Courses en attente</h3>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Départ</th>
            <th>Arrivée</th>
            <th>Date/Heure</th>
            <th>Statut</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Réafficher les courses en attente
        $sql = "SELECT * FROM courses WHERE statut = 'en_attente' ORDER BY date_heure ASC";
        $resultat = mysqli_query($connexion, $sql);
        
        if(mysqli_num_rows($resultat) > 0):
            while($course = mysqli_fetch_assoc($resultat)):
        ?>
        <tr>
            <td><?= $course['id'] ?></td>
            <td><?= htmlspecialchars($course['depart']) ?></td>
            <td><?= htmlspecialchars($course['arrivee']) ?></td>
            <td><?= date('d/m/Y H:i', strtotime($course['date_heure'])) ?></td>
            <td><span class="badge bg-warning">en attente</span></td>
        </tr>
        <?php 
            endwhile;
        else:
        ?>
        <tr>
            <td colspan="5" class="text-center">Aucune course en attente</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

    </div>
</body>
</html>