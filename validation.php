<?php
/* ***** make available the functions from the file ***** */
include("functions.php");

/* ***** create the session (cookie and varable) ***** */
session_start();

/* ***** LOGIC ***** */

/* ***** initialize variable of expedition choice BEFORE CHOICE***** */
if (empty($_SESSION["user"])) {
    header("Location: connexion.php");
}


/* ***** initialize variable of expedition choice BEFORE CHOICE***** */

if (isset($_POST["expedition"])) {
    $_SESSION["expedition"] = $_POST["expedition"];
} else {
    $_POST["expedition"] = '';
}

/* ***** keep the variable of the address to ship in $_SESSION ***** */
if (isset($_POST["addressToShow"])) {
    $_SESSION["AddressToShip"] = $_POST["addressToShow"];
} else {
    $_POST["AddressToShip"] = '';
}

/* check for action for INCREASE quantity */
if (array_key_exists('plusOne', $_POST)) {
    plusOneInCart($_POST["plusOne"]);
}


/* check for action for DECREASE quantity */
if (array_key_exists('minusOneId', $_POST)) {

    if ($_POST["minusOneQuantity"] >= 2) {
        minusOneInCart($_POST["minusOneId"]);
    } else {
        echo "<script>alert('quantité minimum atteinte')</script>";
    }
}

/* check for action for DELETE article from cart */
if (array_key_exists('deleteArticle', $_POST)) {
    deleteFromCart($_POST["deleteArticle"]);
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
            <div class="container">
                <div data-reflow-type="order-status">
                    <div class="reflow-order-status">

                        <!---------- CADRE COORDONNEES ---------->
                        <div class="col-md-5">
                            <div class="ref-order-customer">
                                <h2>Coordonées</h2>
                                <div class="ref-order-line ref-customer-name"><b>Nom</b><?= $_SESSION["user"]["nom"]; ?></div>
                                <div class="ref-order-line ref-customer-name"><b>Prenom</b><?= $_SESSION["user"]["prenom"]; ?></div>
                                <div class="ref-order-line ref-customer-email"><b>email</b><?= $_SESSION["user"]["email"]; ?></div>
                            </div>
                        </div>

                        <!---------- CADRE EXPEDITION ---------->
                        <div class="col-md-7">
                            <div class="ref-order-shipping">
                                <h2>Expedition</h2>
                                <div class="ref-order-line ref-shipping-method"><b>Methode</b>
                                    <span>Selectionner votre mode d'expedition :
                                        <form class="form-check" method="POST" action="validation.php">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="expedition" id="expChoice1" value="Colissimo" <?php if (isset($_SESSION["expedition"]) && $_SESSION["expedition"] == "Colissimo") {
                                                                                                                                                        echo "checked";
                                                                                                                                                    }; ?>>
                                                <label class="form-check-label" for="expChoice11">Colissimo</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="expedition" id="expChoice2" value="Point Relais" <?php if (isset($_SESSION["expedition"]) && $_SESSION["expedition"] == "Point Relais") {
                                                                                                                                                        echo "checked";
                                                                                                                                                    }; ?>>
                                                <label class="form-check-label" for="expChoice2">Point Relais</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="expedition" id="expChoice3" value="Retrait Magasin" <?php if (isset($_SESSION["expedition"]) && $_SESSION["expedition"] == "Retrait Magasin") {
                                                                                                                                                            echo "checked";
                                                                                                                                                        }; ?>>
                                                <label class="form-check-label" for="expChoice3">Retrait en magasin</label>
                                            </div>

                                            <div class="col d-flex justify-content-end">
                                                <?php
                                                selectExpeditionMethod();
                                                ?>
                                            </div>
                                        </form>
                                    </span>
                                </div>



                                <hr />
                                <div class="ref-order-line ref-shipping-address"><b>Adresse de livraison</b>

                                    <!-- Dropdown Button selector for multiple address-->

                                    <form method="POST" action="validation.php">
                                        <select id="addressToShow" name="addressToShow">

                                            <option>Choississez une adresse :</option>
                                            <?php
                                            showAddress(); // this call function which create the HTML <option> element for the address selection
                                            ?>

                                        </select>

                                        <div class="col d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Selectionner</button>
                                        </div>

                                    </form>

                                    <span><b>Adresse sellectionnée : <?php if (!isset($_SESSION["AddressToShip"])) {
                                                                        echo " Aucune selection";
                                                                    } else {
                                                                        echo $_SESSION["AddressToShip"];
                                                                    } ?></b></span>

                                </div>
                            </div>

                            <!---------- RAPPEL DE LA COMMANDE ---------->
                            <hr />
                            <div class="col">
                                <div class="ref-line-items">
                                    <h2 id="AddMinusDeleteArticle">Rappel de la commande</h2>

                                    <?php showArticleInCart(); ?>
                                    <hr />
                                    <div class="ref-order-line ref-line-item">Sous-Total:<span class="ref-price"><?= number_format(grandTotal(), 2, ",", " ") . " €</b>"; ?></span></div>
                                    <div class="ref-order-line ref-line-item">Expedition:<span class="ref-price"><?= $_SESSION["shippingCosts"] ?></span></div>
                                    <div class="ref-order-line ref-line-item">
                                        <div class="ref-name">dont TVA:</div><span class="ref-price"><?= number_format(((grandTotal() / 120) * 20), 2, ",", " ") . " €"; ?></span>
                                    </div>
                                    <hr />
                                    <div class="ref-order-line ref-line-item">
                                        Total: <b><span class="ref-price">
                                                <?php

                                                $_SESSION["totalOrder"] =  grandTotal() + $_SESSION["expeditionCost"];

                                                $totalToDisplay =  number_format($_SESSION["totalOrder"], 2, ",", " ");

                                                echo $totalToDisplay . " €";
                                                ?>
                                            </span></b>
                                    </div>
                                    <?php if (isset($_SESSION["expedition"]) && isset($_SESSION["AddressToShip"])) { ?>
                                        <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#success">Valider la commande !</button>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>

                            <!-- Modal Validation -->
                            <div class="modal fade" id="success" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Commande passé avec succes !</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Felicitation ! Nous avons bien recu votre commande d'un montant de <?= $totalToDisplay . " €" ?>.
                                            Nous vous remercion de votre confiance.
                                        </div>
                                        <div class="modal-footer">
                                            <form method="POST" action="index.php">
                                                <button type="submit" name="validationOK" value="validationOK" class="btn btn-primary">retour à l'acceuil</button>
                                            </form>
                                        </div>
                                    </div>
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