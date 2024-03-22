<?php
include("functions.php");
?>
<h1>Information d'inscription transmises </h1>

<?php
var_dump($_POST);
?>
<h2> <?= checkInfoRegistration(); ?></h2>
<a href="index.php">retour à l'accueil</a>