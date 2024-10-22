async function deleteProduct(url) {
    const response = await fetch(url, {
        method: 'DELETE',
        headers: {
            'Content-type': 'application/json'
        }
    });

    const resData = 'resource deleted...';

    return resData;
}

function massDelete(event) {
    const checkboxes = document.querySelectorAll('.delete-checkbox');

    if (checkboxes.length === 0) {
        return;
    }

    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            deleteProduct("/api.php/products/" + checkbox.getAttribute("name"));
            const sku = checkbox.getAttribute("name");
            document.getElementById(sku).remove();
        }
    });
}

function addProduct() {

}