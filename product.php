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

      <?php
      $clicked_article_id = $_POST["id_article"];
      $article = getArticleFromId($clicked_article_id);
      ?>

      <div class="row justify-content-center">
        <div class="col-md-6 d-flex justify-content-center">

          <div class="card text-center" style="width: 36rem;">
            <div class="card-header">
              En détail
            </div>
            <div class="card-body"> <!-- Display "Zoom" on a selected article -->

              <img src="<?= $article["image"]; ?>" class="card-img" alt="...">
              <h5 class="card-title"><?= $article["nom"]; ?></h5>
              <p class="card-text"><b><?= $article["description"]; ?></b></p>
              <p class="card-text"><?= $article["description_detaillee"]; ?></p>

              <!-- "BUTTON": Quantity (3 colors)-->
              <?php
                echo displayQuantity($article["id"]);
              ?>

              <!-- BUTTON: ADD -->
              <?php
              showAddButton($article["id"])
              ?>

            </div>
            <div class="card-footer text-body-secondary"></div>
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