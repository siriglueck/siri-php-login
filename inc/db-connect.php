<?php
declare(strict_types=1);

require_once __DIR__ . '/../inc/bootstrap.php';

$dsn = sprintf(
    'mysql:host=%s;dbname=%s;charset=%s',
    $_ENV['DB_HOST'],     // 127.0.0.1
    $_ENV['DB_NAME'],
    $_ENV['DB_CHARSET']
);

try {
    $pdo = new PDO(
        $dsn,
        $_ENV['DB_USER'],
        $_ENV['DB_PASSWORD'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        ]
    );
} catch (PDOException $e) {
    die("DB-Fehler: " . htmlspecialchars($e->getMessage()));
}
