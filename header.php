<?php
createCart()
?>

<header>
<!-- creation of the navbar (bootstrap) --> 
  <nav class="navbar navbar-expand-lg bg-*">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">World Watch</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cart.php">Panier<?= "(" . quantityArticle() . ")"; ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php"><i class="fa-regular fa-user"></i>Inscription</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="connexion.php"><i class="fa-regular fa-user"></i>Connexion</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

</header>