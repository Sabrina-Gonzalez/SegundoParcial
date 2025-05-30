<?php
//De los canales se conoce el tipo de canal, importe y si es HD o no
class Canales{
    private $tipoCanal;
    private $importe;
    private $esHD;

    //Constructor
    public function __construct($tipoCanal,$importe,$esHD)
    {
        $this->tipoCanal=$tipoCanal;
        $this->importe=$importe;
        $this->esHD=$esHD;
    }

    //Getters
    public function getTipoCanal(){
        return $this->tipoCanal;
    }
    public function getImporteCanal(){
        return $this->importe;
    }
    public function getEsHD(){
        return $this->esHD;
    }

    //Setters
    public function setTipoCanal($tipoCanal){
        $this->tipoCanal=$tipoCanal;
    }
    public function setImporteCanal($importe){
        $this->importe=$importe;
    }
    public function setEsHD($esHD){
        $this->esHD=$esHD;
    }

    //toString
    public function __toString()
    {
        return "Tipo de Canal: ".$this->getTipoCanal()."\n".
        "Importe del Canal: ".$this->getImporteCanal()."\n".
        "Es HD: ".$this->getEsHD()."\n";
    }
}