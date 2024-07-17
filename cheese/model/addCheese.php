<?php

require_once '../../cheese/model/cheese.php';
require_once '../../cheese/model/dataAccess.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $cheeseName = $_REQUEST['cheeseName'];
        $cheeseType = $_REQUEST['cheeseType'];
        $cheeseOrigin = $_REQUEST['cheeseOrigin'];
        $cheeseStrength = $_REQUEST['cheeseStrength'];
        $cheesePrice = $_REQUEST['cheesePrice'];

        require_once '../../cheese/model/cheese.php';
        require_once '../../cheese/model/dataAccess.php';

        $newCheese = new Cheese();
        $newCheese->name = htmlentities($cheeseName);
        $newCheese->type = htmlentities($cheeseType);
        $newCheese->origin = htmlentities($cheeseOrigin);
        $newCheese->strength = htmlentities($cheeseStrength);
        $newCheese->price = htmlentities($cheesePrice);

        addNewCheese($newCheese, $pdo);


    }

    require_once '../../cheese/controller/adminController.php';
    ?>
