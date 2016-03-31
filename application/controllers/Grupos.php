<?php
class Grupos extends CI_Controller
{
    private $itemNavBar=array("6");
    public function __construct()
    {
        parent::__construct();
        $this->load->model('modgrupo');
        //if(!$this->modsesion->logedin())
        //    header("location: ".base_url("sesiones/logout"));
    }
    public function index()
    {
        $body=$this->load->view("html/body",array(
            "header"=>$this->load->view("html/header",array("link2Principal"=>base_url(),"sitename"=>$this->config->item('appsitename')),true),
            "nav"=>$this->load->view("html/nav",array("currentItems"=>$this->itemNavBar),true),
            "sectionBody"=>$this->load->view("grupos/index",array("grupos"=>$this->modgrupo->getAll()),true),
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
        $this->load->model('modpersona');
        $this->load->model('modusuario');
        $this->load->model('modcliente');
        $this->modgrupo->getFromDatabase(0);
        $body=$this->load->view("html/body",array(
            "header"=>$this->load->view("html/header",array("link2Principal"=>base_url(),"sitename"=>$this->config->item('appsitename')),true),
            "nav"=>$this->load->view("html/nav",array("currentItems"=>$this->itemNavBar),true),
            "sectionBody"=>$this->load->view("grupos/formulario",array(
                "objeto"=>$this->modgrupo,
                "usuarios"=>$this->modusuario->getAll(),
                "personas"=>$this->modpersona->getAll(),
                "clientes"=>$this->modcliente->getAll()
                ),true),
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
        $this->load->model('modpersona');
        $this->load->model('modusuario');
        $this->load->model('modcliente');
        $this->modgrupo->getFromDatabase(0);
        $body=$this->load->view("html/body",array(
            "header"=>$this->load->view("html/header",array("link2Principal"=>base_url(),"sitename"=>$this->config->item('appsitename')),true),
            "nav"=>$this->load->view("html/nav",array("currentItems"=>$this->itemNavBar),true),
            "sectionBody"=>$this->load->view("grupos/formulario",array(
                "objeto"=>$this->modgrupo,
                "usuarios"=>$this->modusuario->getAll(),
                "personas"=>$this->modpersona->getAll(),
                "clientes"=>$this->modcliente->getAll()
                ),true),
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
    public function ver($id)
    {
        
    }
    public function add()
    {
        
    }
    public function upd()
    {
        
    }
    public function del($id)
    {
        
    }
}
?>