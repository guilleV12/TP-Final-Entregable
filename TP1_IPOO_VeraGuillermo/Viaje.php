<?php

class Viaje{
    //atributos
    private $codigoViaje;
    private $destino;
    private $maximoPasajeros;
    private $pasajerosActual;
    private $pasajeros;
    private $obj_responable_viaje;

    
    public function __construct($codViaje, $dest, $maxPas, $pasAct, $pasaj, $respV){
        $this->codigoViaje = $codViaje;
        $this->destino = $dest;
        $this->maximoPasajeros = $maxPas;
        $this->pasajerosActual = $pasAct;
        $this->pasajeros = $pasaj;
        $this->obj_responable_viaje = $respV;
    }

    public function setCodigoViaje($cod){
        $this->codigoViaje = $cod;
    }

    public function getCodigoViaje(){
        return $this->codigoViaje;
    }

    public function setDestino($d){
        $this->destino = $d;
    }

    public function getDestino(){
        return $this->destino;
    }

    public function setMaximoPasajeros($max){
        $this->maximoPasajeros = $max;
    }

    public function getMaximoPasajeros(){
        return $this->maximoPasajeros;
    }

    public function setPasajerosActual($pasA){
        $this->pasajerosActual = $pasA;
    }

    public function getPasajerosActual(){
        return $this->pasajerosActual;
    }

    public function setPasajeros($pasaj){
        $this->pasajeros = $pasaj;
    }

    public function getPasajeros(){
        return $this->pasajeros;
    }

    public function setResponsableViaje($respViaje){
        $this->obj_responable_viaje = $respViaje;
    }

    public function getResponsableViaje(){
        return $this->obj_responable_viaje;
    }

    public function __toString() {
        return "Codigo de viaje: ".$this->getCodigoViaje().", Destino: ".$this->getDestino().
        ".\nCantidad maxima de pasajeros: ".$this->getMaximoPasajeros().", Pasajeros actuales en el viaje: ".$this->getPasajerosActual().
        ".\n".$this->mostrarPasajeros()."\n".$this->getResponsableViaje()->__toString();
    }

    /** metodo que permite modificar los datos de un pasajero 
     * @param int $nroDocPas, $doc
     * @param string $nom, $ape
     * @return void
    */
    public function cambiarDatosUnPasajero($nroDocPas, $nom, $ape, $tel){
        $arrPasajeros = [];
        $arrPasajeros = $this->getPasajeros();
        $cantPasajeros = $this->getPasajerosActual();
        $i = 0;
        $bandera = false;
        $indiceModificar = null;
        while ($i < $cantPasajeros && $bandera == false){
            if ($nroDocPas == $arrPasajeros[$i]->getNumeroDocumento()){
                $bandera = true;
                $indiceModificar = $i;
            }
            $i++;
        }
        if ($i <= $cantPasajeros){
            $arrPasajeros[$indiceModificar]->setNombre($nom);
            $arrPasajeros[$indiceModificar]->setApellido($ape);
            $arrPasajeros[$indiceModificar]->setTelefono($tel);
            $this->setPasajeros($arrPasajeros);
        } else {
            echo "\nNo hay un pasajero con ese numero de documento\n";
        }
    }

    /** metodo que permite agregar un pasajero al arreglo
     * @param int $numDoc
     * @return void
     */
    public function agregarPasajero($numDoc, $nom, $ape, $tel){
        $arrayPasaj = $this->getPasajeros();
        $cantPasaj = $this->getPasajerosActual();
        $i = 0;
        $bandera = false;
        while ($i < $cantPasaj && $bandera == false) {
            if ($arrayPasaj[$i]->getNumeroDocumento() == $numDoc ){
                $bandera = true;
            }
            $i++;
        }
        if ($i < $cantPasaj){
            echo "Ese pasajero ya esta registrado.\n";
        }else{
            $this->setPasajerosActual($cantPasaj+1);
            $nuevoPasaj = new Pasajero($nom, $ape, $numDoc, $tel);
            $arrayPasaj[$i] = $nuevoPasaj;
            $this->setPasajeros($arrayPasaj);
        }
    }

    
    public function mostrarPasajeros(){
        $arrayPas = [];
        $arrayPas = $this->getPasajeros();
        $countPas = $this->getPasajerosActual();
        echo "\n--------Datos de pasajeros:--------\n\n";
        foreach ($this->getPasajeros() as $objPasaj) { 
            echo $objPasaj->__toString().".\n";
        }
    }

}