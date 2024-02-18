<?php

/* REFERENCE : les 3 montres proviennent du site Amazfit (T-REX ULTRA / BALANCE / ACTIVE */
function getArticles()
{
    return [
        [
            "id" => 1,
            "name" => "Extreme",
            "title" => "La montre connectée GPS idéale pour l'extérieur.",
            "detail" => "Devenez le chef de la meute chaque fois que vous bravez l'extérieur, que vos aventures vous mènent dans des forêts denses, vers des montagnes géantes ou dans les rues animées de la ville.",
            "price" => 429.90,
            "img" => "./img/tRexUltra.webp"
        ],

        [
            "id" => 2,
            "name" => "Balance",
            "title" => "Votre chemin vers l'equilibre commence ici.",
            "detail" => "Le succès d'aujourd'hui repose sur les bases que vous avez posées hier. Pour réaliser tout ce dont vous êtes capable, vous devez trouver le bon équilibre entre l'activité et la récupération.",
            "price" => 249.90,
            "img" => "./img/balance.webp"
        ],

        [
            "id" => 3,
            "name" => "Mini",
            "title" => "Restez actif, restez en bonne santé.",
            "detail" => "Notre Watch Mini est votre guide : elle vous permets de planifier vos séances d'entrainement d'etre à l'ecoute de votre récupération, de vous connecter à votre entourage - tout en réhaussant votre style sans effort.",
            "price" => 149.90,
            "img" => "./img/active.webp"
        ]
    ];
}

function showArticles()
{
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
                    <form method="POST" action="">
                        <input type="hidden" name="id_article" value="<?= $article["id"] ?>">
                        <button type="submit">Ajouter au Panier</button>
                    </form>
                    <a href="#" class="btn btn-primary">Ajouter au panier</a>
                </div>
            </div>
        </div>
<?php
    }
}

function createCart()
{
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = [];
    }
}



function addToCart($article)
{

    for ($i = 0; $i < count($_SESSION["cart"]); $i++) {

        if ($_SESSION["cart"][$i]["id"] == $article["id"]) {

            $_SESSION["cart"][$i]["quantity"] += 1;
            echo "article dejà present ; quantité augnmentée";
            return;
        }
    }

    $article["quantity"] = 1;
    array_push($_SESSION["cart"], $article);
    
}



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