<?php
class Modpersona extends CI_Model
{
	private $idpersona;
	private $nombre;
	private $apaterno;
	private $amaterno;
	private $fechanacimiento;
	private $calle;
	private $numint;
	private $numext;
	private $cp;
	private $colonia;
	private $municipio;
	private $estado;
	private $imagen;
    private $imagenmime;
    private $imagenarchivo;
	private $codigobarras;
	private $visible;
	private $telefonos;
	private $correos;
	private $asuntosrecibidos;
	private $usuariosadministradores;
	private $usuario;
	private $grupospertenece;
	private $clientespertenece;
	private $aplicacionesevaluacuacion;
	public function __construct()
	{
        $this->load->model('modtelefono');
        $this->load->model('modcorreo');
        $this->load->model('modasunto');
        $this->load->model('modusuario');
        $this->load->model('modgrupo');
        $this->load->model('modcliente');
        $this->load->model('modaplicacion');
		$this->inicializa();
	}
	public function inicializa()
	{
		$this->idpersona=0;
		$this->nombre="";
		$this->apaterno="";
		$this->amaterno="";
		$this->fechanacimiento="";
		$this->calle="";
		$this->numint="";
		$this->numext="";
		$this->cp=0;
		$this->colonia="";
		$this->municipio="";
		$this->estado="";
		$this->imagen="";
        $this->imagenarchivo="";
        $this->imagenmime="";
		$this->codigobarras="";
		$this->visible=0;
		$this->telefonos=array();
		$this->correos=array();
		$this->asuntosrecibidos=array();
		$this->usuariosadministradores=array();
		$this->usuario=new Modusuario();
		$this->grupospertenece=array();
		$this->clientespertenece=array();
		$this->aplicacionesevaluacuacion=array();
	}
	public function getIdpersona() { return $this->idpersona; }
	public function getNombre() { return $this->nombre; }
	public function getApaterno() { return $this->apaterno; }
	public function getAmaterno() { return $this->amaterno; }
	public function getFechanacimiento() { return $this->fechanacimiento; }
	public function getCalle() { return $this->calle; }
	public function getNumint() { return $this->numint; }
	public function getNumext() { return $this->numext; }
	public function getCp() { return $this->cp; }
	public function getColonia() { return $this->colonia; }
	public function getMunicipio() { return $this->municipio; }
	public function getEstado() { return $this->estado; }
    public function getImagen() { return $this->imagen; }
    public function getImagenmime() { return $this->imagenmime; }
	public function getImagenarchivo() { return $this->imagenarchivo; }
	public function getCodigobarras() { return $this->codigobarras; }
	public function getVisible() { return $this->visible; }
	public function getTelefonos() { return $this->telefonos; }
	public function getCorreos() { return $this->correos; }
	public function getAsuntosrecibidos() { return $this->asuntosrecibidos; }
	public function getUsuariosadministradores() { return $this->usuariosadministradores; }
	public function getUsuario() { return $this->usuario; }
	public function getGrupospertenece() { return $this->grupospertenece; }
	public function getClientespertenece() { return $this->clientespertenece; }
	public function getAplicacionesevaluacuacion() { return $this->aplicacionesevaluacuacion; }
	public function setIdpersona($valor) { $this->idpersona= intval($valor); }
	public function setNombre($valor) { $this->nombre= "".$valor; }
	public function setApaterno($valor) { $this->apaterno= "".$valor; }
	public function setAmaterno($valor) { $this->amaterno= "".$valor; }
	public function setFechanacimiento($valor) { $this->fechanacimiento= "".$valor; }
	public function setCalle($valor) { $this->calle= "".$valor; }
	public function setNumint($valor) { $this->numint= "".$valor; }
	public function setNumext($valor) { $this->numext= "".$valor; }
	public function setCp($valor) { $this->cp= intval($valor); }
	public function setColonia($valor) { $this->colonia= "".$valor; }
	public function setMunicipio($valor) { $this->municipio= "".$valor; }
	public function setEstado($valor) { $this->estado= "".$valor; }
    public function setImagen($valor) { $this->imagen= $valor; }
    public function setImagenmime($valor) { $this->imagenmime= "".$valor; }
	public function setImagenarchivo($valor) { $this->imagenarchivo= "".$valor; }
	public function setCodigobarras($valor) { $this->codigobarras= "".$valor; }
	public function setVisible($valor) { $this->visible= intval($valor); }
	public function setTelefonos($valor) { if(is_array($valor)) $this->telefonos=$valor; else array_push($this->telefonos,$valor); }
	public function setCorreos($valor) { if(is_array($valor)) $this->correos=$valor; else array_push($this->correos,$valor); }
	public function setAsuntosrecibidos($valor) { if(is_array($valor)) $this->asuntosrecibidos=$valor; else array_push($this->asuntosrecibidos,$valor); }
	public function setUsuariosadministradores($valor) { if(is_array($valor)) $this->usuariosadministradores=$valor; else array_push($this->usuariosadministradores,$valor); }
	public function setUsuario($valor) { $this->usuario= $valor; }
	public function setGrupospertenece($valor) { if(is_array($valor)) $this->grupospertenece=$valor; else array_push($this->grupospertenece,$valor); }
	public function setClientespertenece($valor) { if(is_array($valor)) $this->clientespertenece=$valor; else array_push($this->clientespertenece,$valor); }
	public function setAplicacionesevaluacuacion($valor) { if(is_array($valor)) $this->aplicacionesevaluacuacion=$valor; else array_push($this->aplicacionesevaluacuacion,$valor); }
	public function getFromDatabase($id=0)
	{
		if($this->idpersona==""||$this->idpersona==0)
		{
			if($id>0)
				$this->idpersona=$id;
			else
				return false;
		}
		$this->db->where('idpersona',$this->idpersona);
		$regs=$this->db->get('persona');
		if($regs->num_rows()==0)
			return false;
		$reg=$regs->row_array();
		$this->setIdpersona($reg["idpersona"]);
		$this->setNombre($reg["nombre"]);
		$this->setApaterno($reg["apaterno"]);
		$this->setAmaterno($reg["amaterno"]);
		$this->setFechanacimiento($reg["fechanacimiento"]);
		$this->setCalle($reg["calle"]);
		$this->setNumint($reg["numint"]);
		$this->setNumext($reg["numext"]);
		$this->setCp($reg["cp"]);
		$this->setColonia($reg["colonia"]);
		$this->setMunicipio($reg["municipio"]);
		$this->setEstado($reg["estado"]);
        $this->setImagen($reg["imagen"]);
        $this->setImagenmime($reg["imagenmime"]);
		$this->setImagenarchivo($reg["imagenarchivo"]);
		$this->setCodigobarras($reg["codigobarras"]);
		$this->setVisible($reg["visible"]);
        $this->db->where('idpersona',$this->idpersona);
        $regs=$this->db->get('telefono');
        if($regs->num_rows()>0) foreach($regs->result_array() as $a)
        {
            $aux=new Modtelefono();
            $aux->getFromDatabase($a["idtelefono"]);
            $this->setTelefonos($aux);
        }
        $this->db->where('idpersona',$this->idpersona);
        $regs=$this->db->get('correo');
        if($regs->num_rows()>0) foreach($regs->result_array() as $a)
        {
            $aux=new Modcorreo();
            $aux->getFromDatabase($a["idcorreo"]);
            $this->setCorreos($aux);
        }
        $this->db->where('idpersona',$this->idpersona);
        $regs=$this->db->get('asunto');
        if($regs->num_rows()>0) foreach($regs->result_array() as $a)
        {
            $aux=new Modasunto();
            $aux->getFromDatabase($a["idasunto"]);
            $this->setAsuntosrecibidos($aux);
        }
        $this->db->where('idpersona',$this->idpersona);
        $regs=$this->db->get('usuario_administra_persona');
        if($regs->num_rows()>0) foreach($regs->result_array() as $a)
        {
            $aux=new Modusuario();
            $aux->getFromDatabase($a["idusuario"]);
            $this->setUsuariosadministradores($aux);
        }
        /*$this->db->where('idpersona',$this->idpersona);
        $regs=$this->db->get('usuario');
        if($regs->num_rows()>0) foreach($regs->result_array() as $a)
        {
            $aux=new Modusuario();
            $aux->getFromDatabase($a["idusuario"]);
            $this->setUsuario($aux);
        }*/
        $this->db->where('idpersona',$this->idpersona);
        $regs=$this->db->get('grupo_has_persona');
        if($regs->num_rows()>0) foreach($regs->result_array() as $a)
        {
            $aux=new Modgrupo();
            $aux->getFromDatabase($a["idgrupo"]);
            $this->setGrupospertenece($aux);
        }
        $this->db->where('idpersona',$this->idpersona);
        $regs=$this->db->get('cliente_has_persona');
        if($regs->num_rows()>0) foreach($regs->result_array() as $a)
        {
            $aux=new Modcliente();
            $aux->getFromDatabase($a["idcliente"]);
            $this->setClientespertenece($aux);
        }
        $this->db->where('idpersona',$this->idpersona);
        $regs=$this->db->get('aplicacion');
        if($regs->num_rows()>0) foreach($regs->result_array() as $a)
        {
            $aux=new Modaplicacion();
            $aux->getFromDatabase($a["idaplicacion"]);
            $this->setAplicacionesevaluacuacion($aux);
        }
		return true;
	}
	public function getFromInput()
	{
        $config["upload_path"]=$this->config->item('ruta_upload');
        $config["allowed_types"]="png|jpg|gif|jpeg|bmp";
        $config["max_size"]="0";
        $config["max_height"]="0";
        $config["max_width"]="0";
        $this->load->library("upload",$config);
        if($this->upload->do_upload("frm_persona_imagen"))
        {
            $archivo=$this->upload->data()["file_name"];
            $this->setImagen(file_get_contents($this->config->item('ruta_upload').$archivo));
            $this->setImagenarchivo($archivo);
            $this->setImagenmime($this->upload->data()["file_type"]);
        }
		$this->setIdpersona($this->input->post("frm_persona_idpersona"));
		$this->setNombre($this->input->post("frm_persona_nombre"));
		$this->setApaterno($this->input->post("frm_persona_apaterno"));
		$this->setAmaterno($this->input->post("frm_persona_amaterno"));
		$this->setFechanacimiento($this->input->post("frm_persona_fechanacimiento"));
		$this->setCalle($this->input->post("frm_persona_calle"));
		$this->setNumint($this->input->post("frm_persona_numint"));
		$this->setNumext($this->input->post("frm_persona_numext"));
		$this->setCp($this->input->post("frm_persona_cp"));
		$this->setColonia($this->input->post("frm_persona_colonia"));
		$this->setMunicipio($this->input->post("frm_persona_municipio"));
		$this->setEstado($this->input->post("frm_persona_estado"));
		$this->setCodigobarras($this->input->post("frm_persona_codigobarras"));
		$this->setVisible($this->input->post("frm_persona_visible"));
        $idtelefono=$this->input->post('frm_telefono_idtelefono');
        $telefonos=$this->input->post('frm_telefono_valor');
        $tipotelefono=$this->input->post('frm_telefono_idtipotelefono');
        if($telefonos!==false && is_array($telefonos))
            foreach($telefonos as $k=>$telefono)
            {
                $tel=new Modtelefono();
                $tel->setIdpersona($this->idpersona);
                $tel->setIdtelefono($idtelefono!==false&&count($idtelefono)>0&&isset($idtelefono[$k])?$idtelefono[$k]:0);
                $tel->setValor($telefono);
                $tel->setIdtipotelefono($tipotelefono!==false&&count($tipotelefono)>0&&isset($tipotelefono[$k])?$tipotelefono[$k]:1);
                $this->setTelefonos($tel);
            }
        $idcorreo=$this->input->post('frm_correo_idcorreo');
        $correos=$this->input->post('frm_correo_valor');
        $tipocorreo=$this->input->post('frm_correo_idtipocorreo');
        if($correos!==false && is_array($correos))
            foreach($correos as $k=>$correo)
            {
                $corr=new Modcorreo();
                $corr->setIdpersona($this->idpersona);
                $corr->setIdcorreo($idcorreo!==false&&count($idcorreo)>0&&isset($idcorreo[$k])?$idcorreo[$k]:0);
                $corr->setValor($correo);
                $corr->setIdtipocorreo($tipocorreo!==false&&count($tipocorreo)>0&&isset($tipocorreo[$k])?$tipocorreo[$k]:1);
                $this->setCorreos($corr);
            }
        $grupos=$this->input->post('frm_persona_grupospertenece');
        if($grupos!==false&&is_array($grupos))
            foreach($grupos as $v)
            {
                $gpo=new Modgrupo();
                $gpo->getFromDatabase($v);
                $this->setGrupospertenece($gpo);
            }
        $clientes=$this->input->post('frm_persona_clientespertenece');
        if($clientes!==false&&is_array($clientes))
            foreach($clientes as $v)
            {
                $cte=new Modcliente();
                $cte->getFromDatabase($v);
                $this->setClientespertenece($cte);
            }
		return true;
	}
	public function addToDatabase()
	{
		$data=array(
			"nombre"=>$this->nombre,
			"apaterno"=>$this->apaterno,
			"amaterno"=>$this->amaterno,
			"fechanacimiento"=>$this->fechanacimiento,
			"calle"=>$this->calle,
			"numint"=>$this->numint,
			"numext"=>$this->numext,
			"cp"=>$this->cp,
			"colonia"=>$this->colonia,
			"municipio"=>$this->municipio,
			"estado"=>$this->estado,
            "imagen"=>$this->imagen,
            "imagenmime"=>$this->imagenmime,
			"imagenarchivo"=>$this->imagenarchivo,
			"codigobarras"=>$this->codigobarras,
			"visible"=>$this->visible
		);
		$this->db->insert('persona',$data);
		$this->setIdpersona($this->db->insert_id());
        $this->db->where('idpersona',$this->idpersona);
        $this->db->delete(array('telefono','correo','cliente_has_persona','grupo_has_persona'));
        foreach($this->telefonos as $k=>$v)
        {
            $this->telefonos[$k]->setIdpersona($this->idpersona);
            $this->telefonos[$k]->addToDatabase();
        }
        foreach($this->correos as $k=>$v)
        {
            $this->correos[$k]->setIdpersona($this->idpersona);
            $this->correos[$k]->addToDatabase();
        }
        foreach($this->grupospertenece as $v)
            $this->db->insert('grupo_has_persona',array("idpersona"=>$this->idpersona,"idgrupo"=>$v->getIdgrupo()));
        foreach($this->clientespertenece as $v)
            $this->db->insert('cliente_has_persona',array("idpersona"=>$this->idpersona,"idcliente"=>$v->getIdcliente()));
		return true;
	}
	public function updateToDatabase($id=0)
	{
		if($this->idpersona==""||$this->idpersona==0)
		{
			if($id>0)
				$this->idpersona=$id;
			else
				return false;
		}
		$data=array(
			"nombre"=>$this->nombre,
			"apaterno"=>$this->apaterno,
			"amaterno"=>$this->amaterno,
			"fechanacimiento"=>$this->fechanacimiento,
			"calle"=>$this->calle,
			"numint"=>$this->numint,
			"numext"=>$this->numext,
			"cp"=>$this->cp,
			"colonia"=>$this->colonia,
			"municipio"=>$this->municipio,
			"estado"=>$this->estado,
            "imagen"=>$this->imagen,
            "imagenmime"=>$this->imagenmime,
			"imagenarchivo"=>$this->imagenarchivo,
			"codigobarras"=>$this->codigobarras,
			"visible"=>$this->visible
		);
		$this->db->where('idpersona',$this->idpersona);
		$this->db->update('persona',$data);
        $this->db->where('idpersona',$this->idpersona);
        $this->db->delete(array('telefono','correo','cliente_has_persona','grupo_has_persona'));
        foreach($this->telefonos as $k=>$v)
        {
            $this->telefonos[$k]->setIdpersona($this->idpersona);
            $this->telefonos[$k]->addToDatabase();
        }
        foreach($this->correos as $k=>$v)
        {
            $this->correos[$k]->setIdpersona($this->idpersona);
            $this->correos[$k]->addToDatabase();
        }
        foreach($this->grupospertenece as $v)
            $this->db->insert('grupo_has_persona',array("idpersona"=>$this->idpersona,"idgrupo"=>$v->getIdgrupo()));
        foreach($this->clientespertenece as $v)
            $this->db->insert('cliente_has_persona',array("idpersona"=>$this->idpersona,"idcliente"=>$v->getIdcliente()));
		return true;
	}
	public function getAll()
	{
		$this->db->where('visible = true and idpersona not in (select idpersona from usuario)');
        $this->db->order_by('nombre asc, apaterno asc, amaterno asc, fechanacimiento desc');
		$regs=$this->db->get('persona');
		if($regs->num_rows()==0)
			return false;
		return $regs->result_array();
	}
	private function delete($id=0)
	{
		if($this->idpersona==""||$this->idpersona==0)
		{
			if($id>0)
				$this->idpersona=$id;
			else
				return false;
		}
		$this->db->where('idpersona',$this-idpersona);
		$this->db->delete(array('asunto','usuario_administra_persona','telefono','correo','aplicacion','cliente_has_persona','grupo_has_persona','usuario','persona'));
		return true;
	}
	public function desactivar($id=0)
	{
		//return $this->delete($id);
        if($this->idpersona==""||$this->idpersona==0)
        {
            if($id>0)
                $this->idpersona=$id;
            else
                return false;
        }
        $this->db->where('idpersona',$this->idpersona);
        $this->db->delete(array('usuario_administra_persona','grupo_has_persona'));
        $this->db->update('persona',array('visible'=>false));
        $this->usuario->desactivar();
        return true;
	}
}
?>
