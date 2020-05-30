<?php


class Usuarios
{
    private $id_usu;
    private $id_tipo;
    private $id_car;
    private $nom_usu;
    private $contr_usu;
    private $corr_usu;
    private $fecNac_usu;
    private $img_usu;
    private $tabla;

    /**
     * Usuarios constructor.
     * @param $id_usu
     * @param $id_tipo
     * @param $id_car
     * @param $nom_usu
     * @param $contr_usu
     * @param $corr_usu
     * @param $fecNac_usu
     * @param $img_usu
     */
    public function __construct($id_usu="", $id_tipo="", $id_car="", $nom_usu="", $corr_usu="", $fecNac_usu="", $img_usu="", $contr_usu="")
    {
        $this->id_usu = $id_usu;
        $this->id_tipo = $id_tipo;
        $this->id_car = $id_car;
        $this->nom_usu = $nom_usu;
        $this->contr_usu = $contr_usu;
        $this->corr_usu = $corr_usu;
        $this->fecNac_usu = $fecNac_usu;
        $this->img_usu = $img_usu;
        $this->tabla = "usuarios";
    }

    /**
     * @return mixed
     */
    public function getIdUsu()
    {
        return $this->id_usu;
    }

    /**
     * @param mixed $id_usu
     */
    public function setIdUsu($id_usu)
    {
        $this->id_usu = $id_usu;
    }

    /**
     * @return mixed
     */
    public function getIdTipo()
    {
        return $this->id_tipo;
    }

    /**
     * @param mixed $is_tipo
     */
    public function setIdTipo($id_tipo)
    {
        $this->id_tipo = $id_tipo;
    }

    /**
     * @return mixed
     */
    public function getIdCar()
    {
        return $this->id_car;
    }

    /**
     * @param mixed $id_car
     */
    public function setIdCar($id_car)
    {
        $this->id_car = $id_car;
    }

    /**
     * @return mixed
     */
    public function getNomUsu()
    {
        return $this->nom_usu;
    }

    /**
     * @param mixed $nom_usu
     */
    public function setNomUsu($nom_usu)
    {
        $this->nom_usu = $nom_usu;
    }

    /**
     * @return mixed
     */
    public function getContrUsu()
    {
        return $this->contr_usu;
    }

    /**
     * @param mixed $contr_usu
     */
    public function setContrUsu($contr_usu)
    {
        $this->contr_usu = $contr_usu;
    }

    /**
     * @return mixed
     */
    public function getCorrUsu()
    {
        return $this->corr_usu;
    }

    /**
     * @param mixed $corr_usu
     */
    public function setCorrUsu($corr_usu)
    {
        $this->corr_usu = $corr_usu;
    }

    /**
     * @return mixed
     */
    public function getFecNacUsu()
    {
        return $this->fecNac_usu;
    }

    /**
     * @param mixed $fecNac_usu
     */
    public function setFecNacUsu($fecNac_usu)
    {
        $this->fecNac_usu = $fecNac_usu;
    }

    /**
     * @return mixed
     */
    public function getImgUsu()
    {
        return $this->img_usu;
    }

    /**
     * @param mixed $img_usu
     */
    public function setImgUsu($img_usu)
    {
        $this->img_usu = $img_usu;
    }
    public function login($corr,$cont){
        $ok=false;
        $sql="SELECT id_usu FROM ".$this->tabla." WHERE corr_usu ='".$corr."' AND contr_usu='".md5($cont)."'";
        $conexion=new BaseDeDatos();
        $res=$conexion->consultaOneRow($sql);
        if ($conexion->numeroElementos()>0){
            $ok=true;
            $this->id_usu=$res['id_usu'];

        }else{
            $ok=false;
        }
        return $ok;
    }
    public function insertarUsuario($nom,$correo,$contra){
        $bd=new BaseDeDatos();
        $sql ="INSERT INTO `cartera` (`cant_car`) VALUES ('25');";
        $bd->consulta($sql);
        $sql ="SELECT max(id_car) as 'id_car' FROM `cartera`;";
        $car=$bd->consultaOneRow($sql);
        $sql = "INSERT INTO ".$this->tabla."(id_tipo, id_car, nom_usu, corr_usu, contr_usu) VALUES  (1,".$car['id_car'].",'".$nom."','".$correo."','".md5($contra)."')";
        $bd->consulta($sql);
    }
}