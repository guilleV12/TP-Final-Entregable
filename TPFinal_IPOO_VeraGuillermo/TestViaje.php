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
	echo "\n----Menu opciones:------\n\n";
	echo "Se recomienda ingresar al menos un objeto de cada uno, en el orden del menu para su correcto funcionamiento\n";
	echo "1 - Menu de empresas\n";
	echo "2 - Menu de responsables\n";
	echo "3 - Menu de viajes\n";
	echo "4 - Menu de pasajeros\n"; 
	echo "5 - Salir del menu\n";
	$varSwitchMenuPrinc= trim(fgets(STDIN));

	switch ($varSwitchMenuPrinc){
		case 1:
		///////////////////Switch Empresas///////////////////////
		echo "***************************\n";
		echo "************Empresas********\n";
		do {
			echo "\n----Menu opciones de Empresas:------\n\n";
			echo "1 - ingresar una empresa (debe tener al menos una relacionada para que funcione correctamente su base de datos)\n";
			echo "2 - modificar datos de una empresa\n";
			echo "3 - eliminar una empresa\n";
			echo "4 - Salir del menu de empresas\n";
			$varSwitchEmp= trim(fgets(STDIN));

				
			switch($varSwitchEmp) {
				case 1:
						//creo un objeto empresa
						echo "Ingrese el numero de la empresa:\n";
						$idEmpIng= trim(fgets(STDIN));
						if (count($obj_empresa->listar($idEmpIng)) == 0){
						echo "Ingrese el nombre de la empresa:\n";
						$nombEmpIng= trim(fgets(STDIN));
						echo "Ingrese la direccion de la empresa:\n";
						$dirEmpIng= trim(fgets(STDIN));

						//insertar empresa en la base de datos
						$obj_empresa->cargar($idEmpIng,$nombEmpIng,$dirEmpIng);
						$respuestaE= $obj_empresa->insertar();
																		
							echo "\n-------------------------------------------------------\n";
							echo "OP INSERCION:  La empresa fue ingresada en la BD\n";
						}else{
							echo "\nLa empresa ya existe\n";
						}
				break;

				case 2:
							$obj_empresa= new Empresa();
							echo "Ingrese el id de la empresa a modificar:\n";
							$idEmpMod= trim(fgets(STDIN));
							$arrayEmpresasMod=$obj_empresa->listar($idEmpMod);
							if (count($obj_empresa->listar($idEmpMod)) == 0) {
								echo "\nNo existe la empresa\n";
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
							echo "\nIngrese el id de empresa a eliminar:\n";
							$idEmpElim= trim(fgets(STDIN));
							if (count($obj_empresa->listar($idEmpElim)) == 0) {
								echo "\nNo existe la empresa\n";
							}else{
							$arrayEmpresasElim=$obj_empresa->listar($idEmpElim);
							$arrayEmpresasElim[0]->eliminar();
							}
				break;
			}
			
			}while ($varSwitchEmp != 4);
		break;

		case 2:
		///////////////////Switch Responsables///////////////////////
		echo "***************************\n";
		echo "************Responsables********\n";
		do {
			echo "\n----Menu opciones de Responsables:------\n\n";
			echo "1 - ingresar un Responsalbe (debe tener al menos uno relacionada para que funcione correctamente su base de datos)\n";
			echo "2 - modificar datos de un responsable\n";
			echo "3 - eliminar un responsable\n";
			echo "4 - Salir del menu de responsables\n";
			$varSwitchResp= trim(fgets(STDIN));
				
			switch($varSwitchResp) {

				case 1:
						echo "Ingrese el nombre del responsable de los viajes:\n";
						$nombreResp=trim(fgets(STDIN));
						echo "Ingrese apellido del responsable de los viajes:\n";
						$apellidoResp=trim(fgets(STDIN));
						echo "Ingrese el id del responsable de los viajes:\n";
						$numeroResp = trim(fgets(STDIN));
						if (count($obj_responsable->listar($numeroResp)) == 0) {
							
						echo "Ingrese la licencia del responsable de los viajes:\n";
						$liceResp = trim(fgets(STDIN));
			

					//creo un objeto responsable

					//insertar persona de la base de datos
					$obj_responsable->cargar($numeroResp,$liceResp,$nombreResp,$apellidoResp);
					$respuesta= $obj_responsable->insertar();

					if($respuesta == true){
						echo "-------------------------------------------------------\n";
						echo "OP INSERCION:  El responsable fue ingresada en la BD\n";
					}
				}else{
					echo "\nEl responsable ya existe\n";
				}
				break;

				case 2:
					$obj_responsable= new ResponsableV();
					echo "Ingrese el id del reponsable a modificar:\n";
					$idRespMod=trim(fgets(STDIN));
					if (count($obj_responsable->listar($idRespMod)) != 0){
					$arrayRespMod=$obj_responsable->listar($idRespMod);
					
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
						echo "\nEl responsable no existe\n";
					}
				break;

				case 3:
					echo "\nIngrese el id del responsable a eliminar:\n";
					$idRespElim= trim(fgets(STDIN));
					if (count($obj_responsable->listar($idRespElim)) != 0){
					$arrayRespElim=$obj_responsable->listar($idRespElim);
					$arrayRespElim[0]->eliminar();
					}else{
						echo "\nEl responsable no existe.\n";
					}
				break;


			}
			}while($varSwitchResp != 4);
			break;



			case 3:
			///////////////////Switch Viajes///////////////////////
			echo "\n***************************\n";
			echo "************Viaje********\n";
			do {
				echo "\n----Menu opciones de Viajes:------\n\n";
				echo "1 - ingresar un Viaje (debe tener al menos uno relacionada para que funcione correctamente su base de datos)\n";
				echo "2 - modificar datos de un Viaje\n";
				echo "3 - eliminar un viaje\n";
				echo "4 - Salir del menu de viajes\n";
				$varSwitchViaje= trim(fgets(STDIN));
					
				switch($varSwitchViaje) {
					case 1:
						//cargar y ver los datos del viaje
						echo "\nIngrese el numero de viaje:\n"; 
						$numViaje = trim(fgets(STDIN));
						if (count($obj_viaje->listar($numViaje)) != 0 ){
							echo "\nEl viaje ya existe.\n";
						}else {
						echo "Ingrese el destino:\n";
						$destViaje = trim(fgets(STDIN));
						echo "Ingrese cantidad maxima de pasajeros:\n";
						$pasajMax= trim(fgets(STDIN));
						echo "Ingrese el id de la empresa a quien pertenece:\n";
						$idEmpViaj= trim(fgets(STDIN));
						$empresaPert=$obj_empresa->listar($idEmpViaj);
						echo "Ingrese el id del resposable del viaje:\n";
						$idRespViaje= trim(fgets(STDIN));
						$responsablePert=$obj_responsable->listar($idRespViaje);
						echo "Ingrese el importe del viaje: \n";
						$importeViaje= trim(fgets(STDIN));
						do {
							echo "Ingrese el tipo de asiento (cama/semicama): \n";
							$tipoAs= trim(fgets(STDIN));
						} while (($tipoAs != "cama") && ($tipoAs != "semicama"));
						echo "Es de ida y vuelta?:\n";
						$idaYv= trim(fgets(STDIN));
						//creo un objeto viaje
						//insertar viaje en la base de datos
						$obj_viaje->cargar($numViaje,$destViaje,$pasajMax,$empresaPert[0]->getIdempresa(),$responsablePert[0]->getRnumeroempleado(),$importeViaje,$tipoAs,$idaYv);
						$respuestaV= $obj_viaje->insertar();
						$obj_viaje->setVimporte($obj_viaje->importePasaje());
						$obj_viaje->modificar();
						}
					break;

					case 2:
						//modificar datos del viaje
							echo "Ingrese el id del viaje a modificar: \n";
							$idViajeMod = trim(fgets(STDIN));
							$arrayViajeMod=$obj_viaje->listar($idViajeMod);
							if (count($arrayViajeMod) == 0 ){
								echo "\nEl viaje no existe.\n";
							}else {
							echo "Ingrese el destino de viaje: \n";
							$destViajeMod = trim(fgets(STDIN));
							$arrayViajeMod[0]->setVdestino($destViajeMod);
							echo "Ingrese la cantidad maxima de pasajeros: \n";
							$cantMaxPasMod = trim(fgets(STDIN));
							$arrayViajeMod[0]->setVcantmaxpasajeros($cantMaxPasMod);
							echo "Ingrese el tipo de asiento: \n";
							$tipoANueva = trim(fgets(STDIN));
							$arrayViajeMod[0]->setTipoasiento($tipoANueva);
							echo "Ingrese la ida y vuelta: \n";
							$idaYVNueva = trim(fgets(STDIN));
							$arrayViajeMod[0]->setIdayvuelta($idaYVNueva);
							$arrayViajeMod[0]->setVimporte($arrayViajeMod[0]->importePasaje());
							$arrayViajeMod[0]->modificar();
							}
					break;

					case 3:
						echo "\nIngrese el id del viaje a eliminar:\n";
						$idViajeElim= trim(fgets(STDIN));
						if (count($obj_viaje->listar($idViajeElim)) != 0){
						$arrayViajeElim=$obj_viaje->listar($idViajeElim);
						$arrayViajeElim[0]->eliminar();
						}else{
							echo "\nEl viaje no existe.\n";
						}
					break;

				}
			}while($varSwitchViaje != 4);
			break;


			case 4:
			///////////////////Switch Pasajeros///////////////////////
			echo "\n***************************\n";
			echo "************Pasajeros********\n";
			do {
				echo "\n----Menu opciones de Pasajeros:------\n\n";
				echo "1 - ingresar un pasajero (debe tener al menos uno relacionada para que funcione correctamente su base de datos)\n";
				echo "2 - modificar datos de un pasajero\n";
				echo "3 - eliminar un pasajero\n";
				echo "4 - Salir del menu de pasajeros\n";
				$varSwitchPasajeros= trim(fgets(STDIN));
					
				switch($varSwitchPasajeros) {
					case 1:
						echo "Ingrese el documento:\n";
						$respDocNuevo= trim(fgets(STDIN));
						if (count($obj_pasajero->listar($respDocNuevo)) == 0){
						echo "Ingrese nombre:\n";
						$respNomNuevo= trim(fgets(STDIN));
						echo "Ingrese apellido:\n";
						$respApeNuevo= trim(fgets(STDIN));
						echo "Ingrese el telefono:\n";
						$respTelNuevo= trim(fgets(STDIN));
						echo "Ingrese el id del viaje correspondiente:\n";
						$idViajeCorr= trim(fgets(STDIN));
						$arrayViajesIng=$obj_viaje->listar($idViajeCorr);
						$arrayViajesIng[0]->agregarPasajero($respDocNuevo,$respNomNuevo,$respApeNuevo,$respTelNuevo);
						}else{
							echo "\nEl pasajero ya existe.\n";
						}
					break;
					
					case 2:
					//modificar datos de pasajeros
						echo "Ingrese el nro de documento: \n";
						$docModificar= trim(fgets(STDIN));
						if (count($obj_pasajero->listar($docModificar)) != 0){
						echo "Ingrese nombre:\n";
						$nombreMod= trim(fgets(STDIN));
						echo "Ingrese apellido:\n";
						$apellidoMod= trim(fgets(STDIN));
						echo "Ingrese el telefono:\n";
						$telefonoMod= trim(fgets(STDIN));
						echo "Ingrese el id del viaje correspondiente al pasajero:\n";
						$idPasajVMod= trim(fgets(STDIN));
						$arrayPasajMod = $obj_viaje->listar($idPasajVMod);
						$arrayPasajMod[0]->cambiarDatosUnPasajero($docModificar,$nombreMod,$apellidoMod,$telefonoMod);
						}else{
							echo "\nNo existe ese pasajero\n";
						}
					break;

					case 3:
						echo "\nIngrese el nro de documento del pasajero a eliminar:\n";
						$idPasajeroElim= trim(fgets(STDIN));
						if (count($obj_pasajero->listar($idPasajeroElim)) != 0){
						$arrayPasajeroElim=$obj_pasajero->listar($idPasajeroElim);
						$arrayPasajeroElim[0]->eliminar();
						}else{
							echo "\nEl pasajero no existe.\n";
						}

					break;

					default:
                    break;

				}
			}while($varSwitchPasajeros!=4);
			break;
				
		}
	}while($varSwitchMenuPrinc!=5);
		

				//mostrar datos del viaje: 
				/////////////////////////
				echo "\n---------------------------------\n";
				echo "\n--------------Empresa------------\n";
				echo "\n---------------------------------\n";
				$colEmpresasMostrar = $obj_empresa->listar("");
				foreach ($colEmpresasMostrar as $unaEmpresa){
						
					echo $unaEmpresa;
				}	

				echo "\n---------------------------------\n";
				echo "\n--------------Viaje--------------\n";
				echo "\n---------------------------------\n";
				$colViajes = $obj_viaje->listar("");
				foreach ($colViajes as $unViaje){
						
					echo $unViaje;
				}				
				echo "\n---------------------------------\n";
				echo "\n--------------Responsalbe--------\n";
				echo "\n---------------------------------\n";
				$responsables = $obj_responsable->listar("");
				foreach ($responsables as $unResponsable){
					
					echo $unResponsable;
				}
				echo "\n---------------------------------\n";
				echo "\n--------------Pasajeros----------\n";
				echo "\n---------------------------------\n";

				$obj_viaje->mostrarPasajero();



	

	



?>