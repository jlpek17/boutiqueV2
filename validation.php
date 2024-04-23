<?php
/* ***** make available the functions from the file ***** */
include("functions.php");

/* ***** create the session (cookie and varable) ***** */
session_start();

/* ***** LOGIC ***** */

/* ***** initialize variable of expedition choice BEFORE CHOICE***** */
if (!isset($_POST["expedition"])) {
    $_POST["expedition"] = [];
}

/* ***** keep the variable of the address to ship in $_SESSION ***** */
if(isset($_POST["addressToShow"])) {
    $_SESSION["AddressToShip"] = $_POST["addressToShow"];
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

                        <!---------- CADRE COMMANDES TO MOVE 
                        <div class="col">
                            <div class="ref-order-info">
                                <h2>Order #2050714543</h2>
                                <div class="ref-order-line ref-status"><b>Status</b>returned</div>
                                <div class="ref-order-line ref-created"><b>Created</b>10/31/2023, 2:34:02 PM</div>
                            </div>
                        </div>---------->

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
                                                <input class="form-check-input" type="radio" name="expedition" id="expChoice1" value="Colissimo" <?php if ($_POST["expedition"] == "Colissimo") {
                                                                                                                                                        echo "checked";
                                                                                                                                                    }; ?>>
                                                <label class="form-check-label" for="inlineRadio1">Colissimo</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="expedition" id="expChoice2" value="Point Relais" <?php if ($_POST["expedition"] == "Point Relais") {
                                                                                                                                                        echo "checked";
                                                                                                                                                    }; ?>>
                                                <label class="form-check-label" for="inlineRadio2">Point Relais</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="expedition" id="expChoice3" value="Retrait Magasin" <?php if ($_POST["expedition"] == "Retrait Magasin") {
                                                                                                                                                            echo "checked";
                                                                                                                                                        }; ?>>
                                                <label class="form-check-label" for="inlineRadio3">Retrait en magasin</label>
                                            </div>

                                            <div class="col d-flex justify-content-center">
                                                <?= selectExpeditionMethod(); ?>
                                            </div>
                                        </form>
                                    </span>
                                </div>




                                <div class="ref-order-line ref-shipping-address"><b>Adresse de livraison</b>

                                <!-- button selection for multiple address-->
                                <form method="POST" action="validation.php">
                                    <select class="form-select" id="addressToShow" name="addressToShow">
                                        <option>Choississez une adresse :</option>

                                        <?php                        
                                            showAddress(); // this call function which create the HTML <option> element for the address selection
                                        ?>
                                    </select>
                                    <input type="submit" value="appliquer">
                                </form>
                                <span>Adresse: <?= $_SESSION["AddressToShip"]; ?></span>
                            
                            </div>
                        </div>

                        <!---------- RAPPEL DE LA COMMANDE ---------->
                        <div class="col">
                            <div class="ref-line-items">
                                <h2>Rappel de la commande</h2>
                                <?php showArticleInCart(); ?>
                                <hr />
                                <div class="ref-order-line ref-line-item">Sous-Total:<span class="ref-price"><?= number_format(grandTotal(), 2, ",", " ") . " €</b>"; ?></span></div>
                                <div class="ref-order-line ref-line-item">Expedition:<span class="ref-price"><?= $_SESSION["shippingCosts"]; ?></span></div>
                                <div class="ref-order-line ref-line-item">
                                    <div class="ref-name">TVA</div><span class="ref-price"><?= number_format(((grandTotal() / 120) * 20), 2, ",", " ") . " €)"; ?></span>
                                </div>
                                <hr />
                                <div class="ref-order-line ref-line-item">Total <b><span class="ref-price">$979.34</span></b></div>
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