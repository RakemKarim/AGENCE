<?php
include_once "../controller/Db.php"; 
$db = new Db();
$pdo = $db->getPdo();

// Vérifier si les données sont envoyées via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $immatriculation = $_POST['immatriculation'];
    $jours = $_POST['jours'];

    // Récupérer les informations du véhicule à partir de l'immatriculation
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

    // Calcul du prix total
    $prixTotal = $vehicule['prix_par_jour'] * $jours;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de la Réservation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Confirmation de la Réservation</h2>

    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
        <div class="alert alert-success text-center">
            <p><strong>Réservation confirmée !</strong></p>
            <p>Vous avez réservé le véhicule avec l'immatriculation <strong><?= htmlspecialchars($immatriculation) ?></strong> pour <strong><?= $jours ?> jour(s)</strong>.</p>
            <p>Le prix total de la réservation est de <strong><?= number_format($prixTotal, 2) ?> €</strong>.</p>
        </div>
    <?php else: ?>
        <div class="alert alert-danger text-center">
            <p><strong>Erreur : </strong>Les informations de réservation sont manquantes.</p>
        </div>
    <?php endif; ?>

    <div class="text-center mt-4">
        <a href="vehicules.php" class="btn btn-primary">Retour à la page des voitures disponibles</a>
    </div>
</div>

</body>
</html>
