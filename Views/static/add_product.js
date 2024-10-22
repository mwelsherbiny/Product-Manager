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
    form.removeChild(document.getElementById("property-form"))
}

function addCurrInputs(form, properties)
{
    const propertyForm =  document.createElement("div")
    propertyForm.setAttribute("id", "property-form")
    for (let i = 0; i < properties.length; i++)
    {
        const currInput = document.createElement("input")
        const inputLabel = document.createElement("label")
        inputLabel.setAttribute("for", properties[i])
        inputLabel.setAttribute("id", properties[i] + "-label")
        inputLabel.innerText = getLabel(properties[i])
        currInput.setAttribute("id", properties[i])
        currInput.setAttribute("name", "property")
        currInput.setAttribute("type", "number")
        currInput.setAttribute("min", "0")
        currInput.setAttribute("step", ".01")
        currInput.setAttribute("placeholder", properties[i][0].toUpperCase() + properties[i].slice(1)
        )
        const propertyError = document.createElement("span")
        propertyError.setAttribute("class", "property-error warning")
        propertyError.setAttribute("id", properties[i] + "-error")
        propertyForm.append(inputLabel);
        propertyForm.append(currInput);
        propertyForm.append(propertyError);
        const br = document.createElement("br")
        br.setAttribute("class", "break")
        propertyForm.append(br)
    }
    addDescription(propertyForm, properties)
    form.append(propertyForm)
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

function addDescription(propertyForm, properties)
{
    const description = document.createElement("p")
    const descriptionProperty = properties.length !== 1? "dimensions" : properties[0]
    description.innerText = "Please, provide " + descriptionProperty
    description.setAttribute("id", "description")
    propertyForm.append(description)
}

async function validateInput(event)
{
    event.preventDefault()
    const property = getProperty()

    fetch(
        "/api.php/products/add/", {
            method: "POST",
            body: JSON.stringify({
                "sku": document.getElementById("sku").value,
                "name": document.getElementById("name").value,
                "price": document.getElementById("price").value,
                "type": document.getElementById("productType").value,
                "property": property
            })
        }
    ).then(response => {
        return response.json()
    }).then(data => {
        const errorsCount = Object.keys(data).length
        if (errorsCount > 0)
        {
            displayErrors(data)
        }
        else
        {
            window.location.href = "/"
        }
    })
}

function getProperty()
{
    const property = document.getElementsByName("property")
    if (document.getElementsByName("property").length === 3)
    {
        return property[0].value + "x" +  property[1].value + "x" +  property[2].value
    }
    else
    {
        return property[0].value
    }
}

function displayErrors(errors) {
    allInputErrors = ["sku", "name", "price", "empty"]
    allInputErrors.forEach(error => {
        document.getElementById(error + "-error").innerText = ""
    })
    const propertyErrors = document.getElementsByClassName("property-error")
    for (let i = 0; i < propertyErrors.length; i++)
    {
        propertyErrors.item(i).innerText = ""
    }
    Object.keys(errors).forEach(error => {
        if (!(error === "property"))
        {
            document.getElementById(error + "-error").innerText = errors[error]
        }
    })
    for (let i = 0; i < propertyErrors.length; i++)
    {
        const inputId = propertyErrors[i].getAttribute("id").split("-")[0]
        if (!document.getElementById(inputId).value)
        {
            propertyErrors.item(i).innerText = " Please enter property"
        }
    }
}