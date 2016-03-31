<?php
class Modasunto extends CI_Model
{
	private $idasunto;
	private $idusuario;
	private $idpersona;
	private $asunto;
	private $fechaenvio;
	private $horaenvio;
	private $asistencia;
	private $fechacita;
	private $horacita;
	private $asistio;
	private $iddocumento;
	private $documento;
	private $contenedor;
	private $observaciones;
	private $visible;
	private $fechaapertura;
	private $horaapertura;
	private $adjuntos;
	private $secciones;
	private $documentoent;
	private $usuario;
	private $persona;
	public function __construct()
	{
		$this->inicializa();
	}
	public function inicializa()
	{
		$this->idasunto=0;
		$this->idusuario=0;
		$this->idpersona=0;
		$this->asunto="";
		$this->fechaenvio="";
		$this->horaenvio="";
		$this->asistencia=0;
		$this->fechacita="";
		$this->horacita="";
		$this->asistio=0;
		$this->iddocumento=0;
		$this->documento="";
		$this->contenedor="";
		$this->observaciones="";
		$this->visible=0;
		$this->fechaapertura="";
		$this->horaapertura="";
		$this->adjuntos=array();
		$this->secciones=array();
		$this->documentoent="";
		$this->usuario="";
		$this->persona="";
	}
	public function getIdasunto() { return $this->idasunto; }
	public function getIdusuario() { return $this->idusuario; }
	public function getIdpersona() { return $this->idpersona; }
	public function getAsunto() { return $this->asunto; }
	public function getFechaenvio() { return $this->fechaenvio; }
	public function getHoraenvio() { return $this->horaenvio; }
	public function getAsistencia() { return $this->asistencia; }
	public function getFechacita() { return $this->fechacita; }
	public function getHoracita() { return $this->horacita; }
	public function getAsistio() { return $this->asistio; }
	public function getIddocumento() { return $this->iddocumento; }
	public function getDocumento() { return $this->documento; }
	public function getContenedor() { return $this->contenedor; }
	public function getObservaciones() { return $this->observaciones; }
	public function getVisible() { return $this->visible; }
	public function getFechaapertura() { return $this->fechaapertura; }
	public function getHoraapertura() { return $this->horaapertura; }
	public function getAdjuntos() { return $this->adjuntos; }
	public function getSecciones() { return $this->secciones; }
	public function getDocumentoent() { return $this->documentoent; }
	public function getUsuario() { return $this->usuario; }
	public function getPersona() { return $this->persona; }
	public function setIdasunto($valor) { $this->idasunto= intval($valor); }
	public function setIdusuario($valor) { $this->idusuario= intval($valor); }
	public function setIdpersona($valor) { $this->idpersona= intval($valor); }
	public function setAsunto($valor) { $this->asunto= "".$valor; }
	public function setFechaenvio($valor) { $this->fechaenvio= "".$valor; }
	public function setHoraenvio($valor) { $this->horaenvio= "".$valor; }
	public function setAsistencia($valor) { $this->asistencia= intval($valor); }
	public function setFechacita($valor) { $this->fechacita= "".$valor; }
	public function setHoracita($valor) { $this->horacita= "".$valor; }
	public function setAsistio($valor) { $this->asistio= intval($valor); }
	public function setIddocumento($valor) { $this->iddocumento= intval($valor); }
	public function setDocumento($valor) { $this->documento= "".$valor; }
	public function setContenedor($valor) { $this->contenedor= "".$valor; }
	public function setObservaciones($valor) { $this->observaciones= "".$valor; }
	public function setVisible($valor) { $this->visible= intval($valor); }
	public function setFechaapertura($valor) { $this->fechaapertura= "".$valor; }
	public function setHoraapertura($valor) { $this->horaapertura= "".$valor; }
	public function setAdjuntos($valor) { if(is_array($valor)) $this->adjuntos=$valor; else array_push($this->adjuntos,$valor); }
	public function setSecciones($valor) { if(is_array($valor)) $this->secciones=$valor; else array_push($this->secciones,$valor); }
	public function setDocumentoent($valor) { $this->documentoent= "".$valor; }
	public function setUsuario($valor) { $this->usuario= "".$valor; }
	public function setPersona($valor) { $this->persona= "".$valor; }
	public function getFromDatabase($id=0)
	{
		if($this->idasunto==""||$this->idasunto==0)
		{
			if($id>0)
				$this->idasunto=$id;
			else
				return false;
		}
		$this->db->where('idasunto',$this->idasunto);
		$regs=$this->db->get('asunto');
		if($regs->num_rows()==0)
			return false;
		$reg=$regs->row_array();
		$this->setIdasunto($reg["idasunto"]);
		$this->setIdusuario($reg["idusuario"]);
		$this->setIdpersona($reg["idpersona"]);
		$this->setAsunto($reg["asunto"]);
		$this->setFechaenvio($reg["fechaenvio"]);
		$this->setHoraenvio($reg["horaenvio"]);
		$this->setAsistencia($reg["asistencia"]);
		$this->setFechacita($reg["fechacita"]);
		$this->setHoracita($reg["horacita"]);
		$this->setAsistio($reg["asistio"]);
		$this->setIddocumento($reg["iddocumento"]);
		$this->setDocumento($reg["documento"]);
		$this->setContenedor($reg["contenedor"]);
		$this->setObservaciones($reg["observaciones"]);
		$this->setVisible($reg["visible"]);
		$this->setFechaapertura($reg["fechaapertura"]);
		$this->setHoraapertura($reg["horaapertura"]);
		$this->setAdjuntos($reg["adjuntos"]);
		$this->setSecciones($reg["secciones"]);
		$this->setDocumentoent($reg["documentoent"]);
		$this->setUsuario($reg["usuario"]);
		$this->setPersona($reg["persona"]);
		return true;
	}
	public function getFromInput()
	{
		$this->setIdasunto($this->input->post("frm_asunto_idasunto"));
		$this->setIdusuario($this->input->post("frm_asunto_idusuario"));
		$this->setIdpersona($this->input->post("frm_asunto_idpersona"));
		$this->setAsunto($this->input->post("frm_asunto_asunto"));
		$this->setFechaenvio($this->input->post("frm_asunto_fechaenvio"));
		$this->setHoraenvio($this->input->post("frm_asunto_horaenvio"));
		$this->setAsistencia($this->input->post("frm_asunto_asistencia"));
		$this->setFechacita($this->input->post("frm_asunto_fechacita"));
		$this->setHoracita($this->input->post("frm_asunto_horacita"));
		$this->setAsistio($this->input->post("frm_asunto_asistio"));
		$this->setIddocumento($this->input->post("frm_asunto_iddocumento"));
		$this->setDocumento($this->input->post("frm_asunto_documento"));
		$this->setContenedor($this->input->post("frm_asunto_contenedor"));
		$this->setObservaciones($this->input->post("frm_asunto_observaciones"));
		$this->setVisible($this->input->post("frm_asunto_visible"));
		$this->setFechaapertura($this->input->post("frm_asunto_fechaapertura"));
		$this->setHoraapertura($this->input->post("frm_asunto_horaapertura"));
		$this->setAdjuntos($this->input->post("frm_asunto_adjuntos"));
		$this->setSecciones($this->input->post("frm_asunto_secciones"));
		$this->setDocumentoent($this->input->post("frm_asunto_documentoent"));
		$this->setUsuario($this->input->post("frm_asunto_usuario"));
		$this->setPersona($this->input->post("frm_asunto_persona"));
		return true;
	}
	public function addToDatabase()
	{
		$data=array(
			"idusuario"=>$this->idusuario,
			"idpersona"=>$this->idpersona,
			"asunto"=>$this->asunto,
			"fechaenvio"=>$this->fechaenvio,
			"horaenvio"=>$this->horaenvio,
			"asistencia"=>$this->asistencia,
			"fechacita"=>$this->fechacita,
			"horacita"=>$this->horacita,
			"asistio"=>$this->asistio,
			"iddocumento"=>$this->iddocumento,
			"documento"=>$this->documento,
			"contenedor"=>$this->contenedor,
			"observaciones"=>$this->observaciones,
			"visible"=>$this->visible,
			"fechaapertura"=>$this->fechaapertura,
			"horaapertura"=>$this->horaapertura,
			"adjuntos"=>$this->adjuntos,
			"secciones"=>$this->secciones,
			"documentoent"=>$this->documentoent,
			"usuario"=>$this->usuario,
			"persona"=>$this->persona,
		);
		$this->db->insert('asunto',$data);
		$this->setIdasunto($this->db->insert_id());
		return true;
	}
	public function updateToDatabase($id=0)
	{
		if($this->idasunto==""||$this->idasunto==0)
		{
			if($id>0)
				$this->idasunto=$id;
			else
				return false;
		}
		$data=array(
			"idusuario"=>$this->idusuario,
			"idpersona"=>$this->idpersona,
			"asunto"=>$this->asunto,
			"fechaenvio"=>$this->fechaenvio,
			"horaenvio"=>$this->horaenvio,
			"asistencia"=>$this->asistencia,
			"fechacita"=>$this->fechacita,
			"horacita"=>$this->horacita,
			"asistio"=>$this->asistio,
			"iddocumento"=>$this->iddocumento,
			"documento"=>$this->documento,
			"contenedor"=>$this->contenedor,
			"observaciones"=>$this->observaciones,
			"visible"=>$this->visible,
			"fechaapertura"=>$this->fechaapertura,
			"horaapertura"=>$this->horaapertura,
			"adjuntos"=>$this->adjuntos,
			"secciones"=>$this->secciones,
			"documentoent"=>$this->documentoent,
			"usuario"=>$this->usuario,
			"persona"=>$this->persona,
		);
		$this->db->where('idasunto',$this->idasunto);
		$this->db->update('asunto',$data);
		return true;
	}
	public function getAll()
	{
		$this->db->order_by('');
		$regs=$this->db->get('asunto');
		if($regs->num_rows()==0)
			return false;
		return $regs->result_array();
	}
	private function delete($id=0)
	{
		if($this->idasunto==""||$this->idasunto==0)
		{
			if($id>0)
				$this->idasunto=$id;
			else
				return false;
		}
		$this->db->where('idasunto',$this->idasunto);
		$this->db->delete(array('asunto'));
		return true;
	}
	public function desactivar($id=0)
	{
		return $this->delete($id);
	}
}
?>
