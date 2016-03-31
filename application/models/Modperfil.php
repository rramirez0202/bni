<?php
class Modperfil extends CI_Model
{
	private $idperfil;
	private $nombre;
	private $descripcion;
	private $permisos;
	public function __construct()
	{
        $this->load->model('modpermiso');
		$this->inicializa();
	}
	public function inicializa()
	{
		$this->idperfil=0;
		$this->nombre="";
		$this->descripcion="";
		$this->permisos=array();
	}
	public function getIdperfil() { return $this->idperfil; }
	public function getNombre() { return $this->nombre; }
	public function getDescripcion() { return $this->descripcion; }
	public function getPermisos() { return $this->permisos; }
	public function setIdperfil($valor) { $this->idperfil= intval($valor); }
	public function setNombre($valor) { $this->nombre= "".$valor; }
	public function setDescripcion($valor) { $this->descripcion= "".$valor; }
	public function setPermisos($valor) { if(is_array($valor)) $this->permisos=$valor; else array_push($this->permisos,$valor); }
	public function getFromDatabase($id=0)
	{
		if($this->idperfil==""||$this->idperfil==0)
		{
			if($id>0)
				$this->idperfil=$id;
			else
				return false;
		}
		$this->db->where('idperfil',$this->idperfil);
		$regs=$this->db->get('perfil');
		if($regs->num_rows()==0)
			return false;
		$reg=$regs->row_array();
		$this->setIdperfil($reg["idperfil"]);
		$this->setNombre($reg["nombre"]);
		$this->setDescripcion($reg["descripcion"]);
        $this->db->where('idperfil',$this->idperfil);
        $regs=$this->db->get('perfil_has_permiso');
        if($regs->num_rows()>0)
            foreach($regs->result_array() as $reg)
            {
                $permiso=new Modpermiso();
                $permiso->getFromDatabase($reg["idpermiso"]);
                $this->setPermisos($permiso);
            }
		return true;
	}
	public function getFromInput()
	{
		$this->setIdperfil($this->input->post("frm_perfil_idperfil"));
		$this->setNombre($this->input->post("frm_perfil_nombre"));
		$this->setDescripcion($this->input->post("frm_perfil_descripcion"));
        $permisos=$this->input->post("frm_perfil_permisos");
        if(is_array($permisos)&&count($permisos)>0)
            foreach($permisos as $p)
            {
                $permiso=new Modpermiso();
                $permiso->getFromDatabase($p);
                $this->setPermisos($permiso);
            }
		return true;
	}
	public function addToDatabase()
	{
		$data=array(
			"nombre"=>$this->nombre,
			"descripcion"=>$this->descripcion
		);
		$this->db->insert('perfil',$data);
		$this->setIdperfil($this->db->insert_id());
        $this->db->where('idperfil',$this->idperfil);
        $this->db->delete('perfil_has_permiso');
        foreach($this->permisos as $p)
            $this->db->insert("perfil_has_permiso",array('idperfil'=>$this->idperfil,"idpermiso"=>$p->getIdpermiso()));
		return true;
	}
	public function updateToDatabase($id=0)
	{
		if($this->idperfil==""||$this->idperfil==0)
		{
			if($id>0)
				$this->idperfil=$id;
			else
				return false;
		}
		$data=array(
			"nombre"=>$this->nombre,
			"descripcion"=>$this->descripcion
		);
		$this->db->where('idperfil',$this->idperfil);
		$this->db->update('perfil',$data);
        $this->db->where('idperfil',$this->idperfil);
        $this->db->delete('perfil_has_permiso');
        foreach($this->permisos as $p)
            $this->db->insert("perfil_has_permiso",array('idperfil'=>$this->idperfil,"idpermiso"=>$p->getIdpermiso()));
		return true;
	}
	public function getAll()
	{
		$this->db->order_by('nombre');
		$regs=$this->db->get('perfil');
		if($regs->num_rows()==0)
			return false;
		return $regs->result_array();
	}
	private function delete($id=0)
	{
		if($this->idperfil==""||$this->idperfil==0)
		{
			if($id>0)
				$this->idperfil=$id;
			else
				return false;
		}
		$this->db->where('idperfil',$this->idperfil);
		$this->db->delete(array('perfil_has_permiso','usuario_has_perfil','perfil'));
        return true;
	}
	public function desactivar($id=0)
	{
		return $this->delete($id);
	}
    public function hasPermiso($idpermiso)
    {
        if($this->idperfil==""||$this->idperfil==0) return false;
        if(count($this->permisos)==0) return false;
        foreach($this->permisos as $p)
            if($p->getIdpermiso()==$idpermiso)
                return $p;
        return false;
    }
}
?>
