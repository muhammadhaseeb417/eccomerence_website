<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "My_Ecom_Website";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_POST['id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_rating = $_POST['product_rating'];

    $sql = "UPDATE products SET product_name='$product_name', product_price='$product_price', product_rating='$product_rating'";

    // Check if a new image was uploaded
    if (!empty($_FILES['product_img']['name'])) {
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/my_website/assets/img/";
        $unique_name = uniqid() . basename($_FILES["product_img"]["name"]);
        $target_file = $target_dir . $unique_name;
        $image_path = "/my_website/assets/img/" . $unique_name;

        if (move_uploaded_file($_FILES["product_img"]["tmp_name"], $target_file)) {
            $sql .= ", product_img='$image_path'";
        } else {
            echo "Error uploading file.";
            exit;
        }
    }

    $sql .= " WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully";
    } else {
        echo "Error updating product: " . $conn->error;
    }

    $conn->close();
}
?>
