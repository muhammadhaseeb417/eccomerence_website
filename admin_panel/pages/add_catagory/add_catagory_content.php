<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "My_Ecom_Website");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_id = $_POST['category_id'];
    $product_ids = isset($_POST['products']) ? $_POST['products'] : [];
    
    // First delete existing entries for this category
    $delete_sql = "DELETE FROM category_product WHERE category_id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    
    // Insert new category-product relationships
    if (!empty($product_ids)) {
        $insert_sql = "INSERT INTO category_product (category_id, product_id) VALUES (?, ?)";
        $stmt = $conn->prepare($insert_sql);
        foreach ($product_ids as $product_id) {
            $stmt->bind_param("ii", $category_id, $product_id);
            $stmt->execute();
        }
    }
    
    echo "<div class='alert alert-success'>Category products updated successfully!</div>";
}

// Get all categories
$categories_query = "SELECT id, name FROM categories";
$categories_result = mysqli_query($conn, $categories_query);

// Get all products
$products_query = "SELECT id, product_name, product_img FROM products";
$products_result = mysqli_query($conn, $products_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category Content</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-left: 250px;
        }
        
        .product-card {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
        }
        .product-image {
            max-width: 150px;
            height: auto;
        }
        .product-card.selected {
            border-color: #0d6efd;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Add Products to Category</h2>
        
        <form method="POST" action="" id="categoryForm">
            <div class="mb-3">
                <label for="category" class="form-label">Select Category:</label>
                <select name="category_id" id="category" class="form-select" required>
                    <option value="">Choose a category...</option>
                    <?php while ($category = mysqli_fetch_assoc($categories_result)) { ?>
                        <option value="<?php echo $category['id']; ?>">
                            <?php echo htmlspecialchars($category['name']); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="row" id="productsContainer">
                <?php while ($product = mysqli_fetch_assoc($products_result)) { ?>
                    <div class="col-md-3">
                        <div class="product-card" id="card-<?php echo $product['id']; ?>">
                            <img src="<?php echo htmlspecialchars($product['product_img']); ?>" 
                                 alt="<?php echo htmlspecialchars($product['product_name']); ?>" 
                                 class="product-image mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       name="products[]" 
                                       value="<?php echo $product['id']; ?>" 
                                       id="product<?php echo $product['id']; ?>">
                                <label class="form-check-label" for="product<?php echo $product['id']; ?>">
                                    <?php echo htmlspecialchars($product['product_name']); ?>
                                </label>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Save Category Products</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('category').addEventListener('change', function() {
            const categoryId = this.value;
            if (!categoryId) return;

            // Reset all checkboxes and card styling
            document.querySelectorAll('.product-card').forEach(card => {
                card.classList.remove('selected');
            });
            document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                checkbox.checked = false;
            });

            // Fetch current category products
            fetch(`http://localhost/my_website/admin_panel/pages/add_catagory/get_category_products.php?category_id=${categoryId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(productId => {
                        const checkbox = document.getElementById(`product${productId}`);
                        if (checkbox) {
                            checkbox.checked = true;
                            document.getElementById(`card-${productId}`).classList.add('selected');
                        }
                    });
                });
        });

        // Add click handler for product cards
        document.querySelectorAll('.product-card').forEach(card => {
            card.addEventListener('click', function(e) {
                if (e.target.type === 'checkbox') return; // Don't handle checkbox clicks
                
                const checkbox = this.querySelector('input[type="checkbox"]');
                checkbox.checked = !checkbox.checked;
                this.classList.toggle('selected', checkbox.checked);
            });
        });

        // Handle checkbox changes
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const card = this.closest('.product-card');
                card.classList.toggle('selected', this.checked);
            });
        });
    </script>
</body>
</html>