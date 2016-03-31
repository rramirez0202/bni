<?php
class Modaspectoevaluacion extends CI_Model
{
	private $idaspectoevaluacion;
	private $idgrupo;
	private $nombre;
	private $descripcion;
	private $porcentaje;
	private $idtipoaspectoevaluacion;
	private $visible;
	private $grupo;
	private $tipoaspectoevaluacion;
	private $detalleasepctoevaluacion;
	public function __construct()
	{
		$this->inicializa();
	}
	public function inicializa()
	{
		$this->idaspectoevaluacion=0;
		$this->idgrupo=0;
		$this->nombre="";
		$this->descripcion="";
		$this->porcentaje="";
		$this->idtipoaspectoevaluacion=0;
		$this->visible=0;
		$this->grupo="";
		$this->tipoaspectoevaluacion="";
		$this->detalleasepctoevaluacion=array();
	}
	public function getIdaspectoevaluacion() { return $this->idaspectoevaluacion; }
	public function getIdgrupo() { return $this->idgrupo; }
	public function getNombre() { return $this->nombre; }
	public function getDescripcion() { return $this->descripcion; }
	public function getPorcentaje() { return $this->porcentaje; }
	public function getIdtipoaspectoevaluacion() { return $this->idtipoaspectoevaluacion; }
	public function getVisible() { return $this->visible; }
	public function getGrupo() { return $this->grupo; }
	public function getTipoaspectoevaluacion() { return $this->tipoaspectoevaluacion; }
	public function getDetalleasepctoevaluacion() { return $this->detalleasepctoevaluacion; }
	public function setIdaspectoevaluacion($valor) { $this->idaspectoevaluacion= intval($valor); }
	public function setIdgrupo($valor) { $this->idgrupo= intval($valor); }
	public function setNombre($valor) { $this->nombre= "".$valor; }
	public function setDescripcion($valor) { $this->descripcion= "".$valor; }
	public function setPorcentaje($valor) { $this->porcentaje= "".$valor; }
	public function setIdtipoaspectoevaluacion($valor) { $this->idtipoaspectoevaluacion= intval($valor); }
	public function setVisible($valor) { $this->visible= intval($valor); }
	public function setGrupo($valor) { $this->grupo= "".$valor; }
	public function setTipoaspectoevaluacion($valor) { $this->tipoaspectoevaluacion= "".$valor; }
	public function setDetalleasepctoevaluacion($valor) { if(is_array($valor)) $this->detalleasepctoevaluacion=$valor; else array_push($this->detalleasepctoevaluacion,$valor); }
	public function getFromDatabase($id=0)
	{
		if($this->idaspectoevaluacion==""||$this->idaspectoevaluacion==0)
		{
			if($id>0)
				$this->idaspectoevaluacion=$id;
			else
				return false;
		}
		$this->db->where('idaspectoevaluacion',$this->idaspectoevaluacion);
		$regs=$this->db->get('aspectoevaluacion');
		if($regs->num_rows()==0)
			return false;
		$reg=$regs->row_array();
		$this->setIdaspectoevaluacion($reg["idaspectoevaluacion"]);
		$this->setIdgrupo($reg["idgrupo"]);
		$this->setNombre($reg["nombre"]);
		$this->setDescripcion($reg["descripcion"]);
		$this->setPorcentaje($reg["porcentaje"]);
		$this->setIdtipoaspectoevaluacion($reg["idtipoaspectoevaluacion"]);
		$this->setVisible($reg["visible"]);
		$this->setGrupo($reg["grupo"]);
		$this->setTipoaspectoevaluacion($reg["tipoaspectoevaluacion"]);
		$this->setDetalleasepctoevaluacion($reg["detalleasepctoevaluacion"]);
		return true;
	}
	public function getFromInput()
	{
		$this->setIdaspectoevaluacion($this->input->post("frm_aspectoevaluacion_idaspectoevaluacion"));
		$this->setIdgrupo($this->input->post("frm_aspectoevaluacion_idgrupo"));
		$this->setNombre($this->input->post("frm_aspectoevaluacion_nombre"));
		$this->setDescripcion($this->input->post("frm_aspectoevaluacion_descripcion"));
		$this->setPorcentaje($this->input->post("frm_aspectoevaluacion_porcentaje"));
		$this->setIdtipoaspectoevaluacion($this->input->post("frm_aspectoevaluacion_idtipoaspectoevaluacion"));
		$this->setVisible($this->input->post("frm_aspectoevaluacion_visible"));
		$this->setGrupo($this->input->post("frm_aspectoevaluacion_grupo"));
		$this->setTipoaspectoevaluacion($this->input->post("frm_aspectoevaluacion_tipoaspectoevaluacion"));
		$this->setDetalleasepctoevaluacion($this->input->post("frm_aspectoevaluacion_detalleasepctoevaluacion"));
		return true;
	}
	public function addToDatabase()
	{
		$data=array(
			"idgrupo"=>$this->idgrupo,
			"nombre"=>$this->nombre,
			"descripcion"=>$this->descripcion,
			"porcentaje"=>$this->porcentaje,
			"idtipoaspectoevaluacion"=>$this->idtipoaspectoevaluacion,
			"visible"=>$this->visible,
			"grupo"=>$this->grupo,
			"tipoaspectoevaluacion"=>$this->tipoaspectoevaluacion,
			"detalleasepctoevaluacion"=>$this->detalleasepctoevaluacion,
		);
		$this->db->insert('aspectoevaluacion',$data);
		$this->setId($this->db->insert_id());
		return true;
	}
	public function updateToDatabase($id=0)
	{
		if($this->idaspectoevaluacion==""||$this->idaspectoevaluacion==0)
		{
			if($id>0)
				$this->idaspectoevaluacion=$id;
			else
				return false;
		}
		$data=array(
			"idgrupo"=>$this->idgrupo,
			"nombre"=>$this->nombre,
			"descripcion"=>$this->descripcion,
			"porcentaje"=>$this->porcentaje,
			"idtipoaspectoevaluacion"=>$this->idtipoaspectoevaluacion,
			"visible"=>$this->visible,
			"grupo"=>$this->grupo,
			"tipoaspectoevaluacion"=>$this->tipoaspectoevaluacion,
			"detalleasepctoevaluacion"=>$this->detalleasepctoevaluacion,
		);
		$this->db->where('idaspectoevaluacion',$this->idaspectoevaluacion);
		$this->db->update('aspectoevaluacion',$data);
		return true;
	}
	public function getAll()
	{
		$this->db->order_by('');
		$regs=$this->db->get('aspectoevaluacion');
		if($regs->num_rows()==0)
			return false;
		return $regs->result_array();
	}
	private function delete($id=0)
	{
		if($this->idaspectoevaluacion==""||$this->idaspectoevaluacion==0)
		{
			if($id>0)
				$this->idaspectoevaluacion=$id;
			else
				return false;
		}
		$this->db->where('idaspectoevaluacion',$this->idaspectoevaluacion);
		$this->db->delete(array('aspectoevaluacion'));
		return true;
	}
	public function desactivar($id=0)
	{
		return $this->delete($id);
	}
}
?>
