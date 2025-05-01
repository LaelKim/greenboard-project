<?php
session_start();

// Vérifie si un utilisateur est connecté
$isLoggedIn = isset($_SESSION['user_id']);
$userName = $isLoggedIn ? $_SESSION['user_name'] : null;
