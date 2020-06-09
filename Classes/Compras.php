<?php
require_once "BaseDeDatos.php";

class Compras
{
    private $id;
    private $id_producto;
    private $id_usuario;
    private $fecha;

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
    public function getIdProducto()
    {
        return $this->id_producto;
    }

    /**
     * @param mixed $id_producto
     */
    public function setIdProducto($id_producto)
    {
        $this->id_producto = $id_producto;
    }

    /**
     * @return mixed
     */
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    /**
     * @param mixed $id_usuario
     */
    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function __construct($id = 0, $idProd = 0, $idUsu = 0, $fecha = "")
    {
        $this->setId($id);
        $this->setIdProducto($idProd);
        $this->setIdUsuario($idUsu);
        $this->setFecha($fecha);
    }

    public static function getCompraById($id) {
        $db = new BaseDeDatos();
        $arrayDatos = $db->realizarConsulta("SELECT * from compra WHERE id_com=".$id);

        $compra = new Compras($arrayDatos[0][0], $arrayDatos[0][1], $arrayDatos[0][2], $arrayDatos[0][3]);
        $db->cerrarConexion();

        return $compra;
    }
}