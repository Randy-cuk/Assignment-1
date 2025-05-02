<?php
session_start();
session_unset();
session_destroy();
setcookie('session', '', time() - 3600); // Expire cookie
header("Location: index.html");
?>
