function massDelete()
{
    let deletedProducts = []
    const checkboxes = document.getElementsByClassName('delete-checkbox');
    for (let i=0; i<checkboxes.length;i++){
        if (checkboxes[i].checked)
        {
            const sku = checkboxes[i].getAttribute("name")
            deletedProducts.push(sku)
        }
    }
    if (deletedProducts.length > 0)
    {
        deletedProducts.forEach(sku => document.getElementById(sku).remove())
        fetch(
            "remove_products.php", {
                method: "POST",
                body: JSON.stringify(deletedProducts)
            }
        )
    }
}
