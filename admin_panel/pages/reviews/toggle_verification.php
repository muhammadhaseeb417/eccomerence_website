<?php
$data = json_decode(file_get_contents('php://input'), true);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "My_Ecom_Website";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $data['id'];
$verified = $data['verified'];

$sql = "UPDATE reviews SET verified=$verified WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Review verification status updated successfully";
} else {
    echo "Error updating verification status: " . $conn->error;
}

$conn->close();
?>
