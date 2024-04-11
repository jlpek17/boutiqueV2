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




            <div class="card-body d-flex flex-column align-items-center">
                <div class="bs-icon-xl bs-icon-circle bs-icon-primary bs-icon my-4"><i class="fa-solid fa-map-location"></i> Mon Adresse</div>
                <form class="text-center" method="post" action="customers.php">

                    <div class="mb-3">
                        Adresse
                        <input class="form-control" type="text" name="adressModified" placeholder="<?= $_SESSION["user"]["adresse"]; ?>" />
                    </div>
                    <div class="mb-3">
                        Code Postal
                        <input class="form-control" type="text" name="cpModified" placeholder="<?= $_SESSION["user"]["cp"]; ?>" />
                    </div>
                    <div class="mb-3">
                        Ville
                        <input class="form-control" type="text" name="cityModified" placeholder="<?= $_SESSION["user"]["ville"]; ?>" />
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