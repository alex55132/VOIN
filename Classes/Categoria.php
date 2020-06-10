<?php

require_once "BaseDeDatos.php";

class Categoria
{
    private $id;
    private $nombre;
    private $imagen;

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
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * @param mixed $imagen
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }



    public function __construct($id="", $nombre="", $rutaImagen="")
    {
        $this->setId($id);
        $this->setNombre($nombre);
        $this->setImagen($rutaImagen);
    }

    public static function getCategoriaById($id) {
        $db = new BaseDeDatos();

        $query = "SELECT * FROM categoria WHERE id_cat=".$id;

        $arrayCategorias = $db->realizarConsulta($query);

        $categoria = new Categoria($arrayCategorias[0][0], $arrayCategorias[0][1], "imgs/categorias/".$arrayCategorias[0][2]);

        return $categoria;
    }
    public function eliminarCategoria($id) {
        $conexion=new BaseDeDatos();
        $sql = "DELETE FROM categoria WHERE id_cat=".$id;
        $conexion->iudQuery($sql);
    }
    public function subirCategoria($datos,$foto,$carpeta="../imgs/tienda/"){
        require_once "../Controllers/manejoFotos.php";
        $claves  = array();
        $valores = array();
        foreach ($datos as $clave => $valor){
            $claves[] = $clave;
            $valores[] = "'".$valor."'";
        }
        if($foto['foto'] ['size']!= ""){

            $ruta = subirFoto($foto['foto'],$carpeta);

            $claves[] = "img_pro";
            $valores[] = "'".$ruta."'";
        }
        $sql = "INSERT INTO categoria (".implode(',', $claves).") VALUES  (".implode(',', $valores).")";
        $conexion=new BaseDeDatos();
        $conexion->iudQuery($sql);
    }
    public function updateCategoria($datos,$foto,$carpeta="../imgs/tienda/"){
        require_once "../Controllers/manejoFotos.php";
        $sentencias = array();
        $id=0;
        foreach ($datos as $campo => $valor) {
            if ($campo != "id_pro" && $campo != "x" && $campo != "y") {
                $sentencias[] = $campo . "='".addslashes($valor)."'";
                //UPDATE tabla SET nombreCampo = 'valor1', nombreCampo='valor'....
            }else if($campo == "id_pro"){
                $id=$valor;
            }
        }
        if(strlen($foto['foto']['name'])>0){
            $ruta= subirFoto($foto['foto'], $carpeta);
            $sentencias[] = "foto='".$ruta."'";
        }
        $campos = implode(",", $sentencias);
        $sql = "UPDATE categoria SET " . $campos . " WHERE id_pro=" . $id;
        echo $sql;
        $conexion=new BaseDeDatos();
        $conexion->iudQuery($sql);
    }
}