<div class="btn-group pull-right">
    <button type="button" class="btn btn-default" onclick="Catalogo.FrmAdd()" title="<?= $this->lang->line("act_add"); ?>"><?= $this->lang->line("act_add"); ?></button>
    <button type="button" class="btn btn-default" onclick="Catalogo.FrmUpd()" title="<?= $this->lang->line("act_upd"); ?>"><?= $this->lang->line("act_upd"); ?></button>
    <button type="button" class="btn btn-default" onclick="Catalogo.FrmDel()" title="<?= $this->lang->line("act_del"); ?>"><?= $this->lang->line("act_del"); ?></button>
    <div class="btn-group">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            Catálogos
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <?php foreach($this->config->item("navConfigCatalogos") as $item): ?>
                <li><a href="<?= base_url($item["url"]); ?>"><?= $item["item"]; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<h1>Catálogos del Sistema <small><?= $titulo; ?></small></h1>
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>
                    <input id="globalcheck" type="checkbox" onclick="$('#tblelementos input').each(function(){this.checked=($('#globalcheck')[0].checked);})" />
                </th>
                <th>Elemento</th>
            </tr>
        </thead>
        <tbody id="tblelementos">
            <?php foreach($cat->getAll() as $elem): ?>
                <tr>
                    <td><input type="checkbox" value="<?= $elem["id".$catname]; ?>"></td>
                    <td><?= $elem["valor"]; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    var catname='<?= $catname; ?>';
</script>