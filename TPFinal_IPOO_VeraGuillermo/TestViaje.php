<?php
include 'Pasajero.php';
include 'ResponsableV.php';
include 'Empresa.php';
include 'Viaje.php';

    //creo un objeto pasajero
    $obj_pasajero = new Pasajero();


    //Busco todos los pasajeros almacenadas en la BD
	$colPasajeros =$obj_pasajero->listar();
	foreach ($colPasajeros as $unPasajero){
	
		echo $unPasajero;
		echo "-------------------------------------------------------";
	}

    $obj_pasajero->cargar(42165953, "Guillermo", "Vera", 2944391496, 0);
	$respuesta=$obj_pasajero->insertar();
	// Inserto el OBj pasajero en la base de datos
	if ($respuesta==true) {
			echo "\nOP INSERCION;  El pasajero fue ingresado en la BD";
			$colPasajeros =$obj_pasajero->listar("");
			foreach ($colPasajeros as $unPasajero) {
		
				echo $unPasajero;
				echo "-------------------------------------------------------";
			}
	}else 
		echo $obj_pasajero->getmensajeoperacion();




?>