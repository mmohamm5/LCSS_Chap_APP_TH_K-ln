<?php
include 'db.php';

$sql = "SELECT * FROM topics ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chat App</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="chat-container">
    <h2 class="topics-heading">Chat Topics</h2>
    <div class="topics-list">
        <?php while($row = $result->fetch_assoc()): ?>
            <a href="topic_details.php?id=<?= $row['id'] ?>">
                <?= htmlspecialchars($row['name']) ?>
            </a>
        <?php endwhile; ?>
    </div>

    <h3 class="new-chat-topic">Start New Chat</h3>
    <form action="add_topic.php" method="post" class="new-chat-input">
        <input type="text" name="topic_name" id="new-chat-topic-input" placeholder="Enter new topic..." required>
        <button type="submit">Create</button>
    </form>
</div>
</body>
</html>

