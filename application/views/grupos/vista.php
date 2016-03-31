<?php
if(!isset($usuarios)||$usuarios===false) $usuarios=array();
if(!isset($personas)||$personas===false) $personas=array();
if(!isset($clientes)||$clientes===false) $clientes=array();
?>
<div class="btn-group pull-right">
    <button type="button" class="btn btn-default" onclick="location.href=baseURL+'grupos'" title="Ver todos los grupos">Ver todos los grupos</button>
    <button type="button" class="btn btn-default" onclick="location.href=baseURL+'grupos/actualizar/<?= $objeto->getIdgrupo(); ?>'" title="<?= $this->lang->line("act_upd"); ?>"><?= $this->lang->line("act_upd"); ?></button>
    <button type="button" class="btn btn-default" onclick="Grupo.Eliminar(<?= $objeto->getIdgrupo(); ?>)" title="<?= $this->lang->line("act_del"); ?>"><?= $this->lang->line("act_del"); ?></button>
</div>
<h1>Grupos</h1>
<form class="form-horizontal" role="form" id="frm_persona">
    <input type="hidden" id="frm_grupo_idgrupo" name="frm_grupo_idgrupo" value="<?= $objeto->getidgrupo(); ?>" />
    <input type="hidden" value="1" id="frm_grupo_visible" name="frm_grupo_visible" />
    <div class="form-group">
     <label for="frm_grupo_nombre" class="col-sm-2 control-label">Grupo</label>
     <div class="col-sm-10">
      <p class="form-control-static"><?= $objeto->getnombre(); ?></p>
     </div>
    </div>
    <div class="form-group">
     <label for="frm_grupo_descripcion" class="col-sm-2 control-label">Descripcion</label>
     <div class="col-sm-10">
      <p class="form-control-static"><?= $objeto->getdescripcion(); ?></p>
     </div>
    </div>
</form>