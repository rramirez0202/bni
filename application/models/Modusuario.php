<?php
class Modusuario extends CI_Model
{
	private $idusuario;
	private $usr;
	private $pwd;
	private $idpersona;
	private $activo;
	private $visible;
	private $persona;
	private $perfiles;
	private $usuariosadministradores;
	private $usuariosadministra;
	private $asuntosenviados;
	private $personasadministra;
	private $grupospertenece;
	private $gruposadministra;
	private $clientespertenece;
	private $clientesadministra;
	private $asiginacionesactividad;
	public function __construct()
	{
        $this->load->model('modpersona');
        $this->load->model('modperfil');
        $this->load->model('modasunto');
        $this->load->model('modgrupo');
        $this->load->model('modcliente');
        $this->load->model('modasignacion');
		$this->inicializa();
	}
	public function inicializa()
	{
		$this->idusuario=0;
		$this->usr="";
		$this->pwd="";
		$this->idpersona=0;
		$this->activo=0;
		$this->visible=0;
		$this->persona="";
		$this->perfiles=array();
		$this->usuariosadministradores=array();
		$this->usuariosadministra=array();
		$this->asuntosenviados=array();
		$this->personasadministra=array();
		$this->grupospertenece=array();
		$this->gruposadministra=array();
		$this->clientespertenece=array();
		$this->clientesadministra=array();
		$this->asiginacionesactividad=array();
	}
	public function getIdusuario() { return $this->idusuario; }
	public function getUsr() { return $this->usr; }
	public function getPwd() { return $this->pwd; }
	public function getIdpersona() { return $this->idpersona; }
	public function getActivo() { return $this->activo; }
	public function getVisible() { return $this->visible; }
	public function getPersona() { return $this->persona; }
	public function getPerfiles() { return $this->perfiles; }
	public function getUsuariosadministradores() { return $this->usuariosadministradores; }
	public function getUsuariosadministra() { return $this->usuariosadministra; }
	public function getAsuntosenviados() { return $this->asuntosenviados; }
	public function getPersonasadministra() { return $this->personasadministra; }
	public function getGrupospertenece() { return $this->grupospertenece; }
	public function getGruposadministra() { return $this->gruposadministra; }
	public function getClientespertenece() { return $this->clientespertenece; }
	public function getClientesadministra() { return $this->clientesadministra; }
	public function getAsiginacionesactividad() { return $this->asiginacionesactividad; }
	public function setIdusuario($valor) { $this->idusuario= intval($valor); }
	public function setUsr($valor) { $this->usr= "".$valor; }
	public function setPwd($valor) { $this->pwd= "".$valor; }
	public function setIdpersona($valor) { $this->idpersona= intval($valor); }
	public function setActivo($valor) { $this->activo= intval($valor); }
	public function setVisible($valor) { $this->visible= intval($valor); }
	public function setPersona(Modpersona $valor) { $this->persona= $valor; }
	public function setPerfiles($valor) { if(is_array($valor)) $this->perfiles=$valor; else array_push($this->perfiles,$valor); }
	public function setUsuariosadministradores($valor) { if(is_array($valor)) $this->usuariosadministradores=$valor; else array_push($this->usuariosadministradores,$valor); }
	public function setUsuariosadministra($valor) { if(is_array($valor)) $this->usuariosadministra=$valor; else array_push($this->usuariosadministra,$valor); }
	public function setAsuntosenviados($valor) { if(is_array($valor)) $this->asuntosenviados=$valor; else array_push($this->asuntosenviados,$valor); }
	public function setPersonasadministra($valor) { if(is_array($valor)) $this->personasadministra=$valor; else array_push($this->personasadministra,$valor); }
	public function setGrupospertenece($valor) { if(is_array($valor)) $this->grupospertenece=$valor; else array_push($this->grupospertenece,$valor); }
	public function setGruposadministra($valor) { if(is_array($valor)) $this->gruposadministra=$valor; else array_push($this->gruposadministra,$valor); }
	public function setClientespertenece($valor) { if(is_array($valor)) $this->clientespertenece=$valor; else array_push($this->clientespertenece,$valor); }
	public function setClientesadministra($valor) { if(is_array($valor)) $this->clientesadministra=$valor; else array_push($this->clientesadministra,$valor); }
	public function setAsiginacionesactividad($valor) { if(is_array($valor)) $this->asiginacionesactividad=$valor; else array_push($this->asiginacionesactividad,$valor); }
	public function getFromDatabase($id=0)
	{
		if($this->idusuario==""||$this->idusuario==0)
		{
			if($id>0)
				$this->idusuario=$id;
			else
				return false;
		}
		$this->db->where('idusuario',$this->idusuario);
		$regs=$this->db->get('usuario');
		if($regs->num_rows()==0)
			return false;
		$reg=$regs->row_array();
		$this->setIdusuario($reg["idusuario"]);
		$this->setUsr($reg["usr"]);
		$this->setPwd($reg["pwd"]);
		$this->setIdpersona($reg["idpersona"]);
		$this->setActivo($reg["activo"]);
		$this->setVisible($reg["visible"]);
        $pers=new Modpersona();
        $pers->getFromDatabase($reg["idpersona"]);
        $this->setPersona($pers);
        $this->db->where('idusuario',$this->idusuario);
        $regs=$this->db->get('usuario_has_perfil');
        if($regs->num_rows()>0) foreach($regs->result_array() as $reg)
        {
            $perf=new Modperfil();
            $perf->getFromDatabase($reg["idperfil"]);
            $this->setPerfiles($perf);
        }
        $this->db->where('idusuario_administrado',$this->idusuario);
        $regs=$this->db->get('usuario_administra_usuario');
        if($regs->num_rows()>0) foreach($regs->result_array() as $reg)
        {
            $usr=new Modusuario();
            $usr->getFromDatabase($reg["idusuario_administrador"]);
            $this->setUsuariosadministradores($usr);
        }
        $this->db->where('idusuario_administrador',$this->idusuario);
        $regs=$this->db->get('usuario_administra_usuario');
        if($regs->num_rows()>0) foreach($regs->result_array() as $reg)
        {
            $usr=new Modusuario();
            $usr->getFromDatabase($reg["idusuario_administrado"]);
            $this->setUsuariosadministradores($usr);
        }
        $this->db->where('idusuario',$this->idusuario);
        $regs=$this->db->get('asunto');
        if($regs->num_rows()>0) foreach($regs->result_array() as $reg)
        {
            $asunto=new Modasunto();
            $asunto->getFromDatabase($reg["idasunto"]);
            $this->setAsuntosenviados($asunto);
        }
        $this->db->where('idusuario',$this->idusuario);
        $regs=$this->db->get('usuario_administra_persona');
        if($regs->num_rows()>0) foreach($regs->result_array() as $reg)
        {
            $pers=new Modpersona();
            $pers->getFromDatabase($reg["idpersona"]);
            $this->setPersonasadministra($pers);
        }
        $this->db->where('idusuario',$this->idusuario);
        $regs=$this->db->get('grupo_has_usuario');
        if($regs->num_rows()>0) foreach($regs->result_array() as $reg)
        {
            $gpo=new Modgrupo();
            $gpo->getFromDatabase($reg["idgrupo"]);
            $this->setGrupospertenece($gpo);
        }
        $this->db->where('idusuario',$this->idusuario);
        $regs=$this->db->get('usuario_administra_grupo');
        if($regs->num_rows()>0) foreach($regs->result_array() as $reg)
        {
            $gpo=new Modgrupo();
            $gpo->getFromDatabase($reg["idgrupo"]);
            $this->setGruposadministra($gpo);
        }
        $this->db->where('idusuario',$this->idusuario);
        $regs=$this->db->get('cliente_has_usuario');
        if($regs->num_rows()>0) foreach($regs->result_array() as $reg)
        {
            $cte=new Modcliente();
            $cte->getFromDatabase($reg["idcliente"]);
            $this->setClientespertenece($cte);
        }
        $this->db->where('idusuario',$this->idusuario);
        $regs=$this->db->get('usuario_administra_cliente');
        if($regs->num_rows()>0) foreach($regs->result_array() as $reg)
        {
            $cte=new Modcliente();
            $cte->getFromDatabase($reg["idcliente"]);
            $this->setClientesadministra($cte);
        }
        $this->db->where('idusuario',$this->idusuario);
        $regs=$this->db->get('asignacion');
        if($regs->num_rows()>0) foreach($regs->result_array() as $reg)
        {
            $asig=new Modasignacion();
            $asig->getFromDatabase($reg["idasignacion"]);
            $this->setAsiginacionesactividad($asig);
        }
		return true;
	}
	public function getFromInput()
	{
		$this->setIdusuario($this->input->post("frm_usuario_idusuario"));
		$this->setUsr($this->input->post("frm_usuario_usr"));
		$this->setPwd($this->input->post("frm_usuario_pwd"));
		$this->setIdpersona($this->input->post("frm_usuario_idpersona"));
		$this->setActivo($this->input->post("frm_usuario_activo"));
		$this->setVisible($this->input->post("frm_usuario_visible"));
        $pers=new Modpersona();
        $pers->getFromInput();
		$this->setPersona($pers);
        $perfs=$this->input->post("frm_usuario_perfiles");
        if($perfs!==false && is_array($perfs)) foreach($perfs as $p)
        {
            $perf=new Modperfil();
            $perf->getFromDatabase($p);
            $this->setPerfiles($p);
        }
        $usrs=$this->input->post("frm_usuario_usuariosadministra");
        if($usrs!==false && is_array($usrs)) foreach($usrs as $u)
        {
            $usr=new Modusuario();
            $usr->getFromDatabase($u);
            $this->setUsuariosadministra($usr);
        }
        $pers=$this->input->post('frm_usuario_personasadministra');
        if($pers!==false && is_array($pers)) foreach($pers as $p)
        {
            $per=new Modpersona();
            $per->getFromDatabase($p);
            $this->setPersonasadministra($per);
        }
        $gpos=$this->input->post('frm_usuario_grupospertenece');
        if($gpos!==false && is_array($gpos)) foreach($gpos as $g)
        {
            $gpo=new Modgrupo();
            $gpo->getFromDatabase($g);
            $this->setGrupospertenece($gpo);
        }
        $gpos=$this->input->post('frm_usuario_gruposadministra');
        if($gpos!==false && is_array($gpos)) foreach($gpos as $g)
        {
            $gpo=new Modgrupo();
            $gpo->getFromDatabase($g);
            $this->setGruposadministra($gpo);
        }
        $ctes=$this->input->post('frm_usuario_clientespertenece');
        if($ctes!==false && is_array($ctes)) foreach($ctes as $c)
        {
            $cte=new Modcliente();
            $cte->getFromDatabase($c);
            $this->clientespertenece($cte);
        }
        $ctes=$this->input->post('frm_usuario_clientesadministra');
        if($ctes!==false && is_array($ctes)) foreach($ctes as $c)
        {
            $cte=new Modcliente();
            $cte->getFromDatabase($c);
            $this->clientesadministra($cte);
        }
		return true;
	}
	public function addToDatabase()
	{
        $this->persona->addToDatabase();
        $this->setIdpersona($this->persona->getIdpersona());
		$data=array(
			"usr"=>$this->usr,
			"pwd"=>$this->pwd,
			"idpersona"=>$this->idpersona,
			"activo"=>$this->activo,
			"visible"=>$this->visible
		);
        $this->db->insert('usuario',$data);
        $this->setIdusuario($this->db->insert_id());
        $this->db->where("idusuario",$this->idusuario);
        $this->db->delete("usuario_has_perfil");
        foreach($this->perfiles as $p)
        {
            $this->db->insert('usuario_has_perfil',array('idusuario'=>$this->idusuario,'idperfil'=>$p->getIdperfil()));
        }
        $this->db->where("idusuario_administrador",$this->idusuario);
        $this->db->delete("usuario_administra_usuario");
        foreach($this->usuariosadministra as $p)
        {
            $this->db->insert('usuario_administra_usuario',array('idusuario_administrador'=>$this->idusuario,'usuario_administrado'=>$p->getIdusuario()));
        }
        $this->db->where("idusuario",$this->idusuario);
        $this->db->delete("usuario_administra_persona");
        foreach($this->personasadministra as $p)
        {
            $this->db->insert('usuario_administra_persona',array('idusuario'=>$this->idusuario,'idpersona'=>$p->getIdpersona()));
        }
        $this->db->where("idusuario",$this->idusuario);
        $this->db->delete("grupo_has_usuario");
        foreach($this->grupospertenece as $p)
        {
            $this->db->insert('grupo_has_usuario',array('idusuario'=>$this->idusuario,'idgrupo'=>$p->getIdgrupo()));
        }
        $this->db->where("idusuario",$this->idusuario);
        $this->db->delete("usuario_administra_grupo");
        foreach($this->gruposadministra as $p)
        {
            $this->db->insert('usuario_administra_grupo',array('idusuario'=>$this->idusuario,'idgrupo'=>$p->getIdgrupo()));
        }
        $this->db->where("idusuario",$this->idusuario);
        $this->db->delete("cliente_has_usuario");
        foreach($this->clientespertenece as $p)
        {
            $this->db->insert('cliente_has_usuario',array('idusuario'=>$this->idusuario,'idcliente'=>$p->getIdcliente()));
        }
        $this->db->where("idusuario",$this->idusuario);
        $this->db->delete("usuario_administra_cliente");
        foreach($this->clientespertenece as $p)
        {
            $this->db->insert('usuario_administra_cliente',array('idusuario'=>$this->idusuario,'idcliente'=>$p->getIdcliente()));
        }
		return true;
	}
	public function updateToDatabase($id=0)
	{
		if($this->idusuario==""||$this->idusuario==0)
		{
			if($id>0)
				$this->idusuario=$id;
			else
				return false;
		}
        $this->persona->updateToDatabase();
		$data=array(
			"usr"=>$this->usr,
			"pwd"=>$this->pwd,
			"idpersona"=>$this->idpersona,
			"activo"=>$this->activo,
			"visible"=>$this->visible
		);
		$this->db->where('idusuario',$this->idusuario);
		$this->db->update('usuario',$data);
        $this->db->where("idusuario",$this->idusuario);
        $this->db->delete("usuario_has_perfil");
        foreach($this->perfiles as $p)
        {
            $this->db->insert('usuario_has_perfil',array('idusuario'=>$this->idusuario,'idperfil'=>$p->getIdperfil()));
        }
        $this->db->where("idusuario_administrador",$this->idusuario);
        $this->db->delete("usuario_administra_usuario");
        foreach($this->usuariosadministra as $p)
        {
            $this->db->insert('usuario_administra_usuario',array('idusuario_administrador'=>$this->idusuario,'usuario_administrado'=>$p->getIdusuario()));
        }
        $this->db->where("idusuario",$this->idusuario);
        $this->db->delete("usuario_administra_persona");
        foreach($this->personasadministra as $p)
        {
            $this->db->insert('usuario_administra_persona',array('idusuario'=>$this->idusuario,'idpersona'=>$p->getIdpersona()));
        }
        $this->db->where("idusuario",$this->idusuario);
        $this->db->delete("grupo_has_usuario");
        foreach($this->grupospertenece as $p)
        {
            $this->db->insert('grupo_has_usuario',array('idusuario'=>$this->idusuario,'idgrupo'=>$p->getIdgrupo()));
        }
        $this->db->where("idusuario",$this->idusuario);
        $this->db->delete("usuario_administra_grupo");
        foreach($this->gruposadministra as $p)
        {
            $this->db->insert('usuario_administra_grupo',array('idusuario'=>$this->idusuario,'idgrupo'=>$p->getIdgrupo()));
        }
        $this->db->where("idusuario",$this->idusuario);
        $this->db->delete("cliente_has_usuario");
        foreach($this->clientespertenece as $p)
        {
            $this->db->insert('cliente_has_usuario',array('idusuario'=>$this->idusuario,'idcliente'=>$p->getIdcliente()));
        }
        $this->db->where("idusuario",$this->idusuario);
        $this->db->delete("usuario_administra_cliente");
        foreach($this->clientespertenece as $p)
        {
            $this->db->insert('usuario_administra_cliente',array('idusuario'=>$this->idusuario,'idcliente'=>$p->getIdcliente()));
        }
		return true;
	}
	public function getAll()
	{
        $this->db->where('visible',true);
		$this->db->order_by('usr');
		$regs=$this->db->get('usuario');
		if($regs->num_rows()==0)
			return false;
		return $regs->result_array();
	}
	private function delete($id=0)
	{
		if($this->idusuario==""||$this->idusuario==0)
		{
			if($id>0)
				$this->idusuario=$id;
			else
				return false;
		}
        $this->db->where('idusuario_administrador',$this->idusuario);
        $this->db->delete(array('usuario_administra_usuario'));
        $this->db->where('idusuario_administrado',$this->idusuario);
        $this->db->delete(array('usuario_administra_usuario'));
        $this->persona->desactivar();
		$this->db->where('idusuario',$this->idusuario);
		$this->db->delete(array('usuario_has_perfil','asunto','usuario_administra_persona','grupo_has_usuario','usuario_administra_grupo','usuario_administra_cliente','cliente_has_usuario','asignacion','usuario'));
		return true;
	}
	public function desactivar($id=0)
	{
		//return $this->delete($id);
        if($this->idusuario==""||$this->idusuario==0)
        {
            if($id>0)
                $this->idusuario=$id;
            else
                return false;
        }
        $this->db->where('idusuario_administrador',$this->idusuario);
        $this->db->delete(array('usuario_administra_usuario'));
        $this->db->where('idusuario_administrado',$this->idusuario);
        $this->db->delete(array('usuario_administra_usuario'));
        $this->persona->desactivar();
        $this->db->where('idusuario',$this->idusuario);
        $this->db->delete(array('usuario_administra_persona','grupo_has_usuario','usuario_administra_grupo','usuario_administra_cliente','cliente_has_usuario'));
        $this->persona->desactivar();
        $this->db->update('usuario',array('visible',false));
        return true;
	}
}
?>
