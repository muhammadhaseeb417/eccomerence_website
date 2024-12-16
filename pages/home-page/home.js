$(document).ready(function () {
    // Welcome message using localStorage
    const userName = localStorage.getItem('username');

    // Feedback button click alert
    $("#feedbackBtn").on("click", function () {
        alert("Feedback has been sent successfully");
    });

    // Hover effect for feedback button
    const $feedbackButton = $('.btn-primary');
    $feedbackButton.on('mouseenter', function () {
        $(this).css({
            backgroundColor: 'hsl(34, 69%, 47%)',
            borderColor: 'hsl(35, 41%, 15%)'
        });
    });

    $feedbackButton.on('mouseleave', function () {
        $(this).css({
            backgroundColor: '',
            borderColor: ''
        });
    });

    // Fetch and display reviews using AJAX
    const $reviewsWrapper = $("#reviews-wrapper");
    $.ajax({
        url: 'http://localhost/my_website/pages/home-page/fetch_reviews.php', // Update this path to match your PHP script's location
        method: 'GET',
        success: function (reviews) {
            // Clear previous reviews
            $reviewsWrapper.empty();

            // Append the fetched reviews
            reviews.forEach(function (review) {
                const reviewCard = `
                <customer-review-card 
                    customer-name="${review.name}" 
                    customer-rating="${review.rating}" 
                    review-text="${review.reviewText}" 
                    ${review.verified ? 'verified' : ''}>
                </customer-review-card>
            `;
                $reviewsWrapper.append(reviewCard);
            });
        },
        error: function (xhr, status, error) {
            console.error('Failed to fetch reviews:', error);
        }
    });



    // Handle review form submission using AJAX
    // $("#reviewForm").on("submit", function (event) {
    //     event.preventDefault();  // Prevent form from submitting normally

    //     // Collect the review data
    //     let reviewData = {
    //         name: $("#name").val(),
    //         rating: parseFloat($("#rating").val()),
    //         reviewDate: new Date().toLocaleDateString("en-US"),  // Current date
    //         reviewText: $("#review").val(),
    //         verified: $("#verifiedPurchase").is(":checked")
    //     };

    //     // Send the data to the server via AJAX
    //     $.ajax({
    //         url: 'http://localhost:3000/api/review', // Backend URL to add a new review
    //         method: 'POST',
    //         contentType: 'application/json',
    //         data: JSON.stringify(reviewData),
    //         success: function (response) {
    //             $("#reviewForm")[0].reset();
    //             location.reload(); // Refresh the page after review submission
    //         },
    //         error: function (xhr, status, error) {
    //             console.error('Failed to submit review:', error);
    //             alert("An error occurred while submitting the review.");
    //         }
    //     });
    // });
});
