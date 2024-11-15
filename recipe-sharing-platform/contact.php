
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <!-- Bootstrap CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link header.html -->
    
    <?php include '../recipe-sharing-platform/nav.html'; ?>
</head>
<body>
<style>
    .contact-form {
        padding-top: 2rem;
        padding-bottom: 2rem;
        background-color: #f8f9fa;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
    }
</style>
<div class="container contact-form">
    <h1 class="text-center">Contact Us</h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="mailto:tarunmishra2006@gmail.com?subject=Contact%20Form%20Submission" method="post" enctype="text/plain">
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message:</label>
                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send</button>
                <button type="reset" class="btn btn-secondary">Clear</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS and Popper.js for form interaction -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.11/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

