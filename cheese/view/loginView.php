<!doctype html>
<html>
    <head>
        <title>Admin View</title>
        <link rel="stylesheet" href="../controller/loginController.css">
    </head>
    <body>
    <?php
    if (!isset($_SESSION['userId'])) {
    ?>
        <h2>Login Form</h2>
        <form method="post" action="../../cheese/controller/loginController.php">
            Username: <input type="text" name="username" required><br>
            Password: <input type="password" name="password" required><br>
            <button type="submit">Login</button>
        </form>
        
        <a href="../../cheese/controller/signupController.php">
            <button type="submit" alt="Create Account">Create Account</button>
        </a>
        <a href="../../../CheeseStore/public/homePage.php">
            <button type="submit" alt="Return Home">Return Home</button>
        </a>
    <?php
    } else {
    ?>
        <h2>Welcome, you are logged in!</h2>
        <form method="post" action="../../cheese/controller/logoutController.php">
            <button type="submit" alt="Logout">Logout</button>
        </form>
        <form method="post" action="../../cheese/controller/cheeseController.php">
            <button type="submit" alt="Go Back">Go Back</button>
        </form>
        <form method="post" action="../../cheese/controller/orderController.php">
            <button type="submit" alt="View My Orders">View My Orders</button>
        </form>
    <?php
    }
    ?>
    </body>
</html>