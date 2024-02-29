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
            <div class="card" style="width: 18rem;">
              <div class="card-body">
                <h5 class="card-title">Total Panier :</h5>
                <p class="card-text"><?= number_format(grandTotal(), 2, ",", " ") . " €" ?></p>
                <p class="card-text">dont TVA : 0 €</p>
                <a href="#" class="btn btn-primary">Payer</a>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="card" style="width: 18rem;">
              <div class="card-body">
                <form method="post"><input type="submit" name="resetCart" class="btn btn-primary" value="Vider Panier"></form>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Valider</button>
              </div>
            </div>
          </div>
        </div>
      </div>

<!-- Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>











    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </div>
</body>

</html>