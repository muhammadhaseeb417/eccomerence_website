<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding: 0;
        }

        .dashboard-container {
            text-align: center;
            width: 100%;
        }

        .cover {
            width: 100%;
            height: 300px; /* Adjust height as needed */
            background-color: white;
            overflow: hidden;
        }

        .cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 20px;
            
        }

        .content {
            background: white;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.6);
            margin: -50px auto 0 auto;
            width: 1300;
            border-radius: 10px;
        }

        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 10px;
            margin-top: 60px;
        }

        p {
            color: #666;
            font-size: 16px;
            margin-bottom: 20px;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Cover Section -->
        <div class="cover">
            <img src="/my_website/assets/img/cover_image.png" alt="Cover Image">
        </div>

        <!-- Content Section -->
        <div class="content">
            <h1>Welcome to the Dashboard</h1>
            <p>This dashboard allows you to manage products, reviews, and other aspects of your website.</p>
            <a href="http://localhost/my_website/pages/home-page/" target="_blank">
                <button>Go to My Website</button>
            </a>
        </div>
    </div>

    <script>
        // Function to navigate to your website's homepage
        function navigateToWebsite() {
            window.location.href = 'http://localhost/my_website/pages/home-page/';
        }
    </script>
</body>
</html>
