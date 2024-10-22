<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="Views/static/style.css">
    <script defer src="Views/static/main.js"></script>
    <title>Products</title>
</head>
<body>
    <header>
        <h1>Product List</h1>
        <div class="buttons">
            <a href="/add-product">
                <button class="clickable">ADD</button>
            </a>
            <button class="clickable" onclick="massDelete()" id="delete-product-btn">MASS DELETE</button>
        </div>
    </header>
    <hr>
    <div id="products">
        <?php
        foreach ($products as $product) {
            echo '<div class="container" id="' . $product->getSku(). '">';
            echo '<input form="delete-form" class="delete-checkbox" type="checkbox" name="' . $product->getSku() . '">';
            echo '<p>' . $product->getSku() . '</p>';
            echo '<p>' . $product->getName() . '</p>';
            echo '<p>' . $product->getPriceString() . '</p>';
            echo '<p>' . $product->getAttributeString() . '</p>';
            echo '</div>';
        }
        ?>
    </div>
    <hr>
    <?php require "static/footer.html" ?>
</body>
</html>




