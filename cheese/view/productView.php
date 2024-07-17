<!doctype html>
<html>
    <head>
        <title>Cheese List</title>
        <link rel="stylesheet" href="../controller/cheeseController.css">
        <script src="https://kit.fontawesome.com/443217ddce.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="../../cheese/clientcode.js"></script>
        

    </head>
   <body>
    <table>
        <thead>
        <div class="logo-container">
        <a href="../../../CheeseStore/public/homePage.php">
        <img class="logo" src="../../../CheeseStore/public/src/WickedCheeseLogo1.png" alt="Logo">
        </a>
        <div class="search-container">
        <form id="searchForm1" action="../../cheese/controller/cheeseController.php" method="post">
    <input type="text" id="search1" name="searchByName" placeholder="Enter cheese name" onkeypress="handleNiceAutoComplete('searchForm1', 'searchByName')">
</form>
<!-- Repeat for other forms -->
            <form id="searchForm2" action="../../cheese/controller/cheeseController.php" method="post">
                <input type="text" id="search2" name="searchByType" placeholder="Enter cheese type" onkeypress="handleKeyPress(event, 'searchForm2')">
            </form>
            <form id="searchForm3" action="../../cheese/controller/cheeseController.php" method="post">
                <input type="text" id="search3" name="searchByOrigin" placeholder="Enter cheese origin" onkeypress="handleKeyPress(event, 'searchForm3')">
            </form>
            <form id="searchForm4" action="../../cheese/controller/cheeseController.php" method="post">
                <input type="text" id="search4" name="searchByStrength" placeholder="Enter cheese strength" onkeypress="handleKeyPress(event, 'searchForm4')">
            </form>
            <form id="searchForm5" action="../../cheese/controller/cheeseController.php" method="post">
                <input type="text" id="search5" name="searchByPrice" placeholder="Enter cheese price" onkeypress="handleKeyPress(event, 'searchForm5')">
            </form>
        </div>
            <a href="../../../CheeseStore/cheese/controller/basketController.php" class="basket-link">
            <i class="fa-solid fa-basket-shopping"></i>
            </a>

            <a href="../../../CheeseStore/cheese/controller/loginController.php" class="user-link">
            <i class="fa-solid fa-user"></i>
            </a>

            <h1>Featured Products</h1>
            <!-- <img src="../../../CheeseStore/public/src/parmigiano1.png">
            <img src="../../../CheeseStore/public/src/brieCheese.png">
            <img src="../../../CheeseStore/public/src/manchego.png"> -->
        <div class="carousel-container">
        <div class="carousel-slide">
            <img src="../../../CheeseStore/public/src/parmigiano1.png" alt="Parmigiano">
            <button class="imageButton">Parmigiano</button>
            <img src="../../../CheeseStore/public/src/brieCheese.png" alt="Brie Cheese">
            <img src="../../../CheeseStore/public/src/manchego.png" alt="Manchego">
            <img src="../../../CheeseStore/public/src/feta.jpg" alt="Feta">
            <img src="../../../CheeseStore/public/src/brieCheese.png" alt="Brie Cheese">
            <img src="../../../CheeseStore/public/src/manchego.png" alt="Manchego">
            <img src="../../../CheeseStore/public/src/swiss.jpg" alt="Swiss">
            <img src="../../../CheeseStore/public/src/brieCheese.png" alt="Brie Cheese">
            <img src="../../../CheeseStore/public/src/manchego.png" alt="Manchego">
            <img src="../../../CheeseStore/public/src/brieCheese.png" alt="Brie Cheese">
            <img src="../../../CheeseStore/public/src/manchego.png" alt="Manchego">

        </div>
        
     </div>

    <script>
        const filterName = document.getElementById('filter-name');
        const filterStrength = document.getElementById('filter-strength');
        const filterPrice = document.getElementById('filter-price');
        const filterOrigin = document.getElementById('filter-origin');
        const filterType = document.getElementById('filter-type');
        const cheeseRows = document.querySelectorAll('tbody tr');

        function applyFilters() {
            const selectedName = filterName.value;
            const selectedStrength = filterStrength.value;
            const selectedPrice = filterPrice.value;
            const selectedOrigin = filterOrigin.value;
            const selectedType = filterType.value;

            for (const row of cheeseRows) {
                const cheeseName = row.querySelector('td:nth-child(1)').textContent;
                const cheeseStrength = row.querySelector('td:nth-child(4)').textContent;
                const cheesePrice = row.querySelector('td:nth-child(5)').textContent;
                const cheeseOrigin = row.querySelector('td:nth-child(3)').textContent;
                const cheeseType = row.querySelector('td:nth-child(2)').textContent;

                const nameMatch = selectedName === 'all' || selectedName === cheeseName;
                const strengthMatch = selectedStrength === 'all' || selectedStrength === cheeseStrength;
                const priceMatch = selectedPrice === 'all' || selectedPrice === cheesePrice;
                const originMatch = selectedOrigin === 'all' || selectedOrigin === cheeseOrigin;
                const typeMatch = selectedType === 'all' || selectedType === cheeseType;

                if (nameMatch && strengthMatch && priceMatch && originMatch && typeMatch) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            }
        }

        filterName.addEventListener('change', applyFilters);
        filterStrength.addEventListener('change', applyFilters);
        filterPrice.addEventListener('change', applyFilters);
        filterOrigin.addEventListener('change', applyFilters);
        filterType.addEventListener('change', applyFilters);

            
    </script>
</div>
            <tr>
                <th>Cheese Name</th>
                <th>Type</th>
                <th>Origin</th>
                <th>Strength</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
        <form action="cheeseController.php" method="post">
        <?php foreach ($results as $cheese): ?>
            <tr>
                <td><?= $cheese->name ?></td>
                <td><?= $cheese->type ?></td>
                <td><?= $cheese->origin ?></td>
                <td><?= $cheese->strength ?></td>
                <td><?= $cheese->price ?></td>
                <td><button type="submit" name="basket" value="<?= $cheese->id ?>">Add to Basket</button</td>
            </tr>
            <?php endforeach ?>
        </form>
        </tbody>
    </table>

    <script>
        const carouselContainer = document.querySelector('.carousel-container');
        const carouselSlide = document.querySelector('.carousel-slide');
        const carouselImages = document.querySelectorAll('.carousel-slide img');

        let counter = 1; // Start at index 1 to display the second set of images

        const slideWidth = carouselImages[0].clientWidth; // Get width of one image

        carouselSlide.style.transform = `translateX(${-slideWidth * counter}px)`; // Initial positioning

        setInterval(() => {
            carouselSlide.style.transition = 'transform 0.5s ease-in-out';
            counter++;
            carouselSlide.style.transform = `translateX(${-slideWidth * counter}px)`;

            // Reset carousel to the first slide after the last slide
            if (counter >= carouselImages.length - 3) {
                setTimeout(() => {
                    carouselSlide.style.transition = 'none'; // Disable transition for instant reset
                    counter = 1;
                    carouselSlide.style.transform = `translateX(${-slideWidth * counter}px)`;
                }, 500); // Wait for transition to finish before resetting
            }
        }, 2000); // Change slide every 3 seconds
    </script>

    <script>
        function handleKeyPress(event, formId) {
            if (event.key === 'Enter') {
            document.getElementById(formId).submit();
            }
        }
    </script>

    



 
</body>
</html>