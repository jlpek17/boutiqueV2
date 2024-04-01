<?php
echo "page Orders";
?>

<div class="card-body d-flex flex-column align-items-center">
                
                <div class="bs-icon-xl bs-icon-circle bs-icon-primary bs-icon my-4"><i class="fa-solid fa-user"></i>Mes Informations</div>

                <form class="text-center" method="post" action="customers.php">
                    
                    <div class="mb-3"><input class="form-control" type="email" name="emailModified" placeholder="<?= $_SESSION["user"]["email"]; ?>" />Email</div>
                    <div class="mb-3"><input class="form-control" type="text" name="fNameModified" placeholder="<?= $_SESSION["user"]["prenom"]; ?>" />Prénom</div>
                    <div class="mb-3"><input class="form-control" type="text" name="lNameModified" placeholder="<?= $_SESSION["user"]["nom"]; ?>" />Nom</div>

                    
                </form>
                
            </div>