<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reviews</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        .verified {
            background-color: #c8e6c9;
        }
        .unverified {
            background-color: #ffcdd2;
        }
    </style>
</head>
<body>
    <h1>Manage Reviews</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Rating</th>
                <th>Review Text</th>
                <th>Review Count</th>
                <th>Review Date</th>
                <th>Verified</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="reviews-table">
            <!-- Dynamic rows will be inserted here -->
        </tbody>
    </table>

    <script>
        // Fetch reviews from the existing endpoint
        function fetchReviews() {
            fetch('http://localhost/my_website/pages/home-page/fetch_reviews.php')
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.getElementById('reviews-table');
                    tableBody.innerHTML = '';
                    data.forEach(review => {
                        const row = document.createElement('tr');
                        row.className = review.verified == "1" ? 'verified' : 'unverified';
                        row.innerHTML = `
                            <td>${review.id}</td>
                            <td>${review.name}</td>
                            <td>${review.rating}</td>
                            <td>${review.reviewText}</td>
                            <td>${review.reviewCount}</td>
                            <td>${review.reviewDate}</td>
                            <td>
                                <input type="checkbox" ${review.verified == "1" ? 'checked' : ''} 
                                    onchange="toggleVerification(${review.id}, this.checked)">
                            </td>
                            <td>
                                <button onclick="deleteReview(${review.id})">Delete</button>
                            </td>
                        `;
                        tableBody.appendChild(row);
                    });
                });
        }

        // Toggle verification status
        function toggleVerification(id, verified) {
            fetch('toggle_verification.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id, verified: verified ? 1 : 0 })
            })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    fetchReviews();
                });
        }

        // Delete a review
        function deleteReview(id) {
            if (confirm('Are you sure you want to delete this review?')) {
                fetch('delete_review.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id })
                })
                    .then(response => response.text())
                    .then(data => {
                        alert(data);
                        fetchReviews();
                    });
            }
        }

        // Fetch reviews on page load
        fetchReviews();
    </script>
</body>
</html>
