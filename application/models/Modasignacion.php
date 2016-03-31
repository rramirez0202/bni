<?php
class Modasignacion extends CI_Model
{
	private $idinstanciaproyectoactividad;
	private $idusuario;
	private $idtiporol;
	private $idasignacion;
	private $instanciaproyectoactividad;
	private $usuario;
	private $tiporol;
	public function __construct()
	{
		$this->inicializa();
	}
	public function inicializa()
	{
		$this->idinstanciaproyectoactividad=0;
		$this->idusuario=0;
		$this->idtiporol=0;
		$this->idasignacion=0;
		$this->instanciaproyectoactividad="";
		$this->usuario="";
		$this->tiporol="";
	}
	public function getIdinstanciaproyectoactividad() { return $this->idinstanciaproyectoactividad; }
	public function getIdusuario() { return $this->idusuario; }
	public function getIdtiporol() { return $this->idtiporol; }
	public function getIdasignacion() { return $this->idasignacion; }
	public function getInstanciaproyectoactividad() { return $this->instanciaproyectoactividad; }
	public function getUsuario() { return $this->usuario; }
	public function getTiporol() { return $this->tiporol; }
	public function setIdinstanciaproyectoactividad($valor) { $this->idinstanciaproyectoactividad= intval($valor); }
	public function setIdusuario($valor) { $this->idusuario= intval($valor); }
	public function setIdtiporol($valor) { $this->idtiporol= intval($valor); }
	public function setIdasignacion($valor) { $this->idasignacion= intval($valor); }
	public function setInstanciaproyectoactividad($valor) { $this->instanciaproyectoactividad= "".$valor; }
	public function setUsuario($valor) { $this->usuario= "".$valor; }
	public function setTiporol($valor) { $this->tiporol= "".$valor; }
	public function getFromDatabase($id=0)
	{
		if($this->idasignacion==""||$this->idasignacion==0)
		{
			if($id>0)
				$this->idasignacion=$id;
			else
				return false;
		}
		$this->db->where('idasignacion',$this->idasignacion);
		$regs=$this->db->get('asignacion');
		if($regs->num_rows()==0)
			return false;
		$reg=$regs->row_array();
		$this->setIdinstanciaproyectoactividad($reg["idinstanciaproyectoactividad"]);
		$this->setIdusuario($reg["idusuario"]);
		$this->setIdtiporol($reg["idtiporol"]);
		$this->setIdasignacion($reg["idasignacion"]);
		$this->setInstanciaproyectoactividad($reg["instanciaproyectoactividad"]);
		$this->setUsuario($reg["usuario"]);
		$this->setTiporol($reg["tiporol"]);
		return true;
	}
	public function getFromInput()
	{
		$this->setIdinstanciaproyectoactividad($this->input->post("frm_asignacion_idinstanciaproyectoactividad"));
		$this->setIdusuario($this->input->post("frm_asignacion_idusuario"));
		$this->setIdtiporol($this->input->post("frm_asignacion_idtiporol"));
		$this->setIdasignacion($this->input->post("frm_asignacion_idasignacion"));
		$this->setInstanciaproyectoactividad($this->input->post("frm_asignacion_instanciaproyectoactividad"));
		$this->setUsuario($this->input->post("frm_asignacion_usuario"));
		$this->setTiporol($this->input->post("frm_asignacion_tiporol"));
		return true;
	}
	public function addToDatabase()
	{
		$data=array(
			"idinstanciaproyectoactividad"=>$this->idinstanciaproyectoactividad,
			"idusuario"=>$this->idusuario,
			"idtiporol"=>$this->idtiporol,
			"instanciaproyectoactividad"=>$this->instanciaproyectoactividad,
			"usuario"=>$this->usuario,
			"tiporol"=>$this->tiporol,
		);
		$this->db->insert('asignacion',$data);
		$this->setIdasignacion($this->db->insert_id());
		return true;
	}
	public function updateToDatabase($id=0)
	{
		if($this->idasignacion==""||$this->idasignacion==0)
		{
			if($id>0)
				$this->idasignacion=$id;
			else
				return false;
		}
		$data=array(
			"idinstanciaproyectoactividad"=>$this->idinstanciaproyectoactividad,
			"idusuario"=>$this->idusuario,
			"idtiporol"=>$this->idtiporol,
			"instanciaproyectoactividad"=>$this->instanciaproyectoactividad,
			"usuario"=>$this->usuario,
			"tiporol"=>$this->tiporol,
		);
		$this->db->where('idasignacion',$this->idasignacion);
		$this->db->update('asignacion',$data);
		return true;
	}
	public function getAll()
	{
		$this->db->order_by('');
		$regs=$this->db->get('asignacion');
		if($regs->num_rows()==0)
			return false;
		return $regs->result_array();
	}
	private function delete($id=0)
	{
		if($this->idasignacion==""||$this->idasignacion==0)
		{
			if($id>0)
				$this->idasignacion=$id;
			else
				return false;
		}
		$this->db->where('idasignacion',$this->idasignacion);
		$this->db->delete(array('asignacion'));
		return true;
	}
	public function desactivar($id=0)
	{
		return $this->delete($id);
	}
}
?>
