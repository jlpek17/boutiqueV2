<?php
session_start();
include("functions.php");
?>


<!DOCTYPE html>
<html lang="fr">


<?php
include("head.php");
resetOnSuccess();
?>



<body>
    <div class="container-fluid" id="wrapper">
        <?php
        include("header.php");
        ?>
        <main>
            <h1 class="text-center">Best Sellers</h1>
            <div class="row">
                <?php
                    showArticles();
                ?>
            </div>
        </main>
    </div>
    <?php  include("footer.php"); ?>
</body>
</html>

