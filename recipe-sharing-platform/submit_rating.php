<?php
require 'includes/db.php';

$recipe_id = $_POST['recipe_id'];
$rating = $_POST['rating'];


$rating_query = "INSERT INTO ratings (recipe_id, rating) VALUES (?, ?)";
$stmt = $conn->prepare($rating_query);
$stmt->bind_param("ii", $recipe_id, $rating);
if (!$stmt->execute()) {
    echo json_encode([
        'error' => 'Error inserting rating: ' . $stmt->error
    ]);
    exit;
}

echo json_encode([
    'success' => true,
    'message' => 'Rating submitted successfully!'
]);
