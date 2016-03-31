<?php
if(!isset($usuarios)||$usuarios===false) $usuarios=array();
if(!isset($personas)||$personas===false) $personas=array();
if(!isset($clientes)||$clientes===false) $clientes=array();
?>
<h1>Grupos</h1>
<form class="form-horizontal" role="form" id="frm_persona">
    <input type="hidden" id="frm_grupo_idgrupo" name="frm_grupo_idgrupo" value="<?= $objeto->getidgrupo(); ?>" />
    <input type="hidden" value="1" id="frm_grupo_visible" name="frm_grupo_visible" />
    <div class="form-group">
     <label for="frm_grupo_nombre" class="col-sm-2 control-label">Grupo</label>
     <div class="col-sm-10">
      <input type="text" class="form-control" id="frm_grupo_nombre" name="frm_grupo_nombre" value="<?= $objeto->getnombre(); ?>" placeholder="" maxlength="250" />
     </div>
    </div>
    <div class="form-group">
     <label for="frm_grupo_descripcion" class="col-sm-2 control-label">Descripcion</label>
     <div class="col-sm-10">
      <input type="text" class="form-control" id="frm_grupo_descripcion" name="frm_grupo_descripcion" value="<?= $objeto->getdescripcion(); ?>" placeholder="" maxlength="250" />
     </div>
    </div>
    <div id="panelesiniciales">
        <fieldset>
            <legend>Administradores del Grupo</legend>
        </fieldset>
        <div class="row">
            <div class="col-md-5">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Administradores del Grupo</h3>
                    </div>
                    <div class="panel-body">
                        <div class="list-group">
                            <?php foreach($usuarios as $t):
                                $u=new Modusuario();
                                $u->getFromDatabase($t["idusuario"]);
                                ?>
                                <a class="list-group-item" href="#">
                                    <label>
                                        <input type="checkbox" value="<?= $t["idusuario"]; ?>" />
                                        <?= $u->getPersona()->getNombre()." ".$u->getPersona()->getApaterno()." ".$u->getPersona()->getAmaterno(); ?>
                                    </label>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <fieldset><legend>Integrantes del grupo</legend></fieldset>
        <div class="row">
            <div class="col-md-5">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Usuarios</h3>
                    </div>
                    <div class="panel-body">
                        <div class="list-group">
                            <?php foreach($usuarios as $t):
                                $u=new Modusuario();
                                $u->getFromDatabase($t["idusuario"]);
                                ?>
                                <a class="list-group-item" href="#">
                                    <label>
                                        <input type="checkbox" value="<?= $t["idusuario"]; ?>" />
                                        <?= $u->getPersona()->getNombre()." ".$u->getPersona()->getApaterno()." ".$u->getPersona()->getAmaterno(); ?>
                                    </label>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Personas</h3>
                    </div>
                    <div class="panel-body">
                        <div class="list-group">
                            <?php foreach($personas as $t):
                                ?>
                                <a class="list-group-item" href="#">
                                    <label>
                                        <input type="checkbox" value="<?= $t["idpersona"]; ?>" />
                                        <?= $t["nombre"]." ".$t["apaterno"]." ".$t["amaterno"]; ?>
                                    </label>
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
                        <h3 class="panel-title">Clientes</h3>
                    </div>
                    <div class="panel-body">
                        <div class="list-group">
                            <?php foreach($clientes as $p): ?>
                                <a class="list-group-item" href="perfiles/<?= $p["idlciente"]; ?>">
                                    <?= $p["nombre"]; ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-8"></div>
        <div class="col-sm-2">
            <button type="button" class="btn btn-success" onclick="Grupo.Enviar(<?= ($objeto->getIdgrupo()!="" && $objeto->getIdgrupo()!=0?'false':'true'); ?>)" >Guardar</button>
        </div>
        <div class="col-sm-2">
            <button type="button" class="btn btn-danger" onclick="location.href='<?= base_url('grupos'); ?>'">Cancelar</button>
        </div>
    </div>
</form>