<?php
/**Los contratos tienen una fecha de inicio, la fecha de vencimiento, 
 * el plan, un estado (al día, moroso, suspendido, finalizado), un costo, si se renueva o no y una referencia al cliente que adquirió el contrato */
class Contrato{
    private $codigo;
    private $fechaInicio;
    private $fechaVencimiento;
    private $objPlan;
    private $estado;
    private $costo;
    private $renovacion;
    private $objCliente;

    //Constructor
    public function __construct($codigo,$fechaInicio,$fechaVencimiento,$objPlan,$estado,$costo,$renovacion,$objCliente)
    {
        $this->codigo=$codigo;
        $this->fechaInicio=$fechaInicio;
        $this->fechaVencimiento=$fechaVencimiento;
        $this->objPlan=$objPlan;
        $this->estado=$estado;
        $this->costo=$costo;
        $this->renovacion=$renovacion;
        $this->objCliente=$objCliente;
    }

    //Getters
    public function getCodigo(){
        return $this->codigo;
    }
    public function getFechaInicio(){
        return $this->fechaInicio;
    }
    public function getFechaVencimiento(){
        return $this->fechaVencimiento;
    }
    public function getObjPlan(){
        return $this->objPlan;
    }
    public function getEstado(){
        return $this->estado;
    }
    public function getCosto(){
        return $this->costo;
    }
    public function getRenovacion(){
        return $this->renovacion;
    }
    public function getObjCliente(){
        return $this->objCliente;
    }

    //Setters
    public function setCodigo($codigo){
        $this->codigo=$codigo;
    }
    public function setFechaInicio($fechaInicio){
        $this->fechaInicio=$fechaInicio;
    }
    public function setFechaVencimiento($fechaVencimiento){
        $this->fechaVencimiento=$fechaVencimiento;
    }
    public function setObjPlan($objPlan){
        $this->objPlan=$objPlan;
    }
    public function setEstado($estado){
        $this->estado=$estado;
    }
    public function setCosto($costo){
        $this->costo=$costo;
    }
    public function setRenovacion($renovacion){
        $this->renovacion=$renovacion;
    }
    public function setObjCliente($objCliente){
        $this->objCliente=$objCliente;
    }

    //toString
    public function __toString()
    {
        return "Fecha Inicio: ".$this->getFechaInicio()."\n".
        "Fecha Vencimiento: ".$this->getFechaVencimiento()."\n".
        "Plan: \n".$this->getObjPlan()."\n".
        "Estado: ".$this->getEstado()."\n".
        "Costo: ".$this->getCosto()."\n".
        "Renovado: ".$this->getRenovacion()."\n".
        "Cliente: \n".$this->getObjCliente()."\n";
    }


    public function calcularImporte(){
        $importeFinal=0;
        $importePlan=$this->getObjPlan()->getImporte();
        $canales=$this->getObjPlan()->getCanalesOfrecidos();
        $importeFinal=$importePlan;
        foreach ($canales as $canal) {
            $importeFinal+=$canal->getImporteCanal();
        }
        return $importeFinal;
    }

    /**En la clase contrato implementar el método actualizarEstadoContrato: que actualiza el estado del contrato según corresponda. 
     * Utilice un método diasContratoVencido que recibe por parámetro un contrato y retorna la cantidad de días vencidos o 0 en caso contrario.*/
    public function actualizarEstadoContrato(){
        $cantidadDiasVencidos=diasContratoVencido($this);
        if ($cantidadDiasVencidos==0) {
            $this->setEstado("al dia");
        }elseif ($cantidadDiasVencidos<=10) {
            $this->setEstado("moroso");
        }else {
            $this->setEstado("suspendido");
        }
    }

    
}