<?php
class Personas extends CI_Controller
{
    private $itemNavBar=array("6");
    public function __construct()
    {
        parent::__construct();
        $this->load->model('modpersona');
        //if(!$this->modsesion->logedin())
        //    header("location: ".base_url("sesiones/logout"));
    }
    public function index()
    {
        $body=$this->load->view("html/body",array(
            "header"=>$this->load->view("html/header",array("link2Principal"=>base_url(),"sitename"=>$this->config->item('appsitename')),true),
            "nav"=>$this->load->view("html/nav",array("currentItems"=>$this->itemNavBar),true),
            "sectionBody"=>$this->load->view("personas/index",array("personas"=>$this->modpersona->getAll()),true),
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
        $this->load->model('modgrupo');
        $this->load->model('modtipotelefono');
        $this->load->model('modtipocorreo');
        $p=new Modpersona();
        $body=$this->load->view("html/body",array(
            "header"=>$this->load->view("html/header",array("link2Principal"=>base_url(),"sitename"=>$this->config->item('appsitename')),true),
            "nav"=>$this->load->view("html/nav",array("currentItems"=>$this->itemNavBar),true),                              
            "sectionBody"=>$this->load->view("personas/formulario",array("grupos"=>$this->modgrupo->getAll(),"objeto"=>$p,"tipotelefono"=>$this->modtipotelefono->getAll(),"tipocorreo"=>$this->modtipocorreo->getAll()),true),
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
        $this->load->model('modgrupo');
        $this->load->model('modtipotelefono');
        $this->load->model('modtipocorreo');
        $p=new Modpersona();
        $p->getFromDatabase($id);
        $body=$this->load->view("html/body",array(
            "header"=>$this->load->view("html/header",array("link2Principal"=>base_url(),"sitename"=>$this->config->item('appsitename')),true),
            "nav"=>$this->load->view("html/nav",array("currentItems"=>$this->itemNavBar),true),                              
            "sectionBody"=>$this->load->view("personas/formulario",array("grupos"=>$this->modgrupo->getAll(),"objeto"=>$p,"tipotelefono"=>$this->modtipotelefono->getAll(),"tipocorreo"=>$this->modtipocorreo->getAll()),true),
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
        $this->load->model('modgrupo');
        $p=new Modpersona();
        $p->getFromDatabase($id);
        $body=$this->load->view("html/body",array(
            "header"=>$this->load->view("html/header",array("link2Principal"=>base_url(),"sitename"=>$this->config->item('appsitename')),true),
            "nav"=>$this->load->view("html/nav",array("currentItems"=>$this->itemNavBar),true),                              
            "sectionBody"=>$this->load->view("personas/vista",array("objeto"=>$p),true),
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
        $this->modpersona->getFromInput();
        $this->modpersona->addToDatabase();
        $id=$this->modpersona->getIdpersona();
        if($id>0)
        {
            $this->resultado->set(array("resultado"=>true));
            $this->resultado->set(array("codigojs"=>"location.href=baseURL+'personas/ver/$id'"));
        }
        else
        {
            $this->resultado->set(array("resultado"=>false));
            $this->resultado->set(array("texto"=>"Error al guardar datos"));
            $this->resultado->set(array("codigojs"=>"1+1"));
        }
        echo $this->resultado;
    }
    public function upd()
    {
        $id=$this->input->post('frm_persona_idpersona');
        $this->modpersona->getFromDatabase($id);
        $this->modpersona->getFromInput();
        $this->modpersona->updateToDatabase();
        $this->resultado->set(array("resultado"=>true));
        $this->resultado->set(array("codigojs"=>"location.href=baseURL+'personas/ver/$id'"));
        echo $this->resultado;
    }
    public function del($id)
    {
        $this->modpersona->getFromDatabase($id);
        $this->modpersona->desactivar();
        $this->resultado->set(array("resultado"=>true));
        $this->resultado->set(array("codigojs"=>"location.href=baseURL+'personas'"));
        echo $this->resultado;
    }
}
?>
