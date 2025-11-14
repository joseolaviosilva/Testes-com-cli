<div class="item-card">
    <a href="index.php?action=show&id=<?= $item['id'] ?>">
        <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="item-card-img">
        <div class="item-card-content">
            <p class="item-card-category"><?= htmlspecialchars($item['category']) ?></p>
            <h3 class="item-card-title"><?= htmlspecialchars($item['name']) ?></h3>
            <p class="item-card-price">R$ <?= number_format($item['price_per_day'], 2, ',', '.') ?> <span class="per-day">/ dia</span></p>
        </div>
    </a>
</div>
