<?php
class Modtipotelefono extends CI_Model
{
	private $idtipotelefono;
	private $valor;
	private $visible;
	public function __construct()
	{
		$this->inicializa();
	}
	public function inicializa()
	{
		$this->idtipotelefono=0;
		$this->valor="";
		$this->visible=0;
	}
	public function getIdtipotelefono() { return $this->idtipotelefono; }
	public function getValor() { return $this->valor; }
	public function getVisible() { return $this->visible; }
	public function setIdtipotelefono($valor) { $this->idtipotelefono= intval($valor); }
	public function setValor($valor) { $this->valor= "".$valor; }
	public function setVisible($valor) { $this->visible= intval($valor); }
	public function getFromDatabase($id=0)
	{
		if($this->idtipotelefono==""||$this->idtipotelefono==0)
		{
			if($id>0)
				$this->idtipotelefono=$id;
			else
				return false;
		}
		$this->db->where('idtipotelefono',$this->idtipotelefono);
		$regs=$this->db->get('tipotelefono');
		if($regs->num_rows()==0)
			return false;
		$reg=$regs->row_array();
		$this->setIdtipotelefono($reg["idtipotelefono"]);
		$this->setValor($reg["valor"]);
		$this->setVisible($reg["visible"]);
		return true;
	}
	public function getFromInput()
	{
		$this->setIdtipotelefono($this->input->post("frm_tipotelefono_idtipotelefono"));
		$this->setValor($this->input->post("frm_tipotelefono_valor"));
		$this->setVisible($this->input->post("frm_tipotelefono_visible"));
		return true;
	}
	public function addToDatabase()
	{
		$data=array(
			"valor"=>$this->valor,
			"visible"=>$this->visible
		);
        $this->db->insert('tipotelefono',$data);
        $this->setIdtipotelefono($this->db->insert_id());
		return true;
	}
	public function updateToDatabase($id=0)
	{
		if($this->idtipotelefono==""||$this->idtipotelefono==0)
		{
			if($id>0)
				$this->idtipotelefono=$id;
			else
				return false;
		}
		$data=array(
			"valor"=>$this->valor,
			"visible"=>$this->visible
		);
		$this->db->where('idtipotelefono',$this->idtipotelefono);
		$this->db->update('tipotelefono',$data);
		return true;
	}
	public function getAll()
	{
		$this->db->where('visible',true);
		$this->db->order_by('valor');
		$regs=$this->db->get('tipotelefono');
		if($regs->num_rows()==0)
			return false;
		return $regs->result_array();
	}
	private function delete($id=0)
	{
		if($this->idtipotelefono==""||$this->idtipotelefono==0)
		{
			if($id>0)
				$this->idtipotelefono=$id;
			else
				return false;
		}
		$this->db->where('idtipotelefono',$this-idtipotelefono);
		$this->db->delete(array('telefono','tipotelefono'));
		return true;
	}
	public function desactivar($id=0)
	{
		//return $this->delete($id);
        if($this->idtipotelefono==""||$this->idtipotelefono==0)
        {
            if($id>0)
                $this->idtipotelefono=$id;
            else
                return false;
        }
		$this->db->where('idtipotelefono',$this->idtipotelefono);
		$this->db->update('tipotelefono',array('visible'=>false));
		return true;
	}
}
?>
