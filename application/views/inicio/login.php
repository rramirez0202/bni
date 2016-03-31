<script type="text/javascript">
    (function(){
        if(location.host.indexOf("dev")>-1||location.host.indexOf("www")>-1)
            return true;
        location.href = '<?= base_url(); ?>' + location.pathname;
    })();
</script>
<?php
$bg=array();
$dir=dir("./project_files/system/img/background");
while(($file=$dir->read())!==false)
{
    if(in_array(substr($file,strlen($file)-3),array("png","jpg","bmp")))
        array_push($bg,$file);
}
$dir->close();
$div=intval(100/count($bg));
?>
<style type="text/css">
    body
    {
        background: url('<?= base_url('project_files/system/img/bg.jpg'); ?>') no-repeat center fixed;
        background-size: cover;
        -webkit-animation-name: fondos;
        -webkit-animation-duration: <?= count($bg)*5; ?>s;
        -webkit-animation-iteration-count: infinite;
        -webkit-animation-timing-function: ease;
        animation-name: fondos;
        animation-duration: <?= count($bg)*4; ?>s;
        animation-iteration-count: infinite;
        animation-timing-function: ease;
    }
    @-webkit-keyframes fondos
    {
        <?php 
        foreach($bg as $k=>$img)
        {
            echo ($k*$div).'% {background-image: url(\''.base_url('project_files/system/img/background/'.$img).'\');}';
        }
        echo '100% {background-image: url(\''.base_url('project_files/system/img/background/'.$bg[0]).'\');}';
        ?>
    }
    @keyframes fondos
    {
        <?php 
        foreach($bg as $k=>$img)
        {
            echo ($k*$div).'% {background-image: url(\''.base_url('project_files/system/img/background/'.$img).'\');}';
        }
        echo '100% {background-image: url(\''.base_url('project_files/system/img/background/'.$bg[0]).'\');}';
        ?>
    }
</style>
<div class="frmacceso">
    <div class="frmacceso_logo">
        <img src="<?= base_url('project_files/system/img/logo_login.png'); ?>" />
    </div>
    <form id="frmacceso" role="form" onsubmit="return false">
        <div class="form-group">
            <label for="frmacceso_usr">Usuario:</label>
            <input type="text" class="form-control" id="frmacceso_usr" name="frmacceso_usr" maxlength="250" required="required" />
        </div>
        <div class="form-group">
            <label for="frmacceso_pwd">Contraseña:</label>
            <input type="password" class="form-control" id="frmacceso_pwd" name="frmacceso_pwd" maxlength="250" required="required" />
        </div>
        <div class="form-group centro">
            <a href="#">¿Olvido su contraseña?</a>
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-primary btn-block" onclick="$('#frmacceso_usr').val()=='admin'&&$('#frmacceso_pwd').val()=='admin'?location.href='<?= base_url('inicio/principal'); ?>':Alert('Usuario/contraseña incorrectos',function(){return false;})">Accesar</button>
        </div>
    </form>
</div>