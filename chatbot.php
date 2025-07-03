<?php
// Allow CORS from any origin
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

// ✅ Correct API Key
$OPENAI_API_KEY = "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";

// Read user message safely
$data = json_decode(file_get_contents("php://input"), true);
$userMessage = isset($data["message"]) ? $data["message"] : "Hello!";

// Make OpenAI API request
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
        ["role" => "system", "content" => "You are a helpful, fun, and friendly support assistant for PetGlidee.com. Use emojis and casual tone when replying to customers."],
        ["role" => "user", "content" => $userMessage]
    ]
]));

$response = curl_exec($ch);
curl_close($ch);

// Send response back to frontend
echo $response;
?>

