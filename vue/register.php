<?php
// Démarrer la session si nécessaire
session_start();

// Inclure l'en-tête
include "header.php";

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");  // Si l'utilisateur est déjà connecté, le rediriger vers la page d'accueil
    exit;
}
?>

<!-- Formulaire d'inscription -->
<div class="container my-5">
    <h2>Inscription</h2>
    <p>Veuillez remplir les informations ci-dessous pour créer un compte.</p>
    
    <form action="register.php" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Nom d'utilisateur</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Adresse e-mail</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirmer le mot de passe</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form>

    <p class="mt-3">Vous avez déjà un compte ? <a href="login.php">Connectez-vous ici</a>.</p>
</div>

<?php
// Traiter les données du formulaire après soumission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Vérification des mots de passe
    if ($password != $confirm_password) {
        echo "<div class='alert alert-danger'>Les mots de passe ne correspondent pas.</div>";
    } 
}
?>

<?php
// Inclure le pied de page
include "footer.php";
?>
