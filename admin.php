<?php
include 'database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_material'])) {
    $semester_id = (int)($_POST['semester_id'] ?? 0);
    $title = trim($_POST['title'] ?? '');
    $type = trim($_POST['type'] ?? '');
    $url = trim($_POST['url'] ?? '');
    if ($semester_id && $title && $type && $url && filter_var($url, FILTER_VALIDATE_URL)) {
        $stmt = $conn->prepare("INSERT INTO materials (semester_id, title, type, url) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $semester_id, $title, $type, $url);
        $stmt->execute();
        $stmt->close();
        header("Location: admin.php?success=1");
        exit();
    } else {
        $error = "Please fill out all fields correctly.";
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_content'])) {
    $section = trim($_POST['section'] ?? '');
    $content = trim($_POST['content'] ?? '');
    if ($section && $content) {
        $stmt = $conn->prepare("INSERT INTO dynamic_content (section, content) VALUES (?, ?) ON DUPLICATE KEY UPDATE content = ?");
        $stmt->bind_param("sss", $section, $content, $content);
        $stmt->execute();
        $stmt->close();
        header("Location: admin.php?success=2");
        exit();
    } else {
        $error = "Please provide valid content.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAD LE BETA GTU - Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
     <div class="logo">  <img src="logo.jpg.jpg">PAD LE BETAA GTU</div>
        <nav>
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="study_materials.php">Study Materials</a>
            <a href="contact.php">Contact</a>
            <a href="admin.php">Admin</a>
        </nav>
    </header>

    <section class="admin">
        <h2>Admin Panel</h2>
        <?php if (isset($error)) echo "<p style='color: #FF4500;'>$error</p>"; ?>
        <?php if (isset($_GET['success'])) echo "<p style='color: #4682B4;'>Action successful!</p>"; ?>
        <h3>Add Study Material</h3>
        <form action="admin.php" method="POST">
            <select name="semester_id" required>
                <option value="">Select Semester</option>
                <?php
                $result = $conn->query("SELECT id, name FROM semesters");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['name']) . "</option>";
                }
                ?>
            </select>
            <input type="text" name="title" placeholder="Material Title" required>
            <input type="text" name="type" placeholder="Material Type (e.g., Notes, Paper)" required>
            <input type="url" name="url" placeholder="Material URL" required>
            <button type="submit" name="add_material">Add Material</button>
        </form>

        <h3>Update Hero Content</h3>
        <form action="admin.php" method="POST">
            <input type="hidden" name="section" value="hero">
            <textarea name="content" placeholder="Hero Section Content" required><?php
                $stmt = $conn->prepare("SELECT content FROM dynamic_content WHERE section = ?");
                $section = "hero";
                $stmt->bind_param("s", $section);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($row = $result->fetch_assoc()) {
                    echo htmlspecialchars($row['content']);
                } else {
                    echo "Welcome to PAD LE BETA GTU! Your one-stop platform for GTU study resources.";
                }
                $stmt->close();
                $conn->close();
            ?></textarea>
            <button type="submit" name="update_content">Update Content</button>
        </form>
    </section>
      <footer>
        <div class="footer-content">
            <p>&copy; 2025 PAD LE BETA GTU. All rights reserved.</p>
            <p>Designed to empower GTU students with quality resources.</p>
            <div class="footer-links">
            
            </div>
        </div>
    </footer>

</body>
</html>