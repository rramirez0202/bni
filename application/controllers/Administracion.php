<?php
class Administracion extends CI_Controller
{
    private $itemNavBar=array("6");
    public function __construct()
    {
        parent::__construct();
        //if(!$this->modsesion->logedin())
        //    header("location: ".base_url("sesiones/logout"));
    }
    public function index()
    {
        $this->load->model('modpersona');
        $this->load->model('modgrupo');
        $body=$this->load->view("html/body",array(
            "header"=>$this->load->view("html/header",array("link2Principal"=>base_url(),"sitename"=>$this->config->item('appsitename')),true),
            "nav"=>$this->load->view("html/nav",array("currentItems"=>$this->itemNavBar),true),
            "sectionBody"=>$this->load->view("administracion/index",array(
                "personas"=>$this->modpersona->getAll(),
                "grupos"=>$this->modgrupo->getAll()
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
}
?>
