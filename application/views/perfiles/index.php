<?php
if(!isset($perfiles)||$perfiles===false) $perfiles=array();
?>
<div class="btn-group pull-right">
    <button type="button" class="btn btn-default" onclick="location.href='perfiles/nuevo'" title="<?= $this->lang->line("act_add"); ?>"><?= $this->lang->line("act_add"); ?></button>
</div>
<h1>Perfiles</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Perfil</th>
            <th colspan="3">Descripcion</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($perfiles as $p): ?>
            <tr>
                <td><a href="perfiles/ver/<?= $p["idperfil"]; ?>"><?= $p["nombre"]; ?></a></td>
                <td><?= $p["descripcion"]; ?></td>
                <td>
                    <button type="button" class="btn btn-default" onclick="location.href=baseURL+'perfiles/actualizar/<?= $p["idperfil"]; ?>'" title="<?= $this->lang->line("act_upd"); ?>">
                        <span class="glyphicon glyphicon-edit"></span>
                    </button>
                </td>
                <td>
                    <button type="button" class="btn btn-default" onclick="Perfil.Eliminar(<?= $p["idperfil"]; ?>)" title="<?= $this->lang->line("act_del"); ?>">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>