<?php
class Modaplicacion extends CI_Model
{
	private $idaplicacion;
	private $iddetalleaspectoevaluacion;
	private $idpersona;
	private $calificacion;
	private $visible;
	private $persona;
	private $detalleasepctoevaluacion;
	public function __construct()
	{
		$this->inicializa();
	}
	public function inicializa()
	{
		$this->idaplicacion=0;
		$this->iddetalleaspectoevaluacion=0;
		$this->idpersona=0;
		$this->calificacion="";
		$this->visible=0;
		$this->persona="";
		$this->detalleasepctoevaluacion="";
	}
	public function getIdaplicacion() { return $this->idaplicacion; }
	public function getIddetalleaspectoevaluacion() { return $this->iddetalleaspectoevaluacion; }
	public function getIdpersona() { return $this->idpersona; }
	public function getCalificacion() { return $this->calificacion; }
	public function getVisible() { return $this->visible; }
	public function getPersona() { return $this->persona; }
	public function getDetalleasepctoevaluacion() { return $this->detalleasepctoevaluacion; }
	public function setIdaplicacion($valor) { $this->idaplicacion= intval($valor); }
	public function setIddetalleaspectoevaluacion($valor) { $this->iddetalleaspectoevaluacion= intval($valor); }
	public function setIdpersona($valor) { $this->idpersona= intval($valor); }
	public function setCalificacion($valor) { $this->calificacion= "".$valor; }
	public function setVisible($valor) { $this->visible= intval($valor); }
	public function setPersona($valor) { $this->persona= "".$valor; }
	public function setDetalleasepctoevaluacion($valor) { $this->detalleasepctoevaluacion= "".$valor; }
	public function getFromDatabase($id=0)
	{
		if($this->idaplicacion==""||$this->idaplicacion==0)
		{
			if($id>0)
				$this->idaplicacion=$id;
			else
				return false;
		}
		$this->db->where('idaplicacion',$this->idaplicacion);
		$regs=$this->db->get('aplicacion');
		if($regs->num_rows()==0)
			return false;
		$reg=$regs->row_array();
		$this->setIdaplicacion($reg["idaplicacion"]);
		$this->setIddetalleaspectoevaluacion($reg["iddetalleaspectoevaluacion"]);
		$this->setIdpersona($reg["idpersona"]);
		$this->setCalificacion($reg["calificacion"]);
		$this->setVisible($reg["visible"]);
		$this->setPersona($reg["persona"]);
		$this->setDetalleasepctoevaluacion($reg["detalleasepctoevaluacion"]);
		return true;
	}
	public function getFromInput()
	{
		$this->setIdaplicacion($this->input->post("frm_aplicacion_idaplicacion"));
		$this->setIddetalleaspectoevaluacion($this->input->post("frm_aplicacion_iddetalleaspectoevaluacion"));
		$this->setIdpersona($this->input->post("frm_aplicacion_idpersona"));
		$this->setCalificacion($this->input->post("frm_aplicacion_calificacion"));
		$this->setVisible($this->input->post("frm_aplicacion_visible"));
		$this->setPersona($this->input->post("frm_aplicacion_persona"));
		$this->setDetalleasepctoevaluacion($this->input->post("frm_aplicacion_detalleasepctoevaluacion"));
		return true;
	}
	public function addToDatabase()
	{
		$data=array(
			"iddetalleaspectoevaluacion"=>$this->iddetalleaspectoevaluacion,
			"idpersona"=>$this->idpersona,
			"calificacion"=>$this->calificacion,
			"visible"=>$this->visible,
			"persona"=>$this->persona,
			"detalleasepctoevaluacion"=>$this->detalleasepctoevaluacion,
		);
		$this->db->insert('aplicacion',$data);
		$this->setIdaplicacion($this->db->insert_id());
		return true;
	}
	public function updateToDatabase($id=0)
	{
		if($this->idaplicacion==""||$this->idaplicacion==0)
		{
			if($id>0)
				$this->idaplicacion=$id;
			else
				return false;
		}
		$data=array(
			"iddetalleaspectoevaluacion"=>$this->iddetalleaspectoevaluacion,
			"idpersona"=>$this->idpersona,
			"calificacion"=>$this->calificacion,
			"visible"=>$this->visible,
			"persona"=>$this->persona,
			"detalleasepctoevaluacion"=>$this->detalleasepctoevaluacion,
		);
		$this->db->where('idaplicacion',$this->idaplicacion);
		$this->db->update('aplicacion',$data);
		return true;
	}
	public function getAll()
	{
		$this->db->order_by('');
		$regs=$this->db->get('aplicacion');
		if($regs->num_rows()==0)
			return false;
		return $regs->result_array();
	}
	private function delete($id=0)
	{
		if($this->idaplicacion==""||$this->idaplicacion==0)
		{
			if($id>0)
				$this->idaplicacion=$id;
			else
				return false;
		}
		$this->db->where('idaplicacion',$this->idaplicacion);
		$this->db->delete(array('aplicacion'));
		return true;
	}
	public function desactivar($id=0)
	{
		return $this->delete($id);
	}
}
?>
