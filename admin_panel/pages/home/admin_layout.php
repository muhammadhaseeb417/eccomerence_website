<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="http://localhost/my_website/admin_panel/pages/home/home_style.css">
</head>

<body>
<div class="sidebar">
    <h2>Admin Panel</h2>
    <ul>
        <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">
            <a href="http://localhost/my_website/admin_panel/pages/dashboard/dashboard.php">Dashboard</a>
        </li>
        <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'manage_products.php' ? 'active' : ''; ?>">
            <a href="http://localhost/my_website/admin_panel/pages/manage_products/manage_products.php">All Products</a>
        </li>
        <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'add_new_product.php' ? 'active' : ''; ?>">
            <a href="http://localhost/my_website/admin_panel/pages/add_new_product/add_new_product.php">Add New Product</a>
        </li>
        <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'add_catagory.php' ? 'active' : ''; ?>">
            <a href="http://localhost/my_website/admin_panel/pages/add_catagory/add_catagory.php">Add Catagory</a>
        </li>
        <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'reviews.php' ? 'active' : ''; ?>">
            <a href="http://localhost/my_website/admin_panel/pages/reviews/reviews.php">Reviews</a>
        </li>
    </ul>
</div>
    <div class="container">
        <?php include($page); ?>
    </div>
</body>

</html>
