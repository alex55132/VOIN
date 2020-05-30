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



    public function __construct($id, $nombre, $rutaImagen)
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
}