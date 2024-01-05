// price range in product prices filter
let priceRangeSlider = document.getElementById("price-range-slider");
let lowerPrice = document.getElementById("lower-price");
let upperPrice = document.getElementById("upper-price");
let minPriceInput = document.getElementById("prix_u_min");
let maxPriceInput = document.getElementById("prix_u_max");
if (
    priceRangeSlider &&
    lowerPrice &&
    upperPrice &&
    minPriceInput &&
    maxPriceInput
) {
    noUiSlider.create(priceRangeSlider, {
        start: [0, 1000], // Initial values
        connect: true, // Display a range between the handles
        range: {
            min: 0,
            max: 1000,
        },
    });
    // Update the displayed prices when the slider is moved
    priceRangeSlider.noUiSlider.on("update", function (values) {
        lowerPrice.textContent = values[0];
        upperPrice.textContent = values[1];

        minPriceInput.value = values[0];
        maxPriceInput.value = values[1];
    });
}

// enable or disable the filter button
let submitFilter = document.getElementById("submitFilter");
let formInputs =
    submitFilter.parentElement.parentElement.querySelectorAll("input");

if (submitFilter && formInputs) {
    Array.from(formInputs).forEach((e) => {
        e.addEventListener("keyup", function (event) {
            event.target.value !== ""
                ? submitFilter.removeAttribute("disabled")
                : submitFilter.setAttribute("disabled", "true");
        });
    });
}

// show the product image while create or update the product

function showImage(input) {
    let productImg = document.getElementById("productImg");
    if (input.files) {
        let reader = new FileReader();
        reader.onload = function (e) {
            productImg.src = e.target.result;
        };

        reader.readAsDataURL(input.files[0]);
    } else {
        productImg.src = "";
    }
}

//modify the commande status

