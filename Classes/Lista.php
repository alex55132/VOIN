<?php


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
        $fila = new Producto($res[0][0], $res[0][1], $res[0][2], $res[0][3], $res[0][4], $res[0][5],$res[0][6], $res[0][7]);
        array_push($this->lista, $fila);
    }
    public function imprimirProductosEnBack(){

        $html="";
        for($i=0;$i<sizeof($this->lista);$i++){

            $html .= $this->lista[$i]->imprimeteEnTr($i);
        }

        return $html;

    }
}