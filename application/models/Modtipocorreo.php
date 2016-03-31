<?php
class Modtipocorreo extends CI_Model
{
	private $idtipocorreo;
	private $valor;
	private $visible;
	public function __construct()
	{
		$this->inicializa();
	}
	public function inicializa()
	{
		$this->idtipocorreo=0;
		$this->valor="";
		$this->visible=0;
	}
	public function getIdtipocorreo() { return $this->idtipocorreo; }
	public function getValor() { return $this->valor; }
	public function getVisible() { return $this->visible; }
	public function setIdtipocorreo($valor) { $this->idtipocorreo= intval($valor); }
	public function setValor($valor) { $this->valor= "".$valor; }
	public function setVisible($valor) { $this->visible= intval($valor); }
	public function getFromDatabase($id=0)
	{
		if($this->idtipocorreo==""||$this->idtipocorreo==0)
		{
			if($id>0)
				$this->idtipocorreo=$id;
			else
				return false;
		}
		$this->db->where('idtipocorreo',$this->idtipocorreo);
		$regs=$this->db->get('tipocorreo');
		if($regs->num_rows()==0)
			return false;
		$reg=$regs->row_array();
		$this->setIdtipocorreo($reg["idtipocorreo"]);
		$this->setValor($reg["valor"]);
		$this->setVisible($reg["visible"]);
		return true;
	}
	public function getFromInput()
	{
		$this->setIdtipocorreo($this->input->post("frm_tipocorreo_idtipocorreo"));
		$this->setValor($this->input->post("frm_tipocorreo_valor"));
		$this->setVisible($this->input->post("frm_tipocorreo_visible"));
		return true;
	}
	public function addToDatabase()
	{
		$data=array(
			"valor"=>$this->valor,
			"visible"=>$this->visible
		);
		$this->db->insert('tipocorreo',$data);
		$this->setIdtipocorreo($this->db->insert_id());
		return true;
	}
	public function updateToDatabase($id=0)
	{
		if($this->idtipocorreo==""||$this->idtipocorreo==0)
		{
			if($id>0)
				$this->idtipocorreo=$id;
			else
				return false;
		}
		$data=array(
			"valor"=>$this->valor,
			"visible"=>$this->visible
		);
		$this->db->where('idtipocorreo',$this->idtipocorreo);
		$this->db->update('tipocorreo',$data);
		return true;
	}
	public function getAll()
	{
		$this->db->where('visible',true);
		$this->db->order_by('valor');
		$regs=$this->db->get('tipocorreo');
		if($regs->num_rows()==0)
			return false;
		return $regs->result_array();
	}
	private function delete($id=0)
	{
		if($this->idtipocorreo==""||$this->idtipocorreo==0)
		{
			if($id>0)
				$this->idtipocorreo=$id;
			else
				return false;
		}
		$this->db->where('idtipocorreo',$this-idtipocorreo);
		$this->db->delete(array('correo','tipocorreo'));
		return true;
	}
	public function desactivar($id=0)
	{
		//return $this->delete($id);
        if($this->idtipocorreo==""||$this->idtipocorreo==0)
        {
            if($id>0)
                $this->idtipocorreo=$id;
            else
                return false;
        }
		$this->db->where('idtipocorreo',$this->idtipocorreo);
		$this->db->update('tipocorreo',array('visible'=>false));
		return true;
	}
}
?>
