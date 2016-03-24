<?php
$menuItems=$this->config->item('navBarMenu');
$currentItems=isset($currentItems) && is_array($currentItems)?$currentItems:array();
if(count($menuItems)>0):?>
    <nav id="barraNavegacion" class="navbar navbar-default" role="navigation">
        <div class="nav-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Menú</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <?php foreach($menuItems as $mainMenuItem): ?>
                    <li class="<?= (in_array($mainMenuItem["id"],$currentItems)?'active':''); ?> <?= (count($mainMenuItem["subitems"])>0?'dropdown':''); ?>">
                        <a href="<?= ($mainMenuItem["url"]!="" && count($mainMenuItem["subitems"])==0?base_url($mainMenuItem["url"]):"#"); ?>">
                            <h3><?= $mainMenuItem["item"]; ?></h3>
                        </a>
                        <?php 
                            if(count($mainMenuItem["subitems"])>0)
                                showItems($mainMenuItem["subitems"],$currentItems);
                        ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </nav>
<?php 
endif;
function showItems($items,$currentItems)
{
    ?>
    <ul class="dropdown-menu">
        <?php foreach($items as $item): ?>
            <li class="<?= (in_array($item["id"],$currentItems)?'active':''); ?> <?= (count($item["subitems"])>0?'dropdown':''); ?>">
                <a href="<?= ($item["url"]!="" && count($item["subitems"])==0?base_url($item["url"]):"#"); ?>">
                    <?= $item["item"]; ?>
                </a>
                <?php 
                    if(count($item["subitems"])>0)
                        showItems($item["subitems"]);
                ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php
}
?>
