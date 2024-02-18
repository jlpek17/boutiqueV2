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
  <?php
  include("header.php");

  createCart();
  $articleToAddId = $_POST["added_article_id"];

  $article = getArticleFromId($articleToAddId);
  addToCart($article);
  
  var_dump($_SESSION["cart"]);

  ?>

  <main>

    <H1> voir mon Panier
  </main>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
