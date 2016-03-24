<?php
$link2Principal=isset($link2Principal)?$link2Principal:"";
$sitename=isset($sitename)?$sitename:"";
?>
<?php if($link2Principal!=""): ?>
    <a href="<?= $link2Principal; ?>">
<?php endif; ?>
    <img class="img-rounded" src="<?= base_url("project_files/system/img/logo.png")?>" alt="<?= $sitename; ?>" title="<?= $sitename ?>">
    <h1 id="siteTitle"><?= $sitename; ?></h1>
<?php if($link2Principal!=""): ?>
    </a>
<?php endif; ?>