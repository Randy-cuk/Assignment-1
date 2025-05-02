<?php
session_start();
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST')
 {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash']))
     {
        
        $_SESSION['user'] = $user['username'];

        setcookie(session_name(), session_id(),
         [
            'httponly' => true,
            'secure' => false, 
            'samesite' => 'Strict'
        ]);

        header('Location: dashboard.php');
        exit();
    } else 
    {
        echo "Invalid username or password.";
    }
} else 
{
    header('Location: login.php');
    exit();
}
?>
