<?php
if(!isset($personas)||$personas===false) $personas=array();
?>
<div class="btn-group pull-right">
    <button type="button" class="btn btn-default" onclick="location.href='personas/nuevo'" title="<?= $this->lang->line("act_add"); ?>"><?= $this->lang->line("act_add"); ?></button>
</div>
<h3>Personas</h3>
<table class="table table-striped">
    <thead>
        <tr>
            <th></th>
            <th colspan="2">Codigo de Barras</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Fecha de Nacimiento</th>
            <th>Ubicación</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($personas as $p): ?>
            <tr>
                <td><img class="center-block" src="<?= "data:{$p["imagenmime"]};base64,".base64_encode($p["imagen"]); ?>" height="50"></td>
                <td class="Code128"><?= $p["codigobarras"]; ?></td>
                <td><a href="<?= base_url("personas/ver/".$p["idpersona"]); ?>"><?= $p["codigobarras"]; ?></a></td>
                <td><a href="<?= base_url("personas/ver/".$p["idpersona"]); ?>"><?= $p["nombre"]; ?></a></td>
                <td><?= $p["apaterno"]; ?></td>
                <td><?= $p["amaterno"]; ?></td>
                <td><?= DateToMx($p["fechanacimiento"]); ?></td>
                <td><?= "{$p["colonia"]}, {$p["municipio"]}, {$p["estado"]}"; ?></td>
                <td>
                    <button type="button" class="btn btn-default" onclick="location.href='<?= base_url("personas/actualizar/".$p["idpersona"]); ?>'">
                        <span class="glyphicon glyphicon-edit"></span>
                    </button>
                </td>
                <td>
                    <button type="button" class="btn btn-default" onclick="Persona.Eliminar(<?= $p["idpersona"]; ?>)">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>