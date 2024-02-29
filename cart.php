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


    /* creation of cart if not already create */
    createCart();


    /* get article id of the article to add to cart */
    $articleToAddId = $_POST["added_article_id"];

    /* get the article info link to the article id */
    $article = getArticleFromId($articleToAddId);

    /* */
    if ($article != null) {
      addToCart($article);
    } 

    /*check data in cart Array
  var_dump($_SESSION["cart"][0]["img"]);
  echo "\n";*/

    /* look for action for reset cart */
    if (array_key_exists('resetCart', $_POST)) {
      resetCart();
    }
    


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
                <p class="card-text">0 €</p>
                <p class="card-text">dont TVA : 0 €</p>
                <a href="#" class="btn btn-primary">Payer</a>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="card" style="width: 18rem;">
              <div class="card-body">
                <form method="post"><input type="submit" name="resetCart" class="btn btn-primary" value="Vider Panier"></form>
              </div>
            </div>
          </div>
        </div>
      </div>

<div>
 
</div>










    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </div>
</body>

</html>