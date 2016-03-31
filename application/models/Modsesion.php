<?php
class Modsesion extends CI_Model
{
    private $perfiles=array();
    private $administrador=array(
        "usuarios"=>array(),
        "personas"=>array(),
        "clietes"=>array(),
        "grupos"=>array()
    );
    public function __construct()
    {
        parent::__construct();
        $this->inicializa();
    }
    public function inicializa()
    {
        $this->perfiles=array();
        $this->administrador=array(
            "usuarios"=>array(),
            "personas"=>array(),
            "clietes"=>array(),
            "grupos"=>array()
        );
    }
    public function getAcceso($usr,$pwd)
    {
        $pwd=sha1($pwd);
        $this->db->where(array("usr"=>$usr,"pwd"=>$pwd,"activo"=>true,"visible"=>true));
        $regs=$this->db->get("usuario");
        if($regs->num_rows()==0)
            return false;
        return $regs->row_array();
    }
    public function getData($usr)
    {
        $this->db->where(array("usr"=>$usr,"activo"=>true,"visible"=>true));
        $regs=$this->db->get("usuario");
        if($regs->num_rows()==0)
            return false;
        return $regs->row_array();
    }
    public function logedin()
    {
        $insesion=(!($this->session->userdata('idusuario')===false));
        if($insesion)
            $this->getDatos();
        return $insesion;
    }
    private function getDatos()
    {
        $this->inicializa();
    }
}
?>
