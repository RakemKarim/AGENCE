<?php include "header.php"; ?>

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
                <th>Reserver</th>
                
            </tr>
        </thead>
        <tbody>
            <?php 
            // Inclure la classe Vehicules et afficher les véhicules
            include_once "../classes/Vehicules.php"; 
            $listeVehicules = [
                new Vehicules("Toyota", 123456, "SUV", 50.0),
                new Vehicules("Renault", 789101, "Citadine", 30.0),
                new Vehicules("BMW", 112131, "Berline", 70.0),
            ];
            foreach ($listeVehicules as $vehicule): ?>
                <tr>
                    <td><?= htmlspecialchars($vehicule->getMarque()) ?></td>
                    <td><?= htmlspecialchars($vehicule->getImmatriculation()) ?></td>
                    <td><?= htmlspecialchars($vehicule->getType()) ?></td>
                    <td><?= htmlspecialchars($vehicule->getPrixParJour()) ?></td>
                    <td class="<?= $vehicule->getDisponibilite() ? 'text-success' : 'text-danger' ?>">
                        <?= $vehicule->getStatut() ?>

                    </td>
                    <td>
                    <form action="reservation.php" method="get">
                     <input type="hidden" name="immatriculation" value="<?= htmlspecialchars($vehicule->getImmatriculation()) ?>">
                    <button type="submit" class="btn-reserver">Réserver</button>
                     </form>
                
                    </td>
                    
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include "footer.php"; ?>
