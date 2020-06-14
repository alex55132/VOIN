<?php
require_once "BaseDeDatos.php";

class Compras
{
    private $id;
    private $id_producto;
    private $id_usuario;
    private $fecha;

    /**
     * Getter del id
     * @return int Id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Setter del id
     * @param int $id id de la compra
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Getter del id del producto
     * @return int Id del producto
     */
    public function getIdProducto()
    {
        return $this->id_producto;
    }

    /**
     * Setter del id del producto
     * @param int $id_producto Id del producto
     */
    public function setIdProducto($id_producto)
    {
        $this->id_producto = $id_producto;
    }

    /**
     * Getter del id del usuario
     * @return int Id del usuario
     */
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    /**
     * Setter del id de usuario
     * @param int $id_usuario Id del usuario
     */
    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    /**
     * Getter de la fecha de la compra
     * @return string Fecha de la compra en formato Y-m-d
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Setter de la fecha de la compra
     * @param string $fecha Fecha en formato Y-m-d
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * Compras constructor.
     * @param int $id Id de la compra
     * @param int $idProd Id del producto
     * @param int $idUsu Id del usuario
     * @param string $fecha Fecha de la compra
     */
    public function __construct($id = 0, $idProd = 0, $idUsu = 0, $fecha = "")
    {
        $this->setId($id);
        $this->setIdProducto($idProd);
        $this->setIdUsuario($idUsu);
        $this->setFecha($fecha);
    }

    /**
     * Funcion que instancia una compra buscandola en la base de datos según su ID
     * @param int $id Id de la compra
     * @return Compras Objeto compra si hay una compra coincide con el id dado
     */
    public static function getCompraById($id) {
        $db = new BaseDeDatos();
        $arrayDatos = $db->realizarConsulta("SELECT * from compra WHERE id_com=".$id);

        $compra = null;

        if(sizeof($arrayDatos) > 0) {
            $compra = new Compras($arrayDatos[0][0], $arrayDatos[0][1], $arrayDatos[0][2], $arrayDatos[0][3]);
        }
        $db->cerrarConexion();

        return $compra;
    }
}