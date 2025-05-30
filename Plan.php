<?php
/**De los planes se almacena un código, los canales que ofrece, el importe 
 * y si incluye MG de datos o no. Por defecto se asume que el plan incluye 100 MG. */
class p{
    private $codigo;
    private $canalesOfrecidos;
    private $importe;
    private $incluyeMGDatos;

    //Constructor
    public function __construct($codigo,$canalesOfrecidos,$importe)
    {
        $this->codigo=$codigo;
        $this->canalesOfrecidos=$canalesOfrecidos;
        $this->importe=$importe;
        $this->incluyeMGDatos=100;
    }

    //Getters
    public function getCodigo(){
        return $this->codigo;
    }
    public function getCanalesOfrecidos(){
        return $this->canalesOfrecidos;
    }
    public function getImporte(){
        return $this->importe;
    }
    public function getIncluyeMGDatos(){
        return $this->incluyeMGDatos;
    }

    //Setters
    public function setCodigo($codigo){
        $this->codigo=$codigo;
    }
    public function setCanalesOfrecidos($canalesOfrecidos){
        $this->canalesOfrecidos=$canalesOfrecidos;
    }
    public function setImporte($importe){
        $this->importe=$importe;
    }
    public function setIncluyeMGDatos($incluyeMGDatos){
        $this->incluyeMGDatos=$incluyeMGDatos;
    }

    //toString
    public function __toString()
    {
        return "Codigo: ".$this->getCodigo()."\n".
        "Canales Ofrecidos: ".$this->getCanalesOfrecidos()."\n".
        "Importe: ".$this->getImporte()."\n".
        "Incluye: ".$this->getIncluyeMGDatos()."MG de Datos\n";
    }
}