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

$sql = "DELETE FROM reviews WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Review deleted successfully";
} else {
    echo "Error deleting review: " . $conn->error;
}

$conn->close();
?>
