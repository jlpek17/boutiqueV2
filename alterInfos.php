<?php
/* ***** make available the functions from the file ***** */
include("functions.php");

/* ***** create the session (cookie and varable) ***** */
session_start();

if (isset($_POST["emailModified"])) {
updateInfos();
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
                <div class="bs-icon-xl bs-icon-circle bs-icon-primary bs-icon my-4"><i class="fa-solid fa-user"></i>Mes Informations</div>
                <form class="text-center" method="POST" action="alterInfos.php">

                    <div class="mb-3">
                        Email
                        <input class="form-control" type="email" name="emailModified" value="<?= $_SESSION["user"]["email"]; ?>" />
                    </div>
                    <div class="mb-3">
                        Prénom
                        <input class="form-control" type="text" name="fNameModified" value="<?= $_SESSION["user"]["prenom"]; ?>" />
                    </div>
                    <div class="mb-3">
                        Nom
                        <input class="form-control" type="text" name="lNameModified" value="<?= $_SESSION["user"]["nom"]; ?>" />
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