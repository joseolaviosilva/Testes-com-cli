<?php
require_once __DIR__ . '/../database.php';

$id = $_GET['id'] ?? 0;

if ($id) {
    $pdo = get_db_connection();
    $stmt = $pdo->prepare("DELETE FROM items WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: ../../public/index.php");
exit;
