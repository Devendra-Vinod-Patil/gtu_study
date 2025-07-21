<!DOCTYPE html
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAD LE BETAA GTU - Home</title>
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

    <section class="hero">
        <h1>Ultimate Study Platform for GTU Students</h1>
        <h3>Access free, organized study materials, notes, and resources for Computer, CS, CSE, and IT semesters.</h3>
        <?php include 'dynamic_content.php'; ?>
        <button onclick="exploreSemesters()" >Explore Semesters</button>
    </section>

    <section class="semesters">
        <h2>Select a Semester</h2>
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