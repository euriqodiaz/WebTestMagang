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

$course_id = $_GET['course_id'] ?? '';
if (empty($course_id)) {
    die("Course ID is required.");
}

$conn = new mysqli('localhost', 'root', '', 'online_course');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $embed_link = $_POST['embed_link'];

    $stmt = $conn->prepare("INSERT INTO materials (course_id, title, description, embed_link) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $course_id, $title, $description, $embed_link);

    if ($stmt->execute()) {
        header("Location: materials.php?course_id=$course_id");
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
    <title>Add Material</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="dashboard">
        <header>
            <h1>Add Material to Course</h1>
            <a href="materials.php?course_id=<?php echo htmlspecialchars($course_id); ?>" class="btn btn-back">Back to Materials</a>
        </header>
        <div class="content">
            <form action="" method="post">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" required>

                <label for="description">Description</label>
                <textarea id="description" name="description" required></textarea>

                <label for="embed_link">Embed Link</label>
                <input type="text" id="embed_link" name="embed_link" required>

                <button type="submit">Add Material</button>
            </form>
        </div>
        <footer>
            <p>&copy; 2024 Online Course Dashboard</p>
        </footer>
    </div>
</body>
</html>
