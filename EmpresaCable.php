<?php 
class EmpresaCable{
    private $colPlanes;
    private $colContratos;
    private $colClientes;

    public function __construct()
    {
        $this->colPlanes=[];
        $this->colContratos=[];
        $this->colClientes=[];
    }

    //Getters
    public function getColPlanes(){
        return $this->colPlanes;
    }
    public function getColContratos(){
        return $this->colContratos;
    }
    public function getColClientes(){
        return $this->colClientes;
    }

    //Setters
    public function setColPlanes($colPlanes){
        $this->colPlanes=$colPlanes;
    }
    public function setColContratos($colContratos){
        $this->colContratos=$colContratos;
    }
    public function setColClientes($colClientes){
        $this->colClientes=$colClientes;
    }

    public function __toString()
    {
        $planes="Planes: \n";
        foreach ($this->getColPlanes() as $plan) {
            $planes.=$plan."\n";
        }
        $contratos="Contratos: \n";
        foreach ($this->getColContratos() as $contrato) {
            $contratos.=$contrato."\n";
        }
        $clientes="Clientes: \n";
        foreach ($this->getColClientes() as $cliente) {
            $clientes.=$cliente."\n";
        }

        return $planes.$contratos.$clientes; 
    }

    /**Implementar la función incorporarPlan que incorpora a la colección de planes 
     * un nuevo plan siempre y cuando no haya un plan con los mismos canales y los mismos MG (en caso de que el plan incluyera).*/
    public function incorporarPlan($unPlan){
        $colPlanes=$this->getColPlanes();
        $esIgual=false;
        $i=0;
        while ($i < count($colPlanes) && !$esIgual) {
            if ($colPlanes[$i]->getCanalesOfrecidos()->getTipoCanal()==$unPlan->getCanalesOfrecidos()->getTipoCanal() && $colPlanes[$i]->getIncluyeMGDatos()==$unPlan->getIncluyeMGDatos()) {
                $esIgual=true;
            }
            $i++;
        }
        if (!$esIgual) {
            $colPlanes[]=$unPlan;
            $this->setColPlanes($colPlanes);
            $esIgual=true;
        }
        return $esIgual;
    }

    /**Implementar la función BuscarContrato que  recibe un tipo y numero de documento correspondiente a un cliente 
     * y retorna el contrato que tiene el cliente con la empresa. Si no existe ningún contrato el método retorna un valor nulo. */
    public function BuscarContrato($tipoDoc,$numDoc){
        $colContratos=$this->getColContratos();
        $contrato=null;
        $i=0;
        $encontrado=false;
        while ($i < count($colContratos) && !$encontrado) {
            $tipoD=$colContratos[$i]->getObjCliente()->getTipoDoc();
            $numD=$colContratos[$i]->getObjCliente()->getNumDoc();
            if ($tipoD==$tipoDoc && $numD==$numDoc) {
                $contrato=$colContratos[$i];
                $encontrado=true;
            }
            $i++;
        }
        return $contrato;
    }

    /**Implementar la función incorporarContrato: que recibe por parámetro el plan, una referencia al cliente, 
     * la fecha de inicio y de vencimiento del mismo y si se trata de un contrato realizado en la empresa o vía web 
     * (si el valor del parámetro es True se trata de un contrato realizado vía web). 
     * El método corrobora que no exista un contrato previo con el cliente, en caso de existir y 
     * encontrarse activo se debe dar de baja. Por política de la empresa, solo existe la posibilidad de tener 
     * un contrato activo con un cliente determinado. */
    public function incorporarContrato($unPlan,$objCliente,$fechaInicio,$fechaVencimiento,$viaWeb){
        $colContratos=$this->getColContratos();
        $tipoD=$objCliente->getTipoDoc();
        $numD=$objCliente->getNumDoc();
        $existeContrato=$this->BuscarContrato($tipoD,$numD);
        if ($existeContrato!=null) {
            $estado=$existeContrato->getEstado();
            if ($estado=="moroso" || $estado=="suspendido" || $estado=="al dia") {
                $existeContrato->setEstado("finalizado");
            }
        }
        if ($viaWeb) {
            $nuevoContrato=new ContratoWeb($fechaInicio,$fechaVencimiento,$unPlan,"al dia",0,true,$objCliente);
        }else {
            $nuevoContrato= new ContratoEmpresa($fechaInicio,$fechaVencimiento,$unPlan,"al dia",0,true,$objCliente);
        }
        $nuevoContrato->setCosto($nuevoContrato->calcularImporte());
        $colContratos[]=$nuevoContrato;
        $this->setColContratos($colContratos);
    }


    /**Implementar la función  retornarPromImporteContratos que recibe por parámetro el código de un plan y 
     * retorna el promedio de los importes de los contratos realizados usando ese plan. */
    public function retornarPromImporteContratos($codigoPlan){
        $promedio=0;
        $importe=0;
        $cantidad=0;
        $colContratos=$this->getColContratos();
        foreach ($colContratos as $contrato) {
            $unPlan=$contrato->getObjPlan();
            if ($unPlan->getCodigo()==$codigoPlan) {
                $importe+=$unPlan->getImporte();
                $cantidad++;
            }
        }
        if ($cantidad>0) {
            $promedio=$importe/$cantidad;
        }
        return $promedio;
    }

    /**Implementar la función pagarContrato: que recibe como parámetro el código de un contrato, 
     * actualiza el estado del contrato y retorna el importe final que debe ser abonado por el cliente. */
    public function pagarContrato($codigoContrato){
    $colContratos=$this->getColContratos();
    $importeFinal=0;
    $i=0;
    $encontrado=false;

    while ($i < count($colContratos) && !$encontrado) {
        $contrato=$colContratos[$i];
        if ($contrato->getCodigo()==$codigoContrato) {
            $contrato->setEstado("al dia");
            $importeFinal=$contrato->calcularImporte();
            $encontrado=true;
        }
        $i++;
    }

    return $importeFinal;
    }
}