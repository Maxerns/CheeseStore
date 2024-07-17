<?php

require_once '../../cheese/model/user.php';
require_once '../../cheese/model/dataAccess.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $userUsername = $_REQUEST['username'];
        $userPassword = $_REQUEST['password'];
        

        $newUser = new User();
        $newUser->username = $userUsername;
        $newUser->password = $userPassword;
        

        addNewUser($newUser, $pdo);

    }

    require_once '../../cheese/controller/cheeseController.php';
    ?>
