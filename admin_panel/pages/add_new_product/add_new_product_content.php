<div id="loading-spinner" style="display: none;">
        <p>Loading...</p>
    </div>


<div class="form-container">
    <center>
    <h1 >Add New Product</h1>
    </center>
    <form id="add-product-form" enctype="multipart/form-data">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required>

        <label for="product_price">Price:</label>
        <input type="text" id="product_price" name="product_price" required>

        <label for="product_img">Product Image:</label>
        <input type="file" id="product_img" name="product_img" accept="image/*" required>

        <label for="product_rating">Rating:</label>
        <input type="number" step="0.1" id="product_rating" name="product_rating" required>

        <button type="submit">Add Product</button>
    </form>

</div>


<script>
    document.getElementById('add-product-form').addEventListener('submit', function (e) {
        e.preventDefault();

        // Show loading spinner
        const spinner = document.getElementById('loading-spinner');
        spinner.style.display = 'block';

        const formData = new FormData(this);

        // Send form data to the server
        fetch('http://localhost/my_website/admin_panel/pages/manage_products/add_product.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                spinner.style.display = 'none'; // Hide spinner
                alert(data); // Show success or error message
                if (data.includes('Product added successfully')) {
                    location.reload(); // Reload the page
                }
            })
            .catch(error => {
                spinner.style.display = 'none'; // Hide spinner
                alert('Error: ' + error.message);
            });
    });
</script>