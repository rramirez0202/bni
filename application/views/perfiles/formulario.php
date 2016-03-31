<h1>Perfiles</h1>
<form class="form-horizontal" role="form" id="frm_perfil">
    <input type="hidden" id="frm_perfil_idperfil" name="frm_perfil_idperfil" value="<?= $objeto->getidperfil(); ?>" />
    <div class="form-group">
     <label for="frm_perfil_nombre" class="col-sm-2 control-label">Perfil</label>
     <div class="col-sm-10">
      <input type="text" class="form-control" id="frm_perfil_nombre" name="frm_perfil_nombre" value="<?= $objeto->getnombre(); ?>" placeholder="" maxlength="250" />
     </div>
    </div>
    <div class="form-group">
     <label for="frm_perfil_descripcion" class="col-sm-2 control-label">Descripcion</label>
     <div class="col-sm-10">
      <textarea rows="3" class="form-control" id="frm_perfil_descripcion" name="frm_perfil_descripcion"><?= $objeto->getdescripcion(); ?></textarea>
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
    <div class="form-group">
        <div class="col-sm-8"></div>
        <div class="col-sm-2">
            <button type="button" class="btn btn-success" onclick="Perfil.Enviar(<?= ($objeto->getIdperfil()!="" && $objeto->getIdperfil()!=0?'false':'true'); ?>)" >Guardar</button>
        </div>
        <div class="col-sm-2">
            <button type="button" class="btn btn-danger" onclick="location.href='<?= base_url('perfiles'); ?>'">Cancelar</button>
        </div>
    </div>
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
            <input type="checkbox" name="frm_perfil_permisos[]" id="frm_perfil_permisos" value="<?= $p->getIdpermiso(); ?>" <?= ($perf->hasPermiso($p->getIdpermiso())!==false?'checked="checked"':''); ?> />
            (<?= $p->getIdpermiso(); ?>) <?= $p->getPermiso(); ?>
        </label>
    </div>
    <?php
    foreach($p->getHijos() as $h)
        PrintPermiso($perf,$h,$level+1);
}
?>