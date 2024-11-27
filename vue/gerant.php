<?php
session_start();
include "header.php"; 
include "../classes/GestionVehicules.php"; 
include "../classes/Vehicules.php"; 
include "../classes/Reservation.php"; 
include "../controller/Db.php"; 
if ($_SESSION['role'] != 'gerant') {
    header("Location: login.php");
    exit();
}

$db = new Db();  

$gestionVehicules = new GestionVehicules($db); 

if (isset($_POST['add_vehicule'])) {
    $marque = htmlspecialchars($_POST['marque']);
    $immatriculation = htmlspecialchars($_POST['immatriculation']);
    $type = htmlspecialchars($_POST['type']);
    $prix_par_jour = (float) $_POST['prix_par_jour'];
    
    $vehicule = new Vehicules($marque, $immatriculation, $type, $prix_par_jour);
    
    $gestionVehicules->ajouterVehicule($vehicule);
    echo "<p class='text-success'>Véhicule ajouté avec succès!</p>";
}

$vehiculesReserves = $gestionVehicules->getVehiculesReserves();

?>

<h2 class="text-center">Page du Gérant</h2>


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
            <input type="number" step="0.01" name="prix_par_jour" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success mt-2" name="add_vehicule">Ajouter</button>
    </form>
</div>

<h3>Véhicules reservés</h3>
<?php
if (!empty($vehiculesReserves)) {
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
    
    foreach ($vehiculesReserves as $reservation) {
        $vehicule = $reservation['vehicule'];
        $utilisateur = $reservation['utilisateur'];
        
        echo "<tr>
                <td>{$vehicule->getMarque()}</td>
                <td>{$vehicule->getImmatriculation()}</td>
                <td>{$vehicule->getType()}</td>
                <td>{$vehicule->getPrixParJour()} €</td>
                <td>{$utilisateur['prenom']} {$utilisateur['nom']}</td>
                <td>Du {$reservation['dateDebut']} au {$reservation['dateFin']}</td>
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
