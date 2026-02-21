<?php include('connexion.php'); ?>
<?php include('menu.php'); ?>

<h2>Ajouter une course</h2>

<?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success">Course ajoutée!</div>
<?php elseif(isset($_GET['error'])): ?>
    <div class="alert alert-danger">Erreur lors de l'ajout</div>
<?php endif; ?>

<form action="tr_ajouter_course.php" method="POST">
    <div class="mb-3">
        <label>Départ:</label>
        <input type="text" name="depart" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Arrivée:</label>
        <input type="text" name="arrivee" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Date et heure:</label>
        <input type="datetime-local" name="date_heure" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>

<!-- Liste des courses récente -->
<h3 class="mt-5">Dernières courses</h3>
<!-- Même tableau que index.php mais limité à 5 -->