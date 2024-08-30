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

$sql = "DELETE FROM materials WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $material_id);

if ($stmt->execute()) {
    header("Location: materials.php?course_id=$course_id");
    exit;
} else {
    echo "<p>Error: " . $stmt->error . "</p>";
}

$stmt->close();
$conn->close();
?>
