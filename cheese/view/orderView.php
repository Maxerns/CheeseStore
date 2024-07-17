<?php // ordersView.php

foreach ($orders as $order) {
    // Display the order details
    ?>
    Cheeses Purchased: <ul>
        <?php
        if (isset($order['cheeses']) && is_array($order['cheeses'])) {
            foreach ($order['cheeses'] as $cheese) {
                ?>
                <li><?= $cheese->name ?></li>
                <?php
            }
        }
        ?>
    </ul>
    <?php
}
?>

<link rel="stylesheet" href="../controller/orderController.css">

<form method="post" action="../controller/loginController.php">
    <button type="submit" alt="Go Back">Go Back</button>
</form>