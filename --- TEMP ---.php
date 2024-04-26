
buttonDetailOrder($order['id'], $order["numero"], $order["date_commande"], $order["prix"]); ?></div></td>





function buttonDetailOrder($orderId, $orderNumber, $orderDate, $orderPrice) {
    
    echo $orderId . " ET " . $orderNumber . " ET " . $orderDate . " ET " . $orderPrice;

/* ***** Connection to the DB ***** */
    $db = getConnection();

    $orderDetail = $db->query("SELECT a.nom, a.prix, d.quantite FROM articles a INNER JOIN commande_article d ON a.id = d.id_article WHERE id_commande = ?");
    $orderDetail->execute([$orderId]);
    $orderDetail = $checkCustomer->fetch();
    //var_dump($checkCustomer);

    ?>

    <?php
            $selectOrderDetail = [
                "orderNumber" => $orderNumber,
                "orderDate" => $orderDate,
                "OrderPrice" => $orderPrice
            ];
}


<input type="hidden" name="orderQuantity" value="<?= $orderDetail['quantite'] ?>">
                        <input type="hidden" name="orderArticlePrice" value="<?= $orderDetail['prix'] ?>">
                        <input type="hidden" name="orderArticleName" value="<?= $orderDetail['nom'] ?>">
