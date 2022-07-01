<?php
include_once "BaseDatos.php";

class Pasajero{
    //atributos
    private $rdocumento;
    private $pnombre;
    private $papellido;
    private $ptelefono;
	private $viaje;
    private $mensajeoperacion;

    //constructor
    public function __construct(){
        $this->rdocumento = "";
		$this->coleccion = "";
        $this->pnombre = "";
        $this->papellido = "";
        $this->ptelefono = "";
		$this->viaje = "";
    }

    //cargar atrbiutos
    public function cargar($rDoc, $pNom, $pApe, $pTel,$v){
        $this->setRdocumento($rDoc);
        $this->setPnombre($pNom);
        $this->setPapellido($pApe);
        $this->setPtelefono($pTel);
		$this->setviaje($v);
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

	public function setviaje($v){
		$this->viaje = $v;
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

	public function getviaje(){
		return $this->viaje;
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
		$consultaPersona="SELECT * FROM pasajero where rdocumento=".$nroDoc;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPersona)){
				if($row2=$base->Registro()){					
				    $this->setRdocumento($nroDoc);
					$this->setPnombre($row2['pnombre']);
					$this->setPapellido($row2['papellido']);
					$this->setPtelefono($row2['ptelefono']);
					$viaje = new Viaje();
					$viaje->Buscar($row2['idviaje']);
					$this->setviaje($viaje);
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


    public function listar($campo,$condicion){
	    $resp = null;
		$base=new BaseDatos();
		$consultaPersonas="select * from pasajero ";
		if ($campo != ""){
			$consultaPersonas.=' where '.$campo.'='.$condicion;
		}
		//echo $consultaPersonas;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPersonas)){				
				$resp = [];
				while($row2=$base->Registro()){
					$NroDoc=$row2['rdocumento'];
					$perso=new Pasajero();
					$perso->Buscar($NroDoc);
					array_push($resp,$perso);	
				}						
		 	}	else {
					$resp=false;
		 			$this->setMensajeoperacion($base->getError());		 		
			}
		 }	else {
				$resp=false;
		 		$this->setMensajeoperacion($base->getError());	 	
		 }	
		 return $resp;
	}	


	
	public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		$consultaInsertar="INSERT INTO pasajero(rdocumento, pnombre, papellido,  ptelefono, idviaje) 
				VALUES (".$this->getRdocumento().",'".$this->getPnombre()."','".$this->getPapellido()
				."','".$this->getPtelefono()."','".$this->getviaje()->getIdviaje()."')";
		
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
		"',ptelefono='".$this->getPtelefono()."',idviaje='".$this->getviaje()->getIdviaje().
		"' WHERE rdocumento=". $this->getRdocumento();
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
        "\nTelefono: ".$this->getPtelefono()."\nViaje : ".$this->getviaje()->getIdviaje()
        ."\n";
			
	}
}


?>