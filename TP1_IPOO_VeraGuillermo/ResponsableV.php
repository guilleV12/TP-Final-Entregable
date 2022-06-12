<?php

class ResponsableV{
    private $numero_empleado;
    private $numero_licencia;
    private $nombre;
    private $apellido;

    public function __construct($ne, $nl, $n, $a){
        $this->numero_empleado = $ne;
        $this->numero_licencia = $nl;
        $this->nombre = $n;
        $this->apellido = $a;
    }

    public function setNumeroEmpleado($numE){
        $this->numero_empleado = $numE;
    }

    public function getNumeroEmpleado(){
        return $this->numero_empleado;
    }

    public function setNumeroLicencia($numL){
        $this->numero_licencia = $numL;
    }

    public function getNumeroLicencia(){
        return $this->numero_licencia;
    }

    public function setNombre($nom){
        $this->nombre = $nom;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setApellido($apell){
        $this->apellido = $apell;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function __toString(){
        return "--------Responsable del viaje--------\n\nNumero empleado: ".$this->getNumeroEmpleado().". Numero licencia: "
        .$this->getNumeroLicencia().". Nombre: ".$this->getNombre()." ".$this->getApellido();
    }
}