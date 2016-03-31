<hr />
<div id="panelesiniciales">
    <div class="row">
        <div class="col-md-5">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Usuarios</h3>
                </div>
                <div class="panel-body">
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><a href="perfiles">Perfiles</a></h3>
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        <?php foreach($perfiles as $p): ?>
                            <a href="perfiles/<?= $p["idperfil"]; ?>">
                                <?= $p["nombre"]; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Permisos</h3>
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        <a href="permisos" class="list-group-item">
                            Administracion de permisos
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Catálogos del Sistema</h3>
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        <?php foreach($this->config->item("navConfigCatalogos") as $item): ?>
                            <a href="<?= $item["url"]; ?>" class="list-group-item">
                                <?= $item["item"]; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>