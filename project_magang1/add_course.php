<?php
session_start();

// Hardcoded credentials for login
$valid_username = 'adminganteng';
$valid_password = 'kakgem999';

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Logout functionality
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}

$conn = new mysqli('localhost', 'root', '', 'online_course');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];

    $stmt = $conn->prepare("INSERT INTO courses (title, description, duration) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $description, $duration);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Course</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="dashboard">
        <header>
            <h1>Add New Course</h1>
            <a href="index.php" class="btn btn-back">Back to Dashboard</a>
        </header>
        <div class="content">
            <form action="" method="post">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" required>

                <label for="description">Description</label>
                <textarea id="description" name="description" required></textarea>

                <label for="duration">Duration</label>
                <input type="text" id="duration" name="duration" required>

                <button type="submit">Add Course</button>
            </form>
        </div>
        <footer>
            <p>&copy; 2024 Online Course Dashboard</p>
        </footer>
    </div>
</body>
</html>
