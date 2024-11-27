<?php include "header.php"; ?>
<?php

include_once "../controller/Db.php"; 
$db = new Db();
$pdo = $db->getPdo();

try {
    $stmt = $pdo->query("SELECT * FROM vehicules");
    $listeVehicules = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de la récupération des véhicules : " . $e->getMessage());
}
?>
<div class="container mt-5">
    <h2 class="text-center">Liste des Véhicules</h2>
    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>Marque</th>
                <th>Immatriculation</th>
                <th>Type</th>
                <th>Prix par jour (€)</th>
                <th>Statut</th>
                <th>Réserver</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listeVehicules as $vehicule): ?>
                <tr>
                    <td><?= htmlspecialchars($vehicule['marque']) ?></td>
                    <td><?= htmlspecialchars($vehicule['immatriculation']) ?></td>
                    <td><?= htmlspecialchars($vehicule['type']) ?></td>
                    <td><?= htmlspecialchars($vehicule['prix_par_jour']) ?> €</td>
                    <td class="<?= $vehicule['disponibilite'] ? 'text-success' : 'text-danger' ?>">
                        <?= $vehicule['disponibilite'] ? 'Disponible' : 'Indisponible' ?>
                    </td>
                    <td>
                        <?php if ($vehicule['disponibilite']): ?>
                            <form action="reservation.php" method="get">
                                <input type="hidden" name="immatriculation" value="<?= htmlspecialchars($vehicule['immatriculation']) ?>">
                                <button type="submit" class="btn btn-primary">Réserver</button>
                            </form>
                        <?php else: ?>
                            <button class="btn btn-secondary" disabled>Indisponible</button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include "footer.php"; ?>
