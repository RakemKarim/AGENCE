<?php
session_start();
include "header.php"; 
include "../classes/GestionVehicules.php"; // Classe pour gérer les véhicules

// Vérifier si l'utilisateur est un gérant
if ($_SESSION['role'] != 'gerant') {
    header("Location: login.php");
    exit();
}

$gestionVehicules = new GestionVehicules();

// Ajouter un véhicule
if (isset($_POST['add_vehicule'])) {
    $marque = htmlspecialchars($_POST['marque']);
    $immatriculation = htmlspecialchars($_POST['immatriculation']);
    $type = htmlspecialchars($_POST['type']);
    $prix_par_jour = $_POST['prix_par_jour'];
    
    $gestionVehicules->ajouterVehicule($marque, $immatriculation, $type, $prix_par_jour);
    echo "<p class='text-success'>Véhicule ajouté avec succès!</p>";
}

// Afficher les véhicules réservés
$vehiculesReserves = $gestionVehicules->getVehiculesReserves();
?>

<h2 class="text-center">Page du Gérant</h2>

<!-- Formulaire pour ajouter un véhicule -->
<div class="col-md-6">
    <h3 class="text-center">Ajouter un véhicule</h3>
    <form action="" method="post">
        <div class="form-group">
            <label for="marque">Marque</label>
            <input type="text" name="marque" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="immatriculation">Immatriculation</label>
            <input type="text" name="immatriculation" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="type">Type de véhicule</label>
            <input type="text" name="type" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="prix_par_jour">Prix par jour</label>
            <input type="number" name="prix_par_jour" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success mt-2" name="add_vehicule">Ajouter</button>
    </form>
</div>

<!-- Affichage des véhicules réservés -->
<h3>Véhicules réservés</h3>
<?php
if ($vehiculesReserves) {
    echo "<table class='table'>
            <thead>
                <tr>
                    <th>Marque</th>
                    <th>Immatriculation</th>
                    <th>Type</th>
                    <th>Prix par jour</th>
                    <th>Réservé par</th>
                    <th>Dates de réservation</th>
                </tr>
            </thead>
            <tbody>";
    
    foreach ($vehiculesReserves as $vehicule) {
        echo "<tr>
                <td>{$vehicule['marque']}</td>
                <td>{$vehicule['immatriculation']}</td>
                <td>{$vehicule['type']}</td>
                <td>{$vehicule['prix_par_jour']} €</td>
                <td>{$vehicule['prenom']} {$vehicule['nom']}</td>
                <td>Du {$vehicule['date_debut']} au {$vehicule['date_fin']}</td>
              </tr>";
    }
    
    echo "</tbody>
        </table>";
} else {
    echo "<p>Aucune réservation trouvée.</p>";
}
?>

<?php 
include "footer.php";
?>
