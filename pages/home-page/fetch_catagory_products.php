<?php
// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'My_Ecom_Website';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Get category ID from the request
$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;

$sql = "SELECT p.id, p.product_name, p.product_price, p.product_img, p.product_rating 
        FROM products p
        INNER JOIN category_product cp ON p.id = cp.product_id
        WHERE cp.category_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $category_id);
$stmt->execute();
$result = $stmt->get_result();

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($products);

$conn->close();
?>
