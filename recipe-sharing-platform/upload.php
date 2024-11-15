<?php
require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if title, description, and image are set
    if (isset($_POST['title']) && isset($_POST['description']) && isset($_FILES['image'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $image = $_FILES['image']['name'];
        
        // Debug: Output the values being inserted
        var_dump($title, $description, $image);
        
        $upload_dir = 'uploads/' . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir);

        // Prepare the SQL query
        $query = "INSERT INTO recipes (title, description, image) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $title, $description, $image);
        $stmt->execute();
        
        header('Location: index.php');
    } else {
        echo "Required fields are missing!";
    }
}



include 'nav.html'; ?>
<!-- Styling and Decoration Start -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h2>Upload a New Recipe</h2>
                </div>
                <div class="card-body">
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" name="title" class="form-control" required pattern="[A-Za-z0-9\s]+" title="Letters, numbers, and spaces only" placeholder="Enter recipe title">
                        </div>

                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea name="description" class="form-control" required pattern="[A-Za-z0-9\s]+" title="Letters, numbers, and spaces only" rows="4" placeholder="Enter a short description"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="image">Upload Image:</label>
                            <input type="file" name="image" class="form-control-file" required accept=".jpg, .jpeg, .png">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-3">Upload Recipe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Styling and Decoration End -->

<?php include 'templates/footer.php'; ?>
