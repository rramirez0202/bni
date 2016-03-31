<?php
$body=isset($body)?$body:"";
$head=isset($head)?$head:"";
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?= $head; ?>
        <script type="text/javascript">
            var baseURL='<?= base_url(); ?>';
        </script>
    </head>
    <body>
        <?= $body; ?>
    </body>
</html>