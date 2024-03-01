<?php
session_start();
include("functions.php");
?>

<!DOCTYPE html>
<html lang="fr">


<?php
include("head.php");
?>

<body>
  <div class="container-fluid" id="wrapper">
    <?php
    include("header.php");

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";


    /* creation of cart if not already create */
    createCart();

    /* ----- */
    /* This part increase quantity when users click from index.php or product.php*/

    if (isset($_POST["added_article_id"])) {

      /* get article id of the article to add to cart */
      $articleToAddId = $_POST["added_article_id"];

      /* get the article info link to the article id */
      $article = getArticleFromId($articleToAddId);

      addToCart($article);
    }

    /* ----- */
    /* Action button */

    /* ckeck for action for RESET cart */
    if (array_key_exists('resetCart', $_POST)) {
      resetCart();
    }

    /* ckeck for action for RESET cart */
    if (array_key_exists('expedition', $_POST)) {
      resetExpeditionMethod();
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

    /* Calculate Grabnd Total */
    grandTotal();

    ?>

    <main>


      <h1 class="text-center">Mon Panier</h1>

      <div class="row">
        <div class="col-md-8">
          <table>
            <thead>
              <tr>
                <th></th>
                <th></th>
                <th>Prix</th>
                <th>Quantité</th>
                <th></th>
                <th></th>
                <th>Total</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php

              showArticleInCart();
              ?>
              </tr>

            </tbody>
          </table>
        </div>
        <div class="col-md-4 justify-content-center">
          <div class="row">
            <div class="card" style="width: 28rem;">


              <form method="POST" action="cart.php">
                <legend>Mode d'expedition :</legend>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="expedition" id="expChoice1" value="Colissimo" checked="checked">
                  <label class="form-check-label" for="inlineRadio1">Colissimo</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="expedition" id="expChoice2" value="Point Relais">
                  <label class="form-check-label" for="inlineRadio2">Point Relais</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="expedition" id="expChoice3" value="Retrait Magasin">
                  <label class="form-check-label" for="inlineRadio3">Retrait en magasin</label>
                </div>
                <div>
                  <?= confirmExpeditionMethod(); ?>
                </div>


                <div class="card-body">
                  <p class="card-title"><b>Total des achats : <?= number_format(grandTotal(), 2, ",", " ") . " €</b>" . "<i> (dont TVA : " . number_format(((grandTotal() / 120) * 20), 2, ",", " ") . " €)"; ?></i></p>

                  <!-- Button trigger modal Validation (appear if the cart is not empty) -->

                  <?= confirmCartButton(); ?>
                  <?= confirmResetButton(); ?>


                </div>
            </div>
            </form>
          </div>
        </div>
      </div>
  </div>
  <!-- Modal Confirmation -->

  <div class="modal fade" id="cartValidation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Validation du panier</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?= showCartResume(); ?>
          <h5 class="card-title">Total des achats : <?= number_format(grandTotal(), 2, ",", " ") . " €"; ?></h5>
          <p class="card-text"><?= confirmExpeditionMethod(); ?></p>
          <p class="card-text"><?= "Total à Regler :" . number_format(grandTotal() + $_SESSION["expeditionCost"], 2, ",", " ") . " €"; ?></p>
        </div>
        <div>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#success">
            Valider la commande !
          </button>
        </div>
      </div>
    </div>
  </div>




  <!-- Modal Success -->
  <div class="modal fade" id="success" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Commande passé avec succes !</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Felicitation ! Nous avons bien recu votre commande d'un montant de <?= number_format(grandTotal(), 2, ",", " ") . " €"; ?>.
          Nous vous remercion de votre confiance.
        </div>
        <div class="modal-footer">
          <form method="post" action="index.php">
            <button type="submit" name="resetAll" class="btn btn-primary">retour à l'acceuil</button>
          </form>
        </div>
      </div>
    </div>
  </div>










  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </div>
</body>

</html>