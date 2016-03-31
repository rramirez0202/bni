<?php
class Modcorreo extends CI_Model
{
    private $idcorreo;
	private $idpersona;
	private $valor;
	private $idtipocorreo;
	private $tipocorreo;
	public function __construct()
	{
        $this->load->model('modtipocorreo');
		$this->inicializa();
	}
	public function inicializa()
	{
        $this->idcorreo=0;
		$this->idpersona=0;
		$this->valor="";
		$this->idtipocorreo=0;
		$this->tipocorreo=new Modtipocorreo();
	}
    public function getIdcorreo() { return $this->idcorreo; }
	public function getIdpersona() { return $this->idpersona; }
	public function getValor() { return $this->valor; }
	public function getIdtipocorreo() { return $this->idtipocorreo; }
	public function getTipocorreo() { return $this->tipocorreo; }
    public function setIdcorreo($valor) { $this->idcorreo= intval($valor); }
	public function setIdpersona($valor) { $this->idpersona= intval($valor); }
	public function setValor($valor) { $this->valor= "".$valor; }
	public function setIdtipocorreo($valor) { $this->idtipocorreo= intval($valor); }
	public function setTipocorreo($valor) { $this->tipocorreo= $valor; }
	public function getFromDatabase($id=0)
	{
		if($this->idcorreo==""||$this->idcorreo==0)
		{
			if($id>0)
				$this->idcorreo=$id;
			else
				return false;
		}
		$this->db->where('idcorreo',$this->idcorreo);
		$regs=$this->db->get('correo');
		if($regs->num_rows()==0)
			return false;
		$reg=$regs->row_array();
		$this->setIdpersona($reg["idpersona"]);
		$this->setValor($reg["valor"]);
		$this->setIdtipocorreo($reg["idtipocorreo"]);
		$tmpAux=new Modtipocorreo();
        $tmpAux->getFromDatabase($this->idtipocorreo);
        $this->setTipocorreo($tmpAux);
		return true;
	}
	public function getFromInput()
	{
        $this->setIdcorreo($this->input->post("frm_correo_idcorreo"));
		$this->setIdpersona($this->input->post("frm_correo_idpersona"));
		$this->setValor($this->input->post("frm_correo_valor"));
		$this->setIdtipocorreo($this->input->post("frm_correo_idtipocorreo"));
		$this->setTipocorreo($this->input->post("frm_correo_tipocorreo"));
        $tmpAux=new Modtipocorreo();
        $tmpAux->getFromDatabase($this->tipocorreo);
        $this->setTipocorreo($tmpAux);
		return true;
	}
	public function addToDatabase()
	{
		$data=array(
			"idpersona"=>$this->idpersona,
			"valor"=>$this->valor,
			"idtipocorreo"=>$this->idtipocorreo
		);
		$this->db->insert('correo',$data);
		$this->setIdcorreo($this->db->insert_id());
		return true;
	}
	public function updateToDatabase($id=0)
	{
		if($this->idcorreo==""||$this->idcorreo==0)
		{
			if($id>0)
				$this->idcorreo=$id;
			else
				return false;
		}
		$data=array(
			"idpersona"=>$this->idpersona,
			"valor"=>$this->valor,
			"idtipocorreo"=>$this->idtipocorreo
		);
		$this->db->where('idcorreo',$this->idcorreo);
		$this->db->update('correo',$data);
		return true;
	}
	public function getAll()
	{
		$this->db->order_by('idpersona asc,idtipocorreo asc,valor asc');
		$regs=$this->db->get('correo');
		if($regs->num_rows()==0)
			return false;
		return $regs->result_array();
	}
	private function delete($id=0)
	{
		if($this->idcorreo==""||$this->idcorreo==0)
		{
			if($id>0)
				$this->idcorreo=$id;
			else
				return false;
		}
		$this->db->where('idcorreo',$this->idcorreo);
		$this->db->delete(array('correo'));
		return true;
	}
	public function desactivar($id=0)
	{
		return $this->delete($id);
	}
}
?>
