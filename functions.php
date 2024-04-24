<?php

/* ***** Connexion to the BD ***** */

function getConnection()
{
    // try : je tente une connexion
    try {
        $db = new PDO(
            'mysql:host=localhost;dbname=boutique_en_ligne;charset=utf8', // infos : sgbd, nom base, adresse (host) + encodage
            'root', // pseudo utilisateur (root en local)
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
    $gamme = $db->query('SELECT * FROM gammes');

    // je récupère les résultats et je les renvoie grâce à return
    return $gamme->fetchAll();
}


function showGamme()
{
    //fetch all gammes
    $allGammes = getGammes();

    foreach ($allGammes as $gamme) {
?>
        <option value="<?= $gamme["id"]; ?>"><?= $gamme["nom"]; ?></option>
    <?php
    }
}

function getAddresses()
{
    // je me connecte à la base de données
    $db = getConnection();

    // j'exécute une requête qui va récupérer tous les adresses du user
//      $addressToShip = $db->query('SELECT adresse, code_postal, ville FROM adresses WHERE id_client = $_SESSION["user"]["id"]');
    $addressToShip = $db->query('SELECT adresse, code_postal, ville FROM adresses WHERE id_client = 2');
    // je récupère les résultats et je les renvoie grâce à return
    return $addressToShip->fetchAll();
}



function showAddress()
    {
        //fetch all Address from the 
        if(!isset($_POST["addressToShow"])) {
            $_POST["addressToShow"] = $_SESSION["user"]["adresse"] . " " . $_SESSION["user"]["cp"] . " " . $_SESSION["user"]["ville"];
        }
        $allAddresses = getAddresses();
        
        foreach ($allAddresses as $address) {
        ?>
            <option value="<?= $address["adresse"] . " " . $address["code_postal"] . " " . $address["ville"]; ?>"><?= $address["adresse"] . " " . $address["code_postal"] . " " . $address["ville"]; ?></option>
        <?php
        }
    }



/* **************** filtrer les articles à afficher *************/

function filterArticles()
{

    // je récupère tous les articles
    $_SESSION["gamme"] = "all";
    $allArticles = getArticles();

    // je stocke dans le session le choix de gamme si effectué précédemment
    if (isset($_POST["gamme"])) {
        $_SESSION["gamme"] = $_POST["gamme"];
    }

    // si pas de choix ou toutes les gammes => on renvoie tous les articles
    if ($_SESSION["gamme"] == "all" || !isset($_SESSION["gamme"])) {
        return $allArticles;

        // si choix de gamme effectué : on renvoie uniquement les articles correspondants
    } else {
        $gammeId = $_SESSION["gamme"];

        $articlesToDisplay = [];

        // on ne garde que ceux rattachés à la gamme
        foreach ($allArticles as $article) {

            if ($article['id_gamme'] == $gammeId) {
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
                <img id="ico" src=<?= $cartArticle["image"]; ?>>
            </div>
            <div class="col-md-2 text-end">
                <?= $cartArticle["nom"]; ?>
            </div>
            <div class="col-md-2">
                <?= $cartArticle["prix"] . " € "; ?>
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
                <?= $cartArticle["prix"] * $cartArticle["quantity"] . " €"; ?>
            </div>
            <div class="col-md-1">
                <form method="post" action="cart.php">
                    <input type="hidden" name="deleteArticle" value="<?= $cartArticle["id"]; ?>">
                    <button type="submit"><i class="bi bi-trash3-fill"></i></button>
                </form>
            </div>
        </div>
        <div class="ref-tiny-separator">∙∙∙∙∙</div>

<?php

    }
}
?>



<?php
/* ******************** show article in cart for validation ******************** */

function showArticleValidation()
{

        foreach ($_SESSION["cart"] as $cartArticle) {
    ?>
    
            
            <div class="ref-order-line ref-line-item ref-product-line">
                <div class="ref-img"><img id="ico" src=<?= $cartArticle["image"]; ?>>
                <div class="ref-name">6 × Willie Satterfield</div>
                <div class="ref-price"><b>$774.17</b><small>(6 × $5.82)</small></div>
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
        <img id="icoResume" src=<?= $cartArticle["image"]; ?>>
        <?= $cartArticle["nom"]; ?>
        <?= $cartArticle["prix"] . " € "; ?>
        <?= "( x" . $cartArticle["quantity"] . ") = "; ?>
        <?= $cartArticle["prix"] * $cartArticle["quantity"] . " €"; ?>
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
        $total += $_SESSION["cart"][$i]["quantity"] * $_SESSION["cart"][$i]["prix"];
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
function validateCart()
{
//    if (grandTotal() > 0 && $_POST["expedition"] != null) {
    if (grandTotal() > 0) 
    {
    ?>
    <form method="POST" action="validation.php">
        <input type="submit" name="validCart" class="btn btn-danger" value="Valider mon panier">
    </form>
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
        <form method="POST">
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
    //if ($_SESSION ["expedition"] == '' && $_SESSION["cart"] != null) {
    if (!isset($_SESSION ["expedition"])) {
?>

        <form method="post">
            <button type="submit" class="btn btn-primary">Selectionner</button>
        </form>
    <?php
    }
    //if ($_SESSION["expedition"] != null) {
    if (isset($_SESSION["expedition"])) {

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
function showExpeditionMethod()
{
    if ($_SESSION["expedition"] != null) {
        echo "(" . $_SESSION["expedition"] . ")";
    }
}
?>

<?php
function emptyCartTitle()
{
    if ($_SESSION["cart"] == null) {
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
function payExpedition()
{

    $expeditionCost = '';
    $shippingCosts = '';
    
    if (isset($_SESSION["expedition"])) {
    switch ($_SESSION["expedition"]) {

        case "":
            $shippingCosts = "Aucune Selection";

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
}

?>

<?php


/* ***** INSCRIPTION ***** */

function checkInfoRegistration()
{

    $db = getConnection();

    /* ***** 1 - looking for empty field (alert on error) ***** */

    if (checkEmptyField()) {
?>
        <script>
            window.alert("un ou plusieurs champs vides");
        </script>
        <?php

        // otherwise, we continue
    } else {

        /* ***** 2 : check for length field: compatibility of db attributes (alert on error) ***** */

        if (!checkInputLength()) {
        ?>
            <script>
                window.alert("un ou plusieurs champs ne respecte pas les conditions des données");
            </script>
            <?php

            // otherwise, we continue
        } else {

            $chosenEmail = $_POST["registeredEmail"];

            /* ***** 3 : check for duplicate email in db ***** */

            $checkEmail = $db->prepare("SELECT email FROM clients WHERE email = ?");
            $checkEmail->execute([$_POST["registeredEmail"]]);
            $checkEmail = $checkEmail->fetch();

            // alert if email address already in use   
            if ($checkEmail) {
            ?>
                <script>
                    window.alert("adresse email deja utilisée par un autre client");
                </script>
                <?php

                // otherwise, we continue
            } else {

                /* ***** 4 : check for secure for password (alert on error) ***** */

                if (!checkPassword($_POST["registeredPassword"])) {
                ?>
                    <script>
                        window.alert("le password n'est pas conforme");
                    </script>
                <?php

                    // otherwise, we continue
                } else {


                    $clientToRecord = $db->prepare("INSERT INTO clients (nom, prenom, email, mot_de_passe) VALUES (:nom, :prenom, :email, :pw)");
                    $clientToRecord->execute([
                        'nom' => strip_tags($_POST["registeredLastName"]),
                        'prenom' => strip_tags($_POST["registeredFirstName"]),
                        'email' => strip_tags($_POST["registeredEmail"]),
                        'pw' => strip_tags(password_hash($_POST["registeredPassword"], PASSWORD_DEFAULT))
                    ]);

                    /* */
                    $lastRecordedId = $db->lastInsertId();
                    addAddress($lastRecordedId);
                ?>
                    <script>
                        window.alert("vous êtes desormais inscrit à WorldWatch");
                    </script>
                <?php

                }
            }
        }
    }
}




/* ***** fonction VERIFIER qu'aucun input n'est vide ***** */

function checkEmptyField()
{
    foreach ($_POST as $field) {
        if (empty($field)) {
            echo "des champs ne sont pas remplis";
            return true;
        }
    }
    echo "tous les champs sont remplis";
    return false;
}

/* ***** fonction VERIFIER que la longueur des champs est correcte ***** */

function checkInputLength()
{

    if (strlen($_POST["registeredFirstName"]) > 25 || strlen($_POST["registeredFirstName"]) < 3) {
        return false;
    }
    if (strlen($_POST["registeredLastName"]) > 25 || strlen($_POST["registeredLastName"]) < 3) {
        return false;
    }
    if (strlen($_POST["registeredEmail"]) > 25 || strlen($_POST["registeredEmail"]) < 5) {
        return false;;
    }
    if (strlen($_POST["registeredZipCode"]) !== 5) {
        return false;;
    }
    if (strlen($_POST["registeredCity"]) > 25 || strlen($_POST["registeredCity"]) < 3) {
        return false;;
    }
    return true;
}

function checkInputModifyLength()
{
    if (strlen($_POST["fNameModified"]) > 25 || strlen($_POST["fNameModified"]) < 3) {
        //return false;
        echo "stop à fname";
    }
    if (strlen($_POST["lNameModified"]) > 25 || strlen($_POST["lNameModified"]) < 3) {
        //return false;
        echo "stop à lname";
    }
    if (strlen($_POST["emailModified"]) > 25 || strlen($_POST["emailModified"]) < 5) {
        //return false;
        echo "stop à email";
    }
    return true;
}




function checkPassword($password)
{
    // min 8 caractere, max 15 caractere, min 1
    $regex = "^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[@$!%*?/&])(?=\S+$).{8,15}$^";

    if (preg_match($regex, $password) == true) {
        return preg_match($regex, $password);
    }
}

function addAddress($lastRecordedId)
{

    /* je me connecte à la bd */
    $db = getConnection();

    /* j'insere l'adresse du client avec son id dans la table adresse */
    $clientToRecord = $db->prepare("INSERT INTO adresses (adresse, code_postal, ville, id_client) VALUES (:adresse, :codePostal, :ville, :idClient)");
    $clientToRecord->execute([
        'adresse' => strip_tags($_POST["registeredAddress"]),
        'codePostal' => strip_tags($_POST["registeredZipCode"]),
        'ville' => strip_tags($_POST["registeredCity"]),
        'idClient' => $lastRecordedId
    ]);
}


/* ***** VERIFIER CONNEXION ***** */

function connexion()
{

    if (!isset($_SESSION["user"]["id"]) & isset($_POST["connexionEmail"])) {

        /* je me connecte à la bd */
        $db = getConnection();

        /* Intiatlise variable in order to exclude error at laucnch */
        //$_POST["connexionEmail"] = "";
        //$_SESSION["user"] = "";

        /* ***** je tente de recuperer l'email du client dans la BD ***** */
        $checkCustomer = $db->prepare("SELECT c.id, c.nom, c.prenom, c.email, c.mot_de_passe, a.adresse, a.code_postal, a.ville FROM clients c INNER JOIN adresses a ON c.id = a.id_client WHERE email = ?");
        $checkCustomer->execute([$_POST["connexionEmail"]]);
        $checkCustomer = $checkCustomer->fetch();

        /* ***** si la variable est vide la client n'espt pas inscrit ***** */
        if (empty($checkCustomer)) {
            echo "client non inscrit";


            /* ***** sinon je recupere toutes ses données dans $_SESSION ***** */
        } else {

            if (!password_verify($_POST["ConnexionPW"], $checkCustomer["mot_de_passe"])) {
                ?>
                <script>
                    window.alert("le mot de passe ne correspond pas à l'email utilisateurs");
                </script>
            <?php


            } else {
                //echo "le mot de passe correspond à un email utilisateurs";
            ?>
                <script>
                    window.alert("vous êtes connecté");
                </script>
<?php

                $_SESSION["user"] = [
                    'id' => $checkCustomer["id"],
                    'nom' => $checkCustomer["nom"],
                    'prenom' => $checkCustomer["prenom"],
                    'email' => $checkCustomer["email"],
                    'adresse' => $checkCustomer["adresse"],
                    'cp' => $checkCustomer["code_postal"],
                    'ville' => $checkCustomer["ville"]
                ];
            }
        }
    };
}
?>

<?php

function conditionalNavbar()
{
    if (empty($_SESSION["user"])) {
?>
        <li class="nav-item">
            <a class="nav-link" href="register.php"></i>Inscription</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="connexion.php"></i>Connexion</a>
        </li>
    <?php
    } else {
    ?>
        <li class="nav-item">
            <a class="nav-link" href="customers.php"><i class="fa-regular fa-user"></i>Mon compte</a>
        </li>
        <li class="nav-item">
            <form method="POST" action="index.php">
                <button type="submit" name="deconnexion"><i class="fa-solid fa-user-slash"></i></button>
            </form>
        </li>
    <?php
    }
}

function disconnection()
{
    if (isset($_POST['deconnexion'])) {
        $_SESSION = [];
    ?>
        <script>
            window.alert("vous êtes maintenant deconnecté");
        </script>
    <?php
    };
}


function updateInfos()
{

    $db = getConnection();

    /* ***** 1 - looking for empty field (alert on error) ***** */

    if (checkEmptyField()) {
    ?>
        <script>
            window.alert("un ou plusieurs champs vides");
        </script>
        <?php

        // otherwise, we continue
    } else {

        /* ***** 2 : check for length field: compatibility of db attributes (alert on error) ***** */

        if (!checkInputModifyLength()) {
        ?>
            <script>
                window.alert("un ou plusieurs champs ne respecte pas les conditions des données");
            </script>
        <?php

            // otherwise, we continue
        } else {

            $newLname = strip_tags($_POST["lNameModified"]);
            $newFname = strip_tags($_POST["fNameModified"]);
            $newEmail = strip_tags($_POST["emailModified"]);



            $clientToModify = $db->prepare("UPDATE clients SET nom = :nom, prenom = :prenom , email = :email WHERE id = :id");
            //echo $clientToModify;

            $clientToModify->execute([
                'nom' => $newLname,
                'prenom' => $newFname,
                'email' => $newEmail,
                'id' => $_SESSION["user"]['id']
            ]);

            $_SESSION["user"]['nom'] = $newLname;
            $_SESSION["user"]['prenom'] = $newFname;
            $_SESSION["user"]['email'] = $newEmail;

        ?>
            <script>
                window.alert("Information mises à jour");
            </script>
        <?php


        }
    }
}


function updateAdress()
{

    $db = getConnection();

    /* ***** 1 - looking for empty field (alert on error) ***** */

    if (checkEmptyField()) {
        ?>
        <script>
            window.alert("un ou plusieurs champs vides");
        </script>
    <?php

        // otherwise, we continue
    } else {


        $newAdress = strip_tags($_POST["adressModified"]);
        $newCp = strip_tags($_POST["cpModified"]);
        $newCity = strip_tags($_POST["cityModified"]);


        $adressToModify = $db->prepare("UPDATE adresses SET adresse = :adresse , code_postal = :cp , ville = :ville WHERE id_client = :id");

        $adressToModify->execute([
            'adresse' => strip_tags($_POST["adressModified"]),
            'cp' => strip_tags($_POST["cpModified"]),
            'ville' => strip_tags($_POST["cityModified"]),
            'id' => $_SESSION["user"]['id']
        ]);

        var_dump($adressToModify);

        $_SESSION["user"]['adresse'] = $newAdress;
        $_SESSION["user"]['cp'] = $newCp;
        $_SESSION["user"]['ville'] = $newCity;

    ?>
        <script>
            window.alert("Informations mises à jour");
        </script>
<?php

    }
}
?>

<?php
function updatePW()
{

    $db = getConnection();

    /* ********************** 1 - looking for empty field (alert on error) ******************* */

    if (checkEmptyField()) {
?>
        <script>
            window.alert("un ou plusieurs champs vides");
        </script>
        <?php

        // otherwise, we continue

    } else {

        $checkPw = $db->prepare("SELECT c.mot_de_passe FROM clients c WHERE email = ?");
        $checkPw->execute([$_SESSION["user"]["email"]]);
        $checkPw = $checkPw->fetch();

        /* ************************** 3 verification for accept password change ****************** */

        /* 1) old password is ok */

        if (!password_verify($_POST["oldPWToReplace"], $checkPw["mot_de_passe"])) {
        ?>
            <script>
                window.alert("l'ancien mot de passe n'est pas valide");
            </script>
            <?php

        } else {

            /******************2) new password and confirm new password are identical ****************/

            if ($_POST["confirmNewPWToAdd"] != $_POST["newPWToAdd"]) {
            ?>
                <script>
                    window.alert("le mot de passe n'est pas confirmé");
                </script>
                <?php

            } else {

                /************************** * 3) password requirement is ok *************************/

                if (!checkPassword($_POST["newPWToAdd"])) {
                ?>
                    <script>
                        window.alert("le mot de passe ne correspond pas aux exigences demandées");
                    </script>
                <?php

                    /* alors je lance la requete de mise a jours du mot de passe et informe le user */

                } else {

                    $newPw = $db->prepare("UPDATE clients SET mot_de_passe = :pw WHERE id = :id");
                    $newPw->execute([
                        'pw' => strip_tags(password_hash($_POST["newPWToAdd"], PASSWORD_DEFAULT)),
                        'id' => $_SESSION["user"]["id"]
                    ]);

                ?>
                    <script>
                        window.alert("le mot de passe est mis à jours");
                    </script>
<?php
                }
            }
        }
    }
}

function recordOrder() 
{

}


?>