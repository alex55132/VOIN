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
        $res = $conexion->Consulta($sql);
        while( list($id_pro, $id_empr, $nom_pro, $pre_pro, $stock_pro, $descr_pro,$descor_pro, $img_pro) = mysqli_fetch_array($res) ) {

            $fila = new Producto($id_pro, $id_empr, $nom_pro, $pre_pro, $stock_pro, $descr_pro,$descor_pro, $img_pro);
            array_push($this->lista, $fila);
        }
    }
    public function imprimirMangasEnBack(){

        $html="";
        for($i=0;$i<sizeof($this->lista);$i++){

            $html .= $this->lista[$i]->imprimeteEnTr($i);
        }

        return $html;

    }
}