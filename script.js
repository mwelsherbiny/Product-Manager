document.getElementById("productType").addEventListener("change", updateForm)
document.getElementById("product_form").addEventListener("submit", validateInput)
let prevProperties = ["size"]

function updateForm()
{
    const form = document.getElementById("product_form")
    const productType = document.getElementById("productType").value
    const properties = getProductProperty(productType)
    removePrevInputs(form)
    addCurrInputs(form, properties)
    addDescription(form, properties)
    prevProperties = properties
}

function getProductProperty(productType)
{
    if (productType === "DVD")
    {
        return ["size"]
    }
    else if (productType === "Book")
    {
        return ["weight"]
    }
    else if (productType === "Furniture")
    {
        return ["height", "width", "length"]
    }
}

function removePrevInputs(form)
{
    for (let i = 0; i < prevProperties.length; i++)
    {
        const breaks = document.getElementsByClassName("break")
        for (let i = 0; i < breaks.length; i++)
        {
            form.removeChild(breaks[i])
        }
        form.removeChild(document.getElementById(prevProperties[i] + "-label"))
        form.removeChild(document.getElementById(prevProperties[i]))
    }
    form.removeChild(document.getElementById("description"))
}

function addCurrInputs(form, properties)
{

    for (let i = 0; i < properties.length; i++)
    {
        const currInput = document.createElement("input")
        const inputLabel = document.createElement("label")
        const br = document.createElement("br")
        inputLabel.setAttribute("for", properties[i])
        inputLabel.setAttribute("id", properties[i] + "-label")
        inputLabel.innerText = getLabel(properties[i])
        currInput.setAttribute("id", properties[i])
        currInput.setAttribute("name", properties[i])
        currInput.setAttribute("type", "number")
        currInput.setAttribute("min", "0")
        currInput.setAttribute("step", ".01")
        currInput.setAttribute("placeholder", properties[i][0].toUpperCase() + properties[i].slice(1)
    )
        br.setAttribute("class", "break")
        form.append(br)
        form.append(inputLabel);
        form.append(currInput);
    }
}

function getLabel(property)
{
    switch (property)
    {
        case "size":
            return "Size (MB)"
        case "weight":
            return "Weight (KG)"
        case "length":
            return "Length (CM)"
        case "width":
            return "Width (CM)"
        case "height":
            return "Height (CM)"
    }
}

function addDescription(form, properties)
{
    const description = document.createElement("p")
    const descriptionProperty = properties.length !== 1? "dimensions" : properties[0]
    description.innerText = "Please, provide " + descriptionProperty
    description.setAttribute("id", "description")
    form.append(description)
}

function validateInput(event)
{
    let inputsId = getInputsId()
    for (let i = 0; i < inputsId.length; i++)
    {
        const labelText = document.getElementById(inputsId[i] + "-label").innerText
        if (document.getElementById(inputsId[i]).value === "")
        {
            document.getElementById("notification").innerText = "Please, submit required data"
            document.getElementById(inputsId[i] + "-label").innerText = labelText.split("*")[0] + " *"
            event.preventDefault()
            return;
        }
        document.getElementById(inputsId[i] + "-label").innerText = labelText.split("*")[0]
    }
    validateSKU(event)
}

function validateSKU(event)
{
    for (let i = 0; i < x.length; i++)
    {
        let inputSku = document.getElementById("sku").value
        if (x[i]["sku"] === inputSku)
        {
            document.getElementById("notification").innerText = "Please, provide a unique SKU"
            event.preventDefault()
            return;
        }
    }
}

function getInputsId()
{
    let inputsId = ["sku", "name", "price"]
    for (let i = 0; i < prevProperties.length; i++)
    {
        inputsId.push(prevProperties[i])
    }
    return inputsId
}

function isAlphanumeric(str) {
    return /^[a-zA-Z0-9]+$/.test(str);
}