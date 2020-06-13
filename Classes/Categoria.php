<?php

require_once "BaseDeDatos.php";

class Categoria
{
    private $id;
    private $nombre;
    private $imagen;

    /**
     * Getter del id de la categoria
     * @return int Id de la categoria
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Setter del id de la categoria
     * @param int $id Id de la categoria
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Getter del nombre de la categoría
     * @return string Nombre de la categoria
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /** Setter del nombre de la categoria
     * @param string $nombre Nombre de la categoria
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Getter de la imagen de la categoria
     * @return string Ruta de la imagen
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Setter de la imagen de la categoria
     * @param string $imagen Ruta de la imagen
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    /**
     * Categoria constructor.
     * @param int $id Id de la categoria
     * @param string $nombre Nombre de la categoria
     * @param string $rutaImagen Ruta de la imagen de la categoria
     */
    public function __construct($id="", $nombre="", $rutaImagen="")
    {
        $this->setId($id);
        $this->setNombre($nombre);
        $this->setImagen($rutaImagen);
    }

    /**
     * Funcion para obtener una categoria en base a un id dado
     * @param int $id Id de la categoria
     * @return Categoria Objeto categoria
     */
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
        echo $sql;
        $conexion->iudQuery($sql);
    }
    public function subirCategoria($datos,$foto,$carpeta="../imgs/categorias/"){
        require_once "../Controllers/manejoFotos.php";
        $claves  = array();
        $valores = array();
        foreach ($datos as $clave => $valor){
            $claves[] = $clave;
            $valores[] = "'".$valor."'";
        }
        if($foto['foto'] ['size']!= ""){

            $ruta = subirFoto($foto['foto'],$carpeta);

            $claves[] = "img_cat";
            $valores[] = "'".$ruta."'";
        }
        $sql = "INSERT INTO categoria (".implode(',', $claves).") VALUES  (".implode(',', $valores).")";
        $conexion=new BaseDeDatos();
        $conexion->iudQuery($sql);
    }
    public function updateCategoria($datos,$foto,$carpeta="../imgs/categorias/"){
        require_once "../Controllers/manejoFotos.php";
        $sentencias = array();
        $id=0;
        foreach ($datos as $campo => $valor) {
            if ($campo != "id_cat" && $campo != "x" && $campo != "y") {
                $sentencias[] = $campo . "='".addslashes($valor)."'";
                //UPDATE tabla SET nombreCampo = 'valor1', nombreCampo='valor'....
            }else if($campo == "id_cat"){
                $id=$valor;
            }
        }
        if(strlen($foto['foto']['name'])>0){
            $ruta= subirFoto($foto['foto'], $carpeta);
            $sentencias[] = "img_cat='".$ruta."'";
        }
        $campos = implode(",", $sentencias);
        $sql = "UPDATE categoria SET " . $campos . " WHERE id_cat=" . $id;

        $conexion=new BaseDeDatos();
        $conexion->iudQuery($sql);
    }
}