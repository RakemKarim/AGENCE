<?php ob_start(); ?>

    <h2 class="text-center">Inscription / Connexion</h2>

    <div class="row">
        <div class="col-6">
            
            <h2 class="text-center">Inscription</h2>
            <form action="" method="post">
                <div class="fotm-group col-6">
                    <label for="">Prénom <span class="text-danger">*</span></label>
                    <input type="text" name="prenom" class="form-control">
                </div>

                <div class="fotm-group col-6">
                    <label for="">Login</label>
                    <input type="text" name="login" class="form-control">
                </div>
                <div class="fotm-group col-6">
                    <label for="">Mot de pass</label>
                    <input type="password" name="mdp" class="form-control">
                </div>

                <input type="submit" class="btn btn-outline-success mt-2" name="signup" value="Sign Up">
            </form>
        </div>

        <div class="col-6">
        <h2 class="text-center">Connexion</h2>
            <form action="" method="post">

                <div class="fotm-group col-6">
                    <label for="">Login</label>
                    <input type="text" name="login" class="form-control">
                </div>
                <div class="fotm-group col-6">
                    <label for="">Mot de pass</label>
                    <input type="password" name="mdp" class="form-control">
                </div>

                <input type="submit" class="btn btn-outline-success mt-2" name="signin" value="Sign in">
            </form>
        </div>
    </div>

<?php 
$contenu = ob_get_clean();
