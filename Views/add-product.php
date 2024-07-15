<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mahmoud Elsherbiny</title>
        <link rel="stylesheet" href="style.css" type="text/css">
        <script src="add_product.js" defer></script>
    </head>
    <body>
    <header>
        <h1>Product Add</h1>
        <div class = "buttons">
            <button class="clickable" form="product_form" type="submit">Save</button>
            <button onclick="window.location.href='/'" id="cancel" class="clickable">Cancel</button>
        </div>
    </header>
    <hr>
    <form id="product_form" method="POST">
        <p id="empty-error" class="warning"></p>
        <label for="sku" id="sku-label">SKU</label>
        <input type="text" id="sku" name="sku" placeholder="SKU">
        <span id="sku-error" class="warning"></span><br>
        <label for="name" id="name-label">Name</label>
        <input type="text" id="name" name="name" placeholder="Name">
        <span id="name-error" class="warning"></span><br>
        <label for="price" id="price-label">Price ($)</label>
        <input type="number" id="price" name="price" min="0" step=".01" placeholder="Price">
        <span id="price-error" class="warning"></span><br>
        <label for="productType" id="type_switcher">Type Switcher</label>
        <select id="productType">
            <option value="DVD">DVD</option>
            <option value="Book">Book</option>
            <option value="Furniture">Furniture</option>
        </select>
        <span id="type-error"></span><br>
        <div id="property-form">
            <label for="size" id="size-label">Size (MB)</label>
            <input type="number" id="size" name="property" min="0" step=".01" placeholder="Size">
            <span id="size-error" class="warning property-error"></span><br>
            <p id="description">Please, provide size</p>
        </div>
    </form>
    </body>
    <?php require_once("layout/footer.php") ?>
</html>
