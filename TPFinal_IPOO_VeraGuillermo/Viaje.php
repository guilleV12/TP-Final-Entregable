<?php
include_once "BaseDatos.php";

class Viaje{
    //atributos
    private $idviaje;
    private $vdestino;
    private $vcantmaxpasajeros;
	private $idempresa;
    private $rnumeroempleado;
    private $vimporte;
	private $tipoasiento;
	private $idayvuelta;
	private $mensajeoperacion;

    //constructor
    public function __construct(){
        $this->idviaje = "";
        $this->vdestino = "";
        $this->vcantmaxpasajeros = "";
		$this->idempresa = "";
        $this->rnumeroempleado = "";
        $this->vimporte = "";
		$this->tipoasiento = "";
		$this->idayvuelta = "";
	}

    public function cargar($pId, $pDest, $pCantMax,$idemp, $pNumEmp, $pImp, $tipoa,$idayv){
        $this->setIdviaje($pId);
        $this->setVdestino($pDest);
        $this->setVcantmaxpasajeros($pCantMax);
		$this->setIdempresa($idemp);
        $this->setRnumeroempleado($pNumEmp);
        $this->setVimporte($pImp);
		$this->setTipoasiento($tipoa);
		$this->setIdayvuelta($idayv);
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
		$this->tipoasiento = $tipo;
	}

	public function setIdayvuelta($ida){
		$this->idayvuelta = $ida;
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
		return $this->tipoasiento;
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
					$this->setIdempresa($row2['idempresa']);
					$this->setRnumeroempleado($row2['rnumeroempleado']);
					$this->setTipoasiento($row2['tipoAsiento']);
					$this->setIdayvuelta($row2['idayvuelta']);
					$this->setVimporte($row2['vimporte']);
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
		$consultaPersonas="Select * from viaje ";
		if ($condicion!=""){
		    $consultaPersonas=$consultaPersonas.' where '.'idviaje='.$condicion;
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
					$idemp=$row2['idempresa'];
                    $numeroempleado=$row2['rnumeroempleado'];
					$tipoAs = $row2['tipoAsiento'];
					$idayv = $row2['idayvuelta'];
					$importe=$row2['vimporte'];
				
					$perso=new Viaje();
					$perso->cargar($idViaj, $destino, $cantMaxPas, $idemp, $numeroempleado, $importe, $tipoAs, $idayv);
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
		$consultaInsertar="INSERT INTO viaje(idviaje, vdestino, vcantmaxpasajeros, idempresa, rnumeroempleado, vimporte, tipoAsiento, idayvuelta) 
				VALUES (".$this->getIdviaje().",'".$this->getVdestino()."','".$this->getVcantmaxpasajeros()."','".$this->getIdempresa()
				."','".$this->getRnumeroempleado()
				."','".$this->getVimporte()."','".$this->getTipoasiento()."','".$this->getIdayvuelta()."')";
		
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
                           ,vcantmaxpasajeros='".$this->getVcantmaxpasajeros()."',idempresa='".$this->getidempresa()
							."', rnumeroempleado='".$this->getRnumeroempleado().
                           "',vimporte='".$this->getVimporte()."',tipoAsiento='".$this->getTipoasiento()."',idayvuelta='".$this->getIdayvuelta()
                           ."' WHERE idviaje=". $this->getIdviaje();
		if($base->Iniciar()){
			if($base->Ejecutar($consultaModifica)){
			    $resp=  true;
				echo "-------------------------------------------------------\n";
				echo "OP INSERCION:  El viaje fue modificado en la BD\n";
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
					echo "-------------------------------------------------------\n";
					echo "OP INSERCION:  El viaje fue eliminado en la BD\n";
				}else{
						$this->setMensajeoperacion($base->getError());
						
				}
		}else{
				$this->setMensajeoperacion($base->getError());
			
		}
		return $resp; 
	}

	public function __toString(){
	    return "\nId viaje: ".$this->getIdviaje(). "\nDestino:".$this->getVdestino()."\nMaximo pasajeros: ".$this->getVcantmaxpasajeros().
    	"\nNumero empleado: ".$this->getRnumeroempleado().
        "\nImporte:".$this->getVimporte()
        ."\n";
			
	}

	public function agregarPasajero($doc, $nomb, $ape, $telef){
		$obj_pasajero = new Pasajero();

		$bandera=$obj_pasajero->Buscar($doc);
		
		if ($bandera==false) {
			$obj_pasajeroNuevo= new Pasajero();
			$this->setVcantmaxpasajeros($this->getVcantmaxpasajeros()-1);
			$this->modificar();
			//insertar persona de la base de datos
			$obj_pasajeroNuevo->cargar($doc, $nomb, $ape, $telef,$this->getIdviaje());
			$respuesta= $obj_pasajeroNuevo->insertar();

			if($respuesta == true){
				echo "-------------------------------------------------------\n";
				echo "OP INSERCION:  El pasajero fue ingresado en la BD\n";
				
			}else {
				echo $obj_pasajeroNuevo->getmensajeoperacion();
			}		
		}else{
			echo "El pasajero ya esta en el viaje\n";
		}
	}


	public function mostrarPasajero(){
		$obj_pasajero = new Pasajero();
		$colPasajeros= $obj_pasajero->listar("");
					foreach ($colPasajeros as $unPasajero){
												
						echo $unPasajero;
						echo "\n---------------------------------\n";
					}
	}

	public function cambiarDatosUnPasajero($nroDoc, $nomb, $ape, $telef){
		$obj_pasajero = new Pasajero();
		$listaPas = $obj_pasajero->listar("");
		$bandera=false;
		$i= 0;

		while ($i<count($listaPas) && $bandera==false) {
			$bandera=$listaPas[$i]->Buscar($nroDoc);
			$i++;
		}
		if ($bandera == true){
			$listaPas[$i-1]->setPnombre($nomb);
			$listaPas[$i-1]->setPapellido($ape);
			$listaPas[$i-1]->setPtelefono($telef);
			$listaPas[$i-1]->modificar();
		}
	}

	public function importePasaje(){
		$importe = $this->getVimporte();
		if ($this->getIdayvuelta()=="si"){
			if ($this->getTipoasiento()=="cama"){
				$importe = $importe + ($importe / 100 * 25);
			}
			$importe = $importe + ($importe / 100 * 50);
		} else {
			if ($this->getTipoasiento()=="cama"){
				$importe = $importe + ($importe / 100 * 25);
			}
		}
		return $importe;
	}

}



?>