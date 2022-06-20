<?php
include_once "BaseDatos.php";

class Pasajero{
    //atributos
    private $rdocumento;
    private $pnombre;
    private $papellido;
    private $ptelefono;
	private $idviaje;
    private $mensajeoperacion;

    //constructor
    public function __construct(){
        $this->rdocumento = "";
		$this->coleccion = "";
        $this->pnombre = "";
        $this->papellido = "";
        $this->ptelefono = "";
		$this->idviaje = "";
    }

    //cargar atrbiutos
    public function cargar($rDoc, $pNom, $pApe, $pTel,$idv){
        $this->setRdocumento($rDoc);
        $this->setPnombre($pNom);
        $this->setPapellido($pApe);
        $this->setPtelefono($pTel);
		$this->setIdviaje($idv);
    }

    //setter
    public function setRdocumento($nroDoc){
        $this->rdocumento = $nroDoc;
    }


    public function setPnombre($nombre){
        $this->pnombre = $nombre;
    }    

    public function setPapellido($apell){
        $this->papellido = $apell;
    }

    public function setPtelefono($telef){
        $this->ptelefono = $telef;
    }   

	public function setIdviaje($id){
		$this->idviaje = $id;
	}
    
    public function setMensajeoperacion($mensaje){
        $this->mensajeoperacion = $mensaje;
    }
    //getter
    public function getRdocumento(){
        return $this->rdocumento;
    }


    public function getPnombre(){
        return $this->pnombre;
    }    

    public function getPapellido(){
        return $this->papellido;
    }

    public function getPtelefono(){
        return $this->ptelefono;
    }   

	public function getIdviaje(){
		return $this->idviaje;
	}

    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }

    /**
	 * Recupera los datos de una persona por dni
	 * @param int $dni
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function Buscar($nroDoc){
		$base=new BaseDatos();
		$consultaPersona="Select * from pasajero where rdocumento=".$nroDoc;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPersona)){
				if($row2=$base->Registro()){					
				    $this->setRdocumento($nroDoc);
					$this->setPnombre($row2['pnombre']);
					$this->setPapellido($row2['papellido']);
					$this->setPtelefono($row2['ptelefono']);
					$this->setIdviaje($row2['idviaje']);
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


    public function listar($condicion){
	    $arregloPersona = null;
		$base=new BaseDatos();
		$consultaPersonas="Select * from pasajero ";
		if ($condicion!=""){
		    $consultaPersonas=$consultaPersonas.' where '.'rdocumento='.$condicion;
		}
		$consultaPersonas.=" order by papellido ";
		//echo $consultaPersonas;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPersonas)){				
				$arregloPersona= array();
				while($row2=$base->Registro()){
					
					$NroDoc=$row2['rdocumento'];
					$Nombre=$row2['pnombre'];
					$Apellido=$row2['papellido'];
					$Tel=$row2['ptelefono'];
					$idV=$row2['idviaje'];
				
					$perso=new Pasajero();
					$perso->cargar($NroDoc,$Nombre,$Apellido,$Tel,$idV);
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
		$consultaInsertar="INSERT INTO pasajero(rdocumento, pnombre, papellido,  ptelefono, idviaje) 
				VALUES (".$this->getRdocumento().",'".$this->getPnombre()."','".$this->getPapellido()
				."','".$this->getPtelefono()."','".$this->getIdviaje()."')";
		
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
		$consultaModifica="UPDATE pasajero SET pnombre='".$this->getPnombre()."',papellido='".$this->getPapellido().
		"',ptelefono='".$this->getPtelefono()."' WHERE rdocumento=". $this->getRdocumento();
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
				$consultaBorra="DELETE FROM pasajero WHERE rdocumento=".$this->getRdocumento();
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
	    return "\nNombre: ".$this->getPnombre(). "\nApellido: ".$this->getPapellido()."\nDNI: ".$this->getRdocumento().
        "\nTelefono: ".$this->getPtelefono()
        ."\n";
			
	}
}


?>