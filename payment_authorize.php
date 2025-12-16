<?php
header('Content-Type: application/json');

// Only allow POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'status' => 'error',
        'message' => 'Method not allowed'
    ]);
    exit;
}

// Read JSON body
$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

if (!isset($data['amount'])) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => 'Missing amount'
    ]);
    exit;
}

// Fake payment logic — ALWAYS APPROVED
$response = [
    'status' => 'approved',
    'message' => 'Payment approved (test mode)',
    'amount' => (float)$data['amount'],
    'transaction_id' => uniqid('txn_'),
    'timestamp' => date('c')
];

echo json_encode($response);
exit;
