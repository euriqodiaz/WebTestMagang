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

// Database connection
$conn = new mysqli('localhost', 'root', '', 'online_course');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch courses
$sql = "SELECT id, title, description, duration FROM courses";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Course Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="dashboard">
        <header>
            <h1>Course Dashboard</h1>
            <a href="index.php?logout=true" class="btn">Logout</a>
            <a href="public_materials.php" class="btn btn-public" target="_blank">Visit Public View</a>
        </header>
        <div class="content">
            <a href="add_course.php" class="btn btn-add">Add New Course</a>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Duration</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['title']); ?></td>
                                <td><?php echo htmlspecialchars($row['description']); ?></td>
                                <td><?php echo htmlspecialchars($row['duration']); ?></td>
                                <td>
                                    <a href="materials.php?course_id=<?php echo $row['id']; ?>" class="btn">Add Materials/View</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <footer>
            <p>&copy; 2024 Online Course Dashboard</p>
        </footer>
    </div>
</body>
</html>

<?php
$conn->close();
?>
