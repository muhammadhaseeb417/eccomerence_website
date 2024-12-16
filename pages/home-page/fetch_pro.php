<?php
// Database connection
$host = 'localhost';
$dbname = 'My_Ecom_Website';
$username = 'root';
$password = '';

try {
    // Establish connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch all products
    $stmt = $conn->prepare("SELECT * FROM products");
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check if data exists
    if (!empty($products)) {
        // Loop through each product
        foreach ($products as $product) {
            echo '<div class="product-card">';
            echo '<img src="' . htmlspecialchars($product['product_img']) . '" alt="Product Image" class="product-img">';
            echo '<h2 class="product-name">' . htmlspecialchars($product['product_name']) . '</h2>';
            echo '<p class="product-price">Price: $' . htmlspecialchars($product['product_price']) . '</p>';
            echo '<p class="product-rating">Rating: ' . htmlspecialchars($product['product_rating']) . ' / 5</p>';
            echo '</div>';
        }
    } else {
        echo '<p>No products available.</p>';
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

