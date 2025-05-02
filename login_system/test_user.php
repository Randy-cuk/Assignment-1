<?php
require 'db.php';

$username = 'admin';
$password = 'secret123';

$hash = password_hash($password, PASSWORD_BCRYPT);

$stmt = $pdo->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");
$stmt->execute([$username, $hash]);

echo "✅ Test user 'admin' created with password 'secret123'. You can now log in.";
?>