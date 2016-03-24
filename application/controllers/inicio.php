<?php
class Inicio extends CI_Controller
{
    public function index()
    {
        $body=$this->load->view("html/body",array(
            "sectionBody"=>$this->load->view("inicio/login",array(),true),
            "footer"=>$this->config->item('footer')
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
