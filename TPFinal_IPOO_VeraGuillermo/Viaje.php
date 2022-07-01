<?php
include_once "BaseDatos.php";
class Viaje{
    //atributos
    private $idviaje;
    private $vdestino;
    private $vcantmaxpasajeros;
	private $empresa;
    private $responsable;
    private $vimporte;
	private $tipoasiento;
	private $idayvuelta;
	private $mensajeoperacion;

    //constructor
    public function __construct(){
        $this->idviaje = "";
        $this->vdestino = "";
        $this->vcantmaxpasajeros = "";
		$this->empresa = "";
        $this->resposable = "";
        $this->vimporte = "";
		$this->tipoasiento = "";
		$this->idayvuelta = "";
	}

    public function cargar($pId, $pDest, $pCantMax,$empr, $resp, $pImp, $tipoa,$idayv){
        $this->setIdviaje($pId);
        $this->setVdestino($pDest);
        $this->setVcantmaxpasajeros($pCantMax);
		$this->setempresa($empr);
        $this->setresponsable($resp);
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

	public function setempresa($emp){
		$this->empresa = $emp;
	}

    public function setresponsable($resp){
        $this->responsable = $resp;
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

	public function getempresa(){
		return $this->empresa;
	}

    public function getresponsable(){
        return $this->responsable;
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
		$consultaPersona="SELECT * from viaje where idviaje=".$idViaj;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPersona)){
				if($row2=$base->Registro()){					
				    $this->setIdviaje($idViaj);
					$this->setVdestino($row2['vdestino']);
					$this->setVcantmaxpasajeros($row2['vcantmaxpasajeros']);
					$empresa= new Empresa();
					$empresa->Buscar($row2['idempresa']);
					$this->setempresa($empresa);
					$empleado= new ResponsableV();
					$empleado->Buscar($row2['rnumeroempleado']);
					$this->setresponsable($empleado);
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


    public function listar($campo,$condicion){
	    $resp = null;
		$base=new BaseDatos();
		$consultaPersonas="select * from viaje ";
		if ($campo != "" ){
			$consultaPersonas.=' where '.$campo.'='.$condicion;
		}
		//echo $consultaPersonas;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPersonas)){				
				$resp= [];
				while($row2=$base->Registro()){
					
					$idViaj=$row2['idviaje'];
				
					$perso=new Viaje();
					$perso->Buscar($idViaj);
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
		$consultaInsertar="INSERT INTO viaje(idviaje, vdestino, vcantmaxpasajeros, idempresa, rnumeroempleado, vimporte, tipoAsiento, idayvuelta) 
				VALUES (".$this->getIdviaje().",'".$this->getVdestino()."','".$this->getVcantmaxpasajeros()."','".$this->getempresa()->getIdempresa()
				."','".$this->getresponsable()->getRnumeroempleado()
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
                           ,vcantmaxpasajeros='".$this->getVcantmaxpasajeros()."',idempresa='".$this->getempresa()->getIdempresa()
							."', rnumeroempleado='".$this->getresponsable()->getRnumeroempleado().
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
	    return "\nId viaje: ".$this->getIdviaje(). "\nDestino: ".$this->getVdestino()."\nMaximo pasajeros: ".$this->getVcantmaxpasajeros().
    	"\nNumero empleado: ".$this->getresponsable()->getRnumeroempleado()."\nImporte: ".$this->getVimporte()."\nPasajeros:\n"
		;
			
	}

	public function agregarPasajero($doc, $nomb, $ape, $telef){
		$obj_pasajero = new Pasajero();
		$listaPas = $obj_pasajero->listar("idviaje",$this->getIdviaje());
		$cantAsientosDisp = $this->getVcantmaxpasajeros()-count($listaPas);

		$bandera=$obj_pasajero->Buscar($doc);
		if ($cantAsientosDisp >0){
			if ($bandera==false) {
				$obj_pasajeroNuevo= new Pasajero();

				
				//insertar persona de la base de datos
				$esteViaje = new Viaje();
				$esteViaje->Buscar($this->getIdviaje());
				$obj_pasajeroNuevo->cargar($doc, $nomb, $ape, $telef,$esteViaje);
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
		}else{
			echo "\nEl viaje esta lleno\n";
		}
	}


	public function mostrarPasajero(){
		$obj_pasajero = new Pasajero();
		$colPasajeros= $obj_pasajero->listar("idviaje",$this->getIdviaje());
					foreach ($colPasajeros as $unPasajero){
												
						echo $unPasajero;
						echo "\n---------------------------------\n";
					}
	}

	public function cambiarDatosUnPasajero($nroDoc, $nomb, $ape, $telef,$viaje){
		$obj_pasajero = new Pasajero();
		$listaPas = $obj_pasajero->listar("","");
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
			$listaPas[$i-1]->setviaje($viaje);
			$listaPas[$i-1]->modificar();
		}
	}

	public function importePasaje(){
		$importe = $this->getVimporte();
		if ($this->getIdayvuelta()=="si"){
			if (strtolower($this->getTipoasiento())=="cama"){
				$importe = $importe + ($importe / 100 * 25);
			}
			$importe = $importe + ($importe / 100 * 50);
		} else {
			if (strtolower($this->getTipoasiento())=="cama"){
				$importe = $importe + ($importe / 100 * 25);
			}
		}
		return $importe;
	}

}



?>