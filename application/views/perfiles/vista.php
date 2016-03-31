<div class="btn-group pull-right">
    <button type="button" class="btn btn-default" onclick="location.href=baseURL+'perfiles'" title="Ver todos los perfiles">Ver todos los perfiles</button>
    <button type="button" class="btn btn-default" onclick="location.href=baseURL+'perfiles/actualizar/<?= $objeto->getIdperfil(); ?>'" title="<?= $this->lang->line("act_upd"); ?>"><?= $this->lang->line("act_upd"); ?></button>
    <button type="button" class="btn btn-default" onclick="Perfil.Eliminar(<?= $objeto->getIdperfil(); ?>)" title="<?= $this->lang->line("act_del"); ?>"><?= $this->lang->line("act_del"); ?></button>
</div>
<h1>Perfiles</h1>
<form class="form-horizontal" role="form" id="frm_perfil">
    <input type="hidden" id="frm_perfil_idperfil" name="frm_perfil_idperfil" value="<?= $objeto->getidperfil(); ?>" />
    <div class="form-group">
     <label for="frm_perfil_nombre" class="col-sm-2 control-label">Perfil</label>
     <div class="col-sm-10">
      <p class="form-control-static"><?= $objeto->getnombre(); ?></p>
     </div>
    </div>
    <div class="form-group">
     <label for="frm_perfil_descripcion" class="col-sm-2 control-label">Descripcion</label>
     <div class="col-sm-10">
      <p class="form-control-static"><?= $objeto->getdescripcion(); ?></p>
     </div>
    </div>
    <fieldset>
        <legend>Permisos</legend>
        <?php
            if($permisos!==false) 
                foreach($permisos as $p)
                    PrintPermiso($objeto,$p);
        ?>
    </fieldset>
</form>
<?php
function PrintPermiso(Modperfil $perf,Modpermiso $p,$level=0)
{
    $levelStr="";
    for($x=1;$x<=$level;$x++)
        $levelStr.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    ?>
    <div>
        <?= $levelStr; ?>
        <label>
            <input type="checkbox" name="frm_perfil_permisos[]" id="frm_perfil_permisos" value="<?= $p->getIdpermiso(); ?>" <?= ($perf->hasPermiso($p->getIdpermiso())!==false?'checked="checked"':''); ?> disabled="disabled" />
            (<?= $p->getIdpermiso(); ?>) <?= $p->getPermiso(); ?>
        </label>
    </div>
    <?php
    foreach($p->getHijos() as $h)
        PrintPermiso($perf,$h,$level+1);
}
?>