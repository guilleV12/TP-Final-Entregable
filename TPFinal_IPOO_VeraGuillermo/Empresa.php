<?php
include_once "BaseDatos.php";

class Empresa{
    //atributos
    private $idempresa;
    private $enombre;
    private $edireccion;
    private $mensajeoperacion;

    //constructor
    public function __construct(){
        $this->idempresa = "";
        $this->enombre = "";
        $this->edireccion = "";
    }

    public function cargar($pId, $pNom, $pDir){
        $this->setIdempresa($pId);
        $this->setEnombre($pNom);
        $this->setEdireccion($pDir);
    }

    //setter
    public function setIdempresa($id){
        $this->idempresa = $id;
    }

    public function setEnombre($nombre){
        $this->enombre = $nombre;
    }

    public function setEdireccion($direcc){
        $this->edireccion = $direcc;
    }

    public function setMensajeoperacion($mensaje){
        $this->mensajeoperacion = $mensaje;
    }

    //getter
    public function getIdempresa(){
        return $this->idempresa;
    }

    public function getEnombre(){
        return $this->enombre;
    }

    public function getEdireccion(){
        return $this->edireccion;
    }

    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }


     /**
	 * Recupera los datos de una empresa por id
	 * @param int $idEmp
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function Buscar($idEmp){
		$base=new BaseDatos();
		$consultaPersona="Select * from empresa where idempresa=".$idEmp;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPersona)){
				if($row2=$base->Registro()){					
				    $this->setIdempresa($idEmp);
					$this->setEnombre($row2['enombre']);
					$this->setEdireccion($row2['edireccion']);
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
		$consultaPersonas="Select * from empresa ";
		if ($campo != "" && $condicion != ""){
			$consultaPersonas.=' where '.$campo.'='.$condicion;
		}
		//echo $consultaPersonas;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPersonas)){				
				$resp= [];
				while($row2=$base->Registro()){
					
					$idEmp=$row2['idempresa'];
				
					$perso=new Empresa();
					$perso->Buscar($idEmp);
					array_push($resp,$perso);
	
				}
				
			
		 	}	else {
		 			$this->setMensajeoperacion($base->getError());
		 		
			}
		 }	else {
		 		$this->setMensajeoperacion($base->getError());
		 	
		 }	
		 return $resp;
	}	


	
	public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		$consultaInsertar="INSERT INTO empresa(idempresa, enombre, edireccion) 
				VALUES (".$this->getIdempresa().",'".$this->getEnombre()."','".$this->getEdireccion()."')";
		
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
		$consultaModifica="UPDATE empresa SET enombre='".$this->getEnombre()."', edireccion='".$this->getEdireccion()
                           ."' WHERE idempresa=". $this->getIdempresa();
		if($base->Iniciar()){
			if($base->Ejecutar($consultaModifica)){
			    $resp=  true;
				echo "\n-------------------------------------------------------\n";
				echo "OP INSERCION:  La empresa fue modificada en la BD\n";
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
				$consultaBorra="DELETE FROM empresa WHERE idempresa=".$this->getIdempresa();
				if($base->Ejecutar($consultaBorra)){
				    $resp=  true;
					echo "\n-------------------------------------------------------\n";
					echo "OP INSERCION:  La empresa fue eliminada en la BD\n";
				}else{
						$this->setMensajeoperacion($base->getError());
					
				}
		}else{
				$this->setMensajeoperacion($base->getError());
			
		}
		return $resp; 
	}

	public function __toString(){
	    return "\nId empresa: ".$this->getIdempresa(). "\nNombre:".$this->getEnombre()."\nDireccion: ".$this->getEdireccion()
        ."\n";
			
	}
}



?>