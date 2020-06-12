<?php
require_once "BaseDeDatos.php";

class Empresa
{
    private $id;
    private $nom_empr;
    private $correo_empr;
    private $direccion_empr;
    private $telefono_empr;
    private $web_empr;

    /**
     * Empresa constructor.
     * @param $id
     * @param $nom_empr
     * @param $correo_empr
     * @param $direccion_empr
     * @param $telefono_empr
     * @param $web_empr
     */
    public function __construct($id="", $nom_empr="", $correo_empr="", $direccion_empr="", $telefono_empr="", $web_empr="")
    {
        $this->id = $id;
        $this->nom_empr = $nom_empr;
        $this->correo_empr = $correo_empr;
        $this->direccion_empr = $direccion_empr;
        $this->telefono_empr = $telefono_empr;
        $this->web_empr = $web_empr;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNomEmpr()
    {
        return $this->nom_empr;
    }

    /**
     * @param mixed $nom_empr
     */
    public function setNomEmpr($nom_empr)
    {
        $this->nom_empr = $nom_empr;
    }

    /**
     * @return mixed
     */
    public function getCorreoEmpr()
    {
        return $this->correo_empr;
    }

    /**
     * @param mixed $correo_empr
     */
    public function setCorreoEmpr($correo_empr)
    {
        $this->correo_empr = $correo_empr;
    }

    /**
     * @return mixed
     */
    public function getDireccionEmpr()
    {
        return $this->direccion_empr;
    }

    /**
     * @param mixed $direccion_empr
     */
    public function setDireccionEmpr($direccion_empr)
    {
        $this->direccion_empr = $direccion_empr;
    }

    /**
     * @return mixed
     */
    public function getTelefonoEmpr()
    {
        return $this->telefono_empr;
    }

    /**
     * @param mixed $telefono_empr
     */
    public function setTelefonoEmpr($telefono_empr)
    {
        $this->telefono_empr = $telefono_empr;
    }

    /**
     * @return mixed
     */
    public function getWebEmpr()
    {
        return $this->web_empr;
    }

    /**
     * @param mixed $web_empr
     */
    public function setWebEmpr($web_empr)
    {
        $this->web_empr = $web_empr;
    }

    public static function getEmpresaById($id) {
        $db = new BaseDeDatos();

        $query = "SELECT * FROM empresa WHERE id_empr=".$id;

        $arrayEmpresas = $db->realizarConsulta($query);

        $empresa = new Empresa($arrayEmpresas[0][0], $arrayEmpresas[0][1], $arrayEmpresas[0][2],$arrayEmpresas[0][3],$arrayEmpresas[0][4],$arrayEmpresas[0][5]);

        return $empresa;
    }
    public function eliminarEmpresa($id) {
        $conexion=new BaseDeDatos();
        $sql = "DELETE FROM empresa WHERE id_empr=".$id;
        $conexion->iudQuery($sql);
    }
    public function subirEmpresa($datos){
        $claves  = array();
        $valores = array();
        foreach ($datos as $clave => $valor){
            $claves[] = $clave;
            $valores[] = "'".$valor."'";
        }
        $sql = "INSERT INTO empresa (".implode(',', $claves).") VALUES  (".implode(',', $valores).")";
        echo $sql;
        $conexion=new BaseDeDatos();
        $conexion->iudQuery($sql);
    }
    public function updateEmpresa($datos){
        $sentencias = array();
        $id=0;
        foreach ($datos as $campo => $valor) {
            if ($campo != "id_empr" && $campo != "x" && $campo != "y") {
                $sentencias[] = $campo . "='".addslashes($valor)."'";
                //UPDATE tabla SET nombreCampo = 'valor1', nombreCampo='valor'....
            }else if($campo == "id_empr"){
                $id=$valor;
            }
        }

        $campos = implode(",", $sentencias);
        $sql = "UPDATE empresa SET " . $campos . " WHERE  id_empr=" . $id;

        $conexion=new BaseDeDatos();
        $conexion->iudQuery($sql);
    }
}