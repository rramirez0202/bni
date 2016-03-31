<?php
class Modtelefono extends CI_Model
{
	private $idtelefono;
	private $idpersona;
	private $valor;
	private $idtipotelefono;
	private $tipotelefono;
	public function __construct()
	{
		$this->load->model('modtipotelefono');
		$this->inicializa();
	}
	public function inicializa()
	{
		$this->idtelefono=0;
		$this->idpersona=0;
		$this->valor="";
		$this->idtipotelefono=0;
		$this->tipotelefono=new modtipotelefono();
	}
	public function getIdtelefono() { return $this->idtelefono; }
	public function getIdpersona() { return $this->idpersona; }
	public function getValor() { return $this->valor; }
	public function getIdtipotelefono() { return $this->idtipotelefono; }
	public function getTipotelefono() { return $this->tipotelefono; }
	public function setIdtelefono($valor) { $this->idtelefono= intval($valor); }
	public function setIdpersona($valor) { $this->idpersona= intval($valor); }
	public function setValor($valor) { $this->valor= "".$valor; }
	public function setIdtipotelefono($valor) { $this->idtipotelefono= intval($valor); }
	public function setTipotelefono(modtipotelefono $valor) { $this->tipotelefono= $valor; }
	public function getFromDatabase($id=0)
	{
		if($this->idtelefono==""||$this->idtelefono==0)
		{
			if($id>0)
				$this->idtelefono=$id;
			else
				return false;
		}
		$this->db->where('idtelefono',$this->idtelefono);
		$regs=$this->db->get('telefono');
		if($regs->num_rows()==0)
			return false;
		$reg=$regs->row_array();
		$this->setIdpersona($reg["idpersona"]);
		$this->setValor($reg["valor"]);
		$this->setIdtipotelefono($reg["idtipotelefono"]);
		$tmpAux=new modtipotelefono();
		$tmpAux->getFromDatabase($this->idtipotelefono);
		$this->setTipotelefono($tmpAux);
		return true;
	}
	public function getFromInput()
	{
        $this->setIdtelefono($this->input->post("frm_telefono_idtelefono"));
		$this->setIdpersona($this->input->post("frm_telefono_idpersona"));
		$this->setValor($this->input->post("frm_telefono_valor"));
		$this->setIdtipotelefono($this->input->post("frm_telefono_idtipotelefono"));
		$tmpAux=new modtipotelefono();
        $tmpAux->getFromDatabase($this->tipotelefono);
        $this->setTipotelefono($tmpAux);
		return true;
	}
	public function addToDatabase()
	{
		$data=array(
			"idpersona"=>$this->idpersona,
			"valor"=>$this->valor,
			"idtipotelefono"=>$this->idtipotelefono
		);
		$this->db->insert('telefono',$data);
		$this->setIdtelefono($this->db->insert_id());
		return true;
	}
	public function updateToDatabase($id=0)
	{
		if($this->idtelefono==""||$this->idtelefono==0)
		{
			if($id>0)
				$this->idtelefono=$id;
			else
				return false;
		}
		$data=array(
			"idpersona"=>$this->idpersona,
			"valor"=>$this->valor,
			"idtipotelefono"=>$this->idtipotelefono
		);
		$this->db->where('idtelefono',$this->idtelefono);
		$this->db->update('telefono',$data);
		return true;
	}
	public function getAll()
	{
		$this->db->order_by('idpersona asc,idtipotelefono asc,valor asc');
		$regs=$this->db->get('telefono');
		if($regs->num_rows()==0)
			return false;
		return $regs->result_array();
	}
	private function delete($id=0)
	{
		if($this->idtelefono==""||$this->idtelefono==0)
		{
			if($id>0)
				$this->idtelefono=$id;
			else
				return false;
		}
		$this->db->where('idtelefono',$this->idtelefono);
		$this->db->delete(array('telefono'));
		return true;
	}
	public function desactivar($id=0)
	{
		return $this->delete($id);
	}
}
?>
