<?php
/* ***** make available the functions from the file ***** */
include("functions.php");

/* ***** create the session (cookie and varable) ***** */
session_start();

if (isset($_POST["oldPWToReplace"])) {
    updatePW();
    }

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

            <div class="card-body d-flex flex-column align-items-center">
                <div class="bs-icon-xl bs-icon-circle bs-icon-primary bs-icon my-4"><i class="fa-solid fa-user"></i>Sécurité</div>
                <form class="text-center" method="post" action="alterPW.php">

                    <div class="mb-3">
                        Ancien mot de passe
                        <input class="form-control" type="text" name="oldPWToReplace" aria-describedby="oldPWHelp" />
                        <div id="oldPWHelp" class="form-text">celui que vous voulez changer</div>
                    </div>
                    
                    <div class="mb-3">
                        Nouveau mot de passe
                        <input class="form-control" type="text" name="newPWToAdd" aria-describedby="PWHelp"/>
                        <div id="PWHelp" class="form-text">8 caracteres minimum dont 1 caractere spécial et 1 majuscule</div>
                    </div>
                    
                    <div class="mb-3">
                        Confirmer nouveau mot de passe   
                        <input class="form-control" type="text" name="confirmNewPWToAdd" aria-describedby="confirmPWHelp"/>
                        <div id="confirmPWHelp" class="form-text">retaper le à l'identique</div>        
                    </div>

                    <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit">Modifier</button></div>
                </form>

            </div>




        </main>
    </div> <!-- close the wrapper -->

    <?php
    /* ***** fetch the <header> part of the page (navbar / ...) ***** */
    include("footer.php");
    ?>
</body>

</html>