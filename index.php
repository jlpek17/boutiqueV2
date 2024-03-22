<?php
/* ***** make available the functions from the file ***** */
include("functions.php");

/* ***** create the session (cookie and varable) ***** */
session_start();

/* ***** reset the cart after payment ***** */
resetOnSuccess();

checkCustomer();

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

            <!-- create selector to filter product by gamme -->
                <form method="POST" action="./index.php">
                    <label for="gamme">Filtrer:</label>
                    <select id="gamme" name="gamme" multiple>
                        <?php
                        showGamme(); // this call function which create the HTML <option> element from the gamme in BD
                        ?>
                        <option value="all">tout</option>
                    </select>
                    <input type="submit" value="appliquer">
                </form>


            <div class="row">
                <?php
                    showArticles(filterArticles());
                ?>
            </div>

        </main>

    </div>


    <?php
    /* ***** fetch the <header> part of the page (navbar / ...) ***** */
        include("footer.php");
    ?>
</body>
</html>

