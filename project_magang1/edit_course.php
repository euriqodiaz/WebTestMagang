<?php
$conn = new mysqli('localhost', 'root', '', 'online_course');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];

    $sql = "UPDATE courses SET title='$title', description='$description', duration='$duration' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT * FROM courses WHERE id=$id";
$result = $conn->query($sql);
$course = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Kursus</title>
</head>
<body>
    <h1>Edit Kursus</h1>
    <form method="post" action="">
        <label>Judul:</label><br>
        <input type="text" name="title" value="<?php echo $course['title']; ?>" required><br>
        <label>Deskripsi:</label><br>
        <textarea name="description" required><?php echo $course['description']; ?></textarea><br>
        <label>Durasi:</label><br>
        <input type="text" name="duration" value="<?php echo $course['duration']; ?>" required><br>
        <input type="submit" value="Update">
    </form>
    <a href="index.php">Kembali ke Daftar Kursus</a>
</body>
</html>
