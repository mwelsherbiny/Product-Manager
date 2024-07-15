<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahmoud Elsherbiny</title>
    <link rel="stylesheet" href="style.css" type="text/css">
    <script src="product_list.js" defer></script>
</head>

<body>
    <main>
        <header>
            <h1>Product List</h1>
            <div class="buttons">
                <button class="clickable" onclick="window.location.href='/add-product'">ADD</button>
                <button class="clickable" id="delete-product-btn" onclick="massDelete()">MASS DELETE</button>
            </div>
        </header>
        <hr>
        <div id="products">
            <?php
            foreach ($productsInfo as $info) {
                echo '<div class="container" id="' . $info["sku"] . '">';
                echo '<input form="delete-form" class="delete-checkbox" type="checkbox" name="' . $info["sku"] . '">';
                echo '<p>' . $info["sku"] . '</p>';
                echo '<p>' . $info["name"] . '</p>';
                echo '<p>' . $info["price"] . ' $</p>';
                echo '<p>' . $info["property"] . '</p>';
                echo '</div>';
            }
            ?>
        </div>
    </main>
    <?php require_once("layout/footer.php") ?>
</body>
</html>

