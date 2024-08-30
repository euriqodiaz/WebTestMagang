<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'online_course');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the course ID from the query string
$course_id = $_GET['course_id'] ?? '';
if (empty($course_id)) {
    die("Course ID is required.");
}

// Fetch course details
$course_sql = $conn->prepare("SELECT title FROM courses WHERE id = ?");
$course_sql->bind_param("i", $course_id);
$course_sql->execute();
$course_result = $course_sql->get_result();
$course = $course_result->fetch_assoc();

if (!$course) {
    die("Course not found.");
}

// Fetch materials
$materials_sql = $conn->prepare("SELECT title, description, embed_link FROM materials WHERE course_id = ?");
$materials_sql->bind_param("i", $course_id);
$materials_sql->execute();
$materials_result = $materials_sql->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Materials</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="dashboard">
        <header>
            <h1>Materials for <?php echo htmlspecialchars($course['title']); ?></h1>
            <a href="index.php" class="btn">Back to Dashboard</a>
        </header>
        <div class="content">
            <div class="table-container">
                <?php if ($materials_result->num_rows > 0): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Embed Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $materials_result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                                    <td><a href="<?php echo htmlspecialchars($row['embed_link']); ?>" target="_blank">Watch</a></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No materials found for this course.</p>
                <?php endif; ?>
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
