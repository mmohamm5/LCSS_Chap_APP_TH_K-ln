<?php
include 'db.php';

$topic_id = $_GET['id'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = trim($_POST['message']);
    if (!empty($message)) {
        $stmt = $conn->prepare("INSERT INTO messages (topic_id, message) VALUES (?, ?)");
        $stmt->bind_param("is", $topic_id, $message);
        $stmt->execute();
        $stmt->close();
    }
}

$topic_stmt = $conn->prepare("SELECT name FROM topics WHERE id = ?");
$topic_stmt->bind_param("i", $topic_id);
$topic_stmt->execute();
$topic_stmt->bind_result($topic_name);
$topic_stmt->fetch();
$topic_stmt->close();

$msg_stmt = $conn->prepare("SELECT message, created_at FROM messages WHERE topic_id = ? ORDER BY created_at DESC");
$msg_stmt->bind_param("i", $topic_id);
$msg_stmt->execute();
$msg_result = $msg_stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($topic_name) ?> - Chat</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="chat-container">
    <h2><?= htmlspecialchars($topic_name) ?></h2>
    <form method="post">
        <input type="text" name="message" id="message-input" placeholder="Type your message..." required>
        <button type="submit">Send</button>
    </form>
    <hr>
    <div>
        <?php while($row = $msg_result->fetch_assoc()): ?>
            <p><strong><?= $row['created_at'] ?>:</strong> <?= htmlspecialchars($row['message']) ?></p>
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>

