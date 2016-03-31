<div class="btn-group pull-right">
    <button type="button" class="btn btn-default" onclick="location.href=baseURL+'personas'" title="Ver todas las personas">Ver todas las personas</button>
    <button type="button" class="btn btn-default" onclick="location.href=baseURL+'personas/actualizar/<?= $objeto->getIdpersona(); ?>'" title="<?= $this->lang->line("act_upd"); ?>"><?= $this->lang->line("act_upd"); ?></button>
    <button type="button" class="btn btn-default" onclick="Persona.Eliminar(<?= $objeto->getIdpersona(); ?>)" title="<?= $this->lang->line("act_del"); ?>"><?= $this->lang->line("act_del"); ?></button>
</div>
<h1>Personas</h1>
<form class="form-horizontal" role="form" id="frm_persona">
    <input type="hidden" id="frm_persona_idpersona" name="frm_persona_idpersona" value="<?= $objeto->getidpersona(); ?>" />
    <input type="hidden" value="1" id="frm_persona_visible" name="frm_persona_visible" value="<?= $objeto->getvisible(); ?>" />
    <div class="form-group">
     <label for="frm_persona_nombre" class="col-sm-2 control-label">Nombre</label>
     <div class="col-sm-10">
      <p class="form-control-static"><?= $objeto->getnombre(); ?></p>
     </div>
    </div>
    <div class="form-group">
     <label for="frm_persona_apaterno" class="col-sm-2 control-label">Apellido Paterno</label>
     <div class="col-sm-4">
      <p class="form-control-static"><?= $objeto->getapaterno(); ?></p>
     </div>
     <label for="frm_persona_amaterno" class="col-sm-2 control-label">Apellido Materno</label>
     <div class="col-sm-4">
      <p class="form-control-static"><?= $objeto->getamaterno(); ?></p>
     </div>
    </div>
    <div class="form-group">
     <label for="frm_persona_fechanacimiento" class="col-sm-2 control-label">Fecha de Nacimiento</label>
     <div class="col-sm-4">
      <p class="form-control-static"><?= DateToMx($objeto->getfechanacimiento()); ?></p>
     </div>
    </div>
    <div class="form-group">
     <label for="frm_persona_calle" class="col-sm-2 control-label">Calle</label>
     <div class="col-sm-4">
      <p class="form-control-static"><?= $objeto->getcalle(); ?></p>
     </div>
     <label for="frm_persona_cp" class="col-sm-2 control-label">Código Postal</label>
     <div class="col-sm-4">
      <p class="form-control-static"><?= $objeto->getcp(); ?></p>
     </div>
    </div>
    <div class="form-group">
     <label for="frm_persona_numint" class="col-sm-2 control-label">Número Interior</label>
     <div class="col-sm-4">
      <p class="form-control-static"><?= $objeto->getnumint(); ?></p>
     </div>
     <label for="frm_persona_numext" class="col-sm-2 control-label">Número Exterior</label>
     <div class="col-sm-4">
      <p class="form-control-static"><?= $objeto->getnumext(); ?></p>
     </div>
    </div>
    <div class="form-group">
     <label for="frm_persona_colonia" class="col-sm-2 control-label">Colonia</label>
     <div class="col-sm-5">
      <p class="form-control-static"><?= $objeto->getcolonia(); ?></p>
     </div>
    </div>
    <div class="form-group">
     <label for="frm_persona_municipio" class="col-sm-2 control-label">Municipio</label>
     <div class="col-sm-5">
      <p class="form-control-static"><?= $objeto->getmunicipio(); ?></p>
     </div>
    </div>
    <div class="form-group">
     <label for="frm_persona_estado" class="col-sm-2 control-label">Estado</label>
     <div class="col-sm-5">
      <p class="form-control-static"><?= $objeto->getestado(); ?></p>
     </div>
    </div>
    <div class="form-group">
     <label for="frm_persona_codigobarras" class="col-sm-2 control-label">Código de Barras</label>
     <div class="col-sm-4">
      <p class="form-control-static"><?= $objeto->getcodigobarras(); ?></p>
     </div>
     <div class="col-sm-4 Code128" id="codigobarras_display"><?= $objeto->getcodigobarras(); ?></div>
    </div>
    <div id="panelesiniciales">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <button type="button" class="btn btn-default btn-xs pull-right" data-toggle="collapse" data-target="#panel_telefono" onclick="AppExec.ButtonPanelToggle(this)">
                            <span class="glyphicon glyphicon-chevron-up oculto"></span>
                            <span class="glyphicon glyphicon-chevron-down"></span>
                        </button>
                        <h3 class="panel-title">Telefono</h3>
                    </div>
                    <div class="panel-body collapse" id="panel_telefono">
                        <table class="table table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th>Número</th>
                                </tr>
                            </thead>
                            <tbody id="persona_telefonos">
                                <?php if($objeto->getTelefonos()!==false&&is_array($objeto->getTelefonos())) foreach($objeto->getTelefonos() as $val): ?>
                                    <tr>
                                        <td><?= $val->getTipoTelefono()->getValor(); ?></td>
                                        <td><?= $val->getValor(); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <button type="button" class="btn btn-default btn-xs pull-right" data-toggle="collapse" data-target="#panel_correo" onclick="AppExec.ButtonPanelToggle(this)">
                            <span class="glyphicon glyphicon-chevron-up oculto"></span>
                            <span class="glyphicon glyphicon-chevron-down"></span>
                        </button>
                        <h3 class="panel-title">Correo</h3>
                    </div>
                    <div class="panel-body collapse" id="panel_correo">
                        <table class="table table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th>Correo</th>
                                </tr>
                            </thead>
                            <tbody id="persona_correos">
                                <?php if($objeto->getCorreos()!==false&&is_array($objeto->getCorreos())) foreach($objeto->getCorreos() as $val): ?>
                                    <tr>
                                        <td><?= $val->getTipoCorreo()->getValor(); ?></td>
                                        <td><?= $val->getValor(); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <button type="button" class="btn btn-default btn-xs pull-right" data-toggle="collapse" data-target="#panel_grupo" onclick="AppExec.ButtonPanelToggle(this)">
                            <span class="glyphicon glyphicon-chevron-up oculto"></span>
                            <span class="glyphicon glyphicon-chevron-down"></span>
                        </button>
                        <h3 class="panel-title">Grupos a los que pertenece el usuario</h3>
                    </div>
                    <div class="panel-body collapse" id="panel_grupo">
                        <div class="list-group">
                            <a href="#">
                                <?php if($objeto->getGrupospertenece()!==false&&is_array($objeto->getGrupospertenece())) foreach($objeto->getGrupospertenece() as $g): ?>
                                    <?= $g->getNombre(); ?>
                                <?php endforeach; ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <img class="center-block" src="<?= "data:{$objeto->getImagenmime()};base64,".base64_encode($objeto->getImagen()); ?>" width="300">
            </div>
        </div>
    </div>
</form>