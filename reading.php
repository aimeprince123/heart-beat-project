
<?php
require_once __DIR__ . '/config.php';

header('Content-Type: application/json');

$stmt = $pdo->query(
    "SELECT bpm, created_at
     FROM heartbeat_readings
     ORDER BY id DESC
     LIMIT 1"
);

echo json_encode(
    $stmt->fetch(PDO::FETCH_ASSOC) ?: [
        'bpm' => 0,
        'created_at' => null
    ]
);
