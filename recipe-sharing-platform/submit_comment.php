<?php
require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $recipe_id = $_POST['recipe_id'];
    $comment = $_POST['comment'];

    // Insert the comment into the database (you may want to modify this based on your database structure)
    $query = "INSERT INTO comments (recipe_id, comment_text) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $recipe_id, $comment);
    
    if ($stmt->execute()) {
        echo htmlspecialchars($comment); // Return the comment to be prepended
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
