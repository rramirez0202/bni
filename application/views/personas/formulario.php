<?php 
if(!isset($tipotelefono)||$tipotelefono==false) $tipotelefono=array();
if(!isset($tipocorreo)||$tipocorreo==false) $tipocorreo=array();
?>
<h1>Personas</h1>
<form class="form-horizontal" role="form" id="frm_persona" enctype="multipart/form-data">
    <input type="hidden" id="frm_persona_idpersona" name="frm_persona_idpersona" value="<?= $objeto->getidpersona(); ?>" />
    <input type="hidden" value="1" id="frm_persona_visible" name="frm_persona_visible" value="<?= $objeto->getvisible(); ?>" />
    <div class="form-group">
     <label for="frm_persona_nombre" class="col-sm-2 control-label">Nombre</label>
     <div class="col-sm-10">
      <input type="text" class="form-control" id="frm_persona_nombre" name="frm_persona_nombre" value="<?= $objeto->getnombre(); ?>" placeholder="" maxlength="250" />
     </div>
    </div>
    <div class="form-group">
     <label for="frm_persona_apaterno" class="col-sm-2 control-label">Apellido Paterno</label>
     <div class="col-sm-4">
      <input type="text" class="form-control" id="frm_persona_apaterno" name="frm_persona_apaterno" value="<?= $objeto->getapaterno(); ?>" placeholder="" maxlength="250" />
     </div>
     <label for="frm_persona_amaterno" class="col-sm-2 control-label">Apellido Materno</label>
     <div class="col-sm-4">
      <input type="text" class="form-control" id="frm_persona_amaterno" name="frm_persona_amaterno" value="<?= $objeto->getamaterno(); ?>" placeholder="" maxlength="250" />
     </div>
    </div>
    <div class="form-group">
     <label for="frm_persona_fechanacimiento" class="col-sm-2 control-label">Fecha de Nacimiento</label>
     <div class="col-sm-4">
      <input type="date" class="form-control" id="frm_persona_fechanacimiento" name="frm_persona_fechanacimiento" value="<?= $objeto->getfechanacimiento(); ?>" />
     </div>
     <label for="frm_persona_imagen" class="col-sm-2 control-label">Fotografia</label>
     <div class="col-sm-4">
      <input type="file" class="form-control" id="frm_persona_imagen" name="frm_persona_imagen" value="" />
     </div>
    </div>
    <div class="form-group">
     <label for="frm_persona_calle" class="col-sm-2 control-label">Calle</label>
     <div class="col-sm-4">
      <input type="text" class="form-control" id="frm_persona_calle" name="frm_persona_calle" value="<?= $objeto->getcalle(); ?>" placeholder="" maxlength="250" />
     </div>
     <label for="frm_persona_cp" class="col-sm-2 control-label">Código Postal</label>
     <div class="col-sm-4">
      <input type="number" class="form-control" id="frm_persona_cp" name="frm_persona_cp" value="<?= $objeto->getcp(); ?>" placeholder="" min="0" max="99999" maxlength="5" />
     </div>
    </div>
    <div class="form-group">
     <label for="frm_persona_numint" class="col-sm-2 control-label">Número Interior</label>
     <div class="col-sm-4">
      <input type="text" class="form-control" id="frm_persona_numint" name="frm_persona_numint" value="<?= $objeto->getnumint(); ?>" placeholder="" maxlength="25" />
     </div>
     <label for="frm_persona_numext" class="col-sm-2 control-label">Número Exterior</label>
     <div class="col-sm-4">
      <input type="text" class="form-control" id="frm_persona_numext" name="frm_persona_numext" value="<?= $objeto->getnumext(); ?>" placeholder="" maxlength="25" />
     </div>
    </div>
    <div class="form-group">
     <label for="frm_persona_colonia" class="col-sm-2 control-label">Colonia</label>
     <div class="col-sm-10">
      <input type="text" class="form-control" id="frm_persona_colonia" name="frm_persona_colonia" value="<?= $objeto->getcolonia(); ?>" placeholder="" maxlength="250" />
     </div>
    </div>
    <div class="form-group">
     <label for="frm_persona_municipio" class="col-sm-2 control-label">Municipio</label>
     <div class="col-sm-10">
      <input type="text" class="form-control" id="frm_persona_municipio" name="frm_persona_municipio" value="<?= $objeto->getmunicipio(); ?>" placeholder="" maxlength="250" />
     </div>
    </div>
    <div class="form-group">
     <label for="frm_persona_estado" class="col-sm-2 control-label">Estado</label>
     <div class="col-sm-10">
      <input type="text" class="form-control" id="frm_persona_estado" name="frm_persona_estado" value="<?= $objeto->getestado(); ?>" placeholder="" maxlength="250" />
     </div>
    </div>
    <div class="form-group">
     <label for="frm_persona_codigobarras" class="col-sm-2 control-label">Código de Barras</label>
     <div class="col-sm-4">
      <input type="text" class="form-control" id="frm_persona_codigobarras" name="frm_persona_codigobarras" value="<?= $objeto->getcodigobarras(); ?>" placeholder="" maxlength="250" onkeypress="$('#codigobarras_display').html(this.value)" />
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
                        <button type="button" class="btn btn-default btn-xs pull-right" onclick="Persona.FrmAddTelefono()">
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                        <h3 class="panel-title">Telefono</h3>
                    </div>
                    <div class="panel-body collapse" id="panel_telefono">
                        <table class="table table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th colspan="2">Número</th>
                                </tr>
                            </thead>
                            <tbody id="persona_telefonos">
                                <?php if($objeto->getTelefonos()!==false&&is_array($objeto->getTelefonos())) foreach($objeto->getTelefonos() as $val): ?>
                                    <tr>
                                        <td><?= $val->getTipoTelefono()->getValor(); ?></td>
                                        <td><?= $val->getValor(); ?></td>
                                        <td>
                                            <button type="button" class="btn btn-default btn-xs pull-right" onclick="Persona.DelTelefono(this)"><span class="glyphicon glyphicon-remove"></span></button>
                                            <input type="hidden" name="frm_telefono_idtipotelefono[]" id="frm_telefono_idtipotelefono[]" value="<?= $val->getIdtipotelefono(); ?>" />
                                            <input type="hidden" name="frm_telefono_valor[]" id="frm_telefono_valor[]" value="<?= $val->getValor(); ?>" />
                                        </td>
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
                        <button type="button" class="btn btn-default btn-xs pull-right" onclick="Persona.FrmAddCorreo()">
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                        <h3 class="panel-title">Correo</h3>
                    </div>
                    <div class="panel-body collapse" id="panel_correo">
                        <table class="table table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th colspan="2">Correo</th>
                                </tr>
                            </thead>
                            <tbody id="persona_correos">
                                <?php if($objeto->getCorreos()!==false&&is_array($objeto->getCorreos())) foreach($objeto->getCorreos() as $val): ?>
                                    <tr>
                                        <td><?= $val->getTipoCorreo()->getValor(); ?></td>
                                        <td><?= $val->getValor(); ?></td>
                                        <td>
                                            <button type="button" class="btn btn-default btn-xs pull-right" onclick="Persona.DelTelefono(this)"><span class="glyphicon glyphicon-remove"></span></button>
                                            <input type="hidden" name="frm_correo_idtipocorreo[]" id="frm_correo_idtipocorreo[]" value="<?= $val->getIdtipocorreo(); ?>" />
                                            <input type="hidden" name="frm_correo_valor[]" id="frm_correo_idtipocorreo[]" value="<?= $val->getValor(); ?>" />
                                        </td>
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
                                <?php if($grupos!==false&&is_array($grupos)) foreach($grupos as $g): ?>
                                    <label>
                                        <input type="checkbox" value="<?= $g["idgrupo"]; ?>" />
                                        <?= $grupo["nombre"]; ?>
                                    </label>
                                <?php endforeach; ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-8"></div>
        <div class="col-sm-2">
            <button type="button" class="btn btn-success" onclick="Persona.Enviar(<?= ($objeto->getIdpersona()!="" && $objeto->getIdpersona()!=0?'false':'true'); ?>)" >Guardar</button>
        </div>
        <div class="col-sm-2">
            <button type="button" class="btn btn-danger" onclick="location.href='<?= base_url('personas'); ?>'">Cancelar</button>
        </div>
    </div>
</form>
<script type="text/javascript">
    var tipotelefono=<?= json_encode($tipotelefono); ?>;
    var tipocorreo=<?= json_encode($tipocorreo); ?>;
</script>