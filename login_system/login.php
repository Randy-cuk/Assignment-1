<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) 
    {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        setcookie('session', session_id(), [
            'httponly' => true,
            'secure' => isset($_SERVER['HTTPS']), 
            'samesite' => 'Strict'
        ]);

        header('Location: dashboard.php');
        exit;
    } 
    else 
    {
        echo "Invalid username or password.";
    }
}
?>
