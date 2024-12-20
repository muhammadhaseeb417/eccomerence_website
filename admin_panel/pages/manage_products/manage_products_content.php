<h1>Manage Products</h1>

<table id="products-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Image</th>
            <th>Rating</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <!-- Dynamic rows will be inserted here -->
    </tbody>
</table>

<div id="loading-spinner" style="display: none;">
        <p>Loading...</p>
    </div>

<script>
    // Fetch products from the API
    function fetchProducts() {
        fetch('http://localhost/my_website/pages/home-page/fetch_products.php')
            .then(response => response.json())
            .then(data => {
                const tableBody = document.querySelector('#products-table tbody');
                tableBody.innerHTML = '';
                data.forEach(product => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${product.id}</td>
                        <td>${product.product_name}</td>
                        <td>${product.product_price}</td>
                        <td><img src="${product.product_img}" alt="Product Image" style="width: 50px; height: auto;"></td>
                        <td>${product.product_rating}</td>
                        <td>
                            <button onclick="editProduct(${product.id})">Edit</button>
                            <button onclick="deleteProduct(${product.id})">Delete</button>
                        </td>
                    `;
                    tableBody.appendChild(row);
                });
            });
    }

    // Edit a product
    function editProduct(id) {
    const newName = prompt('Enter new product name:');
    const newPrice = prompt('Enter new product price:');
    const newRating = prompt('Enter new product rating:');

    if (newName && newPrice && newRating) {
        const changeImage = confirm('Do you want to change the product image?');

        if (changeImage) {
            // Create a file input element (hidden initially)
            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.accept = 'image/*';
            fileInput.style.display = 'none'; // Hide the file input

            // Add listener for file selection
            fileInput.addEventListener('change', function () {
                const file = fileInput.files[0];
                if (file) {
                    console.log("File selected:", file); // Debugging log
                    const formData = new FormData();
                    formData.append('id', id);
                    formData.append('product_name', newName);
                    formData.append('product_price', newPrice);
                    formData.append('product_rating', newRating);
                    formData.append('product_img', file);

                    // Send data to the back-end
                    fetch('http://localhost/my_website/admin_panel/pages/manage_products/edit_product.php', {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => response.text())
                        .then(data => {
                            alert(data);
                            fetchProducts(); // Refresh product list
                        })
                        .catch(error => {
                            alert('Error: ' + error.message);
                        });
                } else {
                    console.log("No file selected"); // Debugging log
                }
            });

            // Create a button or clickable area for the user to trigger the file input
            const triggerButton = document.createElement('button');
            triggerButton.textContent = 'Choose New Image';
            document.body.appendChild(triggerButton);

            // When the user clicks the button, the file input is triggered
            triggerButton.addEventListener('click', function () {
                fileInput.click(); // Open file dialog
                triggerButton.remove(); // Remove the button after use
            });
        } else {
            // Update product without changing the image
            fetch('http://localhost/my_website/admin_panel/pages/manage_products/edit_product.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id, product_name: newName, product_price: newPrice, product_rating: newRating })
            })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    fetchProducts(); // Refresh product list
                });
        }
    }
}




    // Delete a product
    function deleteProduct(id) {
        if (confirm('Are you sure you want to delete this product?')) {
            fetch('http://localhost/my_website/admin_panel/pages/manage_products/delete_product.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id })
            })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    fetchProducts();
                });
        }
    }

    // Load products on page load
    fetchProducts();
</script>
