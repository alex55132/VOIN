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
    public function __construct($id, $nombre, $rutaImagen)
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
}