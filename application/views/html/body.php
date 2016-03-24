<?php
$header=isset($header)?$header:"";
$nav=isset($nav)?$nav:"";
$sectionBody=isset($sectionBody)?$sectionBody:"";
$aside=isset($aside)?$aside:"";
$footer=isset($footer)?$footer:"";
?>
<section id="pageGlobalHeader">
    <?php if($header!=""): ?>
    <header id="pageHeader" class="container">
        <?= $header; ?>
    </header>
    <?php endif;
    if($nav!=""): ?>
    <section id="pageNav">
        <section class="container">
            <?= $nav; ?>
        </section>
    </section>
    <?php endif; ?>
</section>
<?php if($sectionBody!=""||$aside!=""): ?>
    <section id="pageSuperBodyContainer">
        <section id="pageBodyContainer" class="container">
            <?php if($sectionBody!=""): ?>
            <section id="pageBody">
                <?= $sectionBody; ?>
            </section>
            <?php endif;
            if($aside!=""): ?>
            <aside id="pageASide">
                <?= $aside; ?>
            </aside>
            <?php endif; ?>
        </section>
    </section>
    <script type="text/javascript">
        $(document).ready(function(){
            estandarizaTamanio();
            window.onresize=estandarizaTamanio;
        });
    </script>
<?php endif;
if($footer!=""): ?>
<footer id="pageFooter">
    <section class="container">
        <?= $footer; ?>
    </section>
</footer>
<?php endif; ?>