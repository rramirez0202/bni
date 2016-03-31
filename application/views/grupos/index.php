<?php
if(!isset($grupos)||$grupos===false) $grupos=array();
?>
<div class="btn-group pull-right">
    <button type="button" class="btn btn-default" onclick="location.href='grupos/nuevo'" title="<?= $this->lang->line("act_add"); ?>"><?= $this->lang->line("act_add"); ?></button>
</div>
<h1>Grupos</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Grupo</th>
            <th>Descripción</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($grupos as $g): ?>
            <tr>
                <td><a href="<?= base_url('grupos/ver/'.$g["idgrupo"]); ?>"><?= $g["nombre"]; ?></a></td>
                <td><?= $g["descripcion"]; ?></td>
                <td>
                    <button type="button" class="btn btn-default" onclick="location.href='<?= base_url("grupos/actualizar/".$g["idgrupo"]); ?>'">
                        <span class="glyphicon glyphicon-edit"></span>
                    </button>
                </td>
                <td>
                    <button type="button" class="btn btn-default" onclick="Grupo.Eliminar(<?= $p["idgrupo"]; ?>)">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>