<?php
require 'includes/db.php';
$recipe_id = $_GET['id'];
$query = "SELECT * FROM recipes WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $recipe_id);
$stmt->execute();
$recipe = $stmt->get_result()->fetch_assoc();

include 'templates/header.php';
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img src="uploads/<?= htmlspecialchars($recipe['image']) ?>" class="img-fluid" alt="<?= htmlspecialchars($recipe['title']) ?>">
        </div>
        <div class="col-md-6">
            <h2><?= htmlspecialchars($recipe['title']) ?></h2>
            <p id="recipeDescription"><?= htmlspecialchars($recipe['description']) ?></p>

            <!-- Update Recipe Section -->
            <button id="editButton" class="btn btn-warning mt-2">Edit Description</button>

            <form id="updateForm" style="display:none;" method="POST">
                <div class="form-group">
                    <label for="newDescription">New Description:</label>
                    <textarea name="newDescription" id="newDescription" rows="3" class="form-control" required></textarea>
                </div>
                <input type="hidden" name="recipe_id" value="<?= $recipe['id'] ?>">
                <button type="submit" class="btn btn-primary mt-2">Update Recipe</button>
            </form>

            <!-- Rate This Recipe Section -->
            <h4 class="mt-5">Rate This Recipe</h4>
            <form id="ratingForm">
                <div class="form-group">
                    <label for="rating">Your Rating:</label>
                    <select name="rating" class="form-control" required>
                        <option value="">Choose Rating</option>
                        <option value="1">1 Star</option>
                        <option value="2">2 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="5">5 Stars</option>
                    </select>
                </div>
                <input type="hidden" name="recipe_id" value="<?= $recipe['id'] ?>">
                <button type="submit" class="btn btn-primary mt-2">Submit Rating</button>
            </form>

            <!-- Comments Section -->
            <h4 class="mt-5">Comments</h4>
            <form id="commentForm">
                <textarea name="comment" rows="3" class="form-control" required></textarea>
                <input type="hidden" name="recipe_id" value="<?= $recipe['id'] ?>">
                <button type="submit" class="btn btn-primary mt-2">Submit Comment</button>
            </form>
        </div>
    </div>
</div>

<!-- AJAX Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        $(document).ready(function() {
    $('#ratingForm').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: 'submit_rating.php', // Update with your rating handling script
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
            $('#ratingMessage').html('<div class="alert alert-success">Rating submitted successfully!</div>');
            $('#ratingForm')[0].reset();
            },
            error: function() {
            $('#ratingMessage').html('<div class="alert alert-danger">Error submitting rating.</div>');
        }
        });
    });
});


        // Handle comment submission
        $('#commentForm').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: 'submit_comment.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#commentsList').prepend('<div class="comment p-2 mb-2 bg-light border rounded">' + response + '</div>');
                    $('#commentForm')[0].reset(); // Reset the form
                },
                error: function() {
                    alert('Error submitting comment.');
                }
            });
        });
    });
    $(document).ready(function() {
        // Toggle edit form when "Edit Description" is clicked
        $('#editButton').on('click', function() {
            $(this).hide();  // Hide the "Edit" button
            $('#updateForm').show();  // Show the update form
            $('#newDescription').val($('#recipeDescription').text());  // Set the current description in the text area
        });

        // Handle the update recipe form submission
        $('#updateForm').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: 'update_recipe.php',  // Script to handle the update query
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#recipeDescription').text($('#newDescription').val());  // Update the displayed description
                    $('#updateForm').hide();  // Hide the update form
                    $('#editButton').show();  // Show the edit button again
                    alert('Recipe updated successfully!');
                },
                error: function() {
                    alert('Error updating recipe.');
                }
            });
        });
    });
</script>

<?php include 'templates/footer.php'; ?>
