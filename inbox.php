<?php
    require "functions.php";
    $messages = getMessages();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox</title>
</head>
<body>
    <h1> Inbox </h1>
    <div class="message-wrapper">
        <p class="message-nr">
            <?php echo count($messages) ?> Messages in Inbox
        </p>

        <?php foreach ($messages as $value): ?>
            <div class="message">
                <p class="name">Name: <?php echo htmlspecialchars($value["name"]); ?></p>
                <p class="from">Email: <?php echo htmlspecialchars($value["email"]); ?></p>
                <p class="rating">Rating: <?php echo str_repeat('*', $value["rating"]); ?></p>
                <p class="text">
                    <span>Message:</span>
                    <span><?php echo nl2br(htmlspecialchars($value["message"])); ?></span>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
