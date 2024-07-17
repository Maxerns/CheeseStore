<?php
$pdo = new PDO("mysql:host=localhost;dbname=db_k2129663",
 "k2129663",
 "ughopaem",
[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

function getAllCheese()
{
    global $pdo;
    $statement = $pdo->prepare("SELECT * FROM cheese");
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_CLASS, "Cheese");
    return $results;
}

function getCheeseByName($name)
{
    global $pdo;
    $statement = $pdo->prepare("SELECT * FROM cheese WHERE name = ?");
    $statement->execute([$name]);
    $results = $statement->fetchAll(PDO::FETCH_CLASS, "Cheese");
    return $results;
}

function getCheeseByType($type)
{
    global $pdo;
    $statement = $pdo->prepare("SELECT * FROM cheese WHERE type = ?");
    $statement->execute([$type]);
    $results = $statement->fetchAll(PDO::FETCH_CLASS, "Cheese");
    return $results;
}

function getCheeseByOrigin($origin)
{
    global $pdo;
    $statement = $pdo->prepare("SELECT * FROM cheese WHERE origin = ?");
    $statement->execute([$origin]);
    $results = $statement->fetchAll(PDO::FETCH_CLASS, "Cheese");
    return $results;
}

function getCheeseByStrength($strength)
{
    global $pdo;
    $statement = $pdo->prepare("SELECT * FROM cheese WHERE strength = ?");
    $statement->execute([$strength]);
    $results = $statement->fetchAll(PDO::FETCH_CLASS, "Cheese");
    return $results;
}

function getCheeseByPrice($price)
{
    global $pdo;
    $statement = $pdo->prepare("SELECT * FROM cheese WHERE ROUND(price, 2) = ?");
    $statement->execute([round($price, 2)]);
    $results = $statement->fetchAll(PDO::FETCH_CLASS, "Cheese");
    return $results;
}

function getCheeseByID($id)
{
    global $pdo;
    $statement = $pdo->prepare('SELECT id, name, type, origin, strength, price FROM cheese WHERE id = ?');
    $statement->execute([$id]);
    $results = $statement->fetchAll(PDO::FETCH_CLASS, 'Cheese');
    return $results[0];
}

function addNewCheese($cheese)
{
    global $pdo;
    $statement = $pdo->prepare("INSERT INTO cheese (name, type, origin, strength, price) VALUES (?, ?, ?, ?, ?)");
    $statement->execute([$cheese->name, $cheese->type, $cheese->origin, $cheese->strength, $cheese->price]);
}

function updateCheese($id, $name, $type, $origin, $strength, $price)
{
    global $pdo;
    $statement = $pdo->prepare("UPDATE cheese SET name = ?, type = ?, origin = ?, strength = ?, price = ? WHERE id = ?");
    $statement->execute([$name, $type, $origin, $strength, $price, $id]);
}

function addNewUser($user)
{
    global $pdo;
    $statement = $pdo->prepare("INSERT INTO user (username, password) VALUES (?, ?)");
    $statement->execute([$user->username, $user->password]);
}

function addNewCustomer($fullname, $email, $phoneNumber, $address) {
    global $pdo;
    $statement = $pdo->prepare("INSERT INTO customer (fullname, email, phoneNumber, address) 
                                VALUES (?, ?, ?, ?)");
    $statement->execute([$fullname, $email, $phoneNumber, $address]);
}

function addPurchases($customer_id, $userId, $pdo)
{
    global $pdo;
    $statement = $pdo->prepare('INSERT INTO purchases (customer, user) VALUES (?, ?)');
    $statement->execute([$customer_id, $userId]);
    return $pdo->lastInsertId();
}


function addPurchasedItem($purchases, $cheese, $quantity)
{
    global $pdo;
    $quantity = $quantity * 100; // Multiply the quantity by 100 to get grams
    $statement = $pdo->prepare('INSERT INTO purchasedItem (purchases, cheese, quantity)
                                                            VALUES (?, ?, ?)');
    $statement->execute([$purchases, $cheese, $quantity]);
    
}

function isValidUser($username, $password, $pdo) {
    $statement = $pdo->prepare("SELECT id FROM user WHERE username = ? AND password = ?");
    $statement->execute([$username, $password]);
    $userId = $statement->fetchColumn();

    return $userId ? $userId : false;
}


function getCheesesByOrder($orderId) {
    global $pdo;
    $statement = $pdo->prepare('SELECT cheese.* FROM cheese
                                INNER JOIN purchasedItem ON cheese.id = purchasedItem.cheese
                                INNER JOIN purchases ON purchasedItem.purchases = purchases.id
                                WHERE purchases.id = ?');
    $statement->execute([$orderId]);
    $results = $statement->fetchAll(PDO::FETCH_CLASS, 'Cheese');

    return $results;
}

function getPurchasesByUser($userId) {
global $pdo;
$statement = $pdo->prepare('SELECT purchases.*, customer.fullname, customer.email, customer.phoneNumber, customer.address
                            FROM purchases
                            INNER JOIN customer ON purchases.customer = customer.id
                            WHERE purchases.user = ?');
$statement->execute([$userId]);
$results = $statement->fetchAll(PDO::FETCH_ASSOC);

return $results;
}

function getCustomerById($customerId) {
    global $pdo;
    $statement = $pdo->prepare('SELECT * FROM customer WHERE id = ?');
    $statement->execute([$customerId]);
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $results;
}





?>