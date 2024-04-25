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
                <div class="bs-icon-xl bs-icon-circle bs-icon-primary bs-icon my-4"><i class="fa-solid fa-clipboard-list"></i> Détail Commandes n°</div>


                <table class="table table-bordered table-striped-columns">
                    
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">Article</th>
                            <th class="text-end" scope="col">Prix</th>
                            <th class="text-end" scope="col">Quantité</th>
                            <th class="text-end" scope="col">Montant</th>
                        </tr>
                    </thead>

                    <tbody>
                        
                        
                    </tbody>
                
                </table>
            
            </div>






        </main>

    </div> <!-- close the wrapper -->

    <?php
    /* ***** fetch the <header> part of the page (navbar / ...) ***** */
    include("footer.php");
    ?>
</body>

</html>