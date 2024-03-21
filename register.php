<?php
session_start();
include("functions.php");
?>


<!DOCTYPE html>
<html lang="fr">


<?php
include("head.php");
?>



<body>
    <div class="container-fluid" id="wrapper">
        <?php
        include("header.php");
        ?>

        <form action="successRegister.php" method="POST" class="row g-3">
            <div class="col-md-2">
                <label for="registerFirstName" class="form-label">Prenom</label>
                <input type="text" class="form-control" name="registerFirstName" value="Prenom" required>
            </div>
            <div class="col-md-2">
                <label for="registerLastName" class="form-label">Nom</label>
                <input type="text" class="form-control" name="registerLastName" value="Nom" required>
            </div>
            <div class="col-md-3">
                <label for="registerPassword" class="form-label">Mot de Passe</label>
                <input type="password" class="form-control" name="registerPassword" value="" required>
            </div>
            <div class="col-md-5">
                <label for="registerEmail" class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text" id="inputGroupPrepend2">@</span>
                    <input type="email" class="form-control" name="registerEmail" aria-describedby="inputGroupPrepend2" required>
                </div>
            </div>
            <div class="col-md-3">
                <label for="registerTown" class="form-label">Ville</label>
                <input type="text" class="form-control" name="registerTown" value="town" required>
            </div>
            <div class="col-md-6">
                <label for="registerAddress" class="form-label">Adresse</label>
                <input type="text" class="form-control" name="registerAddress" value="address"required>
            </div>
            <div class="col-md-3">
                <label for="registerCP" class="form-label">Code Postal</label>
                <input type="text" class="form-control" id="registerCP" value="CP" required>
            </div>
            <!-- <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" name="validCGI" required>
                    <label class="form-check-label" for="validCGI">
                        Je valide les conditions de ventes generales et particulieres
                    </label>
                </div>
            </div> -->
            <div class="col-12">
                <button type="submit" class="btn btn-primary" >S'inscrire</button>
            </div>
        </form>
    </div>
</body>