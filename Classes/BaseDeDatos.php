<?php
class BaseDeDatos
{
    private $url;
    private $user;
    private $pass;
    private $db;
    private $conexion;

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param mixed $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    /**
     * @return mixed
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @param mixed $db
     */
    public function setDb($db)
    {
        $this->db = $db;
    }

    /**
     * @return mixed
     */
    public function getConexion()
    {
        return $this->conexion;
    }

    /**
     * @param mixed $conexion
     */
    public function setConexion($conexion)
    {
        $this->conexion = $conexion;
    }

    function __construct($url = "localhost", $user = "root", $pass = "", $db = "voin")
    {
        $this->setUrl($url);
        $this->setUser($user);
        $this->setPass($pass);
        $this->setDb($db);

        $conexion = new mysqli($url, $user, $pass, $db);
        if ($conexion->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
            $this->setConexion(null);
        } else {
            $this->setConexion($conexion);
        }
    }

    public function cerrarConexion() {
        $this->getConexion()->close();
    }

    public function realizarConsulta($query) {
        $resQuery = $this->getConexion()->query($query);

        $arrayLista = [];

        if($resQuery) {

            while ($fila = mysqli_fetch_array($resQuery, MYSQLI_NUM)) {
                array_push($arrayLista, $fila);
            }
        } else {
            $arrayLista = null;
        }

        return $arrayLista;
    }

    //IUD se corresponde a INSERT, UPDATE, DELETE
    public function iudQuery($query) {
        $resultado = false;
        $iudQueryAffectedRows = $this->getConexion()->query($query);

        if($iudQueryAffectedRows > 0) {
            $resultado = true;
        }

        return $resultado;
    }
}