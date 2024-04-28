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

            <!-- create selector to filter product by gamme -->

                <form method="POST" action="index.php">
                  
                        <select id="gamme" name="gamme">

                            <option value="all">Tout</option>
                            <!-- // this call function which create the HTML <option> element from the gamme in BD -->
                            <?= showGamme() ?>

                        </select>
                   
                        <button class="btn btn-primary" type="submit">Filtrer</button>
                 
                </form>



            <!-- end selector ... -->

            <!-- display the selected article -->

                <div class="row">
                    <?php
                        showArticles(filterArticles());
                    ?>
                </div>
            <!-- end display ... -->


        </main>

    </div> <!-- close the wrapper -->


    <?php
    /* ***** fetch the <header> part of the page (navbar / ...) ***** */
        include("footer.php");
    ?>
</body>
</html>

