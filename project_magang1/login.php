<?php
session_start();

// Hardcoded credentials for login
$valid_username = 'adminganteng';
$valid_password = 'kakgem999';

// Check if the user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: index.php");
    exit;
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['loggedin'] = true;
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="dashboard">
        <header>
            <h1>Admin Login</h1>
        </header>
        <div class="content">
            <?php if (isset($error)): ?>
                <p class="error"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <form action="" method="post">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Login</button>
            </form>

            <!-- Button to access public page -->
            <div class="public-link">
                <a href="public_materials.php" class="btn btn-public" target="_blank">View Public Materials</a>
            </div>
        </div>
        <footer>
            <p>&copy; 2024 Online Course Dashboard</p>
        </footer>
    </div>
</body>
</html>
