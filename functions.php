<?php
/* This function create an array with all the reference articles (watch) */
function getArticles() {
    return [
        [
            "id" => 1,
            "name" => "Extreme Watch",
            "title" => "La montre connectée GPS idéale pour l'extérieur.",
            "detail" => "Devenez le chef de la meute chaque fois que vous bravez l'extérieur, que vos aventures vous mènent dans des forêts denses, vers des montagnes géantes ou dans les rues animées de la ville.",
            "price" => 429.90,
            "img" => "./img/tRexUltra.webp"
        ],

        [
            "id" => 2,
            "name" => "Balance Watch",
            "title" => "Votre chemin vers l'equilibre commence ici.",
            "detail" => "Le succès d'aujourd'hui repose sur les bases que vous avez posées hier. Pour réaliser tout ce dont vous êtes capable, vous devez trouver le bon équilibre entre l'activité et la récupération.",
            "price" => 249.90,
            "img" => "./img/balance.webp"
        ],

        [
            "id" => 3,
            "name" => "Mini Watch",
            "title" => "Restez actif, restez en bonne santé.",
            "detail" => "Notre Watch Mini est votre guide : elle vous permets de planifier vos séances d'entrainement d'etre à l'ecoute de votre récupération, de vous connecter à votre entourage - tout en réhaussant votre style sans effort.",
            "price" => 149.90,
            "img" => "./img/active.webp"
        ]
    ];
}

?>

<?php
/* This function print all the articles on index.php page */
function showArticles() {
    $articles = getArticles();

    foreach ($articles as $article) {
?>
        <div class="col-md-4 d-flex justify-content-center">
            <div class="card" style="width: 18rem;">
                <img src=<?= $article["img"]; ?> class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?= $article["name"]; ?></h5>
                    <p class="card-text"><?= $article["detail"] . "\n"; ?></p>
                    <p class="card-text"><?= $article["price"]; ?></p>
                    <form method="POST" action="product.php">
                        <input type="hidden" name="id_article" value="<?= $article["id"] ?>">
                        <button type="submit">Voir le détail</button>
                    </form>
                    <form method="POST" action="cart.php">
                        <input type="hidden" name="added_article_id" value="<?= $article["id"] ?>">
                        <button type="submit"><a class="btn btn-primary">Ajouter au panier</a></button>
                    </form>
                    
                </div>
            </div>
        </div>
<?php
    }
}
?>

<?php
/* This function create the cart if it is not create */
function createCart() {
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = [];
    }
}
?>

<?php
/* This function reset the cart after success order */
function resetOnSuccess() {
    if (isset($_POST["resetAll"])) {
        //echo isset($_POST["resetIfSuccess"]);
        $_SESSION["cart"] = [];
    }
}
?>




<?php
/*This function reset the cart */
function resetCart() {
    //unset($_SESSION["cart"]);
    $_SESSION["cart"] = [];
}
?>

<?php
/*This function reset the expedition method */
function resetExpeditionMethod() {
    $_SESSION["expedition"] = [];
}
?>




<?php
/* This function add the articles when you click on "ajouter au panier" of index.php or product.php */
function addToCart($article) {
    

    for ($i = 0; $i < count($_SESSION["cart"]); $i++) {

        if ($_SESSION["cart"][$i]["id"] == $article["id"]) {

            $_SESSION["cart"][$i]["quantity"] += 1;
            echo "article dejà present ; quantité augmentée";
            return;
        }
    }

    $article["quantity"] += 1;
    array_push($_SESSION["cart"], $article);
    
}
?>



<?php
/*this function target the element information with the transmitted id */
function getArticleFromId($articleID) {
    $articles = getArticles();
    foreach ($articles as $article) {
        if ($article["id"] == $articleID) {
            return $article;
        }
    }
}
?>


<?php
/* This function print all articles in the cart */
function showArticleInCart() {

    foreach ($_SESSION["cart"] as $cartArticle) {
  ?>
    <tr>
      <th><img id="ico" src=<?= $cartArticle["img"]; ?>></th>
      <th><?= $cartArticle["name"]; ?></th>
      <th><?= $cartArticle["price"] . " € "; ?></th>
      <th><?= " x " . $cartArticle["quantity"];?></th>
      <th>
          <form method="post" action="cart.php">
            <button type="submit" name="plusOne" value="<?= $cartArticle["id"]; ?>"><i class="bi bi-plus-circle-fill"></i></button> 
          </form>
      </th>

      <th>
        <form method="post" action="cart.php">
            <input type="hidden" name="minusOneId" value="<?= $cartArticle["id"];?>">
            <input type="hidden" name="minusOneQuantity" value="<?= $cartArticle["quantity"];?>"> 
            <button type="submit"><i class="bi bi-dash-circle"></i></button> 
        </form>
      </th>
        <th><?= $cartArticle["price"] * $cartArticle["quantity"] . " €";?></th>
        <th>
            <form method="post" action="cart.php">
            <input type="hidden" name="deleteArticle" value="<?= $cartArticle["id"]; ?>"> 
        <button type="submit" ><i class="bi bi-trash3-fill"></i></button> 
          </form>    
        </th>

        </tr>
        <?php

    }
}
?>


<?php
/* This function print all articles in the cart */
function showCartResume() {

    foreach ($_SESSION["cart"] as $cartArticle) {
  ?>
      <img id="icoResume" src=<?= $cartArticle["img"]; ?>>
      <?= $cartArticle["name"]; ?>
      <?= $cartArticle["price"] . " € "; ?>
      <?= "( x" . $cartArticle["quantity"] . ") = ";?>
      <?= $cartArticle["price"] * $cartArticle["quantity"] . " €";?>
   <?php
    }
}
?>


<?php
/* This function calculate */
function grandTotal() {

        $total = 0;
        for ($i = 0; $i < count($_SESSION["cart"]); $i++) {
        $total += $_SESSION["cart"][$i]["quantity"] * $_SESSION["cart"][$i]["price"];
        }
        return $total;                
    }

?>


<?php
/* Add one to the article in cart */
function plusOneInCart($articleToIncrease) {
    for ($i = 0; $i < count($_SESSION["cart"]); $i++) {

        if ($_SESSION["cart"][$i]["id"] == $articleToIncrease) {;
            $_SESSION["cart"][$i]["quantity"] += 1;
            //$_POST["plusOne"] = [];
            return;
        }
    }
}
?>

<?php
/* Remove one to the article in cart */
function minusOneInCart($articleToDecrease) {

    for ($i = 0; $i < count($_SESSION["cart"]); $i++) {
        if ($_SESSION["cart"][$i]["id"] == $articleToDecrease) {
            $_SESSION["cart"][$i]["quantity"] -= 1;
            //$_POST["minusOne"] = [];
            return;
        }
    }  
}
?>

<?php
/* This function delete an article from the cart whatever is quantity */
function deleteFromCart($articleToDelete) {

    for ($i = 0; $i < count($_SESSION["cart"]); $i++) {
 
            if ($_SESSION["cart"][$i]["id"] == $articleToDelete) {
                array_splice($_SESSION["cart"],$i,1);
                return;
            }
        }  

}
?>


<?php
/* This function print the button for "validation" modal only if the cart is not empty */
function confirmCartButton() {
    if(grandTotal() > 0 &&  $_POST["expedition"] != null) {
        ?>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cartValidation">Finaliser ma Commande</button>
        <?php
    }
}
?>


<?php
/* This function print the button for "reset Cart" modal only if the cart is not empty */
function confirmResetButton() {
    if(grandTotal() > 0) {
        ?>
           <form method="post">
                <input type="submit" name="resetCart" class="btn btn-danger" value="Vider mon Panier">
            </form>
        <?php
    }
}
?>




<?php
/* This function calculate the total quantity of article in cart */
function quantityArticle() {

        $quantityTotal = 0;
        for ($i = 0; $i < count($_SESSION["cart"]); $i++) {
        $quantityTotal += $_SESSION["cart"][$i]["quantity"];
        }
        return $quantityTotal;                
    }

?>

<?php
/* This function calculate the amount of shipping costs */
function confirmExpeditionMethod() {
    if ($_POST["expedition"] == null) {
        ?>
        <form method="post">
        <button type="submit" class="btn btn-primary">Selectionner</button>
         </form>
     <?php
     } payExpedition();
     if ($_POST["expedition"] != null) {
     ?>
    <form method="post">
    <input type="submit" name="resetExpeditionMetod" class="btn btn-danger" value="changer methode d'expedition">
     </form>
     <?php
     }
}
?>







<?php
/* This function calculate the amount of shipping costs */
function payExpedition() {
    if($_POST["expedition"] == "Colissimo") {
        $expeditionCost = quantityArticle() * 7;
        $shippingCosts = "Frais d'expedition (7€ par montre) : " . $expeditionCost . "€";
    } if($_POST["expedition"] == "Point Relais") {
        $expeditionCost = quantityArticle() * 3;
        $shippingCosts = "Frais d'expedition (3€ par montre) : " . $expeditionCost . "€";
    } if($_POST["expedition"] == "Retrait Magasin") {
        $expeditionCost = 0;
        $shippingCosts = "Frais d'expedition Offert !";   
    }
    echo $shippingCosts;
    $_SESSION["expeditionCost"] =  $expeditionCost;
}
?>