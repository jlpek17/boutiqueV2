<?php

/* ***** GENERAL LOGIC ***** */

/* ***** Connexion a la BDD ***** */

function getConnection()
{
    // try : je tente une connexion
    try {
        $db = new PDO(
            'mysql:host=localhost;dbname=boutique_en_ligne;charset=utf8', // infos : sgbd, nom base, adresse (host) + encodage
            'phpmyadmin', // pseudo utilisateur (root en local)
            'jlpek17', // mot de passe (aucun en local)
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC)
        ); // options PDO : 1) affichage des erreurs / 2) récupération des données simplifiée

        // si ça ne marche pas : je mets fin au code php en affichant l'erreur
    } catch (Exception $erreur) { // je récupère l'erreur en paramètre
        die('Erreur : ' . $erreur->getMessage());  // je l'affiche et je mets fin au script
    }

    // je retourne la connexion stockée dans une variable
    return $db;
}


/* ***** récupérer la liste des articles  dans la base de donnée ***** */

function getArticles()
{
    // je me connecte à la base de données
    $db = getConnection();

    // j'exécute une requête qui va récupérer tous les articles
    $results = $db->query('SELECT * FROM articles');

    // je récupère les résultats et je les renvoie grâce à return
    return $results->fetchAll();
}


function getGammes()
{
    // je me connecte à la base de données
    $db = getConnection();

    // j'exécute une requête qui va récupérer tous les articles
    $results = $db->query('SELECT * FROM id_gamme');

    // je récupère les résultats et je les renvoie grâce à return
    return $results->fetchAll();
}


function getArticlesbyGammes()
{
    // je me connecte à la base de données
    $db = getConnection();

    // j'exécute une requête qui va récupérer tous les articles
    $results = $db->query('SELECT * FROM articles WHERE id_gamme="1"');

    // je récupère les résultats et je les renvoie grâce à return
    return $results->fetchAll();
}


/* **************** filtrer les articles à afficher *************/

function filterArticles(){

    // je récupère tous les articles
    $allArticles = getArticles();

    // je stocke dans le session le choix de gamme si effectué précédemment
    if (isset($_POST["gamme"])){
        $_SESSION["gamme"] = $_POST["gamme"];
    }

    // si pas de choix ou toutes les gammes => on renvoie tous les articles
    if($_SESSION["gamme"] == "all" || !isset($_SESSION["gamme"])){
        return $allArticles;

    // si choix de gamme effectué : on renvoie uniquement les articles correspondants
    } else {
        $gammeId = $_SESSION["gamme"];

        $articlesToDisplay = [];

        // on ne garde que ceux rattachés à la gamme
        foreach ($allArticles as $article) {

            if($article['id_gamme'] == $gammeId){
                array_push($articlesToDisplay, $article);
            }
        }

        return $articlesToDisplay;
    }

}



/* ***** This function print ALL the get articles on index.php page ***** */
function showArticles($articles)
{

    foreach ($articles as $result) {
?>
        <div class="col-md-4 d-flex justify-content-center">
            <div class="card" style="width: 20rem; height: 42rem;">
                <img src=<?= $result["image"]; ?> class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?= $result["nom"]; ?></h5>
                    <p class="card-text"><b><?= $result["description"] . "\n"; ?></b></p>
                    <p class="card-text"><?= $result["description_detaillee"] . "\n"; ?></p>
                    <p class="card-text"><b><?= $result["prix"] . " €"; ?></b></p>
                    <div class="d-flex flex-row justify-content-around">
                        <form method="POST" action="product.php">
                            <input type="hidden" name="id_article" value="<?= $result["id"] ?>">
                            <button type="submit" class="btn btn-light"><i id="glassIco" class="fa-solid fa-magnifying-glass-plus"></i></button>
                        </form>
                        <form method="POST" action="cart.php">
                            <input type="hidden" name="added_article_id" value="<?= $result["id"] ?>">
                            <button type="submit" class="btn btn-primary"><a class="btn btn-primary">Ajouter au panier</a></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php
} 
}

/* This function create the cart if it is not create */
function createCart()
{
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = [];
    }
}
?>

<?php
/* This function reset the cart after success order */
function resetOnSuccess()
{
    if (isset($_POST["resetAll"])) {
        //echo isset($_POST["resetIfSuccess"]);
        $_SESSION["cart"] = [];
    }
}
?>




<?php
/*This function reset the cart */
function resetCart()
{
    //unset($_SESSION["cart"]);
    $_SESSION["cart"] = [];
}
?>

<?php
/*This function reset the expedition method */
function resetExpeditionMethod()
{
    $_SESSION["expedition"] = [];
}
?>




<?php
/* This function add the articles when you click on "ajouter au panier" of index.php or product.php */
function addToCart($article)
{


    for ($i = 0; $i < count($_SESSION["cart"]); $i++) {

        if ($_SESSION["cart"][$i]["id"] == $article["id"]) {

            $_SESSION["cart"][$i]["quantity"] += 1;
            return;
        }
    }
    $article["quantity"] = 0;
    $article["quantity"] += 1;
    array_push($_SESSION["cart"], $article);
}
?>



<?php
/*this function target the element information with the transmitted id */
function getArticleFromId($articleID)
{
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
function showArticleInCart()
{

    foreach ($_SESSION["cart"] as $cartArticle) {
?>

        <div class="row d-flex align-items-center">
            <div class="col-md-3">
                <img id="ico" src=<?= $cartArticle["img"]; ?>>
            </div>
            <div class="col-md-2 text-end">
                <?= $cartArticle["name"]; ?>
            </div>
            <div class="col-md-2">
                <?= $cartArticle["price"] . " € "; ?>
            </div>
            
            <div class="col-md-1">
                <?= " x " . $cartArticle["quantity"]; ?>
            </div>
            <div class="col-md-1">
                <form method="post" action="cart.php">
                    <button type="submit" name="plusOne" value="<?= $cartArticle["id"]; ?>"><i class="bi bi-plus-circle-fill"></i></button>
                </form>
                <form method="post" action="cart.php">
                    <input type="hidden" name="minusOneId" value="<?= $cartArticle["id"]; ?>">
                    <input type="hidden" name="minusOneQuantity" value="<?= $cartArticle["quantity"]; ?>">
                    <button type="submit"><i class="bi bi-dash-circle"></i></button>
                </form>
            </div>
            <div class="col-md-2">
                <?= $cartArticle["price"] * $cartArticle["quantity"] . " €"; ?>
            </div>
            <div class="col-md-1">
                <form method="post" action="cart.php">
                    <input type="hidden" name="deleteArticle" value="<?= $cartArticle["id"]; ?>">
                    <button type="submit"><i class="bi bi-trash3-fill"></i></button>
                </form>
            </div>
        </div>

<?php

    }
}
?>


<?php
/* This function print all articles in the cart */
function showCartResume()
{

    foreach ($_SESSION["cart"] as $cartArticle) {
?>
        <img id="icoResume" src=<?= $cartArticle["img"]; ?>>
        <?= $cartArticle["name"]; ?>
        <?= $cartArticle["price"] . " € "; ?>
        <?= "( x" . $cartArticle["quantity"] . ") = "; ?>
        <?= $cartArticle["price"] * $cartArticle["quantity"] . " €"; ?>
<?php
    }
}
?>


<?php
/* This function calculate */
function grandTotal()
{

    $total = 0;
    for ($i = 0; $i < count($_SESSION["cart"]); $i++) {
        $total += $_SESSION["cart"][$i]["quantity"] * $_SESSION["cart"][$i]["price"];
    }
    return $total;
}

?>


<?php
/* Add one to the article in cart */
function plusOneInCart($articleToIncrease)
{
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
function minusOneInCart($articleToDecrease)
{

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
function deleteFromCart($articleToDelete)
{

    for ($i = 0; $i < count($_SESSION["cart"]); $i++) {

        if ($_SESSION["cart"][$i]["id"] == $articleToDelete) {
            array_splice($_SESSION["cart"], $i, 1);
            return;
        }
    }
}
?>


<?php
/* This function print the button for "validation" modal only if the cart is not empty */
function finalizeButton()
{
    if (grandTotal() > 0 && $_POST["expedition"] != null) {
?>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cartValidation">Finaliser ma Commande</button>
<?php
    }
}
?>


<?php
/* This function print the button for "reset Cart" modal only if the cart is not empty */
function ResetButton()
{
    if (grandTotal() > 0) {
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
function quantityArticle()
{

    $quantityTotal = 0;
    for ($i = 0; $i < count($_SESSION["cart"]); $i++) {
        $quantityTotal += $_SESSION["cart"][$i]["quantity"];
    }
    return $quantityTotal;
}

?>

<?php
/* This function calculate the amount of shipping costs */
function selectExpeditionMethod()
{
    //if ($_POST["expedition"] !== "Point Relais" && $_POST["expedition"] !== "Retrait Magasin" && $_POST["expedition"] !== "Colissimo") {
    if ($_POST["expedition"] == null && $_SESSION["cart"] != null) {
?>

            <form method="post">
                <button type="submit" class="btn btn-primary">Selectionner</button>
            </form>
    <?php
    } if ($_POST["expedition"] != null) {
    ?>
            <form method="post">
                <input type="submit" name="resetExpeditionMetod" class="btn btn-danger" value="Changer">
            </form>
<?php
    }
    payExpedition();

}
?>

<?php
function showExpeditionMethod() {
    if($_POST["expedition"] != null ) {
        echo "(" . $_POST["expedition"] . ")";
    }

}
?>

<?php
function emptyCartTitle() {
    if($_SESSION["cart"] == null ) {
        ?>
        <h1 class="text-center"> Votre panier est vide </h1>
        <?php 
    } else {
    ?>
    <h1 class="text-center">Le montant total de votre panier est de <?= number_format(grandTotal(), 2, ",", " ") . " €"; ?></h1>
    <?php
    }
}
?>





<?php
/* This function calculate the amount of shipping costs */
function payExpedition() {

$expeditionCost = [];
$shippingCosts = [];


    switch ($_POST["expedition"]) {

        case "Colissimo": 
        $expeditionCost = quantityArticle() * 7;
        
        $shippingCosts = "Frais d'expedition (7€ par montre) : " . $expeditionCost . "€";
        break;

        case "Point Relais":
        $expeditionCost = quantityArticle() * 3;
        $shippingCosts = "Frais d'expedition (3€ par montre) : " . $expeditionCost . "€";
        break;
    
        case "Retrait Magasin":
        $expeditionCost = 0;
        $shippingCosts = "Frais d'expedition <b>offert</b> !";
        break;
    }
        $_SESSION["expeditionCost"] = $expeditionCost;
        $_SESSION["shippingCosts"] = $shippingCosts;
    
}
?>