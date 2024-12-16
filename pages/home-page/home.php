<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Shop</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">


    <!-- RemixIcon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">

    <!-- Your Custom CSS -->
    <link rel="stylesheet" href="/my_website/pages/home-page/style.css">

    <!-- Your Custom JS -->
    <script src="/my_website/pages/home-page/custom/product-widgets/product-widget.js" defer></script>
    <script src="/my_website/pages/home-page/custom/product-widgets/product_card_latest.js" defer></script>
    <script src="/my_website/pages/home-page/custom/review/review_card.js" defer></script>

    <!-- Slider Features -->
    <script src="/my_website/pages/home-page/custom/custom-image-slider/slider.js" defer></script>

    <link rel="stylesheet" href="/my_website/pages/home-page/custom/custom-image-slider/slider.css">



    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




</head>

<body>


<?php
session_start();
?>



            <!-- ###################################  PHP form submittion code #################################### -->

            <?php
// Database connection settings
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "My_Ecom_Website"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $conn->real_escape_string($_POST['name']);
    $rating = $conn->real_escape_string($_POST['rating']);
    $review = $conn->real_escape_string($_POST['review']);
    
    // Always set verified_purchase to 0 (false) as per your request
    $verified = 0;

    // SQL query to insert data into the reviews table
    $sql = "INSERT INTO reviews (name, rating, review_count, review_date, review_text, verified) 
            VALUES ('$name', '$rating', 1, NOW(), '$review', '$verified')"; 

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Store success message in session
        $_SESSION['review_success'] = true;
        
        // Redirect to prevent form resubmission
        header("Location: " . $_SERVER['PHP_SELF']);
        // echo "<p id='successMessage' style='color: green;'>Review submitted successfully!</p>";
        exit();
        
    } else {
        echo "<p id='errorMessage' style='color: red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}

// Close connection
$conn->close();
?>


<?php
    // Check for success message in session
    if (isset($_SESSION['review_success']) && $_SESSION['review_success'] === true) {
        echo "<p id='successMessage' style='color: green;'>Review submitted successfully!</p>";
        // Clear the success message
        unset($_SESSION['review_success']);
    }
    ?>


<header>
    <!-- ###################################  NAV #################################### -->
    <nav class="navbar navbar-expand-lg" id="myNavBar">
        <div class="container-fluid">
            <a href="#" class="navbar-brand">
                <img src="/my_website/assets/img/image-removebg-preview.png" alt="logo" width="140px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a href="/my_website/pages/home-page/home.php" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Men</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Women</a>
                    </li>
                    <li class="nav-item">
                        <a href="/my_website/pages/Contact Us/contact-us-page.html" class="nav-link">Contact Us</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center" id="icons">
                    <!-- Shopping Cart Icon -->
                    <a href="#" class="nav-link iconsHeader">
                        <i class="ri-shopping-cart-line navicon mx-2"></i>
                    </a>

                    <!-- Account Icon -->
                    <div class="nav-link iconsHeader position-relative">
                        <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true): ?>
                            <!-- Show user's first letter with a round div -->
                            <div class="account-icon rounded-circle bg-white text-black d-flex justify-content-center align-items-center profileIcon"
                                 style="width: 40px; height: 40px; cursor: pointer;" id="accountIcon">
                                <?php echo strtoupper(substr(htmlspecialchars($_SESSION['user_name']), 0, 1)); ?>
                            </div>

                            <!-- Dropdown for logout -->
                            <div id="accountDropdown" class="position-absolute bg-white shadow p-2 rounded"
                                 style="display: none; top: 50px; right: 0; z-index: 1000;">
                                <p class="mb-1 text-muted">Hello, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</p>
                                <a href="/my_website/pages/home-page/logout.php" class="btn btn-sm btn-danger w-100">Logout</a>
                            </div>
                        <?php else: ?>
                            <!-- Show login icon -->
                            <a href="/my_website/pages/login/login-page.html" class="nav-link  iconsHeader">
                                <i class="ri-account-circle-line navicon mx-2"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<script>
    // JavaScript to toggle dropdown
    document.addEventListener('DOMContentLoaded', () => {
        const accountIcon = document.getElementById('accountIcon');
        const accountDropdown = document.getElementById('accountDropdown');

        if (accountIcon) {
            accountIcon.addEventListener('click', () => {
                accountDropdown.style.display = accountDropdown.style.display === 'block' ? 'none' : 'block';
            });

            // Close dropdown if clicked outside
            document.addEventListener('click', (event) => {
                if (!accountIcon.contains(event.target) && !accountDropdown.contains(event.target)) {
                    accountDropdown.style.display = 'none';
                }
            });
        }
    });
</script>



    <!-- ###################################  MAIN #################################### -->
    
    <main class="main__slider">
        <div class="slider__images">
            <img src="/my_website/assets/img/clothing-5.png" alt="Clothing 5" class="slider__image small" data-name="Polo T-Shirt"
                data-price="$150">
            <img src="/my_website/assets/img/clothing-1.png" alt="Clothing 1" class="slider__image large" data-name="Core Hoodie"
                data-price="$125">
            <img src="/my_website/assets/img/clothing-2.png" alt="Clothing 2" class="slider__image small" data-name="Gucci Bag"
                data-price="$75">
        </div>

        <div class="slider__options">
            <div class="icon" id="left-arrow">
                <i class="ri-arrow-left-line arrow"></i>
            </div>

            <!-- Product name and price -->
            <div class="price__name">
                <p id="item-name">Core Hoodie</p>
                <p id="item-price">$125</p>
            </div>

            <div class="icon" id="right-arrow">
                <i class="ri-arrow-right-line arrow"></i>
            </div>
        </div>
    </main>

    <!-- ###################################  MAIN #################################### -->


    <center>
        <h2 class="headline_sale">Sale upto 40% off on these Products</h2>
    </center>
    <!-- ###################################  Main Products #################################### -->


    <div class="products-wrapper">
    <section class="featured-products">
        <h3>Featured Products</h3>
        <div id="product-container" class="product-card-container">
            <div class="products_wrapper" id="products-wrapper">
                <!-- Product cards will be dynamically loaded here -->
            </div>
        </div>
    </section>
        <!-- ###################################  Mian Products #################################### -->

        <hr class="white-line">

        <!-- ########################### both_catagorysection_and_sidebar ##################################################### -->
        <div class="both_catagorysection_and_sidebar">


            <!-- ######################### left_side_catagory_section ##################################################### -->
            <div class="catagory_and_aboutus">
                <div class="left_side_catagory_section">
                    <h2 class="headline_catagory">Category</h2>
                    <div class="catagory__section">
                        <h2 class="headline_catagory_subline">"Find Your Dream Cloth's to wear this season"</h2>

                        <ul class="catagory__list">
                            <li class="nav__item">
                                <a href="#" class="catagory__link nav__link" data-category-id="1">Best Fits</a>
                            </li>
                            <li class="nav__item">
                                <a href="#" class="catagory__link nav__link" data-category-id="2">Men</a>
                            </li>
                            <li class="nav__item">
                                <a href="#" class="catagory__link nav__link" data-category-id="3">Women</a>
                            </li>
                            <li class="nav__item">
                                <a href="#" class="catagory__link nav__link" data-category-id="4">Bags</a>
                            </li>
                        </ul>

                        <!-- #################     Selected Catagory       ############## -->
                        <div class="selected_catagory_items"></div>


                    </div>
                </div>
                <!-- ##########################################  About Us ######################################################3 -->
                <div class="about_us_section">
                    <h2 class="about_us_heading">About Us</h2>
                    <div class="about_us_section">

                        <div class="upper_about_us_section">

                            <div class="writen_about_us">
                                <h3 class="about_us_heading_sub">Who Am I ?</h3>
                                <p>I am a student at UET Lahore with a passion for web development and app development.
                                    I
                                    specialize in the MERN stack for web applications and also work with Flutter for
                                    mobile
                                    app development. <br>

                                    <br>
                                    With skills in both frontend and backend
                                    technologies, I enjoy creating efficient, user-friendly applications across
                                    platforms.
                                </p>
                            </div>

                            <img src="/my_website/assets/img/haseeb.png" alt="" width="220px" height="170px"
                                style="padding-left: 20px;padding-right: 20px;">

                        </div>

                        <div class="lower_section_about_us">
                            <button class="about_us_button">Read More</button>

                            <div class="social_links">
                                <img src="https://freepnglogo.com/images/all_img/facebook-circle-logo-png.png"
                                    alt="Facebook" style="width: 30px; height: 30px;" class="social_links_icons">
                                <img src="https://www.cdnlogo.com/logos/i/92/instagram.svg" alt="instagram"
                                    style="width: 30px; height: 30px;" class="social_links_icons">
                                <img src="https://cdn3.iconfinder.com/data/icons/basicolor-reading-writing/24/077_twitter-512.png"
                                    alt="twitter" style="width: 30px; height: 30px;" class="social_links_icons">
                                <img src="https://cdn-icons-png.flaticon.com/512/174/174863.png" alt="pinterest"
                                    style="width: 30px; height: 30px;" class="social_links_icons">

                            </div>
                        </div>

                    </div>
                </div>
                <!-- ###########################################  About Us ######################################################3 -->

            </div>



            <!-- ################################################### -->
            <div class="sidebar_latest_products">
                <h2 style="margin-top: 50px;margin-bottom: 20px;" class="headline_catagory">Latest
                    Release</h2>

                <!-- #######################   Latest Product, card ################################################### -->
                <div class="all_latest_product_list">

                    <!-- ###############################################   Latest Product's' ################################################### -->

                    <product-card-latest product-name="Leather Jacket" product-img="/my_website/assets/img/clothing-2.png"
                        product-rating="4.3" product-price="125">
                    </product-card-latest>

                    <product-card-latest product-name="Leather Jacket" product-img="/my_website/assets/img/clothing-2.png"
                        product-rating="4.3" product-price="125">
                    </product-card-latest>

                    <product-card-latest product-name="Leather Jacket" product-img="/my_website/assets/img/clothing-2.png"
                        product-rating="4.3" product-price="125">
                    </product-card-latest>

                    <product-card-latest product-name="Leather Jacket" product-img="/my_website/assets/img/clothing-2.png"
                        product-rating="4.3" product-price="125">
                    </product-card-latest>


                    <!-- #################   Latest Product's' ############################# -->
                </div>
                <!-- ##############   Latest Product, card ################################################### -->
            </div>

        </div>

        <hr class="white-line upper-margin">




        <!-- /////////////////////////////////////////Customer Review//////////////////////////////////// -->

        <center></center>
        <h2 class="headline_sale">Customer Reviews</h2>
        </center>
        <center>
            <div class="reviews_containor">
                <div class="reviews_wrapper" id="reviews-wrapper">
                    <!-- Reviews.json files contents here -->
                </div>
            </div>
        </center>


        <hr class="white-line upper-margin">

        <div class="contact_us_section">
            <h2 class="office_heading">Contact Us</h2>
            <div class="map-contactus">
                <div class="address">

                    <h4 class="contact_us_heading" style="font-weight: 700;padding-top: 20px;">Main Office</h4>
                    <p class="para_contactus">Our office is located in Baghbanpura, Lahore, where we offer a range of
                        professional services,
                        including web development, mobile app development, and other digital solutions.<br> We are
                        committed
                        to delivering high-quality, innovative services tailored to meet your needs.</p>
                </div>
                <div id="map"></div>
            </div>
        </div>

        <section class="review-form-section py-5">
            <div class="container">
                <h2 class="text-center mb-4">Leave a Review</h2>
                <form id="reviewForm" method="POST" action="home.php">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
                    </div>

                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <select class="form-select" id="rating" name="rating" required>
                            <option value="">Select Rating</option>
                            <option value="1">1 - Poor</option>
                            <option value="2">2 - Fair</option>
                            <option value="3">3 - Good</option>
                            <option value="4">4 - Very Good</option>
                            <option value="5">5 - Excellent</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="review" class="form-label">Your Review</label>
                        <textarea class="form-control" id="review" name="review" rows="5" placeholder="Write your review here..." required></textarea>
                    </div>

                    <!-- <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="verifiedPurchase" name="verifiedPurchase">
                        <label class="form-check-label" for="verifiedPurchase">
                            Verified Purchase
                        </label>
                    </div> -->

                    <button type="submit" class="btn btn-primary" id="reviewSubmitButton">Submit Review</button>
                </form>
            </div>
        </section>


        <div class="about_us_three_sections">
            <div class="logo_description">
                <img src="/my_website/assets/img/image-removebg-preview.png" alt="logo" width="150px">
                <p style="width: 200px;padding-top: 20px;">Our clothing brand delivers trendy, high-quality apparel for
                    men and
                    women,
                    blending style with comfort. </p>
            </div>

            <div class="contact_us_quick_links">
                <h2 style="margin-bottom: 20px; color: white;font-weight: 600;">Quick Links</h2>
                <div class="contact_us__menu">
                    <ul class="contact_us__list" style="list-style: none; padding-left: 0;">
                        <li class="contact_us__item">
                            <a href="#" class="nav-link">Home</a>
                        </li>
                        <li class="contact_us__item">
                            <a href="#" class="nav-link">Men</a>
                        </li>
                        <li class="contact_us__item">
                            <a href="#" class="nav-link">Women</a>
                        </li>
                        <li class="contact_us__item">
                            <a href="#" class="nav-link">Bags</a>
                        </li>
                        <li class="contact_us__item">
                            <a href="#" class="nav-link">Community</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="contact_us_send_feedback">
                <h2 style="margin-bottom: 20px; color: white;font-weight: 600;">Send Feedback</h2>
                <textarea name="feedback" id="contact_us_feedback"
                    style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;color: white;"></textarea>
                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-block" id="feedbackBtn">Send Feedback</button>
                </div>
            </div>

        </div>



    </div>

    <!-- Footer with Copyright -->
    <footer class="text-center text-white py-3 mt-5 bottom_most_footer">
        <p>&copy; 2024 Ecommerce Shop. All rights reserved.</p>
    </footer>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // Initialize the map at Shalimar Garden, Baghbanpura, Pakistan
        var map = L.map('map').setView([31.5892, 74.3883], 15); // Coordinates of Shalimar Garden

        // Add a tile layer (OpenStreetMap tiles)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Add a marker at the location
        L.marker([31.5892, 74.3883]).addTo(map)
            .bindPopup('Shalimar Garden, Baghbanpura, Lahore')
            .openPopup();

        // Functionality to resize the map
        function resizeMap(size) {
            const mapDiv = document.getElementById('map');
            if (size === 'small') {
                mapDiv.style.height = '200px';
            } else if (size === 'large') {
                mapDiv.style.height = '600px';
            }
            map.invalidateSize(); // Required for Leaflet to adjust the map after resizing
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- <script src="home.js"></script> -->

<script>
    $(document).ready(function () {
        // Fetch and display products using AJAX
        const $productsWrapper = $("#products-wrapper"); // Target the wrapper for product cards

        $.ajax({
            url: 'http://localhost/my_website/pages/home-page/fetch_products.php', 
            method: 'GET',
            success: function (products) {
                // Clear previous products
                $productsWrapper.empty();

                // Append the fetched products
                products.forEach(function (product) {
                    console.log(product)
                    console.log(product.product_rating);
                    console.log(typeof product.product_rating)
                    const productCard = `
                        <product-card 
                            product-name="${product.product_name}" 
                            product-price="${product.product_price}" 
                            product-img="${product.product_img}" 
                            product-rating="${product.product_rating}">
                        </product-card>
                    `;
            
                    $productsWrapper.append(productCard);
                });
            },
            error: function (xhr, status, error) {
                console.error('Failed to fetch products:', error);
            }
        });
    });
</script>


<script>
    // Function to hide the message after 3 seconds (3000 milliseconds)
    setTimeout(function() {
        var successMsg = document.getElementById('successMessage');
        var errorMsg = document.getElementById('errorMessage');
        if (successMsg) {
            successMsg.style.display = 'none';
        }
        if (errorMsg) {
            errorMsg.style.display = 'none';
        }
    }, 1500);
    document.getElementById("reviewForm").reset();

</script>

<script>
    document.getElementById("reviewForm").addEventListener('submit', function() {
        // The form will automatically reset after submission
        setTimeout(() => {
            this.reset();
        }, 1500);
    });
</script>


<!-- Add this somewhere in your PHP code for debugging -->
<script>
    console.log('PHP Products:', <?php echo json_encode($products); ?>);
</script>

        <!-- Your existing HTML and JS code -->
<script>
$(document).ready(function () {
    // Default category selection
    $('.catagory__link').first().addClass('active');
    loadProducts(1); // Default category ID

    // Add click event for navigation links
    $('.catagory__link').on('click', function (e) {
        e.preventDefault();

        // Reset all category links
        $('.catagory__link').removeClass('active');
        $(this).addClass('active');

        // Get the selected category ID
        const categoryId = $(this).data('category-id');
        console.log(categoryId);
        loadProducts(categoryId); // Load products for the selected category
    });

    // Load products based on category ID
    function loadProducts(categoryId) {
        const $selectedCatagoryItems = $('.selected_catagory_items');
        $selectedCatagoryItems.empty(); // Clear existing products

        // Fetch products from the backend
        $.ajax({
            url: 'http://localhost/my_website/pages/home-page/fetch_catagory_products.php', // PHP script URL
            type: 'GET',
            data: { category_id: categoryId }, // Send the category ID as data
            success: function (response) {
    const $selectedCatagoryItems = $('.selected_catagory_items');
    $selectedCatagoryItems.empty(); // Clear existing products

    if (!response || response.length === 0) {
        $selectedCatagoryItems.append('<p>No products available for this category.</p>');
    } else {
        response.forEach(product => {
            // Create a new product-card element
            const productCard = `
                <product-card 
                    product-name="${product.product_name}" 
                    product-price="${product.product_price}" 
                    product-img="${product.product_img}" 
                    product-rating="${product.product_rating}"
                </product-card>
                `;
            // Append the new product card to the container
            $selectedCatagoryItems.append(productCard);
        });
    }
},
            error: function () {
                alert('Failed to load products.');
            }
        });
    }
});

</script>

<script>
$(document).ready(function () {

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
                    review-count="${review.reviewCount}" 
                    review-date="${review.reviewDate}" 
                    review-text="${review.reviewText}" 
                    ${review.verified==1 ? 'verified' : 'unverified'}>
                </customer-review-card>
                `;
                $reviewsWrapper.append(reviewCard);
            });
        },
        error: function (xhr, status, error) {
            console.error('Failed to fetch reviews:', error);
        }
    });

});
</script>


</body>

</html>