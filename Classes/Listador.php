<?php

require_once "BaseDeDatos.php";
require_once "Video.php";
require_once "Usuario.php";

class Listador
{
    /**
     * Funcion que devuelve una cantidad de $numberRows videos procedentes de la base de datos
     * @param int $start Index de comienzo de la obtencion de los videos en la base de datos
     * @param int $numberRows Cantidad de videos a obtener
     * @param int $channelId Si es 0, el parametro $following es false y no hay una categoría definida, devuelve todos los videos. Si es distinto de 0, devuelve los videos de un canal
     * @param bool $following Si category es 0 y following es true, devolverá los videos de usuarios a los que esté siguiendo el usuario logeado
     * @param int $categoryId Si es distinto de 0, devuelve todos los videos pertenecientes a esa categoría
     * @param bool $mostPopular Si el channelid es diferente de 0 y mostpopular es true se devuelven los videos con más views correspondiente a ese canal
     * @return array Array de videos retornados en base a los parametros dados
     */
    public static function listarVideos($start = 0, $numberRows = 9, $channelId = 0, $following = false, $categoryId = 0, $mostPopular = false)
    {

        //Inicializamos variables
        $db = new BaseDeDatos();

        $arrayResult = [];
        $query = "";

        if ($categoryId != 0 && is_numeric($categoryId)) {
            //Sacamos los ultimos videos de la categoría dada
            $query = "SELECT id_video FROM video WHERE id_cat=".$categoryId;
        } else {
            //Sacamos los videos de canales a los que sigue el usuario
            if ($following) {
                $query = "SELECT video.id_video FROM video INNER JOIN relacion ON relacion.id_seguido = video.id_usu WHERE relacion.id_seguidor = " . $channelId . " ORDER BY video.id_video DESC LIMIT 0, 9";
            } else {
                //Comprobamos que el id dado existe
                if(is_numeric($channelId)) {
                    if ($channelId == 0) {
                        //Mostramos los ultimos videos, no hay criterio
                        $query = "SELECT id_video FROM video ORDER BY id_video DESC LIMIT " . $start . "," . $numberRows;
                    } else {
                        if($mostPopular) {
                            //Sacamos los videos más populares del canal
                            $query = "SELECT id_video FROM video WHERE id_usu = ".$channelId." ORDER BY visu_video DESC LIMIT ".$start.",".$numberRows;
                        } else {
                            if($numberRows == 0) {
                                //Mostramos los ultimos videos de un canal en concreto
                                $query = "SELECT id_video FROM video WHERE id_usu=" . $channelId . " ORDER BY id_video DESC";
                            } else {
                                //Mostramos los ultimos videos de un canal en concreto limitados por numberRows
                                $query = "SELECT id_video FROM video WHERE id_usu=" . $channelId . " ORDER BY id_video DESC LIMIT " . $start . "," . $numberRows;
                            }
                        }
                    }
                }
            }
        }

        //Obtenemos los datos
        $arrayDatos = $db->realizarConsulta($query);
        $video = "";

        for ($i = 0; $i < sizeof($arrayDatos); $i++) {
            $video = Video::getVideoById($arrayDatos[$i][0]);
            array_push($arrayResult, $video);
        }

        $db->cerrarConexion();

        return $arrayResult;
    }

    /**
     * Funcion para listar categorias
     * @param int $index Index de la base de datos
     * @param int $limit Cantidad de categorias a obtener
     * @return array Array de categorias
     */
    public static function listarCategorias($index = 0, $limit = 6)
    {

        $db = new BaseDeDatos();

        $query = "";

        $arrayResult = [];
        if ($limit == null && $limit == 0) {
            $query = "SELECT * FROM categoria ORDER BY id_cat DESC";
        } else {
            $query = "SELECT * FROM categoria ORDER BY id_cat DESC LIMIT " . $index . "," . $limit;
        }

        $arrayDatos = $db->realizarConsulta($query);

        for ($i = 0; $i < sizeof($arrayDatos); $i++) {
            $categoria = Categoria::getCategoriaById($arrayDatos[$i][0]);
            array_push($arrayResult, $categoria);
        }

        $db->cerrarConexion();

        return $arrayResult;
    }

    /**
     * Funcion para listar canales
     * @param int $start Index de comienzo
     * @param int $numberRows Cantidad de canales para obtener
     * @param bool $following Si es true, devolvemos los canales a los que el usuario sigue
     * @param int $userId Usuario del que se obtienen los canales seguidos
     * @return array Array de canales
     */
    public static function listarCanales($start = 0, $numberRows = 6, $following = false, $userId = 0) {
        $db = new BaseDeDatos();

        $query = "";
        $canales = [];

        if($following && $userId != 0) {
            //Lista de canales a los que el usuario sigue
            $query = "SELECT relacion.id_seguido FROM relacion WHERE relacion.id_seguidor = ".$userId." ORDER BY relacion.id_rel DESC LIMIT ".$start.",".$numberRows;
        } else {
            if($numberRows == null) {
                //Ultimos canales
                $query = "SELECT usuarios.id_usu FROM usuarios ORDER BY usuarios.id_usu DESC";
            } else {
                //Ultimos canales
                $query = "SELECT usuarios.id_usu FROM usuarios ORDER BY usuarios.id_usu DESC LIMIT ".$start.",".$numberRows;
            }
        }

        $datosArray = $db->realizarConsulta($query);

        for($i = 0; $i < sizeof($datosArray); $i++) {
            $usuario = Usuario::getUsuarioById($datosArray[$i][0]);
            if($usuario->getTipo() != 3) {
                array_push($canales, $usuario);
            }
        }

        $db->cerrarConexion();

        return $canales;
    }

    /**
     * Funcion para obtener y mostrar los productos
     */
    public function listarProductos(){
        $lista=[];
        $sql = "SELECT * FROM producto ";
        $conexion = new BaseDeDatos();
        $res = $conexion->realizarConsulta($sql);
        for($i=0;$i<count($res);$i++){
            $fila = new Producto($res[$i][0], $res[$i][1], $res[$i][2], $res[$i][3], $res[$i][4], $res[$i][5],$res[$i][6]);
            $html = $fila->imprimeteEnTr($i);
            echo $html;
        }
    }
  
  /**
   * Funcion para obtener una lista de los datos
   * @return array Array de productos
   */
    public function listarDatosProductos(){
        $lista=[];
        $sql = "SELECT * FROM producto ";
        $conexion = new BaseDeDatos();
        $res = $conexion->realizarConsulta($sql);
        for($i=0;$i<count($res);$i++){
            $producto = new Producto($res[$i][0], $res[$i][1], $res[$i][2], $res[$i][3], $res[$i][4], $res[$i][5],$res[$i][6]);
            array_push($lista, $producto);
        }
        return $lista;
    }
    public function listarEmpresas(){
        $lista=[];
        $sql = "SELECT * FROM empresa ";
        $conexion = new BaseDeDatos();
        $res = $conexion->realizarConsulta($sql);
        for($i=0;$i<count($res);$i++){
            $empresa = new Empresa($res[$i][0], $res[$i][1], $res[$i][2], $res[$i][3], $res[$i][4], $res[$i][5]);
            array_push($lista, $empresa);
        }
        return $lista;
    }
    /**
     * Funcion para listar los videos reportados
     * @return array Array con los videos reportados
     */
    public static function listarVideoReportados() {
        $db = new BaseDeDatos();

        $arrayResult = [];
        $query = "SELECT video.id_video FROM video INNER JOIN reporte ON video.id_video = reporte.id_video WHERE stat_rep=0";

        //Obtenemos los datos
        $arrayDatos = $db->realizarConsulta($query);

        $video = "";

        for ($i = 0; $i < sizeof($arrayDatos); $i++) {
            $video = Video::getVideoById($arrayDatos[$i][0]);
            //Comprobamos si el video no está en el array para añadirlo
            if(!in_array($video, $arrayResult)) {
                array_push($arrayResult, $video);
            }
        }

        $db->cerrarConexion();

        return $arrayResult;
    }
}