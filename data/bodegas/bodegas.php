<?php
	include '../conexion.php';
	include '../funciones_generales.php';		
	$conexion = conectarse();
	date_default_timezone_set('America/Guayaquil');
    $fecha=date('Y-m-d H:i:s', time()); 
    $fecha_larga = date('His', time()); 
	$sql = "";	
	$id = unique($fecha_larga);
	$descripcion = strtoupper($_POST["nombre_bodega"]);	
	
	if ($_POST['oper'] == "add") {
			$repetidos = repetidos($conexion,"nombre_bodega",$descripcion,"bodega","g","","");	
			if( $repetidos == 'true'){
				$data = "1"; /// este dato ya existe;
			}else{	
				 $sql ="insert into bodega values ('$id','$descripcion','$_POST[ubicacion_bodega]','1')";	
				 $guardar = guardarSql($conexion,$sql);
				 $data = 0;
				}
		  }	
	echo $data;
?>