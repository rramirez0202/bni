<?php
/**
* Genera el tag &lt;meta charset="_charset_" /&gt;
* 
* @param string Cadena correspondiente al juego de caracteres
* 
* @return string
*/
function html_head_meta_charset($charset="utf-8")
{
    return '<meta charset="'.$charset.'" />';
}
/**
* Genera el tag &lt;meta http-equiv="_name_" content="_content_" /&gt;
* 
* @param mixed Nombre del metadato
* @param mixed Valor del metadato
* 
* @return string
*/
function html_head_meta_http_equiv($name,$content)
{
    return '<meta http-equiv="'.$name.'" content="'.$content.'" />';
}
/**
* General el tag &lt;meta name="_name_" content="_content_" /&gt;
* 
* @param mixed Nombre del metadato
* @param mixed Valor del metadato
* 
* @return string
*/
function html_head_meta_name($name,$content)
{
    return '<meta name="'.$name.'" content="'.$content.'" />';
}
/**
* Genera el tag &lt;title&gt;_title_&lt;/title&gt;
* 
* @param mixed Título de la página
* 
* @return string
*/
function html_head_title($title)
{
    return "<title>$title</title>";
}
/**
* Genera el tag correspondiente &lt;link rel="_$rel_" href="_$href_"  _param1_="_val1_" _param2_="_val2_" ... /&gt;
* 
* @param string Archivo a ligar
* @param string Tipo de relación
* @param array Parametros extra al tag, array("_param1_"="_val1_", "_param2_"="_val2_", ...)
* 
* @return string
*/
function html_head_link($href,$rel="stylesheet",$parameters=array())
{
    $params="";
    foreach($parameters as $p=>$v)
        $params.="$p=\"$v\" ";
    return '<link rel="'.$rel.'" href="'.$href.'" '.$params.'/>';
}
/**
* Genera el tag &lt;script type="_type_" src="_src_"&gt;&lt;/script&gt;
* 
* @param string Archivo a ligar
* @param string Tipo de contenido del archivo
* 
* @return string
*/
function html_head_script($src,$type="text/javascript")
{
    return '<script type="'.$type.'" src="'.$src.'"></script>';
}
/**
* Genera los tags básicos para head
* 
* @param string URL base del proyecto + "/project_files" para favicon, css y js
* @param string Título para la página
* @param string Título para link en dispositivos Apple
* @param string Favicon de la página
* @param array Archivos css a ligar en la página
* @param array Archivos js a ligar en la página
* 
* @return string
*/
function html_head_basictags($urlBase,$title,$appCss=array("/css/basicos.css"),$appJs=array("/js/app.js"),$appTitle="",$favicon="/system/img/favicon.png")
{
    $appTitle=trim($appTitle)!=""?trim($appTitle):$title;
    $basicHeaderTags="";
    $basicHeaderTags.=html_head_meta_charset();
    $basicHeaderTags.=html_head_meta_http_equiv("Expires","Fri, Jan 01 1900 00:00:00 GMT");
    $basicHeaderTags.=html_head_meta_http_equiv("Pragma","no-chache");
    $basicHeaderTags.=html_head_meta_http_equiv("Cache-Control","no-cache");
    $basicHeaderTags.=html_head_meta_http_equiv("Content-Type","text/html; charset=utf-8");
    $basicHeaderTags.=html_head_meta_http_equiv("Lang","es");
    $basicHeaderTags.=html_head_meta_http_equiv("Reply-to","rramirez@rramirez.com");
    $basicHeaderTags.=html_head_meta_http_equiv("X-UA-Compatible","IE=edge");
    $basicHeaderTags.=html_head_meta_name("author","Rubén Ramírez Gómez");
    $basicHeaderTags.=html_head_meta_name("creation-date","01/01/2000");
    $basicHeaderTags.=html_head_meta_name("revisit-after","15 days");
    $basicHeaderTags.=html_head_meta_name("apple-mobile-web-app-title",$appTitle);
    $basicHeaderTags.=html_head_meta_name("viewport","width=device-width, initial-scale=1");
    $basicHeaderTags.=html_head_title($title);
    $basicHeaderTags.=html_head_link($urlBase.$favicon,"shortcut icon",array("type"=>"image/x-icon"));
    $basicHeaderTags.=html_head_link($urlBase.$favicon,"apple-toich-icon");
    $basicHeaderTags.=html_head_link($urlBase.$favicon,"apple-toich-icon",array("sizes"=>"57x57"));
    $basicHeaderTags.=html_head_link($urlBase.$favicon,"apple-toich-icon",array("sizes"=>"72x72"));
    $basicHeaderTags.=html_head_link($urlBase.$favicon,"apple-toich-icon",array("sizes"=>"76x76"));
    $basicHeaderTags.=html_head_link($urlBase.$favicon,"apple-toich-icon",array("sizes"=>"114x114"));
    $basicHeaderTags.=html_head_link($urlBase.$favicon,"apple-toich-icon",array("sizes"=>"120x120"));
    $basicHeaderTags.=html_head_link($urlBase.$favicon,"apple-toich-icon",array("sizes"=>"144x144"));
    $basicHeaderTags.=html_head_link($urlBase.$favicon,"apple-toich-icon",array("sizes"=>"152x152"));
    $basicHeaderTags.=html_head_link($urlBase."/bootstrap/css/bootstrap.min.css");
    $basicHeaderTags.=html_head_link($urlBase."/css/jquery.msg.css");
    $basicHeaderTags.=html_head_link($urlBase."/css/dataTables.bootstrap.min.css");
    foreach($appCss as $css) $basicHeaderTags.=html_head_link($urlBase.$css);
    $basicHeaderTags.=html_head_script($urlBase."/js/jquery-2.2.1.min.js");
    $basicHeaderTags.=html_head_script($urlBase."/bootstrap/js/bootstrap.min.js");
    /*$basicHeaderTags.='
        <!--[if lt IE 9]>
            '.
            html_head_script("htpps://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js").
            html_head_script("https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js");
            '
        <![endif]-->
    ';*/
    $basicHeaderTags.=html_head_script($urlBase."/js/jquery.center.min.js");
    $basicHeaderTags.=html_head_script($urlBase."/js/jquery.msg.min.js");
    $basicHeaderTags.=html_head_script($urlBase."/js/jquery.dataTables.min.js");
    $basicHeaderTags.=html_head_script($urlBase."/js/dataTables.bootstrap.min.js");
    foreach($appJs as $js) $basicHeaderTags.=html_head_script($urlBase.$js);
    return $basicHeaderTags;
}
?>
