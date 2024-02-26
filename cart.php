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
  addToCart($article);

  /*check cart Array*/
  var_dump($_SESSION["cart"][0]["img"]);
  echo "\n";

  /* look for action for reset*/ 
  if(array_key_exists('resetCart', $_POST)) { 
    resetCart(); 
  } 


  ?>

  <main>


    <H1> Mon Panier

    <table>
      <thead>
        <tr>
          <th>image</th>
          <th>nom</th>
          <th>prix</th>
          <th>quantite</th>
          <th>modifier quantité</th>
          <th>supprimer article</th>
        </tr>
      </thead>
      <tbody>
        <tr>
        <?php
        /* This function - showCartArticle()- print all articles in the cart */
          $cartArticles = $_SESSION["cart"];
          foreach ($cartArticles as $cartArticle) {
        ?>
          <td><img id="ico" src=<?=$cartArticle["img"];?>></td>
          <td><?=$cartArticle["name"];?></td>
          <td><?=$cartArticle["price"];?></td>
          <td><?=$cartArticle["quantity"];?></td>
          <td>TODO</td>
          <td>TODO</td>
        <?php
        }
        ?>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <th scope="row" colspan="3">Total des achats</th>
          <td></td>
        </tr>
      </tfoot>
</table>





<form method="post"> 
        <input type="submit" name="resetCart"
                class="button" value="resetCart" /> 




  </main>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</div>
</body>
</html>
