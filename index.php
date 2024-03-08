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
            <h1 class="text-center">Catalogue</h1>

            <form method="POST" action="./index.php">
                <label for="gamme">Filtrer:</label>
                <select id="gamme" name="gamme" size=3 multiple>
                    <option value="all">Tout</option>    
                    <option value="1">Gamme 1</option>
                    <option value="2">Gamme 2</option>
                </select>
                <input type="submit" value="appliquer">
            </form>


            <div class="row">
                <?php
                    showArticles(filterArticles());
                ?>
            </div>
        </main>
    </div>
    <?php  include("footer.php"); ?>
</body>
</html>

