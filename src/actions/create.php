<?php
require_once __DIR__ . '/../database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $category = $_POST['category'] ?? '';
    $price_per_day = $_POST['price_per_day'] ?? 0;
    $image_url = $_POST['image_url'] ?? '';

    if ($name && $category && $price_per_day && $image_url) {
        $pdo = get_db_connection();
        $stmt = $pdo->prepare(
            "INSERT INTO items (name, description, category, price_per_day, image_url) VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->execute([$name, $description, $category, $price_per_day, $image_url]);
    }
}

header("Location: ../../public/index.php");
exit;
