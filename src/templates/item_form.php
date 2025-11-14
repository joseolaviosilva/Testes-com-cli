<div class="form-container">
    <h1 class="page-title"><?= $page_title ?></h1>
    <form action="../src/actions/<?= $item ? 'update.php' : 'create.php' ?>" method="POST">
        <?php if ($item): ?>
            <input type="hidden" name="id" value="<?= $item['id'] ?>">
        <?php endif; ?>

        <div class="form-group">
            <label for="name">Nome do Item</label>
            <input type="text" id="name" name="name" class="form-control" value="<?= htmlspecialchars($item['name'] ?? '') ?>" required>
        </div>

        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea id="description" name="description" class="form-control"><?= htmlspecialchars($item['description'] ?? '') ?></textarea>
        </div>

        <div class="form-group">
            <label for="category">Categoria</label>
            <select id="category" name="category" class="form-control" required>
                <option value="Carro" <?= ($item['category'] ?? '') == 'Carro' ? 'selected' : '' ?>>Carro</option>
                <option value="Trailer" <?= ($item['category'] ?? '') == 'Trailer' ? 'selected' : '' ?>>Trailer</option>
                <option value="Equipamento de Construção" <?= ($item['category'] ?? '') == 'Equipamento de Construção' ? 'selected' : '' ?>>Equipamento de Construção</option>
                <option value="Outro" <?= ($item['category'] ?? '') == 'Outro' ? 'selected' : '' ?>>Outro</option>
            </select>
        </div>

        <div class="form-group">
            <label for="price_per_day">Preço por Dia (R$)</label>
            <input type="number" id="price_per_day" name="price_per_day" class="form-control" step="0.01" value="<?= htmlspecialchars($item['price_per_day'] ?? '') ?>" required>
        </div>

        <div class="form-group">
            <label for="image_url">URL da Imagem</label>
            <input type="url" id="image_url" name="image_url" class="form-control" value="<?= htmlspecialchars($item['image_url'] ?? '') ?>" required>
        </div>

        <div class="form-actions">
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>
</div>
