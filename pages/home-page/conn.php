<?php
$conn = new mysqli("localhost", "root", "", "My_Ecom_Website");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br>";

// Test query execution
$result = $conn->query("SELECT * FROM products");

if ($result === false) {
    die("Query error: " . $conn->error);
}

// Check if data exists
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Product Name: " . htmlspecialchars($row['product_name']) . "<br>";
        echo "Product Price: " . htmlspecialchars($row['product_price']) . "<br>";
        echo "Product Image: " . htmlspecialchars($row['product_img']) . "<br>";
        echo "Product Rating: " . htmlspecialchars($row['product_rating']) . "<br><hr>";
    }
} else {
    echo "No data found in the products table.";
}

$conn->close();
?>
