<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); 

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "My_Ecom_Website";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

$sql = "SELECT * FROM products";

$result = $conn->query($sql);

$products = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

echo json_encode($products);

$conn->close();
?>
