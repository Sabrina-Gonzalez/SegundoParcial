<?php
/**En la clase Cliente se registra la siguiente información: nombre, apellido, dirección, mail y teléfono.  */
class Cliente{
    private $nombre;
    private $apellido;
    private $tipoDoc;
    private $numDoc;
    private $direccion;
    private $mail;
    private $telefono;

    //Constructor
    public function __construct($nombre,$apellido,$tipoDoc,$numDoc,$direccion,$mail,$telefono)
    {
        $this->nombre=$nombre;
        $this->apellido=$apellido;
        $this->tipoDoc=$tipoDoc;
        $this->numDoc=$numDoc;
        $this->direccion=$direccion;
        $this->mail=$mail;
        $this->telefono=$telefono;
    }

    //Getters
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function getTipoDoc(){
        return $this->tipoDoc;
    }
    public function getNumDoc(){
        return $this->numDoc;
    }
    public function getDireccion(){
        return $this->direccion;
    }
    public function getMail(){
        return $this->mail;
    }
    public function getTelefono(){
        return $this->telefono;
    }
    //Setters
    public function setNombre($nombre){
        $this->nombre=$nombre;
    }
    public function setApellido($apellido){
        $this->apellido=$apellido;
    }
    public function setTipoDoc($tipoDoc){
        $this->tipoDoc=$tipoDoc;
    }
    public function setNumDoc($numDoc){
        $this->numDoc=$numDoc;
    }
    public function setDireccion($direccion){
        $this->direccion=$direccion;
    }
    public function setMail($mail){
        $this->mail=$mail;
    }
    public function setTelefono($telefono){
        $this->telefono=$telefono;
    }
    //Metodo toString
    public function __toString()
    {
        return "Nombre: ".$this->getNombre()."\n".
        "Apellido: ".$this->getApellido()."\n".
        "Tipo Documento: ".$this->getTipoDoc()."\n".
        "Numero Documento: ".$this->getNumDoc()."\n".
        "Direccion ".$this->getDireccion()."\n".
        "Mail: ".$this->getMail()."\n".
        "Telefono: ".$this->getTelefono()."\n";
    }
}