<?php

require_once '../model/cheese.php';
require_once '../model/dataAccess.php';

// Get the cheese ID from the URL or form submission
$cheeseId = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

if ($cheeseId) {
    $cheese = getCheeseByID($cheeseId);
}

?>

<!-- HTML form to edit cheese details -->
<form method="post" action="../model/updateCheese.php">
    <input type="hidden" name="id" value="<?= htmlentities($cheese->id) ?>">
    <label>Name:</label>
    <input type="text" name="name" value="<?= htmlentities($cheese->name) ?>">
    <label>Type:</label>
    <input type="text" name="type" value="<?= htmlentities($cheese->type) ?>">
    <label>Origin:</label>
    <input type="text" name="origin" value="<?= htmlentities($cheese->origin) ?>">
    <label>Strength:</label>
    <input type="text" name="strength" value="<?= htmlentities($cheese->strength) ?>">
    <label>Price:</label>
    <input type="text" name="price" value="<?= htmlentities($cheese->price) ?>">
    <button type="submit" alt="update">Update</button>
</form>