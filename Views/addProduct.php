<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="Views/static/style.css">
    <script defer src="Views/static/add_product.js"></script>
    <title>Add Product</title>
</head>
<body>
    <header>
        <h1>Product Add</h1>
        <div class="buttons">
            <button class="clickable" form="product_form" type="submit">Save</button>
            <button class="clickable" onclick="window.location.href='/'" id="cancel-btn">Cancel</button>
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
    <?php require "static/footer.html" ?>
</body>
</html>
