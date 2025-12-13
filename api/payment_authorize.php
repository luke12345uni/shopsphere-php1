<?php
header("Content-Type: application/json");

// Only allow POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        "status" => "error",
        "message" => "Method not allowed"
    ]);
    exit;
}

// Read JSON input
$input = json_decode(file_get_contents("php://input"), true);

$amount = $input['amount'] ?? null;
$user_id = $input['user_id'] ?? null;
$method = $input['method'] ?? 'card';

if ($amount === null) {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "Missing amount"
    ]);
    exit;
}

// Fake payment logic — ALWAYS APPROVED
$response = [
    "status" => "approved",
    "message" => "Payment approved (test mode)",
    "transaction_id" => uniqid("txn_"),
    "amount" => (float)$amount,
    "method" => $method,
    "user_id" => $user_id,
    "timestamp_utc" => gmdate("Y-m-d\TH:i:s\Z")
];

echo json_encode($response);
