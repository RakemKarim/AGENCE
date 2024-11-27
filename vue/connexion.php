<?php
ob_start();
include "header.php"; 
include "../classes/Utilisateur.php"; 
include "../controller/Db.php"; 

if (isset($_POST['signup'])) {
    $prenom = htmlspecialchars($_POST['prenom'] ?? '');
    $login = htmlspecialchars($_POST['login'] ?? '');
    $mdp = $_POST['mdp'] ?? '';
    $role = htmlspecialchars($_POST['role'] ?? 'client'); 

    try {
        
        $utilisateur = new Utilisateur($prenom, $login, $mdp, $role); 
        $utilisateur->enregistrer(); 

        echo "<p class='text-center text-success'>Inscription réussie pour $prenom avec le rôle $role.</p>";
    } catch (Exception $e) {
        echo "<p class='text-center text-danger'>Erreur: " . $e->getMessage() . "</p>";
    }
}

if (isset($_POST['signin_client']) || isset($_POST['signin_gerant'])) {
    $login = htmlspecialchars($_POST['login'] ?? '');
    $mdp = $_POST['mdp'] ?? '';
 try {
        $db = new Db();
        $utilisateur = $db->getUtilisateurByLogin($login); // Méthode pour récupérer l'utilisateur par login

        if ($utilisateur) {
            // Vérification du mot d passe
            if (password_verify($mdp, $utilisateur['mot_de_passe'])) {
                session_start();
                $_SESSION['login'] = $utilisateur['login'];
                $_SESSION['role'] = $utilisateur['role'];

                if ($utilisateur['role'] == 'client') {
                    header("Location: vehicules.php");
                    exit();
                } elseif ($utilisateur['role'] == 'gerant') {
                    header("Location: gerant.php");
                    exit();
                }
            } else {
                echo "<p class='text-center text-danger'>Mot de pass incorrect.</p>";
            }
        } else {
            echo "<p class='text-center text-danger'>Utilisateur non trouve.</p>";
        }
    } catch (Exception $e) {
        echo "<p class='text-center text-danger'>Erreur: " . $e->getMessage() . "</p>";
    }
}
?>

<h2 class="text-center">Inscription / Connexion</h2>

<div class="row">
    <div class="col-md-6">
        <h3 class="text-center">Inscription</h3>
        <form action="" method="post">
            <div class="form-group">
                <label for="prenom">Prénom <span class="text-danger">*</span></label>
                <input type="text" name="prenom" class="form-control" id="prenom" required>
            </div>

            <div class="form-group">
                <label for="login">Login <span class="text-danger">*</span></label>
                <input type="text" name="login" class="form-control" id="login" required>
            </div>
            
            <div class="form-group">
                <label for="mdp">Mot de passe <span class="text-danger">*</span></label>
                <input type="password" name="mdp" class="form-control" id="mdp" required>
            </div>

        
            <div class="form-group">
                <label for="role">Rôle <span class="text-danger">*</span></label>
                <select name="role" class="form-control" id="role" required>
                    <option value="client">Client</option>
                    <option value="gerant">Gérant</option>
                </select>
            </div>

            <input type="submit" class="btn btn-success mt-2" name="signup" value="S'inscrire">
        </form>
    </div>

    <div class="col-md-6">
        <h3 class="text-center">Connexion</h3>
        <form action="" method="post">
            <div class="form-group">
                <label for="login_connexion">Login</label>
                <input type="text" name="login" class="form-control" id="login_connexion" required>
            </div>

            <div class="form-group">
                <label for="mdp_connexion">Mot de passe</label>
                <input type="password" name="mdp" class="form-control" id="mdp_connexion" required>
            </div>

           
            <div class="d-flex justify-content-between mt-3">
                <button type="submit" name="signin_client" class="btn btn-primary">Connexion Client</button>
                <button type="submit" name="signin_gerant" class="btn btn-warning">Connexion Gérant</button>
            </div>
        </form>
    </div>
</div>

<?php 
$contenu = ob_get_clean();
echo $contenu;
?>
