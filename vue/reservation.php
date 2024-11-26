<?php
// Inclure la connexion à la base de données
include_once "controller/db.php";

// Récupérer l'immatriculation depuis la requête GET
$immatriculation = isset($_GET['immatriculation']) ? $_GET['immatriculation'] : null;

if (!$immatriculation) {
    die("Immatriculation manquante.");
}

// Récupérer les informations du véhicule correspondant dans la base de données
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
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .btn-reserver {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-reserver:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Réservez votre véhicule</h2>
        <p><strong>Marque :</strong> <?= htmlspecialchars($vehicule['marque']) ?></p>
        <p><strong>Immatriculation :</strong> <?= htmlspecialchars($vehicule['immatriculation']) ?></p>
        <p><strong>Type :</strong> <?= htmlspecialchars($vehicule['type']) ?></p>
        <p><strong>Prix par jour :</strong> <?= htmlspecialchars($vehicule['prix_par_jour']) ?> €</p>

        <!-- Formulaire pour confirmer la réservation -->
        <?php if ($vehicule['disponibilite']): ?>
            <form action="confirmer_reservation.php" method="post">
                <input type="hidden" name="id" value="<?= htmlspecialchars($vehicule['id']) ?>">
                <button type="submit" class="btn-reserver">Confirmer la Réservation</button>
            </form>
        <?php else: ?>
            <p>Ce véhicule est actuellement indisponible.</p>
        <?php endif; ?>
    </div>
</body>
</html>
