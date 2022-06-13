<?php
include_once "BaseDatos.php";

class Viaje{
    //atributos
    private $idviaje;
    private $vdestino;
    private $vcantmaxpasajeros;
    private $rdocumento;
    private $idempresa;
    private $rnumeroempleado;
    private $vimporte;
    private $tipoAsiento;
    private $idayvuelta;
    private $mensajeoperacion;

    //constructor
    public function __construct(){
        $this->idviaje = "";
        $this->vdestino = "";
        $this->vcantmaxpasajeros = "";
        $this->rdocumento = "";
        $this->idempresa = "";
        $this->rnumeroempleado = "";
        $this->vimporte = "";
        $this->tipoAsiento = "";
        $this->idayvuelta = "";
    }

    public function cargar($pId, $pDest, $pCantMax, $pDoc, $pEmp, $pNumEmp, $pImp, $pTipoA, $pIdaYV){
        $this->setIdviaje($pId);
        $this->setVdestino($pDest);
        $this->setVcantmaxpasajeros($pCantMax);
        $this->setRdocumento($pDoc);
        $this->setIdempresa($pEmp);
        $this->setRnumeroempleado($pNumEmp);
        $this->setVimporte($pImp);
        $this->setTipoasiento($pTipoA);
        $this->setIdaYVuelta($pIdaYV);
    }

    //setter
    public function setIdviaje($id){
        $this->idviaje = $id;
    }

    public function setVdestino($destino){
        $this->vdestino = $destino;
    }

    public function setVcantmaxpasajeros($cant){
        $this->vcantmaxpasajeros = $cant;
    }

    public function setRdocumento($doc){
        $this->rdocumento = $doc;
    }

    public function setIdempresa($id){
        $this->idempresa = $id;
    }

    public function setRnumeroempleado($nro){
        $this->rnumeroempleado = $nro;
    }

    public function setVimporte($importe){
        $this->vimporte = $importe;
    }

    public function setTipoasiento($tipo){
        $this->tipoAsiento = $tipo;
    }

    public function setIdayvuelta($idayvuel){
        $this->idayvuelta = $idayvuel;
    }

    public function setMensajeoperacion($mensaje){
        $this->mensajeoperacion = $mensaje;
    }

    //getter
    public function getIdviaje(){
        return $this->idviaje;
    }

    public function getVdestino(){
        return $this->vdestino;
    }

    public function getVcantmaxpasajeros(){
        return $this->vcantmaxpasajeros;
    }

    public function getRdocumento(){
        return $this->rdocumento;
    }

    public function getIdempresa(){
        return $this->idempresa;
    }

    public function getRnumeroempleado(){
        return $this->rnumeroempleado;
    }

    public function getVimporte(){
        return $this->vimporte;
    }

    public function getTipoasiento(){
        return $this->tipoAsiento;
    }

    public function getIdayvuelta(){
        return $this->idayvuelta;
    }

    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }


     /**
	 * Recupera los datos de un viaje por id
	 * @param int $idViaj
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function Buscar($idViaj){
		$base=new BaseDatos();
		$consultaPersona="Select * from viaje where idviaje=".$idViaj;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPersona)){
				if($row2=$base->Registro()){					
				    $this->setIdviaje($idViaj);
					$this->setVdestino($row2['vdestino']);
					$this->setVcantmaxpasajeros($row2['vcantmaxpasajeros']);
					$this->setRdocumento($row2['rdocumento']);
                    $this->setIdempresa($row2['idempresa']);
					$this->setRnumeroempleado($row2['rnumeroempleado']);
					$this->setVimporte($row2['vimporte']);
                    $this->setTipoasiento($row2['tipoAsiento']);
                    $this->setIdaYVuelta($row2['idayvuelta']);
					$resp= true;
				}				
			
		 	}	else {
		 			$this->setMensajeoperacion($base->getError());
		 		
			}
		 }	else {
		 		$this->setMensajeoperacion($base->getError());
		 	
		 }		
		 return $resp;
	}	


    public function listar($condicion=""){
	    $arregloPersona = null;
		$base=new BaseDatos();
		$consultaPersonas="Select * from viaje ";
		if ($condicion!=""){
		    $consultaPersonas=$consultaPersonas.' where '.$condicion;
		}
		$consultaPersonas.=" order by vdestino ";
		//echo $consultaPersonas;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPersonas)){				
				$arregloPersona= array();
				while($row2=$base->Registro()){
					
					$idViaj=$row2['idviaje'];
					$destino=$row2['vdestino'];
					$cantMaxPas=$row2['vcantmaxpasajeros'];
					$doc=$row2['rdocumento'];
                    $idEmp=$row2['idempresa'];
                    $numeroempleado=$row2['rnumeroempleado'];
                    $importe=$row2['vimporte'];
                    $tipoAs=$row2['tipoAsiento'];
                    $idayV=$row2['idayvuelta'];
				
					$perso=new Viaje();
					$perso->cargar($idViaj, $destino, $cantMaxPas, $doc, $idEmp, $numeroempleado, $importe, $tipoAs, $idayV);
					array_push($arregloPersona,$perso);
	
				}
				
			
		 	}	else {
		 			$this->setMensajeoperacion($base->getError());
		 		
			}
		 }	else {
		 		$this->setMensajeoperacion($base->getError());
		 	
		 }	
		 return $arregloPersona;
	}	


	
	public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		$consultaInsertar="INSERT INTO viaje(idviaje, vdestino, vcantmaxpasajeros,  rdocumento, idempresa, rnumeroempleado, vimporte, tipoAsiento, idayvuelta) 
				VALUES (".$this->getIdviaje().",'".$this->getVdestino()."','".$this->getVcantmaxpasajeros()."','".$this->getRdocumento().$this->getIdempresa().",'".$this->getRnumeroempleado()."','".$this->getVimporte()."','".$this->getTipoasiento()."','".$this->getIdaYVuelta().")";
		
		if($base->Iniciar()){

			if($base->Ejecutar($consultaInsertar)){

			    $resp=  true;

			}	else {
					$this->setMensajeoperacion($base->getError());
					
			}

		} else {
				$this->setMensajeoperacion($base->getError());
			
		}
		return $resp;
	}
	
	
	
	public function modificar(){
	    $resp =false; 
	    $base=new BaseDatos();
		$consultaModifica="UPDATE viaje SET vdestino='".$this->getVdestino()."'
                           ,vcantmaxpasajeros='".$this->getVcantmaxpasajeros()."', rdocumento='".$this->getRdocumento().
                           "',idempresa='".$this->getIdempresa()."', rnumeroempleado='".$this->getRnumeroempleado().
                           "',vimporte='".$this->getVimporte()."', tipoAsiento='".$this->getTipoasiento()
                           ."', idayvuelta='".$this->getIdaYVuelta()
                           ."' WHERE idviaje=". $this->getIdviaje();
		if($base->Iniciar()){
			if($base->Ejecutar($consultaModifica)){
			    $resp=  true;
			}else{
				$this->setMensajeoperacion($base->getError());
				
			}
		}else{
				$this->setMensajeoperacion($base->getError());
			
		}
		return $resp;
	}
	
	public function eliminar(){
		$base=new BaseDatos();
		$resp=false;
		if($base->Iniciar()){
				$consultaBorra="DELETE FROM viaje WHERE idviaje=".$this->getIdviaje();
				if($base->Ejecutar($consultaBorra)){
				    $resp=  true;
				}else{
						$this->setMensajeoperacion($base->getError());
					
				}
		}else{
				$this->setMensajeoperacion($base->getError());
			
		}
		return $resp; 
	}

	public function __toString(){
	    return "\nId viaje: ".$this->getIdviaje(). "\n Destino:".$this->getVdestino()."\n Maximo pasajeros: ".$this->getVcantmaxpasajeros().
        "\nDocumento: ".$this->getRdocumento(). "\n Id empresa:".$this->getIdempresa()."\n Numero empleado: ".$this->getRnumeroempleado().
        "\n Importe:".$this->getVimporte()."\n Tipo asiento: ".$this->getTipoasiento()."\nIda y vuelta: ".$this->getIdaYVuelta()
        ."\n";
			
	}
}



?>