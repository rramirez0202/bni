<?php
class Modpermiso extends CI_Model
{
	private $idpermiso;
	private $permiso;
	private $descripcion;
	private $idpermisopadre;
	private $hijos;
	public function __construct()
	{
		$this->inicializa();
	}
	public function inicializa()
	{
		$this->idpermiso=0;
		$this->permiso="";
		$this->descripcion="";
		$this->idpermisopadre=0;
		$this->hijos=array();
	}
	public function getIdpermiso() { return $this->idpermiso; }
	public function getPermiso() { return $this->permiso; }
	public function getDescripcion() { return $this->descripcion; }
	public function getIdpermisopadre() { return $this->idpermisopadre; }
	public function getHijos() { return $this->hijos; }
	public function setIdpermiso($valor) { $this->idpermiso= intval($valor); }
	public function setPermiso($valor) { $this->permiso= "".$valor; }
	public function setDescripcion($valor) { $this->descripcion= "".$valor; }
	public function setIdpermisopadre($valor) { $this->idpermisopadre= intval($valor); }
	public function setHijos($valor) { if(is_array($valor)) $this->hijos=$valor; else array_push($this->hijos,$valor); }
	public function getFromDatabase($id=0)
	{
		if($this->idpermiso==""||$this->idpermiso==0)
		{
			if($id>0)
				$this->idpermiso=$id;
			else
				return false;
		}
		$this->db->where('idpermiso',$this->idpermiso);
		$regs=$this->db->get('permiso');
		if($regs->num_rows()==0)
			return false;
		$reg=$regs->row_array();
		$this->setIdpermiso($reg["idpermiso"]);
		$this->setPermiso($reg["permiso"]);
		$this->setDescripcion($reg["descripcion"]);
		$this->setIdpermisopadre($reg["idpermisopadre"]);
        $this->db->where('idpermisopadre',$this->idpermiso);
        $regs=$this->db->get('permiso');
        if($regs->num_rows()>0)
            foreach($regs->result_array() as $h)
            {
                $hijo=new Modpermiso();
                $hijo->getFromDatabase($h["idpermiso"]);
                $this->setHijos($hijo);
            }
		return true;
	}
	public function getFromInput()
	{
		$this->setIdpermiso($this->input->post("frm_permiso_idpermiso"));
		$this->setPermiso($this->input->post("frm_permiso_permiso"));
		$this->setDescripcion($this->input->post("frm_permiso_descripcion"));
		$this->setIdpermisopadre($this->input->post("frm_permiso_idpermisopadre"));
        $this->db->where('idpermisopadre',$this->idpermiso);
        $regs=$this->db->get('permiso');
        if($regs->num_rows()>0)
            foreach($regs->result_array() as $h)
            {
                $hijo=new Modpermiso();
                $hijo->getFromDatabase($h["idpermiso"]);
                $this->setHijos($hijo);
            }
		return true;
	}
	public function addToDatabase()
	{
		$data=array(
			"permiso"=>$this->permiso,
			"descripcion"=>$this->descripcion,
			"idpermisopadre"=>$this->idpermisopadre
		);
		$this->db->insert('permiso',$data);
		$this->setIdpermiso($this->db->insert_id());
		return true;
	}
	public function updateToDatabase($id=0)
	{
		if($this->idpermiso==""||$this->idpermiso==0)
		{
			if($id>0)
				$this->idpermiso=$id;
			else
				return false;
		}
		$data=array(
			"permiso"=>$this->permiso,
			"descripcion"=>$this->descripcion,
			"idpermisopadre"=>$this->idpermisopadre
		);
		$this->db->where('idpermiso',$this->idpermiso);
		$this->db->update('permiso',$data);
		return true;
	}
	public function getAll($solopermisosraiz=true)
	{
        if($solopermisosraiz)
            $this->db->where('idpermisopadre is null or idpermisopadre=0');
		$this->db->order_by('idpermisopadre asc,permiso asc,idpermiso asc');
		$regs=$this->db->get('permiso');
		if($regs->num_rows()==0)
			return false;
		return $regs->result_array();
	}
    public function getAllStructured()
    {
        $raiz=$this->getAll();
        if($raiz===false)
            return false;
        $permisos=array();
        foreach($raiz as $p)
        {
            $perm=new Modpermiso();
            $perm->getFromDatabase($p["idpermiso"]);
            array_push($permisos,$perm);
        }
        return $permisos;
    }
	private function delete($id=0)
	{
		if($this->idpermiso==""||$this->idpermiso==0)
		{
			if($id>0)
				$this->idpermiso=$id;
			else
				return false;
		}
        foreach($this->hijos as $h)
            $h->desactivar();
        $this->db->where('idpermiso',$this->idpermiso);
		$this->db->delete(array('perfil_has_permiso','permiso'));
		return true;
	}
	public function desactivar($id=0)
	{
        if($this->idpermiso==""||$this->idpermiso==0)
        {
            if($id>0)
                $this->idpermiso=$id;
            else
                return false;
        }
        $this->getFromDatabase();
		return $this->delete($id);
	}
}
?>
