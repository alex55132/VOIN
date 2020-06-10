<?php
class BaseDeDatos
{
    private $url;
    private $user;
    private $pass;
    private $db;
    private $conexion;

    /**
     * Getter de la url de la base de datos
     * @return string Url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Setter de la url de la base de datos
     * @param string $url Url de la base de datos
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Getter del usuario de la base de datos
     * @return string Nombre del usuario
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Setter del usuario de la base de datos
     * @param string $user Nombre del usuario
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * Getter de la contraseña del usuario
     * @return string Contraseña
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * Setter de la contraseña
     * @param string $pass Contraseña de la base de datos
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    /**
     * Getter de la base de datos
     * @return string Base de datos
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * Setter de la base de datos
     * @param string $db Base de datos
     */
    public function setDb($db)
    {
        $this->db = $db;
    }

    /**
     * Getter de la conexion de la base de datos
     * @return mysqli Conexion de la base de datos
     */
    public function getConexion()
    {
        return $this->conexion;
    }

    /**
     * Setter de la conexion de la base de datos
     * @param mysqli $conexion Conexion de la base de datos
     */
    public function setConexion($conexion)
    {
        $this->conexion = $conexion;
    }

    /**
     * BaseDeDatos constructor.
     * @param string $url Url del servidor
     * @param string $user Usuario del servidor
     * @param string $pass Contraseña del servidor
     * @param string $db Base de datos del servidor
     */
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

    /**
     * Funcion para cerrar la conexion
     */
    public function cerrarConexion() {
        $this->getConexion()->close();
    }


    /**
     * Funcion para realizar una consulta
     * @param string $query Query a introducir en la base de datos
     * @return array|null Devuelve un array si la query tiene exito
     */
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

    /**
     * Funcion para realizar querys INSERT, UPDATE, DELETE en la base de datos
     * @param string $query Query a introducir
     * @return bool True si la query tiene exito
     */
    public function iudQuery($query) {
        $resultado = false;
        $iudQueryAffectedRows = $this->getConexion()->query($query);

        if($iudQueryAffectedRows > 0) {
            $resultado = true;
        }

        return $resultado;
    }

}