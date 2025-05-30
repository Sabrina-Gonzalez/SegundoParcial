<?php
class ContratoEmpresa extends Contrato{

    public function __construct($fechaInicio,$fechaVencimiento,$objPlan,$estado,$costo,$renovacion,$objCliente)
    {
        parent::__construct($fechaInicio,$fechaVencimiento,$objPlan,$estado,$costo,$renovacion,$objCliente);
    }

    public function __toString()
    {
        return parent::__toString();
    }

}