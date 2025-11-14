<?php
require_once __DIR__ . '/../src/database.php';

$pdo = get_db_connection();
$action = $_GET['action'] ?? 'list';
$search = $_GET['search'] ?? '';

// Simple router
switch ($action) {
    case 'new':
        $page_title = 'Adicionar Novo Item';
        $item = null;
        require __DIR__ . '/../src/templates/header.php';
        require __DIR__ . '/../src/templates/item_form.php';
        require __DIR__ . '/../src/templates/footer.php';
        break;

    case 'edit':
        $id = $_GET['id'] ?? 0;
        $stmt = $pdo->prepare("SELECT * FROM items WHERE id = ?");
        $stmt->execute([$id]);
        $item = $stmt->fetch();
        
        $page_title = 'Editar Item';
        require __DIR__ . '/../src/templates/header.php';
        require __DIR__ . '/../src/templates/item_form.php';
        require __DIR__ . '/../src/templates/footer.php';
        break;

    case 'show':
        $id = $_GET['id'] ?? 0;
        $stmt = $pdo->prepare("SELECT * FROM items WHERE id = ?");
        $stmt->execute([$id]);
        $item = $stmt->fetch();

        if (!$item) {
            header("Location: index.php");
            exit;
        }

        require __DIR__ . '/../src/templates/header.php';
        ?>
        <div class="item-detail-container">
            <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="item-detail-img">
            <h1 class="item-detail-title"><?= htmlspecialchars($item['name']) ?></h1>
            <p class="item-detail-category"><?= htmlspecialchars($item['category']) ?></p>
            <p class="item-detail-description"><?= nl2br(htmlspecialchars($item['description'])) ?></p>
            <p class="item-detail-price">R$ <?= number_format($item['price_per_day'], 2, ',', '.') ?> <span class="per-day">/ dia</span></p>
            <div class="item-detail-actions">
                <a href="index.php?action=edit&id=<?= $item['id'] ?>" class="btn btn-primary">Editar</a>
                <a href="../src/actions/delete.php?id=<?= $item['id'] ?>" class="btn btn-danger btn-delete" data-item-name="<?= htmlspecialchars($item['name']) ?>">Excluir</a>
            </div>
        </div>
        <?php
        require __DIR__ . '/../src/templates/footer.php';
        break;

    case 'list':
    default:
        $page_title = 'Itens Disponíveis';
        $query = "SELECT * FROM items";
        $params = [];
        if ($search) {
            $query .= " WHERE name LIKE ? OR description LIKE ?";
            $params[] = '%' . $search . '%';
            $params[] = '%' . $search . '%';
        }
        $query .= " ORDER BY created_at DESC";
        
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        $items = $stmt->fetchAll();

        require __DIR__ . '/../src/templates/header.php';
        ?>
        <h1 class="page-title"><?= $page_title ?></h1>
        <div class="items-grid">
            <?php if (empty($items)): ?>
                <p>Nenhum item encontrado.</p>
            <?php else: ?>
                <?php foreach ($items as $item): ?>
                    <?php require __DIR__ . '/../src/templates/item_card.php'; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <?php
        require __DIR__ . '/../src/templates/footer.php';
        break;
}
