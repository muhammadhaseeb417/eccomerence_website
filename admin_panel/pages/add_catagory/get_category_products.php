<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "My_Ecom_Website");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['category_id'])) {
    $category_id = (int)$_GET['category_id'];
    
    // Get products for this category
    $query = "SELECT product_id FROM category_product WHERE category_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row['product_id'];
    }
    
    header('Content-Type: application/json');
    echo json_encode($products);
}
?>