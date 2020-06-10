<?php

require_once "BaseDeDatos.php";

class Video
{
    private $id;
    private $idUsuario;
    private $nombreUsuario;
    private $titulo;
    private $miniatura;
    private $categoria;
    private $visualizaciones;
    private $fechaPublicacion;
    private $likes;
    private $dislikes;
    private $direccion;
    private $descripcion;
    private $repStatus;

    /**
     * Getter del id del video
     * @return int Id del video
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Setter del id del video
     * @param int $id Id del usuario
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Getter del id del usuario
     * @return int Id del usuario
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Setter del id del usuario
     * @param int $idUsuario Id del usuario
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    /**
     * Getter del nombre del usuario
     * @return string Nombre del usuario
     */
    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }

    /**
     * Setter del nombre de usuario
     * @param string $nombreUsuario Nombre del usuario
     */
    public function setNombreUsuario($nombreUsuario)
    {
        $this->nombreUsuario = $nombreUsuario;
    }

    /**
     * Getter del titulo del video
     * @return string Titulo del video
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Setter del titulo del video
     * @param string $titulo Titulo del video
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * Getter de la ruta de la miniatura
     * @return string Ruta de la miniatura
     */
    public function getMiniatura()
    {
        return $this->miniatura;
    }

    /**
     * Setter de la ruta de la miniatura
     * @param string $miniatura Ruta de la miniatura
     */
    public function setMiniatura($miniatura)
    {
        $this->miniatura = $miniatura;
    }



    /**
     * Getter del id de la categoria
     * @return int Id categoria
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Setter del id de la categoria
     * @param int $categoria Id de la categoria
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    /**
     * Getter de la cantidad de visualizaciones del video
     * @return int Visualizaciones del video
     */
    public function getVisualizaciones()
    {
        return $this->visualizaciones;
    }

    /**
     * Setter de visualizaciones del video
     * @param int $visualizaciones Visualizaciones del video
     */
    public function setVisualizaciones($visualizaciones)
    {
        $this->visualizaciones = $visualizaciones;
    }

    /**
     * Getter de la fecha de publicacion del video
     * @return string Fecha de publicacion del video
     */
    public function getFechaPublicacion()
    {
        return $this->fechaPublicacion;
    }

    /**
     * Setter de la fecha de publicación
     * @param string $fechaPublicacion Fecha de publicacion
     */
    public function setFechaPublicacion($fechaPublicacion)
    {
        $this->fechaPublicacion = $fechaPublicacion;
    }

    /**
     * Getter de likes del video
     * @return int likes
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * Setter de los likes del video
     * @param int $likes
     */
    public function setLikes($likes)
    {
        $this->likes = $likes;
    }

    /**
     * Setter de los dislikes del video
     * @return int Dislikes
     */
    public function getDislikes()
    {
        return $this->dislikes;
    }

    /**
     * Setter de los dislikes del video
     * @param int $dislikes Dislikes del video
     */
    public function setDislikes($dislikes)
    {
        $this->dislikes = $dislikes;
    }

    /**
     * Getter de la ruta del video
     * @return string Ruta del video
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Setter de la ruta del video
     * @param string $direccion Ruta del video
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    /**
     * Getter de la descripcion del video
     * @return string Descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Setter de la descripcion del video
     * @param string $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * Getter el status de reporte del video
     * @return int Status
     */
    public function getRepStatus()
    {
        return $this->repStatus;
    }

    /**
     * Setter del status de reporte del video
     * @param int $repStatus Status del reporte
     */
    public function setRepStatus($repStatus)
    {
        $this->repStatus = $repStatus;
    }


    /**
     * Video constructor.
     * @param int $id Id del video
     * @param int $idUsuario Id del usuario propietario del video
     * @param string $nombreUsuario Nombre del usuario propietario del video
     * @param string $titulo Titulo del video
     * @param string $miniatura Ruta de la miniatura
     * @param int $categoria Id de la categoria
     * @param int $visualizaciones Cantidad de visualizaciones
     * @param string $fechaPublicacion Fecha de publicacion
     * @param int $likes Cantidad de likes
     * @param int $dislikes Cantidad de dislikes
     * @param string $ruta Ruta del video
     * @param string $descripcion Descripcion del video
     * @param int $repStatus Status del reporte
     */
    public function __construct($id, $idUsuario,$nombreUsuario, $titulo, $miniatura, $categoria, $visualizaciones, $fechaPublicacion, $likes,
        $dislikes, $ruta, $descripcion, $repStatus = 0)
    {
        $this->setId($id);
        $this->setIdUsuario($idUsuario);
        $this->setNombreUsuario($nombreUsuario);
        $this->setTitulo($titulo);
        $this->setMiniatura($miniatura);
        $this->setCategoria($categoria);
        $this->setVisualizaciones($visualizaciones);
        $this->setFechaPublicacion($fechaPublicacion);
        $this->setLikes($likes);
        $this->setDislikes($dislikes);
        $this->setDireccion($ruta);
        $this->setDescripcion($descripcion);
        $this->setRepStatus($repStatus);
    }

    /**
     * Funcion que retorna un objeto video en base al id dado
     * @param int $id Id del video
     * @return Video|null Si es exitoso devuelve un objeto Video, si no devuelve null
     */
    public static function getVideoById($id) {
        $bd = new BaseDeDatos();

        $arrayDatos = $bd->realizarConsulta('SELECT video.id_video as "Id Video", usuarios.id_usu AS "Id usuario", usuarios.nom_usu AS "Nombre de usuario", categoria.id_cat AS "Categoria ID", categoria.nom_cat AS "Categoria", video.tit_video AS "Titulo video", video.visu_video AS "Visualizaciones", video.minia_video AS "Miniatura", video.fecha_video AS "Fecha publicacion", video.ruta_video AS "Ruta video", video.descr_video AS "Descripcion", (SELECT COUNT(valoracion.id_lidis) FROM valoracion WHERE valoracion.tipo_id_lidis = 1 && valoracion.id_video = '.$id.') AS "Likes",(SELECT COUNT(valoracion.id_lidis) FROM valoracion WHERE valoracion.tipo_id_lidis = -1 && valoracion.id_video = '.$id.') AS "Dislikes", (SELECT reporte.stat_rep FROM reporte WHERE reporte.id_video = '.$id.' LIMIT 1) AS "Status reporte" FROM `video` INNER JOIN usuarios ON usuarios.id_usu = video.id_usu INNER JOIN categoria ON video.id_cat = categoria.id_cat LEFT JOIN valoracion ON valoracion.id_video = video.id_video WHERE video.id_video = '.$id);
        $video = null;

        if($arrayDatos != null) {
            $id = $arrayDatos[0][0];
            $idUsuario = $arrayDatos[0][1];
            $nombreUsuario = $arrayDatos[0][2];
            $idCategoria = $arrayDatos[0][3];
            $titulo = $arrayDatos[0][5];
            $views = $arrayDatos[0][6];
            $miniatura = "./imgs/miniaturas/".$arrayDatos[0][7];
            $fechaVideo = $arrayDatos[0][8];
            $ruta = $arrayDatos[0][9];
            $descripcion = $arrayDatos[0][10];
            $likes = $arrayDatos[0][11];
            $dislikes = $arrayDatos[0][12];
            $repStatus = $arrayDatos[0][13];

            $video = new Video($id, $idUsuario, $nombreUsuario, $titulo, $miniatura, $idCategoria, $views, $fechaVideo, $likes, $dislikes, $ruta, $descripcion, $repStatus);

        }

        $bd->cerrarConexion();

        return $video;

    }

    /**
     * Funcion para eliminar un video
     * @param $id Id del video a eliminar
     */
    public function eliminarVideo($id) {
        $conexion=new BaseDeDatos();
        $sql = "DELETE FROM video WHERE id_video=".$id;
        $conexion->iudQuery($sql);
    }

    /**
     * Funcion para actualizar un video
     * @param array $datos Array de datos del video a actualizar
     */
    public function actualizarVideo($datos) {

        $sentencias = array();
        $id=0;
        foreach ($datos as $campo => $valor) {
            if ($campo != "id_video" && $campo != "x" && $campo != "y") {
                $sentencias[] = $campo . "='".addslashes($valor)."'";
            }else if($campo == "id_video"){
                $id=$valor;
            }
        }
        $campos = implode(",", $sentencias);
        $sql = "UPDATE video SET " . $campos . " WHERE id_video=" . $id;
        $conexion = new BaseDeDatos();
        $conexion->iudQuery($sql);
    }
}