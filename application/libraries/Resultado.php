<?php
class Resultado
{
    public $resultado=false;
    public $datos="";
    public $texto="";
    public $tipo="alert";
    public $codigojs="";
    public function __toString()
    {
        $res=array(
            "resultado"=>$this->resultado,
            "datos"=>$this->datos,
            "mensaje"=>array("texto"=>$this->texto,"tipo"=>$this->tipo),
            "codigojs"=>$this->codigojs
            );
        return json_encode($res);
    }
    public function set($valores)
    {
        if($valores!=null&&is_array($valores)&&count($valores)>0)
        {
            foreach($valores as $k=>$v)
            {
                switch(strtolower(trim($k)))
                {
                    case "resultado":
                    case "datos":
                    case "tipo":
                        $this->{$k}=$v;
                        break;
                    case "texto":
                    case "codigojs":
                        $this->{$k}.=$v;
                        break;
                }
            }
            return true;
        }
        return false;
    }
}
?>
