<?php
class Perfiles extends CI_Controller
{
    private $itemNavBar=array("7");
    public function __construct()
    {
        parent::__construct();
        $this->load->model('modperfil');
        //if(!$this->modsesion->logedin())
        //    header("location: ".base_url("sesiones/logout"));
    }
    public function index()
    {
        $body=$this->load->view("html/body",array(
            "header"=>$this->load->view("html/header",array("link2Principal"=>base_url(),"sitename"=>$this->config->item('appsitename')),true),
            "nav"=>$this->load->view("html/nav",array("currentItems"=>$this->itemNavBar),true),
            "sectionBody"=>$this->load->view("perfiles/index",array("perfiles"=>$this->modperfil->getAll()),true),
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
    public function nuevo()
    {
        $this->load->model('modpermiso');
        $p=new Modperfil();
        $body=$this->load->view("html/body",array(
            "header"=>$this->load->view("html/header",array("link2Principal"=>base_url(),"sitename"=>$this->config->item('appsitename')),true),
            "nav"=>$this->load->view("html/nav",array("currentItems"=>$this->itemNavBar),true),                              
            "sectionBody"=>$this->load->view("perfiles/formulario",array("perfiles"=>$this->modperfil->getAll(),"objeto"=>$p,"permisos"=>$this->modpermiso->getAllStructured()),true),
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
        $this->modperfil->getFromInput();
        $this->modperfil->addToDatabase();
        $id=$this->modperfil->getIdperfil();
        if($id>0)
        {
            $this->resultado->set(array("resultado"=>true));
            $this->resultado->set(array("codigojs"=>"location.href=baseURL+'perfiles/ver/$id'"));
        }
        else
        {
            $this->resultado->set(array("resultado"=>false));
            $this->resultado->set(array("texto"=>"Error al guardar perfil"));
            $this->resultado->set(array("codigojs"=>"1+1"));
        }
        echo $this->resultado;
    }
    public function upd()
    {
        $this->modperfil->getFromInput();
        $this->modperfil->updateToDatabase();
        $id=$this->modperfil->getIdperfil();
        $this->resultado->set(array("resultado"=>true));
        $this->resultado->set(array("codigojs"=>"location.href=baseURL+'perfiles/ver/$id'"));
        echo $this->resultado;
    }
    public function del($idperfil)
    {
        $this->modperfil->getFromDatabase($idperfil);
        $this->modperfil->desactivar();
        $this->resultado->set(array("resultado"=>true));
        $this->resultado->set(array("codigojs"=>"location.href=baseURL+'perfiles'"));
        echo $this->resultado;
    }
    public function ver($id)
    {
        $this->load->model('modpermiso');
        $p=new Modperfil();
        $p->getFromDatabase($id);
        $body=$this->load->view("html/body",array(
            "header"=>$this->load->view("html/header",array("link2Principal"=>base_url(),"sitename"=>$this->config->item('appsitename')),true),
            "nav"=>$this->load->view("html/nav",array("currentItems"=>$this->itemNavBar),true),                              
            "sectionBody"=>$this->load->view("perfiles/vista",array("perfiles"=>$this->modperfil->getAll(),"objeto"=>$p,"permisos"=>$this->modpermiso->getAllStructured()),true),
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
    public function actualizar($id)
    {
        $this->load->model('modpermiso');
        $p=new Modperfil();
        $p->getFromDatabase($id);
        $body=$this->load->view("html/body",array(
            "header"=>$this->load->view("html/header",array("link2Principal"=>base_url(),"sitename"=>$this->config->item('appsitename')),true),
            "nav"=>$this->load->view("html/nav",array("currentItems"=>$this->itemNavBar),true),                              
            "sectionBody"=>$this->load->view("perfiles/formulario",array("perfiles"=>$this->modperfil->getAll(),"objeto"=>$p,"permisos"=>$this->modpermiso->getAllStructured()),true),
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
}
?>
