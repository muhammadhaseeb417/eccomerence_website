const $images = $('.slider__image');
const $itemName = $('#item-name');
const $itemPrice = $('#item-price');
let currentIndex = 1; // Start with the second image as the center

// Function to update image classes and the corresponding name and price
function updateSlider() {
    // Remove all classes first
    $images.each(function () {
        $(this).removeClass('large').addClass('small');
    });

    // Add class to the current image with a slight delay to trigger smooth animation
    requestAnimationFrame(() => {
        $images.eq(currentIndex).removeClass('small').addClass('large');

        // Update the product name and price
        const $currentImage = $images.eq(currentIndex);
        $itemName.text($currentImage.data('name'));
        $itemPrice.text($currentImage.data('price'));
    });
}

// Event listeners for left and right arrows
$('#left-arrow').on('click', function () {
    currentIndex = (currentIndex === 0) ? $images.length - 1 : currentIndex - 1;
    updateSlider();
});

$('#right-arrow').on('click', function () {
    currentIndex = (currentIndex === $images.length - 1) ? 0 : currentIndex + 1;
    updateSlider();
});

// Initial call to set the correct image sizes and details
updateSlider();
