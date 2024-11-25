<?php
// Inclure la classe Vehicules et GestionVehicules
include_once "../classes/Vehicules.php";
include_once "../classes/GestionVehicules.php";

// Récupérer l'immatriculation de la requête GET
$immatriculation = isset($_GET['immatriculation']) ? $_GET['immatriculation'] : null;

// Instancier la gestion des véhicules
$gestionVehicules = new GestionVehicules();

// Récupérer le véhicule correspondant à l'immatriculation
$vehicule = $gestionVehicules->getVehicule($immatriculation);

// Vérifier si le véhicule existe avant de l'ajouter
if ($vehicule !== null) {
    $gestionVehicules->ajouterVehicule($vehicule);
} else {
    // Gérer le cas où le véhicule n'a pas été trouvé
    echo "<p>Véhicule non trouvé.</p>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation de Véhicule</title>
    <style>
        /* Style pour la page de réservation */
        .container {
            margin-top: 50px;
        }

        .btn-reserver {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-reserver:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($vehicule): ?>
            <h2>Réservez votre véhicule</h2>
            <p><strong>Marque :</strong> <?= htmlspecialchars($vehicule->getMarque()) ?></p>
            <p><strong>Immatriculation :</strong> <?= htmlspecialchars($vehicule->getImmatriculation()) ?></p>
            <p><strong>Type :</strong> <?= htmlspecialchars($vehicule->getType()) ?></p>
            <p><strong>Prix par jour :</strong> <?= htmlspecialchars($vehicule->getPrixParJour()) ?>€</p>

            <!-- Formulaire pour confirmer la réservation -->
            <form action="confirmer_reservation.php" method="post">
                <input type="hidden" name="immatriculation" value="<?= $vehicule->getImmatriculation() ?>">
                <button type="submit" class="btn-reserver">Confirmer la Réservation</button>
            </form>
        <?php else: ?>
            <p>Véhicule non trouvé. Assurez-vous que l'immatriculation soit correcte.</p>
        <?php endif; ?>
    </div>
</body>
</html>
