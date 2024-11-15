document.addEventListener('DOMContentLoaded', () => {

    // Submit rating via AJAX
    document.getElementById('ratingForm').addEventListener('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        fetch('rate.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('ratingMessage').textContent = data.message;
        })
        .catch(error => console.error('Error:', error));
    });

    // Submit comment via AJAX
    document.getElementById('commentForm').addEventListener('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        fetch('comment.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Append the new comment dynamically
            let newComment = document.createElement('div');
            newComment.classList.add('comment');
            newComment.textContent = data.comment;
            document.getElementById('commentsList').prepend(newComment);

            // Clear the form after submission
            document.getElementById('commentForm').reset();
        })
        .catch(error => console.error('Error:', error));
    });
});
