<?php
/* ***** make available the functions from the file ***** */
include("functions.php");

/* ***** create the session (cookie and varable) ***** */
session_start();

/* ***** reset the cart after payment ***** */
resetOnSuccess();

/* ***** verify connection information and fetch info from DB ***** */
connexion();

/* ***** verify if a disconnection query is entered  ***** */
disconnection();
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
            <h1 class="text-center">Catalogue</h1>
            <div><?php echo date('d-m-y h:i:s'); ?></div>
            <div><?php echo $_SESSION["user"]["id"]; ?></div>
            <div><?php var_dump($_SESSION["totalOrder"]) ?></div>
            <div><?php echo rand(1000000, 9999999) ?></div>


            <!-- create selector to filter product by gamme -->

                <form method="POST" action="index.php">
                    <select class="form-select" id="gamme" name="gamme">

                        <option>Filtrer:</option>
                        <option value="all">Tout</option>
                        <?php                        
                        showGamme(); // this call function which create the HTML <option> element from the gamme in BD
                        ?>
                    </select>
                    <input type="submit" value="appliquer">
                </form>


            <div class="row">
                <?php
                    showArticles(filterArticles());
                ?>
            </div>

        </main>

    </div> <!-- close the wrapper -->


    <?php
    /* ***** fetch the <header> part of the page (navbar / ...) ***** */
        include("footer.php");
    ?>
</body>
</html>

