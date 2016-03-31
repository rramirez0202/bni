<?php
class Catalogo extends CI_Controller
{
    private $itemNavBar=array("7");
    function index()
    {
        $body=$this->load->view("html/body",array(
            "header"=>$this->load->view("html/header",array("link2Principal"=>base_url(),"sitename"=>$this->config->item('appsitename')),true),
            "nav"=>$this->load->view("html/nav",array("currentItems"=>$this->itemNavBar),true),
            "sectionBody"=>$this->load->view("catalogo/index",array(),true),
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
    public function administrar($cat)
    {
        $cbody="";
        $cat=strtolower(trim($cat));
        $catcorrecto=false;
        foreach($this->config->item("navConfigCatalogos") as $item)
            if(strpos($item["url"],"catalogo/$cat")!==false)
            {
                eval("\$this->load->model('mod".$cat."');");
                eval("\$catObj=new Mod".$cat."();");
                $cbody=$this->load->view("catalogo/administrar",array("titulo"=>$item["item"],"cat"=>$catObj,"catname"=>$cat),true);
                $catcorrecto=true;
            }
        if(!$catcorrecto)
            header("location: ".base_url('inicio/principal'));
        $body=$this->load->view("html/body",array(
            "header"=>$this->load->view("html/header",array("link2Principal"=>base_url(),"sitename"=>$this->config->item('appsitename')),true),
            "nav"=>$this->load->view("html/nav",array("currentItems"=>$this->itemNavBar),true),
            "sectionBody"=>$cbody,
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
    public function addoption($cat)
    {
        $cat=trim($cat);
        if($cat=="")
        {
            $this->resultado->set(array("resultado"=>false));
            $this->resultado->set(array("texto"=>"No se ha ingresado el catalogo"));
            $this->resultado->set(array("codigojs"=>"location.reload();"));
        }
        else
        {
            eval("\$this->load->model('mod".$cat."');");
            $valor=$this->input->post('valor');
            if($valor!==false&&is_array($valor))
                foreach($valor as $v)
                {
                    eval("\$catObj=new Mod$cat();");
                    $catObj->setVisible(true);
                    $catObj->setValor($v);
                    $catObj->addToDatabase();
                }
            $this->resultado->set(array("resultado"=>true));
            $this->resultado->set(array("codigojs"=>"location.reload();"));
        }
        echo $this->resultado;
    }
    public function updoption($cat)
    {
        $cat=trim($cat);
        if($cat=="")
        {
            $this->resultado->set(array("resultado"=>false));
            $this->resultado->set(array("texto"=>"No se ha ingresado el catalogo"));
            $this->resultado->set(array("codigojs"=>"location.reload();"));
        }
        else
        {
            eval("\$this->load->model('mod".$cat."');");
            $valor=$this->input->post('valor');
            $id=$this->input->post('id');
            if($valor!==false&&is_array($valor))
                foreach($valor as $k=>$v)
                {
                    eval("\$catObj=new Mod$cat();");
                    $catObj->getFromDatabase($id[$k]);
                    $catObj->setVisible(true);
                    $catObj->setValor($v);
                    $catObj->updateToDatabase();
                }
            $this->resultado->set(array("resultado"=>true));
            $this->resultado->set(array("codigojs"=>"location.reload();"));
        }
        echo $this->resultado;
    }
    public function deloption($cat)
    {
        $cat=trim($cat);
        if($cat=="")
        {
            $this->resultado->set(array("resultado"=>false));
            $this->resultado->set(array("texto"=>"No se ha ingresado el catalogo"));
            $this->resultado->set(array("codigojs"=>"location.reload();"));
        }
        else
        {
            eval("\$this->load->model('mod".$cat."');");
            $id=$this->input->post('id');
            if($id!==false&&is_array($id))
                foreach($id as $i)
                {
                    eval("\$catObj=new Mod$cat();");
                    $catObj->desactivar($i);
                }
            $this->resultado->set(array("resultado"=>true));
            $this->resultado->set(array("codigojs"=>"location.reload();"));
        }
        echo $this->resultado;
    }
}
?>