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


        <?php
        foreach ($messages as $value) {
            $name_parts = explode(' ', $value["name"]);
            $formatted_name = $name_parts[0] . ' ' . strtoupper(substr(end($name_parts), 0, 1)) . '.';

            $email_parts = explode('@', $value["email"]);
            $masked_email = substr($email_parts[0], 0, 2) . str_repeat('*', strlen($email_parts[0]) - 2) . '@' . $email_parts[1];

            $rating_asterisks = str_repeat('*', $value["rating"]);
        ?>
            <div class="message">
                <p class="name">Name: <?php echo $formatted_name; ?></p>
                <p class="from">Email: <?php echo $masked_email; ?></p>
                <p class="rating">Rating: <?php echo $rating_asterisks; ?></p>
                <p class="text">
                    <span>Message:</span>
                    <span><?php echo $value["message"]; ?></span>
                </p>
            </div>
        <?php
        }
        ?>
    </div>





</body>
</html>