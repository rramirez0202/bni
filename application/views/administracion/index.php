<hr />
<div id="panelesiniciales">
    <div class="row">
        <div class="col-md-5">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <button type="button" class="btn btn-default btn-xs pull-right" data-toggle="collapse" data-target="#panel_personas" onclick="AppExec.ButtonPanelToggle(this)">
                        <span class="glyphicon glyphicon-chevron-up oculto"></span>
                        <span class="glyphicon glyphicon-chevron-down"></span>
                    </button>
                    <h3 class="panel-title"><a href="personas">Personas</a></h3>
                </div>
                <div class="panel-body collapse" id="panel_personas">
                    <table class="table table-striped table-condensed">
                        <thead>
                            <tr>
                                <th></th>
                                <th colspan="2">Codigo de Barras</th>
                                <th>Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($personas!==false&&is_array($personas)) foreach($personas as $p): ?>
                                <tr>
                                    <td><img class="center-block" src="<?= "data:{$p["imagenmime"]};base64,".base64_encode($p["imagen"]); ?>" height="50"></td>
                                    <td class="Code128"><?= $p["codigobarras"]; ?></td>
                                    <td><?= $p["codigobarras"]; ?></td>
                                    <td><a href="<?= base_url("personas/ver/".$p["idpersona"]); ?>"><?= "{$p["nombre"]} {$p["apaterno"]} {$p["amaterno"]}"; ?></a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <button type="button" class="btn btn-default btn-xs pull-right" data-toggle="collapse" data-target="#panel_grupos" onclick="AppExec.ButtonPanelToggle(this)">
                        <span class="glyphicon glyphicon-chevron-up oculto"></span>
                        <span class="glyphicon glyphicon-chevron-down"></span>
                    </button>
                    <h3 class="panel-title"><a href="grupos">Grupos</a></h3>
                </div>
                <div class="panel-body collapse" id="panel_grupos">
                    <table class="table table-striped table-condensed">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($grupos!==false&&is_array($grupos)) foreach($grupos as $g): ?>
                                <tr>
                                    <td><a href="<?= base_url("grupos/ver/".$g["idgrupo"]); ?>"><?= $g["nombre"]?></a></td>
                                    <td><?= $g["descripcion"]; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
