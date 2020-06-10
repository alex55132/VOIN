<?php
require_once "BaseDeDatos.php";

class Producto
{
    private $id_pro;
    private $id_empr;
    private $nom_pro;
    private $pre_pro;
    private $stock_pro;
    private $descr_pro;
    private $img_pro;
    private $directorio;
    private $tabla;

    /**
     * Producto constructor.
     * @param string $id_pro Id del producto
     * @param string $id_empr Id empresa
     * @param string $nom_pro Nombre del producto
     * @param string $pre_pro Precio del producto
     * @param string $stock_pro Stock del producto
     * @param string $descr_pro Descripcion del producto
     * @param string $img_pro Ruta de la imagen del producto
     */
    public function __construct($id_pro="", $id_empr="", $nom_pro="", $pre_pro="", $stock_pro="", $descr_pro="", $img_pro="")
    {
        $this->id_pro = $id_pro;
        $this->id_empr = $id_empr;
        $this->nom_pro = $nom_pro;
        $this->pre_pro = $pre_pro;
        $this->stock_pro = $stock_pro;
        $this->descr_pro = $descr_pro;
        $this->img_pro = $img_pro;
        $this->directorio="imgs/tienda/";
        $this->tabla="producto";
    }

    /**
     * Funcion para llenar los datos del objeto
     * @param string $id_pro Id del producto
     * @param string $id_empr Id de la empresa
     * @param string $nom_pro Nombre del producto
     * @param string $pre_pro Precio del producto
     * @param string $stock_pro Stock del producto
     * @param string $descr_pro Descripcion del producto
     * @param string $img_pro Imagen del producto
     */
    public function llenar($id_pro="", $id_empr="", $nom_pro="", $pre_pro="", $stock_pro="", $descr_pro="", $img_pro=""){
        $this->id_pro = $id_pro;
        $this->id_empr = $id_empr;
        $this->nom_pro = $nom_pro;
        $this->pre_pro = $pre_pro;
        $this->stock_pro = $stock_pro;
        $this->descr_pro = $descr_pro;
        $this->img_pro = $img_pro;
    }
    /**
     * Getter del id del producto
     * @return string id del producto
     */
    public function getIdPro()
    {
        return $this->id_pro;
    }

    /**
     * Setter del id del producto
     * @param string $id_pro Id del producto
     */
    public function setIdPro($id_pro)
    {
        $this->id_pro = $id_pro;
    }

    /**
     * Getter id de la empresa del producto
     * @return string Id de la empresa
     */
    public function getIdEmpr()
    {
        return $this->id_empr;
    }

    /**
     * Setter del id de la empresa
     * @param string $id_empr
     */
    public function setIdEmpr($id_empr)
    {
        $this->id_empr = $id_empr;
    }

    /**
     * Getter del nombre del producto
     * @return string Nombre del producto
     */
    public function getNomPro()
    {
        return $this->nom_pro;
    }

    /**
     * Setter del nombre del producto
     * @param string $nom_pro Nombre del producto
     */
    public function setNomPro($nom_pro)
    {
        $this->nom_pro = $nom_pro;
    }

    /**
     * Getter del precio del producto
     * @return string Precio del producto
     */
    public function getPrePro()
    {
        return $this->pre_pro;
    }

    /**
     * Setter del precio del producto
     * @param string $pre_pro Precio del producto
     */
    public function setPrePro($pre_pro)
    {
        $this->pre_pro = $pre_pro;
    }

    /**
     * Getter del stock del producto
     * @return string Stock del producto
     */
    public function getStockPro()
    {
        return $this->stock_pro;
    }

    /**
     * Setter del stock del producto
     * @param string $stock_pro Stock
     */
    public function setStockPro($stock_pro)
    {
        $this->stock_pro = $stock_pro;
    }

    /**
     * Getter de la descripcion del producto
     * @return string Descripcion
     */
    public function getDescrPro()
    {
        return $this->descr_pro;
    }

    /**
     * Setter de la descripcion del producto
     * @param string $descr_pro Descripcion
     */
    public function setDescrPro($descr_pro)
    {
        $this->descr_pro = $descr_pro;
    }

    /**
     * Getter de la ruta de la imagen
     * @return string Ruta de imagen
     */
    public function getImgPro()
    {
        return $this->img_pro;
    }

    /**
     * Setter ruta de la imagen
     * @param string $img_pro Ruta de la imagen del producto
     */
    public function setImgPro($img_pro)
    {
        $this->img_pro = $img_pro;
    }

    /**
     * Funcion que imprime el producto
     * @param int $i Index que indica la posicion en el bucle para determinar si se posiciona a la izq o a la der
     * @return string Cadena html
     */
    public function imprimeteEnTr($i){
        $html="
        <div class='producto'>";
        if ($i % 2==0){
            $html.="<div class='proizq'>";
        }else{
            $html.="<div class='proder'>";
        }
        $html.="
                <div class='fotoproducto'>
                    <img src='".$this->directorio.$this->img_pro."' alt='producto'>
                </div>
                <div class='comPro'>
                    <div class='titPro'>
                        <h2>".$this->nom_pro."</h2>
                    </div>
                    <div class='incluyePro'>
                       
                    </div>
                    <div data-productoid='".$this->id_pro."' data-precio='".$this->pre_pro."' data-stock='".$this->stock_pro."' class='botonComPro productoCompraBtn'>
                        ".$this->pre_pro."
                    </div>
                    <div class='cantidadPro'>
                         <p>Quedan ".$this->stock_pro." unidades</p>
                    </div>
                </div>
                <div class='desPro'>
                    <div class='texto'>
                       <p>".$this->descr_pro."
                           </p>

                    </div>
                    <div class='sabermas'>
                        <a href='producto.php?id=".$this->id_pro."'>+Saber más</a>
                    </div>
                </div>
            </div>
        </div>";

        return $html;

    }

    /**
     * Funcion para mostrar el producto
     * @return string Html con los datos del producto
     */
    public function imprimirEnFicha(){
    $web=$this->obtenerWeb($this->id_empr);
            $html="<section>
    <div class='producto'>
        <div class='proizq'>
            <div class='fotoproducto'>
                <img src='".$this->directorio.$this->img_pro."' alt='producto'>
            </div>
            <div class='proFin'>
                <div class='titPro'>
                    <h2>".$this->nom_pro."</h2>
                </div>
                <div class='descripcion'>
                    <p>".$this->descr_pro."
                    </p>
                </div>
               
            </div>

        </div>
    </div>
</section>
<footer>
    <div class='botonComPro'>
        ".$this->pre_pro."€
    </div>
    <div class='cantidadPro'>
        <p>Quedan ".$this->stock_pro." unidades</p>
    </div>
    <!-- <div class='enlace'>
      <p><a href='".$web[0][0]."'>Pagina de la empresa</a></p>
    </div>-->
</footer>
    ";

        return $html;

    }

    /**
     * Funcion que obtiene la web de una empresa
     * @param int $id Id de la empresa
     * @return array|null Array con los resultados
     */
    function obtenerWeb($id){
        $sql = "SELECT web_empr FROM empresa WHERE id_empr=".$id." ;";
        $conexion = new BaseDeDatos();
        $res = $conexion->realizarConsulta($sql);
        return $res;
    }

    /**
     * Funcion para obtener un producto segun su ID. (Ya que se puede generar el objeto vacio, no hace falta que este sea estático)
     * @param int $id Id del producto
     */
    public function ObtenerPorId($id){
        $sql="SELECT * FROM ".$this->tabla." WHERE 	id_pro=".$id;
        $conexion=new BaseDeDatos();
        $res=$conexion->realizarConsulta($sql);
        $this->llenar($res[0][0], $res[0][1], $res[0][2], $res[0][3], $res[0][4], $res[0][5],$res[0][6]);

    }
    public function eliminarProducto($id) {
        $conexion=new BaseDeDatos();
        $sql = "DELETE FROM producto WHERE id_pro=".$id;
        $conexion->iudQuery($sql);
    }
    public function subirProducto($datos,$foto,$carpeta="../imgs/tienda/"){
        require_once "../Controllers/manejoFotos.php";
        $claves  = array();
        $valores = array();
        foreach ($datos as $clave => $valor){
            $claves[] = $clave;
            $valores[] = "'".$valor."'";
        }
        if($foto['foto'] ['size']!= ""){

            $ruta = subirFoto($foto['foto'],$carpeta);

            $claves[] = "img_pro";
            $valores[] = "'".$ruta."'";
        }
        $sql = "INSERT INTO producto (".implode(',', $claves).") VALUES  (".implode(',', $valores).")";

        $conexion=new BaseDeDatos();
        $conexion->iudQuery($sql);
    }
    public function updateProducto($datos,$foto,$carpeta="../imgs/tienda/"){
        require_once "../Controllers/manejoFotos.php";
        $sentencias = array();
        $id=0;
        foreach ($datos as $campo => $valor) {
            if ($campo != "id_pro" && $campo != "x" && $campo != "y") {
                $sentencias[] = $campo . "='".addslashes($valor)."'";
                //UPDATE tabla SET nombreCampo = 'valor1', nombreCampo='valor'....
            }else if($campo == "id_pro"){
                $id=$valor;
            }
        }
        if(strlen($foto['foto']['name'])>0){
            $ruta= subirFoto($foto['foto'], $carpeta);
            $sentencias[] = "foto='".$ruta."'";
        }



        $campos = implode(",", $sentencias);
        $sql = "UPDATE producto SET " . $campos . " WHERE id_pro=" . $id;
        echo $sql;
        $conexion=new BaseDeDatos();
        $conexion->iudQuery($sql);
    }
}