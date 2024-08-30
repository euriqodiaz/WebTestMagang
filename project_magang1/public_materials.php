<?php
$conn = new mysqli('localhost', 'root', '', 'online_course');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all courses
$course_stmt = $conn->prepare("SELECT id, title FROM courses");
$course_stmt->execute();
$course_result = $course_stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Course Materials</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="dashboard">
        <header>
        <h1>Pusat Materi Terlengkap</h1>
            <h2>All Course Materials</h2>
        </header>
        <div class="content">
            <?php while ($course = $course_result->fetch_assoc()): ?>
                <h2><?php echo htmlspecialchars($course['title']); ?></h2>
                <?php
                // Fetch materials for the current course
                $materials_stmt = $conn->prepare("SELECT title, description, embed_link FROM materials WHERE course_id = ?");
                $materials_stmt->bind_param("i", $course['id']);
                $materials_stmt->execute();
                $materials_result = $materials_stmt->get_result();
                ?>
                <div class="table-container">
                    <?php if ($materials_result->num_rows > 0): ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($material = $materials_result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($material['title']); ?></td>
                                        <td><?php echo htmlspecialchars($material['description']); ?></td>
                                        <td>
                                            <a href="<?php echo htmlspecialchars($material['embed_link']); ?>" class="btn btn-watch" target="_blank">See More</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No materials available for this course.</p>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
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
