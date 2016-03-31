<?php
class Permisos extends CI_Controller
{
    private $itemNavBar=array("7");
    function index()
    {
        $this->load->model('modpermiso');
        $permisos=$this->modpermiso->getAllStructured();
        $body=$this->load->view("html/body",array(
            "header"=>$this->load->view("html/header",array("link2Principal"=>base_url(),"sitename"=>$this->config->item('appsitename')),true),
            "nav"=>$this->load->view("html/nav",array("currentItems"=>$this->itemNavBar),true),
            "sectionBody"=>$this->load->view("permisos/index",array("permisos"=>$permisos),true),
            "footer"=>""//$this->config->item('footer')
            ),true);
        $this->load->view("html/html",array(
            "head"=>html_head_basictags(
                base_url("project_files"),
                $this->config->item('sitename'),
                array("/css/basicos.css?fecha=".time()),
                array("/js/app.js?fecha=".time()),
                $this->config->item('appname')),
            "body"=>$body
            ));
    }
    public function add()
    {
        $this->load->model('modpermiso');
        $idpermiso=$this->input->post('idpermiso');
        $perms=array();
        for($x=1;$x<=10;$x++)
            array_push($perms,array(
                "p"=>$this->input->post('elemento'.$x)."",
                "d"=>$this->input->post('descripcion'.$x).""
            ));
        foreach($perms as $p) if($p["p"]!="")
        {
            $perm=new Modpermiso();
            $perm->setDescripcion($p["d"]);
            $perm->setIdpermisopadre($idpermiso);
            $perm->setPermiso($p["p"]);
            $perm->addToDatabase();
        }
        $this->resultado->set(array("resultado"=>true));
        $this->resultado->set(array("codigojs"=>"(auxFnPermiso.length>0?setTimeout(function(){Permiso.FrmAdd(auxFnPermiso.shift())},500):location.reload())"));
        echo $this->resultado;
    }
    public function upd()
    {
        $this->load->model('modpermiso');
        $idpermiso=$this->input->post('idpermiso');
        $p=array(
            "p"=>$this->input->post('elemento')."",
            "d"=>$this->input->post('descripcion').""
        );
        if($p["p"]!="")
        {
            $perm=new Modpermiso();
            $perm->getFromDatabase($idpermiso);
            $perm->setDescripcion($p["d"]);
            $perm->setPermiso($p["p"]);
            $perm->updateToDatabase();
            $this->resultado->set(array("resultado"=>true));
            $this->resultado->set(array("codigojs"=>"(auxFnPermiso.length>0?setTimeout(function(){Permiso.FrmUpd(auxFnPermiso.shift())},500):location.reload())"));
        }
        else
        {
            $this->resultado->set(array("resultado"=>false));
            $this->resultado->set(array("texto"=>"Debe ingresar un valor para el permiso."));
            $this->resultado->set(array("codigojs"=>"location.reload()"));
        }
        echo $this->resultado;
    }
    public function del()
    {
        $this->load->model('modpermiso');
        $idpermiso=$this->input->post('idpermiso')."";
        if($idpermiso!="")
        {
            $perm=new Modpermiso();
            $perm->getFromDatabase($idpermiso);
            $perm->desactivar();
            $this->resultado->set(array("resultado"=>true));
            $this->resultado->set(array("codigojs"=>"(auxFnPermiso.length>0?setTimeout(function(){Permiso.Del(auxFnPermiso.shift())},500):location.reload())"));
        }
        else
        {
            $this->resultado->set(array("resultado"=>false));
            $this->resultado->set(array("texto"=>"No se selecciono el permiso."));
            $this->resultado->set(array("codigojs"=>"location.reload()"));
        }
        echo $this->resultado;
    }
}
?>
