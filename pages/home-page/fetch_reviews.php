<?php
header('Content-Type: application/json');

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

// Corrected query with actual column names based on your new reviews table structure
$sql = "SELECT id, name, rating, review_count AS reviewCount, review_date AS reviewDate, review_text AS reviewText, verified AS verified FROM reviews";

$result = $conn->query($sql);

$reviews = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }
}

echo json_encode($reviews);

$conn->close();
?>
