let priceRangeSlider = document.getElementById("price-range-slider");
let lowerPrice = document.getElementById("lower-price");
let upperPrice = document.getElementById("upper-price");
let minPriceInput = document.getElementById("prix_u_min");
let maxPriceInput = document.getElementById("prix_u_max");

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
