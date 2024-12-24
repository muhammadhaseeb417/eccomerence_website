<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "My_Ecom_Website";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch the latest 4 products
$sql = "SELECT product_name, product_price, product_img, product_rating FROM products ORDER BY created_at DESC LIMIT 4";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    echo json_encode($products); // Return JSON response
} else {
    echo json_encode([]);
}

$conn->close();
?>
