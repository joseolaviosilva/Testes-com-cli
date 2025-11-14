<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AlugaTudo - Aluguel de Bens Móveis</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="main-header">
        <a href="index.php" class="logo">AlugaTudo</a>
        <form action="index.php" method="GET" class="search-bar">
            <input type="text" name="search" class="search-input" placeholder="Buscar produtos...">
            <button type="submit" class="search-button">Buscar</button>
        </form>
        <nav class="nav-actions">
            <a href="index.php?action=new" class="btn">Adicionar Novo Item</a>
        </nav>
    </header>
    <main class="container">
