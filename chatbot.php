<?php
header('Content-Type: application/json');
$OPENAI_API_KEY = "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";
$data = json_decode(file_get_contents("php://input"), true);
$userMessage = $data["message"];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/chat/completions");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer " . $OPENAI_API_KEY
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
    "model" => "gpt-3.5-turbo",
    "messages" => [
        ["role" => "system", "content" => "You are a helpful support assistant for the website PetGlidee.com. Answer in a friendly and clear tone."],
        ["role" => "user", "content" => $userMessage]
    ]
]));
$response = curl_exec($ch);
curl_close($ch);
echo $response;
?>
