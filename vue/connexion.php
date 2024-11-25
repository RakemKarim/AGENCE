<?php 
ob_start(); 
include "header.php"; 
?>

<h2 class="text-center">Inscription / Connexion</h2>

<div class="row">
    <div class="col-6">
        <h2 class="text-center">Inscription</h2>
        <form action="" method="post">
            <div class="form-group col-6">
                <label for="prenom">Prénom <span class="text-danger">*</span></label>
                <input type="text" name="prenom" class="form-control" id="prenom">
            </div>

            <div class="form-group col-6">
                <label for="login">Login</label>
                <input type="text" name="login" class="form-control" id="login">
            </div>
            
            <div class="form-group col-6">
                <label for="mdp">Mot de passe</label>
                <input type="password" name="mdp" class="form-control" id="mdp">
            </div>

            <input type="submit" class="btn btn-outline-success mt-2" name="signup" value="Sign Up">
        </form>
    </div>

    <div class="col-6">
        <h2 class="text-center">Connexion</h2>
        <form action="" method="post">
            <div class="form-group col-6">
                <label for="login_connexion">Login</label>
                <input type="text" name="login" class="form-control" id="login_connexion">
            </div>

            <div class="form-group col-6">
                <label for="mdp_connexion">Mot de passe</label>
                <input type="password" name="mdp" class="form-control" id="mdp_connexion">
            </div>

            <input type="submit" class="btn btn-outline-success mt-2" name="signin" value="Sign in">
        </form>
    </div>
</div>

<?php 
// Traitement des formulaires si les boutons sont soumis
if (isset($_POST['signup'])) {
    $prenom = $_POST['prenom'] ?? '';
    $login = $_POST['login'] ?? '';
    $mdp = $_POST['mdp'] ?? '';
    
    // Validation et traitement de l'inscription ici
    echo "Inscription: $prenom, $login, $mdp";
}

if (isset($_POST['signin'])) {
    $login = $_POST['login'] ?? '';
    $mdp = $_POST['mdp'] ?? '';
    
    // Validation et traitement de la connexion ici
    echo "Connexion: $login, $mdp";
}

$contenu = ob_get_clean();
echo $contenu;
?>
