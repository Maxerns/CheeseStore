<!doctype html>
<html>
    <head>
        <title>Admin View</title>
        <link rel="stylesheet" href="../controller/adminController.css">
    </head>
    <body>
        <table>
            <h1>Welcome, Admin</h1>

            <h2>Add Cheese</h2>
            <form method="post" action="../model/addCheese.php">
                Cheese Name: <input alt="Cheese Name" type="text" name="cheeseName" required><br>
                Cheese Type: <input alt="Cheese Type" type="text" name="cheeseType" required><br>
                Cheese Origin: <input alt="Cheese Origin" type="text" name="cheeseOrigin" required><br>
                Cheese Strength: <input alt="Cheese Strength" type="number" name="cheeseStrength" required min="1" max="5"><br>
                Cheese Price: <input alt="Cheese Price" type="number" name="cheesePrice" required step="0.01" min="0" max="1"><br>
                <button type="submit" alt="Add Cheese">Add Cheese</button>
            </form>

            <thead>
                <tr>
                    <th>Cheese Name</th>
                    <th>Type</th>
                    <th>Origin</th>
                    <th>Strength</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $results = getAllCheese();

                foreach ($results as $cheese) {
                    ?>
                    <tr>
                        <td><?= $cheese->name ?></td>
                        <td><?= $cheese->type ?></td>
                        <td><?= $cheese->origin ?></td>
                        <td><?= $cheese->strength ?></td>
                        <td><?= $cheese->price ?></td>
                        <td><a alt="Edit Cheese" href="../model/editCheese.php?id=<?= $cheese->id ?>">Edit</a></td>
                    </tr>
                    <?php
                }
                ?>
                </form>

                <a href="../../../CheeseStore/public/homePage.php" alt="Go To Main Page">Go to Main Page</a>
            </tbody>
        </table>
    </body>
</html>