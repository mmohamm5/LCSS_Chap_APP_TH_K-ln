<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $topic = trim($_POST['topic_name']);
    if (!empty($topic)) {
        $stmt = $conn->prepare("INSERT INTO topics (name) VALUES (?)");
        $stmt->bind_param("s", $topic);
        $stmt->execute();
        $stmt->close();
    }
}
header("Location: index.php");
exit();

