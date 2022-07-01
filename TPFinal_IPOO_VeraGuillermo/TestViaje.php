<?php
include 'Pasajero.php';
include 'ResponsableV.php';
include 'Empresa.php';
include 'Viaje.php';
$obj_viaje= new Viaje();
$obj_empresa= new Empresa();
$obj_responsable= new ResponsableV();
$obj_pasajero= new Pasajero();

				
do {
	echo "Menu opciones:\n";
	echo "1 - Menu de empresas\n";
	echo "2 - Menu de responsables\n";
	echo "3 - Menu de viajes\n";
	echo "4 - Menu de pasajeros\n"; 
	echo "5 - Salir del menu\n";
	$varSwitchMenuPrinc= trim(fgets(STDIN));

	switch ($varSwitchMenuPrinc){
		case 1:
		///////////////////Switch Empresas///////////////////////
		echo "\n----------------------\n";
		echo "Empresas\n";
		echo "\n----------------------\n";

		do {
			echo "Menu opciones de Empresas:\n";
			echo "1 - Ingresar una empresa\n";
			echo "2 - Modificar datos de una empresa\n";
			echo "3 - Eliminar una empresa\n";
			echo "4 - Mostrar empresas\n";
			echo "5 - Salir del menu de empresas\n";
			$varSwitchEmp= trim(fgets(STDIN));

				
			switch($varSwitchEmp) {
				case 1:
						//creo un objeto empresa
						echo "Ingrese el numero de la empresa:\n";
						$idEmpIng= trim(fgets(STDIN));
						if (($obj_empresa->Buscar($idEmpIng)) == false){
						echo "Ingrese el nombre de la empresa:\n";
						$nombEmpIng= trim(fgets(STDIN));
						echo "Ingrese la direccion de la empresa:\n";
						$dirEmpIng= trim(fgets(STDIN));

						//insertar empresa en la base de datos
						$obj_empresa->cargar($idEmpIng,$nombEmpIng,$dirEmpIng);
						$respuestaE= $obj_empresa->insertar();
																		
							echo "\nOP INSERCION:  La empresa fue ingresada en la BD\n";
						}else{
							echo "La empresa ya existe\n";
						}
				break;

				case 2:
							$obj_empresa= new Empresa();
							echo "Ingrese el id de la empresa a modificar:\n";
							$idEmpMod= trim(fgets(STDIN));
							$arrayEmpresasMod=$obj_empresa->listar("idempresa",$idEmpMod);
							if (($obj_empresa->Buscar($idEmpMod)) == false) {
								echo "No existe la empresa\n";
							}else{
							echo "Ingrese el nombre modificado de la empresa:\n";
							$nombEmpMod= trim(fgets(STDIN));
							$arrayEmpresasMod[0]->setEnombre($nombEmpMod);
							echo "Ingrese la direccion modificada de la empresa:\n";
							$dirEmpMod= trim(fgets(STDIN));
							$arrayEmpresasMod[0]->setEdireccion($dirEmpMod);
							$arrayEmpresasMod[0]->modificar();
							}
				break;

				case 3:
							$obj_empresa= new Empresa();
							echo "Ingrese el id de empresa a eliminar:\n";
							$idEmpElim= trim(fgets(STDIN));
							if (($obj_empresa->Buscar($idEmpElim)) == false) {
								echo "No existe la empresa\n";
							}else{
								if (count($obj_viaje->listar("idempresa",$idEmpElim)) == 0){
								$arrayEmpresasElim=$obj_empresa->listar("idempresa",$idEmpElim);
								$arrayEmpresasElim[0]->eliminar();
								}else{
									echo "No se puede eliminar la empresa porque pertenece a un viaje\n";
								}
							}
				break;

				case 4:
					echo "\n----------------------\n";
					echo "Empresas\n";
					echo "----------------------\n";
					$colEmpresasMostrar = $obj_empresa->listar("","");
					foreach ($colEmpresasMostrar as $unaEmpresa){
						echo $unaEmpresa;
					}	
				break;

				
			}
			
			}while ($varSwitchEmp != 5);
		break;

		case 2:
		///////////////////Switch Responsables///////////////////////
		echo "\n----------------------\n";
		echo "Responsables\n";
		echo "----------------------\n";
		do {
			echo "Menu opciones de Responsables:\n";
			echo "1 - Ingresar un Responsalbe\n";
			echo "2 - Modificar datos de un responsable\n";
			echo "3 - Eliminar un responsable\n";
			echo "4 - Mostrar resposables\n";
			echo "5 - Salir del menu de responsables\n";
			$varSwitchResp= trim(fgets(STDIN));
				
			switch($varSwitchResp) {

				case 1:
						echo "Ingrese el nombre del responsable de los viajes:\n";
						$nombreResp=trim(fgets(STDIN));
						echo "Ingrese apellido del responsable de los viajes:\n";
						$apellidoResp=trim(fgets(STDIN));
						echo "Ingrese el id del responsable de los viajes:\n";
						$numeroResp = trim(fgets(STDIN));
						if (($obj_responsable->Buscar($numeroResp)) == false) {
							
						echo "Ingrese la licencia del responsable de los viajes:\n";
						$liceResp = trim(fgets(STDIN));
			

					//creo un objeto responsable

					//insertar persona de la base de datos
					$obj_responsable->cargar($numeroResp,$liceResp,$nombreResp,$apellidoResp);
					$respuesta= $obj_responsable->insertar();

					if($respuesta == true){
						echo "OP INSERCION:  El responsable fue ingresada en la BD\n";
					}
				}else{
					echo "El responsable ya existe\n";
				}
				break;

				case 2:
					$obj_responsable= new ResponsableV();
					echo "Ingrese el id del reponsable a modificar:\n";
					$idRespMod=trim(fgets(STDIN));
					if (($obj_responsable->Buscar($idRespMod)) != false){
					$arrayRespMod=$obj_responsable->listar("rnumeroempleado",$idRespMod);
					echo "Ingrese el nombre del responsable de los viajes:\n";
					$nombreRespMod=trim(fgets(STDIN));
					$arrayRespMod[0]->setRnombre($nombreRespMod);
					echo "Ingrese apellido del responsable de los viajes:\n";
					$apellidoRespMod=trim(fgets(STDIN));
					$arrayRespMod[0]->setRapellido($apellidoRespMod);
					echo "Ingrese la licencia del responsable de los viajes:\n";
					$liceRespMod= trim(fgets(STDIN));
					$arrayRespMod[0]->setRnumerolicencia($liceRespMod);
					$arrayRespMod[0]->modificar();
					}else{
						echo "El responsable no existe\n";
					}
				break;

				case 3:
					echo "Ingrese el id del responsable a eliminar:\n";
					$idRespElim= trim(fgets(STDIN));
					if (($obj_responsable->Buscar($idRespElim)) != false){
						if (count($obj_viaje->listar("rnumeroempleado",$idRespElim)) == 0){
							$arrayRespElim=$obj_responsable->listar("rnumeroempleado",$idRespElim);
							$arrayRespElim[0]->eliminar();
						}else{
							echo "No se puede eliminar porque pertenece a un viaje\n";
						}
					}else{
						echo "El responsable no existe.\n";
					}
				break;

				case 4:
					echo "\n----------------------\n";
					echo "Responsables\n";
					echo "----------------------\n";
					$responsables = $obj_responsable->listar("","");
					foreach ($responsables as $unResponsable){
						echo $unResponsable;
					}
				break;

			}
			}while($varSwitchResp != 5);
			break;



			case 3:
			///////////////////Switch Viajes///////////////////////
			echo "\n----------------------\n";
			echo "Viajes\n";
			echo "----------------------\n";
			do {
				echo "Menu opciones de Viajes:\n";
				echo "1 - Ingresar un Viaje\n";
				echo "2 - Modificar datos de un Viaje\n";
				echo "3 - Eliminar un viaje\n";
				echo "4 - Mostrar viajes\n";
				echo "5 - Salir del menu de viajes\n";
				$varSwitchViaje= trim(fgets(STDIN));
					
				switch($varSwitchViaje) {
					case 1:
						//cargar y ver los datos del viaje
						echo "Ingrese el numero de viaje:\n"; 
						$numViaje = trim(fgets(STDIN));
						if (($obj_viaje->Buscar($numViaje)) != false ){
							echo "El viaje ya existe.\n";
						}else {
						echo "Ingrese el destino:\n";
						$destViaje = trim(fgets(STDIN));	
						while (count($obj_viaje->listar("vdestino","'".$destViaje."'")) > 0){
							echo "El destino ya esta en otro viaje, ingrese otro destino:\n";
							$destViaje = trim(fgets(STDIN));
						}
						echo "Ingrese cantidad maxima de pasajeros:\n";
						$pasajMax= trim(fgets(STDIN));
						echo "Ingrese el id de la empresa a quien pertenece:\n";
						$idEmpViaj= trim(fgets(STDIN));
						if (($obj_empresa->Buscar($idEmpViaj)) != false){
						$empresaPert=$obj_empresa->listar("idempresa",$idEmpViaj);
						echo "Ingrese el id del resposable del viaje:\n";
						$idRespViaje= trim(fgets(STDIN));
						if (($obj_responsable->Buscar($idRespViaje)) != false){
						$responsablePert=$obj_responsable->listar("rnumeroempleado",$idRespViaje);
						echo "Ingrese el importe del viaje: \n";
						$importeViaje= trim(fgets(STDIN));
						do {
							echo "Ingrese el tipo de asiento (cama/semicama): \n";
							$tipoAs= trim(fgets(STDIN));
						} while (($tipoAs != "cama") && ($tipoAs != "semicama"));
						do {
						echo "Es de ida y vuelta?:\n";
						$idaYv= trim(fgets(STDIN));
						} while (($idaYv != "si") && ($idaYv != "no"));
						//creo un objeto viaje
						//insertar viaje en la base de datos
						$obj_viaje->cargar($numViaje,$destViaje,$pasajMax,$empresaPert[0],$responsablePert[0],$importeViaje,$tipoAs,$idaYv);
						$respuestaV= $obj_viaje->insertar();
						$obj_viaje->setVimporte($obj_viaje->importePasaje());
						$obj_viaje->modificar();
						}else {
							echo "No existe el responsable\n";
						}
						}else {
							echo "No existe la empresa\n";
						}
					}
					break;

					case 2:
						//modificar datos del viaje
							echo "Ingrese el id del viaje a modificar: \n";
							$idViajeMod = trim(fgets(STDIN));
							$arrayViajeMod=$obj_viaje->listar("idviaje",$idViajeMod);
							if (($obj_viaje->Buscar($idViajeMod)) == false ){
								echo "El viaje no existe.\n";
							}else {
								echo "Ingrese el destino de viaje: \n";
								$destViajeMod = trim(fgets(STDIN));
								$viajesDest = $obj_viaje->listar("vdestino","'".$destViajeMod."'");
								while (count($viajesDest) > 0){
									echo "El destino ya esta en otro viaje, ingrese otro destino:\n";
									$destViajeMod = trim(fgets(STDIN));
								}
								$arrayViajeMod[0]->setVdestino($destViajeMod);
								echo "Ingrese la cantidad maxima de pasajeros: \n";
								$cantMaxPasMod = trim(fgets(STDIN));
								$arrayViajeMod[0]->setVcantmaxpasajeros($cantMaxPasMod);
							do {
								echo "Ingrese el tipo de asiento (cama/semicama): \n";
								$tipoANueva= trim(fgets(STDIN));
							} while (($tipoANueva != "cama") && ($tipoANueva != "semicama"));
								$arrayViajeMod[0]->setTipoasiento($tipoANueva);
							do {
								echo "Es de ida y vuelta: \n";
								$idaYVNueva = trim(fgets(STDIN));
							} while (($idaYVNueva != "si" && $idaYVNueva != "no"));
								echo "Ingrese el id de la empresa: \n";
								$idEmpModV= trim(fgets(STDIN));
								if (($obj_empresa->Buscar($idEmpModV)) == false){
									echo "La empresa no existe: \n";
								} else {
								echo "Ingrese el id del responsable de los viajes:\n";
								$idRespViajeM = trim(fgets(STDIN));
								if ($obj_responsable->Buscar($idRespViajeM)==false){
									echo "El responsable de los viajes no existe: \n";
								}else {
								$empViajeMod=$obj_empresa->listar("idempresa",$idEmpModV);
								$respViajeMod=$obj_responsable->listar("rnumeroempleado",$idRespViajeM);
								$arrayViajeMod[0]->setresponsable($respViajeMod[0]);
								$arrayViajeMod[0]->setempresa($empViajeMod[0]);
								$arrayViajeMod[0]->setIdayvuelta($idaYVNueva);
								$arrayViajeMod[0]->setVimporte($arrayViajeMod[0]->importePasaje());
								$arrayViajeMod[0]->modificar();
								}
								}
							}
					break;

					case 3:
						echo "Ingrese el id del viaje a eliminar:\n";
						$idViajeElim= trim(fgets(STDIN));
						if (($obj_viaje->Buscar($idViajeElim)) != false){
							if (count($obj_pasajero->listar("idviaje",$idViajeElim))==0){
							$arrayViajeElim=$obj_viaje->listar("idviaje",$idViajeElim);
							$arrayViajeElim[0]->eliminar();
							}else{
								echo "No se puede eliminar si tiene pasajeros\n";
							}
						}else{
							echo "El viaje no existe.\n";
						}
					break;

					case 4:
						echo "\n----------------------\n";
						echo "Viajes\n";
						echo "----------------------\n";
						$colViajes = $obj_viaje->listar("","");
						foreach ($colViajes as $unViaje){			
							echo $unViaje;
							$unViaje->mostrarPasajero();
						}		
					break;

				}
			}while($varSwitchViaje != 5);
			break;


			case 4:
			///////////////////Switch Pasajeros///////////////////////
			echo "\n----------------------\n";
			echo "Pasajeros\n";
			echo "----------------------\n";
			do {
				echo "Menu opciones de Pasajeros:\n";
				echo "1 - Ingresar un pasajero \n";
				echo "2 - Modificar datos de un pasajero\n";
				echo "3 - Eliminar un pasajero\n";
				echo "4 - Mostrar pasajeros\n";
				echo "5 - Salir del menu de pasajeros\n";
				$varSwitchPasajeros= trim(fgets(STDIN));
					
				switch($varSwitchPasajeros) {
					case 1:
						echo "Ingrese el documento:\n";
						$respDocNuevo= trim(fgets(STDIN));
						if (($obj_pasajero->Buscar($respDocNuevo)) == false){
						echo "Ingrese nombre:\n";
						$respNomNuevo= trim(fgets(STDIN));
						echo "Ingrese apellido:\n";
						$respApeNuevo= trim(fgets(STDIN));
						echo "Ingrese el telefono:\n";
						$respTelNuevo= trim(fgets(STDIN));
						echo "Ingrese el id del viaje que desea:\n";
						$idViajeCorr= trim(fgets(STDIN));
						if ($obj_viaje->Buscar($idViajeCorr)==true){
						$arrayViajesIng=$obj_viaje->listar("idviaje",$idViajeCorr);
						if ($arrayViajesIng[0]->getVcantmaxpasajeros() > count($obj_pasajero->listar("idviaje",$idViajeCorr))){
						$arrayViajesIng[0]->agregarPasajero($respDocNuevo,$respNomNuevo,$respApeNuevo,$respTelNuevo);
						}else{
							echo "El viaje ya esta lleno!\n";
						}
						}else{
							echo "El viaje no existe\n";
						}
						}else{
							echo "El pasajero ya existe.\n";
						}
					break;
					
					case 2:
					//modificar datos de pasajeros
						echo "Ingrese el nro de documento: \n";
						$docModificar= trim(fgets(STDIN));
						if (($obj_pasajero->Buscar($docModificar)) != false){
						echo "Ingrese nombre:\n";
						$nombreMod= trim(fgets(STDIN));
						echo "Ingrese apellido:\n";
						$apellidoMod= trim(fgets(STDIN));
						echo "Ingrese el telefono:\n";
						$telefonoMod= trim(fgets(STDIN));
						echo "Ingrese el id del viaje :\n";
						$idPasajVMod= trim(fgets(STDIN));
						if ($obj_viaje->Buscar($idPasajVMod)==true){
						$arrayViajesModP = $obj_viaje->listar("idviaje",$idPasajVMod);
						if ($arrayViajesModP[0]->getVcantmaxpasajeros() > count($obj_pasajero->listar("idviaje",$arrayViajesModP[0]->getIdviaje()))){
						$pasajeroModificar = $obj_pasajero->listar("rdocumento",$docModificar);
						$arrayPasajMod = $obj_viaje->listar("idviaje",$pasajeroModificar[0]->getviaje()->getIdviaje());
						$arrayPasajMod[0]->cambiarDatosUnPasajero($docModificar,$nombreMod,$apellidoMod,$telefonoMod,$arrayViajesModP[0]);
						}else{
							echo "El viaje ya esta lleno\n";
						}
						}else{
							echo "No existe ese viaje\n";
						}
						}else{
							echo "No existe ese pasajero\n";
						}
					break;

					case 3:
						echo "Ingrese el nro de documento del pasajero a eliminar:\n";
						$idPasajeroElim= trim(fgets(STDIN));
						if (($obj_pasajero->Buscar($idPasajeroElim))){
						$arrayElimP=$obj_pasajero->listar("rdocumento",$idPasajeroElim);
						$arrayElimP[0]->eliminar();
						}else{
							echo "El pasajero no existe.\n";
						}

					break;

					case 4:
						echo "\n----------------------\n";
						echo "Pasajeros\n";
						echo "----------------------\n";
						$colPasaj=$obj_pasajero->listar("","");
						foreach ($colPasaj as $unPasaj){			
							echo $unPasaj;
						}	
					break;

					default:
                    break;

				}
			}while($varSwitchPasajeros!=5);
			break;
				
		}
	}while($varSwitchMenuPrinc!=5);
		



?>