async function deleteProduct(url) {
    await fetch(url, {
        method: 'POST',
        headers: {
            'Content-type': 'application/json'
        },
    });
    return 'resource deleted...';
}

function massDelete(event) {
    const checkboxes = document.querySelectorAll('.delete-checkbox');

    if (checkboxes.length === 0) {
        return;
    }

    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            deleteProduct("/api.php/products/delete/" + checkbox.getAttribute("name"));
            const sku = checkbox.getAttribute("name");
            document.getElementById(sku).remove();
        }
    });
}