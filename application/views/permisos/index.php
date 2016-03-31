<div class="btn-group pull-right">
    <button type="button" class="btn btn-default" onclick="Permiso.CapturaNuevos()" title="<?= $this->lang->line("act_add"); ?>"><?= $this->lang->line("act_add"); ?></button>
    <button type="button" class="btn btn-default" onclick="Permiso.CapturaUpd()" title="<?= $this->lang->line("act_upd"); ?>"><?= $this->lang->line("act_upd"); ?></button>
    <button type="button" class="btn btn-default" onclick="Permiso.FrmDel()" title="<?= $this->lang->line("act_del"); ?>"><?= $this->lang->line("act_del"); ?></button>
</div>
<h1>Permisos</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Permiso</th>
            <th>Descripción</th>
        </tr>
    </thead>
    <tbody id="elementosMenu">
        <?php
        if($permisos!==false)
            foreach($permisos as $p)
                PrintPermiso($p);
        ?>
    </tbody>
</table>
<?php
function PrintPermiso(Modpermiso $p,$level=0)
{
    $levelStr="";
    for($x=1;$x<=$level;$x++)
        $levelStr.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    ?>
    <tr>
        <td>
            <?= $levelStr; ?>
            <label>
                <input type="checkbox" value="<?= $p->getIdpermiso(); ?>"/>
                (<?= $p->getIdpermiso(); ?>) <?= $p->getPermiso(); ?>
            </label>
        </td>
        <td>
            <?= $p->getDescripcion(); ?>
        </td>
    </tr>
    <?php
    foreach($p->getHijos() as $h)
        PrintPermiso($h,$level+1);
}
?>