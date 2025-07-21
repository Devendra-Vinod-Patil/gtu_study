<?php
include 'database.php';
$stmt = $conn->prepare("SELECT content FROM dynamic_content WHERE section = ?");
$section = "hero";
$stmt->bind_param("s", $section);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    echo $row['content'];
} else {
    echo "<h4>Welcome to PAD LE BETAA GTU! Your one-stop platform for GTU study resources.<p><br>";
}
$stmt->close();
$conn->close();
?>