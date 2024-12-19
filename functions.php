<?php

function storeMessage($name, $email, $rating, $message) {

    if (!preg_match('/^[A-Za-zÀ-ÖØ-öø-ÿ]+\s[A-Za-zÀ-ÖØ-öø-ÿ]+$/u', $name)) {
        return "Name must include first and last name.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email address.";
    }

    if (!is_numeric($rating) || $rating < 1 || $rating > 5) {
        return "Rating must be a number between 1 and 5.";
    }

    if (mb_strlen(trim($message), 'UTF-8') < 15) {
        return "Message must be at least 15 characters long.";
    }

    $maskedEmail = maskEmail($email);
    $maskedName = maskName($name);

    $sanitized_message = [
        "name" => htmlspecialchars($maskedName),
        "email" => htmlspecialchars($maskedEmail),
        "rating" => (int)$rating,
        "message" => htmlspecialchars($message),
    ];

    $existing_messages = [];
    if (filesize("messages.json") > 0) {
        $existing_messages = json_decode(file_get_contents("messages.json"), true);
    }

    foreach ($existing_messages as $existing_message) {
        if ($existing_message['name'] === $sanitized_message['name'] &&
            $existing_message['email'] === $sanitized_message['email'] &&
            $existing_message['message'] === $sanitized_message['message']) {
                return "";
        }
    }

    array_push($existing_messages, $sanitized_message);

    $encoded_data = json_encode($existing_messages, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    if (!file_put_contents("messages.json", $encoded_data, LOCK_EX)) {
        return "Error storing message.";
    } else {
        return "success";
    }
}

function getMessages() {
    if (filesize("messages.json") == 0) {
        return [];
    }
    return array_reverse(json_decode(file_get_contents("messages.json"), true));
}

function maskEmail($email){
    $prefix = strpos($email, '@');
    $sufix = substr($email, 0, $prefix);
    $domainPart = substr($email, $prefix);

    $maskedName =     substr($sufix, 0, 1) 
                    . str_repeat('*', max(0, strlen($sufix) -2)) 
                    . substr($sufix, -1);

    return $maskedName . $domainPart;
}

function maskName($name) {
    $name_parts = explode(' ', $name);
    
    $first_name = $name_parts[0];
    $masked_first_name = substr($first_name, 0, 1) 
                        . str_repeat('*', max(0, strlen($first_name)));

    $last_name = $name_parts[1];
    $masked_last_name = substr($last_name, 0, 1) 
                       . str_repeat('*', max(0, strlen($last_name)));
    return $masked_first_name . ' ' . $masked_last_name;
}

?>
