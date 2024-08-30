<?php
$material_id = $_GET['id'] ?? '';
$course_id = $_GET['course_id'] ?? '';
if (empty($material_id) || empty($course_id)) {
    die("Material ID and Course ID are required.");
}

$conn = new mysqli('localhost', 'root', '', 'online_course');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $embed_link = $_POST['embed_link'];

    $stmt = $conn->prepare("UPDATE materials SET title = ?, description = ?, embed_link = ? WHERE id = ?");
    $stmt->bind_param("ssss", $title, $description, $embed_link, $material_id);

    if ($stmt->execute()) {
        header("Location: materials.php?course_id=$course_id");
        exit;
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

$sql = "SELECT * FROM materials WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $material_id);
$stmt->execute();
$result = $stmt->get_result();
$material = $result->fetch_assoc();

if (!$material) {
    die("Material not found.");
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Material</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="dashboard">
        <header>
            <h1>Edit Material</h1>
        </header>
        <div class="content">
            <form action="" method="post">
                <input type="hidden" name="course_id" value="<?php echo htmlspecialchars($course_id); ?>">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($material['title']); ?>" required>

                <label for="description">Description</label>
                <textarea id="description" name="description" required><?php echo htmlspecialchars($material['description']); ?></textarea>

                <label for="embed_link">Embed Link</label>
                <input type="text" id="embed_link" name="embed_link" value="<?php echo htmlspecialchars($material['embed_link']); ?>" required>

                <button type="submit">Update Material</button>
            </form>
        </div>
        <footer>
            <p>&copy; 2024 Online Course Dashboard</p>
        </footer>
    </div>
</body>
</html>
