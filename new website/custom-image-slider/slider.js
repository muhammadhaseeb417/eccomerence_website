const images = document.querySelectorAll('.slider__image');
const itemName = document.getElementById('item-name');
const itemPrice = document.getElementById('item-price');
let currentIndex = 1; // Start with the second image as the center

// Function to update image classes and the corresponding name and price
function updateSlider() {
    images.forEach((img, index) => {
        if (index === currentIndex) {
            img.classList.add('large');
            img.classList.remove('small');
            // Update the product name and price in the slider
            itemName.textContent = img.getAttribute('data-name');
            itemPrice.textContent = img.getAttribute('data-price');
        } else {
            img.classList.add('small');
            img.classList.remove('large');
        }
    });
}

// Event listeners for left and right arrows
document.getElementById('left-arrow').addEventListener('click', () => {
    currentIndex = (currentIndex === 0) ? images.length - 1 : currentIndex - 1;
    updateSlider();
});

document.getElementById('right-arrow').addEventListener('click', () => {
    currentIndex = (currentIndex === images.length - 1) ? 0 : currentIndex + 1;
    updateSlider();
});

// Initial call to set the correct image sizes and details
updateSlider();
