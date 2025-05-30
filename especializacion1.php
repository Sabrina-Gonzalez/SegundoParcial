<?php
class G1 extends G{
    private $a;
    private $b;

    public function __construct($a,$b)
    {
        parent::__construct();
        $this->a=$a;
        $this->b=$b;
    }

    //Getters
    public function getA(){
        return $this->a;
    }
    public function getB(){
        return $this->b;
    }

    //Setters
    public function setA($a){
        $this->a=$a;
    }
    public function setCoefPenalizacion($b){
        $this->b=$b;
    }

    //toString
    public function __toString()
    {
        return parent::__toString().
        "I";
    }
}