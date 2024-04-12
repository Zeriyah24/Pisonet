<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin.css"> <!-- Link the custom CSS file -->
</head>
<body>
    <?php include 'header.php'; ?> <!-- Include the header -->
    <?php include 'sidebar.php'; ?> <!-- Include the sidebar -->

    <div class="container-fluid content" style=" margin-top: 100px;">
        <div class="container1.
            <h3>PC 1</h3>
            <p>Coin Count: 100</p> <!-- Replace 100 with the actual coin count -->
            <button type="button" class="btn btn-primary">Reset Count</button><br><br>
            <button type="button" class="btn btn-danger">Force Close</button><br><br>
            <button type="button" class="btn btn-success">Credit</button><br><br>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Script for toggling sidebar -->
    <script>
        function toggleSidebar() {
            $('.sidebar').toggleClass('active');
        }
    </script>
</body>
</html>
