<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAD LE BETAA GTU - Study Materials</title>
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

    <main>
        <section class="semesters">
            <h2>Available Study Materials</h2>
            <div class="semester-list">
                <?php
                include 'database.php';
                $result = $conn->query("SELECT id, name FROM semesters");
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='semester'>" . htmlspecialchars($row['name']) . " - <a href='materials.php?semester_id=" . $row['id'] . "'>View Materials</a></div>";
                }
                $conn->close();
                ?>
            </div>
            <h3>Explore semester-wise resources including notes, papers, and more to support your studies.<h3>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <p>© 2025 PAD LE BETA GTU. All rights reserved.</p>
            <p>Designed to empower GTU students with quality resources.</p>
            <div class="footer-links">
                <!-- <a href="about.php">About</a>
                <a href="contact.php">Contact</a>
                <a href="study_materials.php">Study Materials</a> -->
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>