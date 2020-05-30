<?php


class Producto
{
    private $id_pro;
    private $id_empr;
    private $nom_pro;
    private $pre_pro;
    private $stock_pro;
    private $descr_pro;
    private $descor_pro;
    private $img_pro;
    private $directorio;
    private $tabla;
    /**
     * Producto constructor.
     * @param $id_pro
     * @param $id_empr
     * @param $nom_pro
     * @param $pre_pro
     * @param $stock_pro
     * @param $descr_pro
     * @param $img_pro
     */
    public function __construct($id_pro="", $id_empr="", $nom_pro="", $pre_pro="", $stock_pro="", $descr_pro="", $descor_pro="", $img_pro="")
    {
        $this->id_pro = $id_pro;
        $this->id_empr = $id_empr;
        $this->nom_pro = $nom_pro;
        $this->pre_pro = $pre_pro;
        $this->stock_pro = $stock_pro;
        $this->descr_pro = $descr_pro;
        $this->descor_pro = $descor_pro;
        $this->img_pro = $img_pro;
        $this->directorio="imgs/tienda/";
        $this->tabla="producto";
    }
    public function llenar($id_pro="", $id_empr="", $nom_pro="", $pre_pro="", $stock_pro="", $descr_pro="", $descor_pro="", $img_pro=""){
        $this->id_pro = $id_pro;
        $this->id_empr = $id_empr;
        $this->nom_pro = $nom_pro;
        $this->pre_pro = $pre_pro;
        $this->stock_pro = $stock_pro;
        $this->descr_pro = $descr_pro;
        $this->descor_pro = $descor_pro;
        $this->img_pro = $img_pro;
    }
    /**
     * @return mixed
     */
    public function getIdPro()
    {
        return $this->id_pro;
    }

    /**
     * @param mixed $id_pro
     */
    public function setIdPro($id_pro)
    {
        $this->id_pro = $id_pro;
    }

    /**
     * @return mixed
     */
    public function getIdEmpr()
    {
        return $this->id_empr;
    }

    /**
     * @param mixed $id_empr
     */
    public function setIdEmpr($id_empr)
    {
        $this->id_empr = $id_empr;
    }

    /**
     * @return mixed
     */
    public function getNomPro()
    {
        return $this->nom_pro;
    }

    /**
     * @param mixed $nom_pro
     */
    public function setNomPro($nom_pro)
    {
        $this->nom_pro = $nom_pro;
    }

    /**
     * @return mixed
     */
    public function getPrePro()
    {
        return $this->pre_pro;
    }

    /**
     * @param mixed $pre_pro
     */
    public function setPrePro($pre_pro)
    {
        $this->pre_pro = $pre_pro;
    }

    /**
     * @return mixed
     */
    public function getStockPro()
    {
        return $this->stock_pro;
    }

    /**
     * @param mixed $stock_pro
     */
    public function setStockPro($stock_pro)
    {
        $this->stock_pro = $stock_pro;
    }

    /**
     * @return mixed
     */
    public function getDescrPro()
    {
        return $this->descr_pro;
    }

    /**
     * @param mixed $descr_pro
     */
    public function setDescrPro($descr_pro)
    {
        $this->descr_pro = $descr_pro;
    }

    /**
     * @return mixed
     */
    public function getDescorPro()
    {
        return $this->descor_pro;
    }

    /**
     * @param mixed $descor_pro
     */
    public function setDescorPro($descor_pro)
    {
        $this->descor_pro = $descor_pro;
    }

    /**
     * @return mixed
     */
    public function getImgPro()
    {
        return $this->img_pro;
    }

    /**
     * @param mixed $img_pro
     */
    public function setImgPro($img_pro)
    {
        $this->img_pro = $img_pro;
    }
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
                        <p>".$this->descor_pro."</p>
                    </div>
                    <div class='botonComPro'>
                        ".$this->pre_pro."€
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
    public function imprimirEnFicha(){
    $web=$this->obtenerWeb($this->id_empr);
        var_dump($web);
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
    function obtenerWeb($id){
        $sql = "SELECT web_empr FROM empresa WHERE id_empr=".$id." ;";
        $conexion = new BaseDeDatos();
        $res = $conexion->realizarConsulta($sql);
        return $res;
    }
    public function ObtenerPorId($id){
        $sql="SELECT * FROM ".$this->tabla." WHERE 	id_pro=".$id;
        $conexion=new BaseDeDatos();
        $res=$conexion->realizarConsulta($sql);
        $this->llenar($res[0][0], $res[0][1], $res[0][2], $res[0][3], $res[0][4], $res[0][5],$res[0][6], $res[0][7]);
    }
    public function insertar($datos){
        $conexion = new BaseDeDatos();
        $conexion->insertarElemento($this->tabla,$datos);
    }
}