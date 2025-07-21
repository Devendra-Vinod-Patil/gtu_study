<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAD LE BETAA GTU - Materials</title>
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

    <section class="resources">
        <h2>Materials for <?php
            include 'database.php';
            $semester_id = isset($_GET['semester_id']) ? (int)$_GET['semester_id'] : 0;
            $stmt = $conn->prepare("SELECT name FROM semesters WHERE id = ?");
            $stmt->bind_param("i", $semester_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $semester_name = $result->fetch_assoc()['name'] ?? "Unknown Semester";
            echo htmlspecialchars($semester_name);
            $stmt->close();
        ?></h2>
        <div class="resources">
            <?php
            $stmt = $conn->prepare("SELECT title, type, url FROM materials WHERE semester_id = ?");
            $stmt->bind_param("i", $semester_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='resource'><a href='" . htmlspecialchars($row['url']) . "' target='_blank'>" . htmlspecialchars($row['title']) . " (" . htmlspecialchars($row['type']) . ")</a></div>";
                }
            } else {
                echo "<p>No materials available for this semester.</p>";
            }
            $stmt->close();
            $conn->close();
            ?>
        </div>
    </section>
 <footer>
        <div class="footer-content">
            <p>&copy; 2025 PAD LE BETA GTU. All rights reserved.</p>
            <p>Designed to empower GTU students with quality resources.</p>
            <div class="footer-links">
              
            </div>
        </div>
    </footer>
    <script src="script.js"></script>
</body>
</html>