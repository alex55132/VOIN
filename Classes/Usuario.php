<?php
require_once "BaseDeDatos.php";
class Usuario
{
    private $id;
    private $nombre;
    private $correo;
    private $fechaNacimiento;
    private $img;
    private $tipo;
    private $videosSubidos;
    private $suscripciones;
    private $comprasRealizadas;
    private $dineroCartera;
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
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * @param mixed $correo
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    /**
     * @return mixed
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * @param mixed $fechaNacimiento
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    /**
     * @return mixed
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param mixed $img
     */
    public function setImg($img)
    {
        $this->img = $img;
    }

    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return mixed
     */
    public function getVideosSubidos()
    {
        return $this->videosSubidos;
    }

    /**
     * @param mixed $videoSubidos
     */
    public function setVideosSubidos($videoSubidos)
    {
        $this->videosSubidos = $videoSubidos;
    }

    /**
     * @return mixed
     */
    public function getSuscripciones()
    {
        return $this->suscripciones;
    }

    /**
     * @param mixed $suscripciones
     */
    public function setSuscripciones($suscripciones)
    {
        $this->suscripciones = $suscripciones;
    }

    /**
     * @return mixed
     */
    public function getComprasRealizadas()
    {
        return $this->comprasRealizadas;
    }

    /**
     * @param mixed $comprasRealizadas
     */
    public function setComprasRealizadas($comprasRealizadas)
    {
        $this->comprasRealizadas = $comprasRealizadas;
    }

    /**
     * @return mixed
     */
    public function getDineroCartera()
    {
        return $this->dineroCartera;
    }

    /**
     * @param mixed $dineroCartera
     */
    public function setDineroCartera($dineroCartera)
    {
        $this->dineroCartera = $dineroCartera;
    }



    public function __construct($id, $nombre, $correo, $fechaNacimiento, $img, $tipo, $dineroCartera, $videoSubidos = null, $suscripciones = null, $comprasRealizadas = null)
    {
        $this->setId($id);
        $this->setNombre($nombre);
        $this->setCorreo($correo);
        $this->setFechaNacimiento($fechaNacimiento);
        $this->setImg("imgs/userImages/".$img);
        $this->setTipo($tipo);
        $this->setDineroCartera($dineroCartera);
        $this->setVideosSubidos($videoSubidos);
        $this->setSuscripciones($suscripciones);
        $this->setComprasRealizadas($comprasRealizadas);
    }

    public static function getUsuarioById($id) {
        $db = new BaseDeDatos();

        $query = "SELECT usuarios.id_usu AS \"Id usuario\", usuarios.id_tipo AS \"Id tipo\", tipo_usuario.nom_tipo AS \"Nombre tipo\", cartera.cant_car AS \"Dinero cartera\", usuarios.nom_usu AS \"Nombre usuario\", usuarios.corr_usu AS \"Correo\", usuarios.fecNac_usu AS \"Fecha Nacimiento\", usuarios.img_usu AS \"Imagen\" FROM usuarios INNER JOIN tipo_usuario ON usuarios.id_tipo = tipo_usuario.id_tipo INNER JOIN cartera ON usuarios.id_car = cartera.id_car WHERE usuarios.id_usu = ".$id;

        $arrayDatos = $db->realizarConsulta($query);

        //Comprobamos que hay datos
        if(sizeof($arrayDatos) > 0) {
            $usuario = new Usuario($arrayDatos[0][0], $arrayDatos[0][4], $arrayDatos[0][5], $arrayDatos[0][6], $arrayDatos[0][7], $arrayDatos[0][1], $arrayDatos[0][3], null, null, null);

            //Obtenemos los ids de los videos subidos
            $queryVideos = "SELECT id_video FROM video WHERE id_usu=".$arrayDatos[0][0];

            $videoDatos = $db->realizarConsulta($queryVideos);
            $videosArray = [];

            for($i = 0; $i < sizeof($videoDatos); $i++) {
                array_push($videosArray, $videoDatos[$i][0]);
            }

            //Guardamos en el objeto los ids de los videos que ha subido
            $usuario->setVideosSubidos($videosArray);

            $querySuscripciones = "SELECT id_seguido FROM relacion WHERE id_seguidor = ".$arrayDatos[0][0];

            $suscripcionesDatos = $db->realizarConsulta($querySuscripciones);
            $suscripcionesArray = [];

            for($i = 0; $i < sizeof($suscripcionesDatos); $i++) {
                array_push($suscripcionesArray, $suscripcionesDatos[$i][0]);
            }

            $usuario->setSuscripciones($suscripcionesArray);

            //TODO: COMPRAS REALIZADAS

            $db->cerrarConexion();
        } else {
            $usuario = null;
        }


        return $usuario;
    }
}