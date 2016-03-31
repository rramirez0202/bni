<?php
class Sesiones extends CI_Controller
{
    public function login()
    {
        $this->load->model('modsesion');
        $usr=trim($this->input->post('frmacceso_usr'));
        $pwd=trim($this->input->post('frmacceso_pwd'));
        $fncallback=trim($this->input->post('fncallback'));
        if($usr=="")
        {
            $this->resultado->set(array("texto"=>"Debe ingresar su usuario."));
            $this->resultado->set(array("codigojs"=>'$'."('#frmacceso_usr').focus()"));
        }
        else if($pwd=="")
        {
            $this->resultado->set(array("texto"=>"Debe ingresar su contraseña."));
            $this->resultado->set(array("codigojs"=>'$'."('#frmacceso_pwd').focus()"));
        }
        else
        {
            $usuario=$this->modsesion->getAcceso($usr,$pwd);
            if($usuario===false)
            {
                $this->resultado->set(array("texto"=>"El usuario no se encuentra registrado en el sistema."));
                $this->resultado->set(array("codigojs"=>'$'."('#frmacceso_usr')[0].value='';"));
                $this->resultado->set(array("codigojs"=>'$'."('#frmacceso_pwd')[0].value='';"));
                $this->resultado->set(array("codigojs"=>'$'."('#frmacceso_usr').focus()"));
            }
            else
            {
                $this->session->set_userdata('idusuario',$usuario["idusuario"]);
                $this->resultado->set(array("resultado"=>true));
                $this->resultado->set(array("codigojs"=>"location.href='".base_url('inicio/principal')."'"));
            }
        }
        echo "$fncallback({$this->resultado})";
    }
    public function logout()
    {
        $this->session->sess_destroy();
        header("location: ".base_url());
    }
}
?>
