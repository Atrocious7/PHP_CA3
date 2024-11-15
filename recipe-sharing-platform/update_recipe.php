<?php
require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $recipe_id = $_POST['recipe_id'];
    $new_description = $_POST['newDescription'];

    // Update query
    $query = "UPDATE recipes SET description = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $new_description, $recipe_id);

    if ($stmt->execute()) {
        echo "Description updated successfully.";
    } else {
        echo "Error updating description.";
    }

    $stmt->close();
    $conn->close();
}
?>
