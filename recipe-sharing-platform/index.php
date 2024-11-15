<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Sharing Platform</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="style.css"> -->

    <style>
        /* Basic Styles for the Body and Container */
        
body {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f9fa;
    overflow-x: hidden;
}

/* Navbar Styles */
.navbar {
    background-color: #343a40;
}

.navbar-brand, .navbar-nav .nav-link {
    color: #fff;
    transition: color 0.3s;
}

.navbar-brand:hover, .navbar-nav .nav-link:hover {
    color: red;
}

/* Side Navigation Panel Styles */
.sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #343a40;
    overflow-x: hidden;
    transition: width 0.5s ease;
    padding-top: 60px;
}


.sidenav a {
    padding: 10px 8px 10px 32px;
    text-decoration: none;
    font-size: 18px;
    color: #fff;
    display: block;
    transition: color 0.3s ease;
}

.sidenav a:hover {
    color: #ffc107;
}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}

/* Open/Close Animation for Sidenav */
.menu {
    font-size: 30px;
    cursor: pointer;
    padding: 15px;
    color: #343a40;
}

/* Main Content Styling */
.main-content {
    transition: transform 0.5s ease;
}

/* Card Styles */
.card {
    border: none;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

.card-body {
    padding: 15px;
}

.thumbnail-img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

/* Button Styles */
.btn-primary {
    background-color: #343a40;
    border-color: #343a40;
    transition: background-color 0.3s ease, border-color 0.3s ease;
}

.btn-primary:hover {
    background-color: #ffc107;
    border-color: #ffc107;
}

/* Typography */
h1, h2 {
    color: #343a40;
}

.text-center {
    margin-bottom: 1.5rem;
}

/* Responsive Design Adjustments */
@media (max-width: 768px) {
    .thumbnail-img {
        height: 150px;
    }

    /* Make sidenav full-width for small screens */
    .sidenav {
        width: 100%;
    }

    .main-content {
        margin-left: 0;
    }
}

    </style>
</head>
<body>

    <!-- Navbar Start -->
    <?php include 'nav.html'; ?>
    <!-- Navbar End -->


    <!-- Main Content -->
    <div class="container mt-5 main-content">
        <h1 class="text-center mb-4">Browse Recipes</h1>

        <!-- Thumbnails Start -->
        <div class="row">
            <!-- Recipe 1 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <a href="recipe_list/cake.html">
                        <img src="images/cake.jpg" class="card-img-top thumbnail-img" alt="Recipe 1">
                        <div class="card-body text-center">
                            <h5 class="card-title">Cake</h5>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Recipe 2 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <a href="recipe_list/chicken.html">
                        <img src="images/chicken.jpg" class="card-img-top thumbnail-img" alt="Recipe 2">
                        <div class="card-body text-center">
                            <h5 class="card-title">Grilled Chicken</h5>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Recipe 3 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <a href="recipe_list/stir-fry.html">
                        <img src="images/Vegetable-Stir-Fry-2.jpg" class="card-img-top thumbnail-img" alt="Recipe 3">
                        <div class="card-body text-center">
                            <h5 class="card-title">Stir Fry</h5>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- Thumbnails End -->

        <!-- My Uploads Section -->
        <h2 class="text-center mt-5">My Uploads</h2>
        <div class="row">
            <?php
            require 'includes/db.php'; // Include the database connection

            // Fetch all uploaded recipes from the database
            $query = "SELECT id, title, description, image FROM recipes"; // No user filter
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if there are results
            if ($result->num_rows > 0) {
                // Output data for each uploaded recipe
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4 mb-4">
                        <div class="card">
                            <a href="recipe.php?id=' . htmlspecialchars($row['id']) . '">
                                <img src="uploads/' . htmlspecialchars($row['image']) . '" class="card-img-top thumbnail-img" alt="' . htmlspecialchars($row['title']) . '">
                                <div class="card-body text-center">
                                    <h5 class="card-title">' . htmlspecialchars($row['title']) . '</h5>
                                </div>
                            </a>
                        </div>
                    </div>';
                }
            } else {
            echo '<div class="col-12 text-center"><p>No uploaded recipes found.</p></div>';
            }
    ?>
</div>
        </div>

    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.11/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
