<?php
/* ***** make available the functions from the file ***** */
include("functions.php");

/* ***** create the session (cookie and varable) ***** */
session_start();

/* *****  ***** */
connexion();

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


                    <div class="container py-4 py-xl-5">
                        <div class="row mb-5">
                            <div class="col-md-8 col-xl-6 text-center mx-auto">
                                <h2>Mon Compte</h2>
                                <p class="w-lg-50">Acceder à l'ensemble des informations liées à mon compte</p>
                            </div>
                        </div>
                        <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-4">
                            
                            <div class="col">
                                <div class="d-flex">
                                    <div class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon"><i class="fa-solid fa-user"></i></div>
                                    <div class="px-3">
                                        <h4>Mes informations</h4>
                                        <p>Nom, Prenom, eMail</p><a href="alterInfos.php">Voir/Modifier</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="d-flex">
                                    <div class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon"><i class="fa-solid fa-key"></i></div>
                                    <div class="px-3">
                                        <h4>Sécurité</h4>
                                        <p>Changer votre mot de passe</p><a href="alterPW.php">Changer</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="d-flex">
                                    <div class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon"><i class="fa-solid fa-map-location"></i></div>
                                    <div class="px-3">
                                        <h4>Mon adresse</h4>
                                        <p>Verifier l'adresse enregistrée pour l'envoi de ma commande</p><a href="alterAdress.php">Verifier/Modifier</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="d-flex">
                                    <div class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon"><i class="fa-solid fa-clipboard-list"></i></div>
                                    <div class="px-3">
                                        <h4>Mes Commandes</h4>
                                        <p>Verifier l'etat de mes commandes</p><a href="orders.php">Voir</a>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
        </main>
     </div> <!-- close the wrapper -->

     <?php
    /* ***** fetch the <header> part of the page (navbar / ...) ***** */
        include("footer.php");
    ?>
</body>
</html>
