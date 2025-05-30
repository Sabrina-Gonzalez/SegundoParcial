<?php
//un contrato realizado vía web se guarda además el porcentaje de descuento
class ContratoWeb extends Contrato{
    private $porcentajeDescuento;

    public function __construct($fechaInicio,$fechaVencimiento,$objPlan,$estado,$costo,$renovacion,$objCliente)
    {
        parent::__construct($fechaInicio,$fechaVencimiento,$objPlan,$estado,$costo,$renovacion,$objCliente);
        $this->porcentajeDescuento=10;
    }

    //Get
    public function getPorcentajeDescuento(){
        return $this->porcentajeDescuento;
    }

    //Set
    public function setPorcentajeDescuento($porcentajeDescuento){
        $this->porcentajeDescuento=$porcentajeDescuento;
    }

    //toString
    public function __toString()
    {
        return parent::__toString().
        "Porcentaje de Descuento: ".$this->porcentajeDescuento;
    }

    /**Si se trata de un contrato realizado via web al 
     * importe del mismo se le aplica un porcentaje de descuento que por defecto es del 10%. */
    public function calcularImporte(){
        $importeInicial=parent::calcularImporte();
        $importeFinal=$importeInicial - ($importeInicial * $this->getPorcentajeDescuento()/100);
        return $importeFinal;
    }
}