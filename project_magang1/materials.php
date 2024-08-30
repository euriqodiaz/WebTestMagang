<?php
$course_id = $_GET['course_id'] ?? '';
if (empty($course_id)) {
    die("Course ID is required.");
}

$conn = new mysqli('localhost', 'root', '', 'online_course');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch course details
$course_stmt = $conn->prepare("SELECT title FROM courses WHERE id = ?");
$course_stmt->bind_param("i", $course_id);
$course_stmt->execute();
$course_result = $course_stmt->get_result();
$course = $course_result->fetch_assoc();

if (!$course) {
    die("Course not found.");
}

// Fetch materials
$material_stmt = $conn->prepare("SELECT id, title, description, embed_link FROM materials WHERE course_id = ?");
$material_stmt->bind_param("i", $course_id);
$material_stmt->execute();
$materials = $material_stmt->get_result();
$has_materials = $materials->num_rows > 0;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Materials for <?php echo htmlspecialchars($course['title']); ?></title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="dashboard">
        <header>
            <h1>Materials for <?php echo htmlspecialchars($course['title']); ?></h1>
            <a href="index.php" class="btn btn-back">Back to Dashboard</a>
        </header>
        <div class="content">
            <!-- Conditionally display the "Add New Material" button -->
            <?php if (!$has_materials): ?>
                <a href="add_material.php?course_id=<?php echo htmlspecialchars($course_id); ?>" class="btn btn-add">Add New Material</a>
            <?php endif; ?>
            
            <div class="table-container">
                <?php if ($has_materials): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Embed Link</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $materials->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                                    <td><a href="<?php echo htmlspecialchars($row['embed_link']); ?>" target="_blank">Watch</a></td>
                                    <td>
                                        <a href="edit_material.php?id=<?php echo $row['id']; ?>&course_id=<?php echo $course_id; ?>" class="btn btn-edit">Edit</a>
                                        <a href="delete_material.php?id=<?php echo $row['id']; ?>&course_id=<?php echo $course_id; ?>" class="btn btn-delete">Delete</a>
                                    </td>
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
