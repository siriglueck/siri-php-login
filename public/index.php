<?php
declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once __DIR__ . '/header.php';

$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll();

foreach ($users as $user) {
    echo $user->username . "<br>";
    echo $user->created_at . "<br>";
    echo $user->role . "<br>";
    echo $user->profile_image . "<br>";
}
?>
<body>
    <h1>Learn Login</h1>
</body>
</html>