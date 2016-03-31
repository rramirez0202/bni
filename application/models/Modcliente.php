<?php
class Modcliente extends CI_Model
{
	private $idcliente;
	private $nombre;
	private $razonsocial;
	private $rfc;
	private $curp;
	private $logotipo;
	private $calle;
	private $numint;
	private $numext;
	private $cp;
	private $colonia;
	private $municipio;
	private $estado;
	private $visible;
	private $personas;
	private $usuarios;
	private $administradores;
	private $grupos;
	private $procesos;
	private $proyectos;
	public function __construct()
	{
		$this->inicializa();
	}
	public function inicializa()
	{
		$this->idcliente=0;
		$this->nombre="";
		$this->razonsocial="";
		$this->rfc="";
		$this->curp="";
		$this->logotipo="";
		$this->calle="";
		$this->numint="";
		$this->numext="";
		$this->cp=0;
		$this->colonia="";
		$this->municipio="";
		$this->estado="";
		$this->visible=0;
		$this->personas=array();
		$this->usuarios=array();
		$this->administradores=array();
		$this->grupos=array();
		$this->procesos=array();
		$this->proyectos=array();
	}
	public function getIdcliente() { return $this->idcliente; }
	public function getNombre() { return $this->nombre; }
	public function getRazonsocial() { return $this->razonsocial; }
	public function getRfc() { return $this->rfc; }
	public function getCurp() { return $this->curp; }
	public function getLogotipo() { return $this->logotipo; }
	public function getCalle() { return $this->calle; }
	public function getNumint() { return $this->numint; }
	public function getNumext() { return $this->numext; }
	public function getCp() { return $this->cp; }
	public function getColonia() { return $this->colonia; }
	public function getMunicipio() { return $this->municipio; }
	public function getEstado() { return $this->estado; }
	public function getVisible() { return $this->visible; }
	public function getPersonas() { return $this->personas; }
	public function getUsuarios() { return $this->usuarios; }
	public function getAdministradores() { return $this->administradores; }
	public function getGrupos() { return $this->grupos; }
	public function getProcesos() { return $this->procesos; }
	public function getProyectos() { return $this->proyectos; }
	public function setIdcliente($valor) { $this->idcliente= intval($valor); }
	public function setNombre($valor) { $this->nombre= "".$valor; }
	public function setRazonsocial($valor) { $this->razonsocial= "".$valor; }
	public function setRfc($valor) { $this->rfc= "".$valor; }
	public function setCurp($valor) { $this->curp= "".$valor; }
	public function setLogotipo($valor) { $this->logotipo= "".$valor; }
	public function setCalle($valor) { $this->calle= "".$valor; }
	public function setNumint($valor) { $this->numint= "".$valor; }
	public function setNumext($valor) { $this->numext= "".$valor; }
	public function setCp($valor) { $this->cp= intval($valor); }
	public function setColonia($valor) { $this->colonia= "".$valor; }
	public function setMunicipio($valor) { $this->municipio= "".$valor; }
	public function setEstado($valor) { $this->estado= "".$valor; }
	public function setVisible($valor) { $this->visible= intval($valor); }
	public function setPersonas($valor) { if(is_array($valor)) $this->personas=$valor; else array_push($this->personas,$valor); }
	public function setUsuarios($valor) { if(is_array($valor)) $this->usuarios=$valor; else array_push($this->usuarios,$valor); }
	public function setAdministradores($valor) { if(is_array($valor)) $this->administradores=$valor; else array_push($this->administradores,$valor); }
	public function setGrupos($valor) { if(is_array($valor)) $this->grupos=$valor; else array_push($this->grupos,$valor); }
	public function setProcesos($valor) { if(is_array($valor)) $this->procesos=$valor; else array_push($this->procesos,$valor); }
	public function setProyectos($valor) { if(is_array($valor)) $this->proyectos=$valor; else array_push($this->proyectos,$valor); }
	public function getFromDatabase($id=0)
	{
		if($this->idcliente==""||$this->idcliente==0)
		{
			if($id>0)
				$this->idcliente=$id;
			else
				return false;
		}
		$this->db->where('idcliente',$this->idcliente);
		$regs=$this->db->get('cliente');
		if($regs->num_rows()==0)
			return false;
		$reg=$regs->row_array();
		$this->setIdcliente($reg["idcliente"]);
		$this->setNombre($reg["nombre"]);
		$this->setRazonsocial($reg["razonsocial"]);
		$this->setRfc($reg["rfc"]);
		$this->setCurp($reg["curp"]);
		$this->setLogotipo($reg["logotipo"]);
		$this->setCalle($reg["calle"]);
		$this->setNumint($reg["numint"]);
		$this->setNumext($reg["numext"]);
		$this->setCp($reg["cp"]);
		$this->setColonia($reg["colonia"]);
		$this->setMunicipio($reg["municipio"]);
		$this->setEstado($reg["estado"]);
		$this->setVisible($reg["visible"]);
		$this->setPersonas($reg["personas"]);
		$this->setUsuarios($reg["usuarios"]);
		$this->setAdministradores($reg["administradores"]);
		$this->setGrupos($reg["grupos"]);
		$this->setProcesos($reg["procesos"]);
		$this->setProyectos($reg["proyectos"]);
		return true;
	}
	public function getFromInput()
	{
		$this->setIdcliente($this->input->post("frm_cliente_idcliente"));
		$this->setNombre($this->input->post("frm_cliente_nombre"));
		$this->setRazonsocial($this->input->post("frm_cliente_razonsocial"));
		$this->setRfc($this->input->post("frm_cliente_rfc"));
		$this->setCurp($this->input->post("frm_cliente_curp"));
		$this->setLogotipo($this->input->post("frm_cliente_logotipo"));
		$this->setCalle($this->input->post("frm_cliente_calle"));
		$this->setNumint($this->input->post("frm_cliente_numint"));
		$this->setNumext($this->input->post("frm_cliente_numext"));
		$this->setCp($this->input->post("frm_cliente_cp"));
		$this->setColonia($this->input->post("frm_cliente_colonia"));
		$this->setMunicipio($this->input->post("frm_cliente_municipio"));
		$this->setEstado($this->input->post("frm_cliente_estado"));
		$this->setVisible($this->input->post("frm_cliente_visible"));
		$this->setPersonas($this->input->post("frm_cliente_personas"));
		$this->setUsuarios($this->input->post("frm_cliente_usuarios"));
		$this->setAdministradores($this->input->post("frm_cliente_administradores"));
		$this->setGrupos($this->input->post("frm_cliente_grupos"));
		$this->setProcesos($this->input->post("frm_cliente_procesos"));
		$this->setProyectos($this->input->post("frm_cliente_proyectos"));
		return true;
	}
	public function addToDatabase()
	{
		$data=array(
			"nombre"=>$this->nombre,
			"razonsocial"=>$this->razonsocial,
			"rfc"=>$this->rfc,
			"curp"=>$this->curp,
			"logotipo"=>$this->logotipo,
			"calle"=>$this->calle,
			"numint"=>$this->numint,
			"numext"=>$this->numext,
			"cp"=>$this->cp,
			"colonia"=>$this->colonia,
			"municipio"=>$this->municipio,
			"estado"=>$this->estado,
			"visible"=>$this->visible,
			"personas"=>$this->personas,
			"usuarios"=>$this->usuarios,
			"administradores"=>$this->administradores,
			"grupos"=>$this->grupos,
			"procesos"=>$this->procesos,
			"proyectos"=>$this->proyectos,
		);
		$this->db->insert('cliente',$data);
		$this->setIdcliente($this->db->insert_id());
		return true;
	}
	public function updateToDatabase($id=0)
	{
		if($this->idcliente==""||$this->idcliente==0)
		{
			if($id>0)
				$this->idcliente=$id;
			else
				return false;
		}
		$data=array(
			"nombre"=>$this->nombre,
			"razonsocial"=>$this->razonsocial,
			"rfc"=>$this->rfc,
			"curp"=>$this->curp,
			"logotipo"=>$this->logotipo,
			"calle"=>$this->calle,
			"numint"=>$this->numint,
			"numext"=>$this->numext,
			"cp"=>$this->cp,
			"colonia"=>$this->colonia,
			"municipio"=>$this->municipio,
			"estado"=>$this->estado,
			"visible"=>$this->visible,
			"personas"=>$this->personas,
			"usuarios"=>$this->usuarios,
			"administradores"=>$this->administradores,
			"grupos"=>$this->grupos,
			"procesos"=>$this->procesos,
			"proyectos"=>$this->proyectos,
		);
		$this->db->where('idcliente',$this->idcliente);
		$this->db->update('cliente',$data);
		return true;
	}
	public function getAll()
	{
		$this->db->order_by('');
		$regs=$this->db->get('cliente');
		if($regs->num_rows()==0)
			return false;
		return $regs->result_array();
	}
	private function delete($id=0)
	{
		if($this->idcliente==""||$this->idcliente==0)
		{
			if($id>0)
				$this->idcliente=$id;
			else
				return false;
		}
		$this->db->where('idcliente',$this->idcliente);
		$this->db->delete(array('cliente'));
		return true;
	}
	public function desactivar($id=0)
	{
		return $this->delete($id);
	}
}
?>
