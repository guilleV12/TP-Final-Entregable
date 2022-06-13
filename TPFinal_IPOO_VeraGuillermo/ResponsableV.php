<?php
include_once "BaseDatos.php";


class ResponsableV{
    //atributos
    private $rnumeroempleado;
    private $rnumerolicencia;
    private $rnombre;
    private $rapellido;
    private $mensajeoperacion;

    //constructor
    public function __construct(){
        $this->rnumeroempleado = "";
        $this->rnumerolicencia = "";
        $this->rnombre = "";
        $this->rapellido = "";
    }

    public function cargar($pNumEmp, $pNumLic, $pNom, $pApe){
        $this->setRnumeroempleado($pNumEmp);
        $this->setRnumerolicencia($pNumLic);
        $this->setRnombre($pNom);
        $this->setRapellido($pApe);
    }

    //setter
    public function setRnumeroempleado($nro){
        $this->rnumeroempleado = $nro;
    }

    public function setRnumerolicencia($nro){
        $this->rnumerolicencia = $nro;
    }

    public function setRnombre($nombre){
        $this->rnombre = $nombre;
    }

    public function setRapellido($apellido){
        $this->rapellido = $apellido;
    }

    public function setMensajeoperacion($mensaje){
        $this->mensajeoperacion = $mensaje;
    }

    //getter
    public function getRnumeroempleado(){
        return $this->rnumeroempleado;
    }

    public function getRnumerolicencia(){
        return $this->rnumerolicencia;
    }

    public function getRnombre(){
        return $this->rnombre;
    }

    public function getRapellido(){
        return $this->rapellido;
    }

    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }


     /**
	 * Recupera los datos de un responsable por nro empleado
	 * @param int $nroEmp
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function Buscar($nroEmp){
		$base=new BaseDatos();
		$consultaPersona="Select * from responsable where rnumeroempleado=".$nroEmp;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPersona)){
				if($row2=$base->Registro()){					
				    $this->setRnumeroempleado($nroEmp);
					$this->setRnumerolicencia($row2['rnumerolicencia']);
					$this->setRnombre($row2['rnombre']);
					$this->setRapellido($row2['rapellido']);
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
		$consultaPersonas="Select * from responsable ";
		if ($condicion!=""){
		    $consultaPersonas=$consultaPersonas.' where '.$condicion;
		}
		$consultaPersonas.=" order by rapellido ";
		//echo $consultaPersonas;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPersonas)){				
				$arregloPersona= array();
				while($row2=$base->Registro()){
					
					$nroEmp=$row2['rnumeroempleado'];
					$nroLic=$row2['rnumerolicencia'];
					$nombre=$row2['rnombre'];
					$apellido=$row2['rapellido'];
				
					$perso=new ResponsableV();
					$perso->cargar($nroEmp,$nroLic,$nombre,$apellido);
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
		$consultaInsertar="INSERT INTO responsable(rnumeroempleado, rnumerolicencia, rnombre,  rapellido) 
				VALUES (".$this->getRnumeroempleado().",'".$this->getRnumerolicencia()."','".$this->getRnombre()."','".$this->getRapellido().")";
		
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
		$consultaModifica="UPDATE responsable SET rnumerolicencia='".$this->getRnumerolicencia()."',rnombre='".$this->getRnombre()."'
                           ,rapellido='".$this->getRapellido()."' WHERE rnumeroempleado=". $this->getRnumeroempleado();
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
				$consultaBorra="DELETE FROM responsable WHERE rnumeroempleado=".$this->getRnumeroempleado();
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
	    return "\nNombre: ".$this->getRnombre(). "\n Apellido:".$this->getRapellido()."\n Numero empleado: ".$this->getRnumeroempleado().
        "\nNumero licencia: ".$this->getRnumerolicencia()
        ."\n";
			
	}
}


?>