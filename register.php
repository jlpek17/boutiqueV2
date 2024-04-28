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

<body>

    <!-- wrapper to limit the wide of the webpage to px (check on css)-->
    <div class="container-fluid" id="wrapper">

        <?php
        /* ***** fetch the <header> part of the page (navbar / ...) ***** */
        include("header.php");
        ?>

        <main>

            <h1>Inscrivez vous :</h1>

            <form action="connexion.php" method="POST" class="row g-3">
                <div class="col-md-2">
                    <label for="registeredFirstName" class="form-label">Prenom</label>
                    <input type="text" class="form-control" name="registeredFirstName" placeholder="Prenom" required>
                </div>
                <div class="col-md-2">
                    <label for="registeredLastName" class="form-label">Nom</label>
                    <input type="text" class="form-control" name="registeredLastName" placeholder="Nom" required>
                </div>
                <div class="col-md-4">
                    <label for="registeredPassword" class="form-label">Mot de Passe</label>
                    <input type="password" class="form-control" name="registeredPassword" required>
                    <div id="emailHelp" class="form-text">8 caract. mini, 15 caract. maxi, 1 lettre, 1 chiffre, 1 special</div>
                </div>
                <div class="col-md-4">
                    <label for="registeredEmail" class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text" id="inputGroupPrepend2">@</span>
                        <input type="email" class="form-control" name="registeredEmail" aria-describedby="inputGroupPrepend2" placeholder="x@x.com" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="registeredCity" class="form-label">Ville</label>
                    <input type="text" class="form-control" name="registeredCity" placeholder="Paris" value="" required>
                </div>
                <div class="col-md-6">
                    <label for="registeredAddress" class="form-label">Adresse</label>
                    <input type="text" class="form-control" name="registeredAddress" placeholder="rue de la ville" value="" required>
                </div>
                <div class="col-md-3">
                    <label for="registeredZipCode" class="form-label">Code Postal</label>
                    <input type="text" class="form-control" name="registeredZipCode" placeholder="exemple : 79000" required>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">S'inscrire</button>
                </div>
            </form>
        </main>

    </div> <!-- close the wrapper -->


    <?php
    /* ***** fetch the <header> part of the page (navbar / ...) ***** */
    include("footer.php");
    ?>
</body>

</html>