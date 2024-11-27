<?php
include_once "../controller/Db.php"; 
$db = new Db();
$pdo = $db->getPdo();

if (isset($_GET['immatriculation'])) {
    $immatriculation = $_GET['immatriculation'];

    // Récupérer apres ajoute faire apres ..
    try {
        $stmt = $pdo->prepare("SELECT * FROM vehicules WHERE immatriculation = ?");
        $stmt->execute([$immatriculation]);
        $vehicule = $stmt->fetch(PDO::FETCH_ASSOC);

        
        if (!$vehicule) {
            die("Véhicule non trouvé.");
        }
    } catch (PDOException $e) {
        die("Erreur lors de la récupération du véhicule : " . $e->getMessage());
    }
} else {
    die("Aucune immatriculation fournie.");
}


$reservationMessage = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jours = $_POST['jours'];

    
    $prixTotal = $vehicule['prix_par_jour'] * $jours;

   
    if ($vehicule['disponibilite'] == 1) {
        try {
            $stmt = $pdo->prepare("INSERT INTO reservations (vehicule_id, immatriculation, jours, date_reservation, prix_total) VALUES (?, ?, ?, NOW(), ?)");
            $stmt->execute([$vehicule['id'], $immatriculation, $jours, $prixTotal]);

            // il ne mis pas ajour a verfier ??
            $stmt = $pdo->prepare("UPDATE vehicules SET disponibilite = 0 WHERE immatriculation = ?");
            $stmt->execute([$immatriculation]);

            
            header("Location: confirmation.php?message=Votre réservation du véhicule avec l'immatriculation $immatriculation pour $jours jour(s) a été confirmée. Le prix total est de $prixTotal €.");
            exit();
        } catch (PDOException $e) {
            
            $reservationMessage = "Erreur lors de la réservation : " . $e->getMessage();
        }
    } else {
        $reservationMessage = "Désolé, ce véhicule n'est plus disponible.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation du Véhicule</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Réservation du Véhicule</h2>

    <div class="row mt-4">
        <div class="col-md-6 offset-md-3">
            <h4>Véhicule sélectionné :</h4>
            <table class="table">
                <tr>
                    <th>Marque</th>
                    <td><?= htmlspecialchars($vehicule['marque']) ?></td>
                </tr>
                <tr>
                    <th>Immatriculation</th>
                    <td><?= htmlspecialchars($vehicule['immatriculation']) ?></td>
                </tr>
                <tr>
                    <th>Type</th>
                    <td><?= htmlspecialchars($vehicule['type']) ?></td>
                </tr>
                <tr>
                    <th>Prix par jour (€)</th>
                    <td><?= htmlspecialchars($vehicule['prix_par_jour']) ?> €</td>
                </tr>
            </table>

            <h4>Choisir la durée de la réservation :</h4>
            <form action="confirmation.php" method="post">
    <input type="hidden" name="immatriculation" value="<?= htmlspecialchars($vehicule['immatriculation']) ?>">
    <label for="jours">Nombre de jours :</label>
    <input type="number" id="jours" name="jours" min="1" required class="form-control mb-3">
    <button type="submit" class="btn btn-primary">Confirmer la réservation</button>
</form>
        </div>
    </div>
</div>



</body>
</html>
