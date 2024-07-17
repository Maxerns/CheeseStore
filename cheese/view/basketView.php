<!DOCTYPE html>
<html>
<head>
    <title>Basket</title>
    <link rel="stylesheet" href="../controller/basketController.css">
<body>
    <a href="../../cheese/controller/cheeseController.php" alt="Go Back">Go Back</a>
    <h1>Basket Contents</h1>

    <form id="basketItems" class="basketItems" action="../model/checkout.php" method="post">
        <div class="item-wrapper">
            <?php 
            if(isset($_SESSION['basket'])): 
                if(!empty($_SESSION['basket'])):
                    foreach ($_SESSION['basket'] as $item): ?>
                        <ul class="inline-list">
                            <li><?= $item->name ?></li>
                            <li><?= $item->type ?></li>
                            <li><?= $item->origin ?></li>
                            <li><?= $item->strength ?></li>
                            <li><?= $item->price ?> per 1g</li>
                            <li>
                                <button type="button" class="remove-button" data-id="<?= $item->id ?>">Remove</button>
                            </li>
                            <li>
                                <label for="quantity[<?= $item->id ?>]">Quantity (100g units):</label>
                                <select id="quantity[<?= $item->id ?>]" name="quantity[<?= $item->id ?>]" onchange="updateTotalPrice(<?= $item->id ?>, <?= $item->price ?>)">
                                    <?php for ($i = 1; $i <= 10; $i++): ?>
                                        <option value="<?= $i ?>"><?= $i * 100 ?></option>
                                    <?php endfor; ?>
                                </select>
                                <input type="hidden" id="totalPrice[<?= $item->id ?>]" name="totalPrice[<?= $item->id ?>]" value="<?= $item->price ?>">
                            </li>
                        </ul>
                        <?php endforeach; ?>
                <button type="button" id="showCheckoutFormButton" alt="Checkout">Checkout</button> 
            <?php else: ?>
                <p>Basket is empty</p>
            <?php endif;
        else: ?>
            <p>Session basket is not set</p>
        <?php endif; ?> 
    </div>
</form>

    <!-- <button type="button" id="showCheckoutFormButton" alt="Checkout">Checkout</button>    -->

    <form id="checkoutForm" class="checkoutForm" action="../model/checkout.php" method="post">
        <label for="fullname">Full Name</label>
        <input type="text" id="fullname" name="fullname" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone" required>

        <label for="address">Address</label>
        <textarea id="address" name="address" required></textarea>

        <p>Total price: <span id="totalPrice">0</span></p>

        <button type="submit" id="checkoutButton" alt="Checkout">Checkout</button>
    </form>

       

    <script>
    function updateTotalPrice(itemId, pricePer100g) {
        var quantity = document.getElementById('quantity[' + itemId + ']').value;
        var totalPrice = quantity * Number(pricePer100g) * 100; // Convert pricePer100g to a number
        document.getElementById('totalPrice[' + itemId + ']').value = totalPrice.toFixed(2); // Round to two decimal places

        // Update the total price display
        var totalPriceDisplay = 0;
        var totalPriceInputs = document.querySelectorAll('input[id^="totalPrice"]');
        for (var i = 0; i < totalPriceInputs.length; i++) {
            totalPriceDisplay += parseFloat(totalPriceInputs[i].value);
        }
        document.getElementById('totalPrice').textContent = totalPriceDisplay.toFixed(2); // Round to two decimal places
    }

    document.getElementById('showCheckoutFormButton').addEventListener('click', function() {
        // Show the checkout form
        document.getElementById('checkoutForm').style.display = 'block';

        // Hide the showCheckoutFormButton
    document.getElementById('showCheckoutFormButton').style.display = 'none';
    });

    document.getElementById('checkoutForm').addEventListener('submit', function(event) {
        // Prevent the default form submission
        event.preventDefault();

        // Gather the data from the basket items form and the checkout form
        var basketItemsFormData = new FormData(document.getElementById('basketItems'));
        var checkoutFormData = new FormData(event.target);
        var formData = new FormData();
        for (var pair of basketItemsFormData.entries()) {
            formData.append(pair[0], pair[1]);
        }
        for (var pair of checkoutFormData.entries()) {
            formData.append(pair[0], pair[1]);
        }

        // Send the data to checkout.php
        fetch('../model/checkout.php', {
            method: 'POST',
            body: formData
        }).then(function(response) {
            // Redirect to a new page after successful submission
            window.location.href = '../controller/checkoutController.php';
        });
    });

    // Handle the click event of the remove buttons
    var removeButtons = document.querySelectorAll('.remove-button');
    for (var i = 0; i < removeButtons.length; i++) {
        removeButtons[i].addEventListener('click', function(event) {
            var itemId = event.target.getAttribute('data-id');

            // Send a POST request to the server to remove the item from the basket
            fetch('../model/basket.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'remove=' + itemId
            }).then(function(response) {
                // Reload the page after successful removal
                location.reload();
            });
        });
    }
    </script>
</body>
</html>