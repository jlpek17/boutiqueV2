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

 /* look for action for reset*/ 
 if(array_key_exists('added_article_id', $_POST)) { 
  resetCart(); 
} 


  $clicked_article_id = $_POST["id_article"];
  $article = getArticleFromId($clicked_article_id);
  ?>
  <main>

    <div class="row justify-content-center">
      <div class="col-md-6 d-flex justify-content-center">

      <div class="card text-center" style="width: 36rem;">
        <div class="card-header">
          En détail
        </div>
        <div class="card-body">
          <img src="<?=$article["img"];?>" class="card-img" alt="...">
          <h5 class="card-title"><?=$article["name"];?></h5>
          <p class="card-text"><b><?=$article["title"];?></b></p>
          <p class="card-text"><?=$article["detail"];?></p>
          <form method="POST" action="cart.php">
            <input type="hidden" name="added_article_id" value="<?=$article["id"];?>">
            <button class="btn btn-primary" type="submit">Ajouter et voir mon panier</button>
          </form>
        </div>
        <div class="card-footer text-body-secondary"></div>
      </div>
      </div>

</div>

  </main>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</div>
</body>
</html>