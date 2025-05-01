<?php
session_start();
$pdo = new PDO("mysql:host=localhost;dbname=greenboard;charset=utf8", "root", "");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"] ?? '';
    $password = $_POST["password"] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["is_admin"] = $user["is_admin"];
        header("Location: ../frontend/index.php");
        exit;
    } else {
        header("Location: ../frontend/login.php?error=1");
        exit;
    }
}
?>
