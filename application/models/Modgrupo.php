<?php
class Modgrupo extends CI_Model
{
	private $idgrupo;
	private $nombre;
	private $descripcion;
	private $visible;
	private $personas;
	private $usuarios;
	private $administradores;
	private $clientes;
	private $aspectosevaluacion;
	public function __construct()
	{
        $this->load->model('modpersona');
        $this->load->model('modusuario');
        $this->load->model('modcliente');
        $this->load->model('modaspectoevaluacion');
		$this->inicializa();
	}
	public function inicializa()
	{
		$this->idgrupo=0;
		$this->nombre="";
		$this->descripcion="";
		$this->visible=0;
		$this->personas=array();
		$this->usuarios=array();
		$this->administradores=array();
		$this->clientes=array();
		$this->aspectosevaluacion=array();
	}
	public function getIdgrupo() { return $this->idgrupo; }
	public function getNombre() { return $this->nombre; }
	public function getDescripcion() { return $this->descripcion; }
	public function getVisible() { return $this->visible; }
	public function getPersonas() { return $this->personas; }
	public function getUsuarios() { return $this->usuarios; }
	public function getAdministradores() { return $this->administradores; }
	public function getClientes() { return $this->clientes; }
	public function getAspectosevaluacion() { return $this->aspectosevaluacion; }
	public function setIdgrupo($valor) { $this->idgrupo= intval($valor); }
	public function setNombre($valor) { $this->nombre= "".$valor; }
	public function setDescripcion($valor) { $this->descripcion= "".$valor; }
	public function setVisible($valor) { $this->visible= intval($valor); }
	public function setPersonas($valor) { if(is_array($valor)) $this->personas=$valor; else array_push($this->personas,$valor); }
	public function setUsuarios($valor) { if(is_array($valor)) $this->usuarios=$valor; else array_push($this->usuarios,$valor); }
	public function setAdministradores($valor) { if(is_array($valor)) $this->administradores=$valor; else array_push($this->administradores,$valor); }
	public function setClientes($valor) { if(is_array($valor)) $this->clientes=$valor; else array_push($this->clientes,$valor); }
	public function setAspectosevaluacion($valor) { if(is_array($valor)) $this->aspectosevaluacion=$valor; else array_push($this->aspectosevaluacion,$valor); }
	public function getFromDatabase($id=0)
	{
		if($this->idgrupo==""||$this->idgrupo==0)
		{
			if($id>0)
				$this->idgrupo=$id;
			else
				return false;
		}
		$this->db->where('idgrupo',$this->idgrupo);
		$regs=$this->db->get('grupo');
		if($regs->num_rows()==0)
			return false;
		$reg=$regs->row_array();
		$this->setIdgrupo($reg["idgrupo"]);
		$this->setNombre($reg["nombre"]);
		$this->setDescripcion($reg["descripcion"]);
		$this->setVisible($reg["visible"]);
        $this->db->where('idgrupo',$this->idgrupo);
        $regs=$this->db->get('grupo_has_persona');
        if($regs->num_rows()>0) foreach($regs->result_array() as $reg)
        {
            $v=new Modpersona();
            $v->getFromDatabase($reg["idpersona"]);
            $this->setPersonas($v);
        }
        $this->db->where('idgrupo',$this->idgrupo);
        $regs=$this->db->get('grupo_has_usuario');
        if($regs->num_rows()>0) foreach($regs->result_array() as $reg)
        {
            $v=new Modusuario();
            $v->getFromDatabase($reg["idusuario"]);
            $this->setUsuarios($v);
        }
        $this->db->where('idgrupo',$this->idgrupo);
        $regs=$this->db->get('grupo_has_cliente');
        if($regs->num_rows()>0) foreach($regs->result_array() as $reg)
        {
            $v=new Modcliente();
            $v->getFromDatabase($reg["idcliente"]);
            $this->setClientes($v);
        }
        $this->db->where('idgrupo',$this->idgrupo);
        $regs=$this->db->get('usuario_administra_grupo');
        if($regs->num_rows()>0) foreach($regs->result_array() as $reg)
        {
            $v=new Modusuario();
            $v->getFromDatabase($reg["idusuario"]);
            $this->setAdministradores($v);
        }
        $this->db->where('idgrupo',$this->idgrupo);
        $regs=$this->db->get('aspectoevaluacion');
        if($regs->num_rows()>0) foreach($regs->result_array() as $reg)
        {
            $v=new Modaspectoevaluacion();
            $v->getFromDatabase($reg["idaspectoevaluacion"]);
            $this->setAspectosevaluacion($v);
        }
		return true;
	}
	public function getFromInput()
	{
		$this->setIdgrupo($this->input->post("frm_grupo_idgrupo"));
		$this->setNombre($this->input->post("frm_grupo_nombre"));
		$this->setDescripcion($this->input->post("frm_grupo_descripcion"));
		$this->setVisible($this->input->post("frm_grupo_visible"));
		$personas=$this->input->post("frm_grupo_personas");
		$usuarios=$this->input->post("frm_grupo_usuarios");
		$administradores=$this->input->post("frm_grupo_administradores");
		$clientes=$this->input->post("frm_grupo_clientes");
        if($personas!==false&&is_array($personas)) foreach($personas as $t)
        {
            $v=new Modpersona();
            $v->getFromDatabase($t);
            $this->setPersonas($v);
        }
        if($usuarios!==false&&is_array($usuarios)) foreach($usuarios as $t)
        {
            $v=new Modusuario();
            $v->getFromDatabase($t);
            $this->setUsuarios($v);
        }
        if($administradores!==false&&is_array($administradores)) foreach($administradores as $t)
        {
            $v=new Modusuario();
            $v->getFromDatabase($t);
            $this->setAdministradores($v);
        }
        if($clientes!==false&&is_array($clientes)) foreach($clientes as $t)
        {
            $v=new Modcliente();
            $v->getFromDatabase($t);
            $this->setClientes($v);
        }
		return true;
	}
	public function addToDatabase()
	{
		$data=array(
			"nombre"=>$this->nombre,
			"descripcion"=>$this->descripcion,
			"visible"=>$this->visible
		);
		$this->db->insert('grupo',$data);
		$this->setIdgrupo($this->db->insert_id());
        $this->db->where("idgrupo",$this->idgrupo);
        $this->db->delete(array('grupo_has_persona','grupo_has_usuario','usuario_administra_grupo','grupo_has_cliente'));
        foreach($this->personas as $p)
            $this->db->insert('grupo_has_persona',array("idgrupo"=>$this->idgrupo,"idpersona"=>$p->getIdpersona()));
        foreach($this->usuarios as $p)
            $this->db->insert('grupo_has_usuario',array("idgrupo"=>$this->idgrupo,"idusuario"=>$p->getIdusuario()));
        foreach($this->clientes as $p)
            $this->db->insert('grupo_has_cliente',array("idgrupo"=>$this->idgrupo,"idcliente"=>$p->getIdcliente()));
        foreach($this->administradores as $p)
            $this->db->insert('usuario_administra_grupo',array("idgrupo"=>$this->idgrupo,"idusuario"=>$p->getIdusuario()));
		return true;
	}
	public function updateToDatabase($id=0)
	{
		if($this->idgrupo==""||$this->idgrupo==0)
		{
			if($id>0)
				$this->idgrupo=$id;
			else
				return false;
		}
		$data=array(
			"nombre"=>$this->nombre,
			"descripcion"=>$this->descripcion,
			"visible"=>$this->visible
		);
		$this->db->where('idgrupo',$this->idgrupo);
		$this->db->update('grupo',$data);
        $this->db->where("idgrupo",$this->idgrupo);
        $this->db->delete(array('grupo_has_persona','grupo_has_usuario','usuario_administra_grupo','grupo_has_cliente'));
        foreach($this->personas as $p)
            $this->db->insert('grupo_has_persona',array("idgrupo"=>$this->idgrupo,"idpersona"=>$p->getIdpersona()));
        foreach($this->usuarios as $p)
            $this->db->insert('grupo_has_usuario',array("idgrupo"=>$this->idgrupo,"idusuario"=>$p->getIdusuario()));
        foreach($this->clientes as $p)
            $this->db->insert('grupo_has_cliente',array("idgrupo"=>$this->idgrupo,"idcliente"=>$p->getIdcliente()));
        foreach($this->administradores as $p)
            $this->db->insert('usuario_administra_grupo',array("idgrupo"=>$this->idgrupo,"idusuario"=>$p->getIdusuario()));
		return true;
	}
	public function getAll()
	{
        $this->db->where('visible',true);
		$this->db->order_by('');
		$regs=$this->db->get('grupo');
		if($regs->num_rows()==0)
			return false;
		return $regs->result_array();
	}
	private function delete($id=0)
	{
		if($this->idgrupo==""||$this->idgrupo==0)
		{
			if($id>0)
				$this->idgrupo=$id;
			else
				return false;
		}
		$this->db->where('idgrupo',$this->idgrupo);
		$this->db->delete(array('grupo_has_persona','grupo_has_usuario','usuario_administra_grupo','grupo_has_cliente','aspectoevaluacion','grupo'));
		return true;
	}
	public function desactivar($id=0)
	{
		//return $this->delete($id);
        if($this->idgrupo==""||$this->idgrupo==0)
        {
            if($id>0)
                $this->idgrupo=$id;
            else
                return false;
        }
        $this->db->where('idgrupo',$this->idgrupo);
        $this->db->delete(array('grupo_has_persona','grupo_has_usuario','usuario_administra_grupo','grupo_has_cliente'));
        $this->db->where('idgrupo',$this->idgrupo);
        $this->db->update('grupo',array("visible"=>false));
        return true;
	}
}
?>
