<?php
session_start();
require_once 'config/database.php';
require_once 'route.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?page=login");
    exit;
}
