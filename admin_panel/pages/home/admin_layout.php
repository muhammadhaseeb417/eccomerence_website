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
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="http://localhost/my_website/admin_panel/pages/manage_products/manage_products.php">Manage Products</a></li>
            <li><a href="orders.php">Orders</a></li>
            <li><a href="users.php">Users</a></li>
            <li><a href="settings.php">Settings</a></li>
        </ul>
    </div>
    <div class="container">
        <?php include($page); ?>
    </div>
</body>

</html>
