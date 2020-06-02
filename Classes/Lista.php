<?php
require_once "BaseDeDatos.php";

class Lista
{
    private $lista;
    private $tabla;

    public function __construct(){

        $this->lista = array();
        $this->tabla = "producto";
    }

    public function obtenerElementos(){
        $sql = "SELECT * FROM ".$this->tabla." ;";
        $conexion = new BaseDeDatos();
        $res = $conexion->realizarConsulta($sql);
        for($i=0;$i<count($res);$i++){
            $fila = new Producto($res[$i][0], $res[$i][1], $res[$i][2], $res[$i][3], $res[$i][4], $res[$i][5],$res[$i][6], $res[$i][7]);
            array_push($this->lista, $fila);
        }
    }
    public function imprimirProductosEnBack(){

        $html="";
        for($i=0;$i<sizeof($this->lista);$i++){

            $html .= $this->lista[$i]->imprimeteEnTr($i);
        }

        return $html;

    }
}