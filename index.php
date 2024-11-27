<?php
session_start();  

include "classes/Utilisateur.php";
include "classes/GestionVehicules.php";
include "classes/Vehicules.php";
include "vue/header.php";
?>

<div class="container my-5">
    <h2>Bienvenue sur notre site de Location de Véhicules</h2>
    <p>
        Nous sommes une agence spécialisée dans la location de véhicules pour tous vos besoins de transport, que ce soit pour un voyage d'affaires ou des vacances en famille. 
        Découvrez notre large gamme de voitures disponibles, allant des petites citadines économiques aux SUV spacieux.
    </p>

    <?php if (isset($_SESSION['user_id'])): ?>
        <div class="alert alert-success" role="alert">
            Bienvenue, <strong><?php echo $_SESSION['username']; ?></strong> ! Vous pouvez maintenant consulter nos véhicules disponibles.
        </div>
        <h3>Nos véhicules disponibles à la location</h3>
        <p>Voici les véhicules que vous pouvez réserver.</p>
    <?php else: ?>
        <div class="alert alert-warning" role="alert">
            Vous devez être connecté pour voir les véhicules disponibles à la location.
        </div>
        <a href="./vue/connexion.php" class="btn btn-primary">Se connecter</a>
        <p>Pas encore membre ? <a href="vue/register.php">Inscrivez-vous ici</a>.</p>
    <?php endif; ?>
</div>

<?php

include "vue/footer.php";
?>
