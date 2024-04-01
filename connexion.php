<?php
/* ***** make available the functions from the file ***** */
include("functions.php");

/* ***** create the session (cookie and varable) ***** */
session_start();
?>

<!-- START HTML -->
<!DOCTYPE html>
<html lang="fr">


<?php
/* ***** fetch the <head> part of the page (meta / title / link / ...) ***** */
include("head.php");
?>

<?php
/* ***** check from where the user come from ***** */
if (isset($_POST["registeredLastName"])) {
    checkInfoRegistration();
}
?>
<h1>Connectez-vous avec vos identifiants :</h1>
<a href="index.php">retour à l'accueil</a>

<div class="container">
    <div class="col-md-6">
        <form action="index.php" method="POST">
            <div class="mb-3">
                <label for="connexionEmail" class="form-label">Email</label>
                <input type="email" class="form-control" name="connexionEmail" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Celle utilisée lors de votre inscription.</div>
            </div>
            <div class="mb-3">
                <label for="ConnexionPW" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" name="ConnexionPW">
            </div>
            <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>
    </div>
</div>