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
     * Getter del id de usuario
     * @return int Id del usuario
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Setter del id de usuario
     * @param int $id Id del usuario
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Getter del nombre del usuario
     * @return string Nombre del usuario
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Setter del nombre del usuario
     * @param string $nombre Nombre del usuario
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Getter del correo electrónico del usuario
     * @return string Correo del usuario
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Setter del correo electronico del usuario
     * @param string $correo Correo electronico
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    /**
     * Getter de la fecha de nacimiento del usuario
     * @return string Fecha de nacimiento
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Setter de la fecha de nacimiento del usuario
     * @param string $fechaNacimiento Fecha de nacimiento en formato Y-m-d
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    /**
     * Getter de la imagen del video
     * @return string Ruta de la imagen
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Setter de la imagen del video
     * @param string $img Ruta de la imagen
     */
    public function setImg($img)
    {
        $this->img = $img;
    }

    /**
     * Getter del tipo de usuario
     * @return int Tipo de usuario
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Setter del tipo de usuario
     * @param int $tipo Tipo de usuario
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * Getter de los videos subidos
     * @return array Videos subidos
     */
    public function getVideosSubidos()
    {
        return $this->videosSubidos;
    }

    /**
     * Setter de los videos subidos
     * @param array $videoSubidos Array de videos subidos
     */
    public function setVideosSubidos($videoSubidos)
    {
        $this->videosSubidos = $videoSubidos;
    }

    /**
     * Getter de las suscripciones
     * @return array Suscripciones
     */
    public function getSuscripciones()
    {
        return $this->suscripciones;
    }

    /**
     * Setter de las suscripciones
     * @param array $suscripciones Suscripciones
     */
    public function setSuscripciones($suscripciones)
    {
        $this->suscripciones = $suscripciones;
    }

    /**
     * Getter de las compras realizadas
     * @return array
     */
    public function getComprasRealizadas()
    {
        return $this->comprasRealizadas;
    }

    /**
     * Setter de las compras realizadas
     * @param array $comprasRealizadas Compras
     */
    public function setComprasRealizadas($comprasRealizadas)
    {
        $this->comprasRealizadas = $comprasRealizadas;
    }

    /**
     * Getter del dinero de la cartera del usuario
     * @return int Dinero de la cartera
     */
    public function getDineroCartera()
    {
        return $this->dineroCartera;
    }

    /**
     * Setter del dinero de la cartera del usuario
     * @param int $dineroCartera Dinero de la cartera
     */
    public function setDineroCartera($dineroCartera)
    {
        $this->dineroCartera = $dineroCartera;
    }


    /**
     * Usuario constructor.
     * @param int $id Id del usuario
     * @param string $nombre Nombre del usuario
     * @param string $correo Correo del usuario
     * @param string $fechaNacimiento Fecha de nacimiento del usuario
     * @param string $img Ruta de la imagen del usuario
     * @param int $tipo Tipo del usuario
     * @param int $dineroCartera Dinero de la cartera del usuario
     * @param array $videoSubidos Videos subidos del usuario
     * @param array $suscripciones Suscripciones del usuario
     * @param array $comprasRealizadas Compras realizadas por el usuario
     */
    public function __construct($id = 0, $nombre = "", $correo = "", $fechaNacimiento = "", $img = null, $tipo = null, $dineroCartera = 0, $videoSubidos = null, $suscripciones = null, $comprasRealizadas = null)
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

    /**
     * Funcion que retorna un Usuario en base a la id dad
     * @param int $id Id del usuario a obtener
     * @return Usuario|null Devuelve un objeto Usuario si tiene exito, si no, es null
     */
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

            $db->cerrarConexion();
        } else {
            $usuario = null;
        }


        return $usuario;
    }

    /**
     * Funcion para logear al usuario
     * @param string $corr Correo
     * @param string $cont Contraseña
     * @return bool True si el login es exitoso, false si no
     */
    public function login($corr,$cont){
        $ok=false;
        $sql="SELECT id_usu FROM usuarios WHERE corr_usu ='".$corr."' AND contr_usu='".md5($cont)."'";
        $conexion=new BaseDeDatos();
        $res=$conexion->realizarConsulta($sql);
        if ($res!=null){
            $ok=true;
            $this->setId($res[0][0]);
        }else{
            $ok=false;
        }
        return $ok;
    }

    /**
     * Funcion para insertar a un usuario en la base de datos
     * @param string $nom Nombre del usuario
     * @param string $correo Correo del usuario
     * @param string $contra Contraseña del usuario
     * @return bool True si se realiza correctamente, false si no
     */
    public static function insertarUsuario($nom,$correo,$contra){
        $bd=new BaseDeDatos();
        $sql ="INSERT INTO `cartera` (`cant_car`) VALUES ('25');";
        $bd->iudQuery($sql);
        $sql ="SELECT max(id_car) as 'id_car' FROM `cartera`;";
        $car=$bd->realizarConsulta($sql);
        $sql = "INSERT INTO usuarios (id_tipo, id_car, nom_usu, contr_usu, corr_usu, fecNac_usu, img_usu) VALUES  (0,".$car[0][0].",'".$nom."','".md5($contra)."','".$correo."', '".date("Y/m/d")."', 'default.jpg')";
        $resultado = $bd->iudQuery($sql);
        return $resultado;
    }
}