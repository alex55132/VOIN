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
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * @param mixed $idUsuario
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    /**
     * @return mixed
     */
    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }

    /**
     * @param mixed $nombreUsuario
     */
    public function setNombreUsuario($nombreUsuario)
    {
        $this->nombreUsuario = $nombreUsuario;
    }

    /**
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * @return mixed
     */
    public function getMiniatura()
    {
        return $this->miniatura;
    }

    /**
     * @param mixed $miniatura
     */
    public function setMiniatura($miniatura)
    {
        $this->miniatura = $miniatura;
    }



    /**
     * @return mixed
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @param mixed $categoria
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    /**
     * @return mixed
     */
    public function getVisualizaciones()
    {
        return $this->visualizaciones;
    }

    /**
     * @param mixed $visualizaciones
     */
    public function setVisualizaciones($visualizaciones)
    {
        $this->visualizaciones = $visualizaciones;
    }

    /**
     * @return mixed
     */
    public function getFechaPublicacion()
    {
        return $this->fechaPublicacion;
    }

    /**
     * @param mixed $fechaPublicacion
     */
    public function setFechaPublicacion($fechaPublicacion)
    {
        $this->fechaPublicacion = $fechaPublicacion;
    }

    /**
     * @return mixed
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * @param mixed $likes
     */
    public function setLikes($likes)
    {
        $this->likes = $likes;
    }

    /**
     * @return mixed
     */
    public function getDislikes()
    {
        return $this->dislikes;
    }

    /**
     * @param mixed $dislikes
     */
    public function setDislikes($dislikes)
    {
        $this->dislikes = $dislikes;
    }

    /**
     * @return mixed
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param mixed $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function __construct($id, $idUsuario,$nombreUsuario, $titulo, $miniatura, $categoria, $visualizaciones, $fechaPublicacion, $likes,
        $dislikes, $ruta, $descripcion)
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
    }

    public static function getVideoById($id) {
        $bd = new BaseDeDatos();
        $arrayDatos = $bd->realizarConsulta('SELECT video.id_video as "Id Video", usuarios.id_usu AS "Id usuario", usuarios.nom_usu AS "Nombre de usuario", categoria.id_cat AS "Categoria ID", categoria.nom_cat AS "Categoria", video.tit_video AS "Titulo video", video.visu_video AS "Visualizaciones", video.minia_video AS "Miniatura", video.fecha_video AS "Fecha publicacion", video.ruta_video AS "Ruta video", video.descr_video AS "Descripcion", (SELECT COUNT(valoracion.id_lidis) FROM valoracion WHERE valoracion.tipo_id_lidis = 1 && valoracion.id_video = '.$id.') AS "Likes",(SELECT COUNT(valoracion.id_lidis) FROM valoracion WHERE valoracion.tipo_id_lidis = -1 && valoracion.id_video = '.$id.') AS "Dislikes" FROM `video` INNER JOIN usuarios ON usuarios.id_usu = video.id_usu INNER JOIN categoria ON video.id_cat = categoria.id_cat LEFT JOIN valoracion ON valoracion.id_video = video.id_video WHERE video.id_video ='.$id);

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

            $video = new Video($id, $idUsuario, $nombreUsuario, $titulo, $miniatura, $idCategoria, $views, $fechaVideo, $likes, $dislikes, $ruta, $descripcion);

        }

        $bd->cerrarConexion();

        return $video;

    }

    public function guardarVideo($titulo, $categoria, $descripcion) {
        //TODO
    }

    public function eliminarVideo($id) {
        $conexion=new BaseDeDatos();
        $sql = "DELETE FROM video WHERE id_video=".$id;
        $conexion->iudQuery($sql);
    }

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