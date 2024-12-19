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

   // if (mb_strlen(trim($message), 'UTF-8') < 15) {
   //     return "Message must be at least 15 characters long.";
   // }

    $sanitized_message = [
        "name" => htmlspecialchars($name),
        "email" => htmlspecialchars($email),
        "rating"=> (int)$rating,
        "message" => htmlspecialchars($message),
    ];

    if (filesize("messages.json") == 0) {
        $data_to_save = [$sanitized_message];
    } else {
        $old_records = json_decode(file_get_contents("messages.json"), true);
        array_push($old_records, $sanitized_message);
        $data_to_save = $old_records;
    }

    $encoded_data = json_encode($data_to_save, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

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
?>
