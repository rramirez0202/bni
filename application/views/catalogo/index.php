<h1>Catálogos del Sistema</h1>
<div class="list-group">
    <?php foreach($this->config->item("navConfigCatalogos") as $item): ?>
        <a href="<?= $item["url"]; ?>" class="list-group-item">
            <?= $item["item"]; ?>
        </a>
    <?php endforeach; ?>
</div>