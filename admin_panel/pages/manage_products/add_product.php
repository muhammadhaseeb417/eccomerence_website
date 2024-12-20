<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "My_Ecom_Website";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the product details
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$product_rating = $_POST['product_rating'];

// Handle the uploaded file
$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/my_website/assets/img/";
$unique_name = uniqid() . basename($_FILES["product_img"]["name"]);
$target_file = $target_dir . $unique_name;
$image_path = "/my_website/assets/img/" . $unique_name;

if (move_uploaded_file($_FILES["product_img"]["tmp_name"], $target_file)) {
    // File uploaded successfully; insert into the database
    $sql = "INSERT INTO products (product_name, product_price, product_img, product_rating) VALUES ('$product_name', '$product_price', '$image_path', '$product_rating')";

    if ($conn->query($sql) === TRUE) {
        echo "Product added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Error uploading file.";
}

$conn->close();
?>
