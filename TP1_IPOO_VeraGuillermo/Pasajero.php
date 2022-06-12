<?php

class Pasajero{
    private $nombre;
    private $apellido;
    private $numero_documento;
    private $telefono;

    public function __construct( $n, $a, $numD, $t){
        $this->nombre = $n;
        $this->apellido = $a;
        $this->numero_documento = $numD;
        $this->telefono = $t;
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

    public function setNumeroDocumento($numDoc){
        $this->numero_documento = $numDoc;
    }

    public function getNumeroDocumento(){
        return $this->numero_documento;
    }

    public function setTelefono($tel){
        $this->telefono = $tel;
    }

    public function getTelefono(){
        return $this->telefono;
    }

    public function __toString(){
        return "Nombre: ".$this->getNombre()." ".$this->getApellido().
        ". Documento: ".$this->getNumeroDocumento().". Telefono: ".$this->getTelefono();
    }


}