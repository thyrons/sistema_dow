<?php

	include '../conexion.php';
	include '../funciones_generales.php';		
	$conexion = conectarse();
	date_default_timezone_set('America/Guayaquil');
    $fecha=date('Y-m-d H:i:s', time()); 
    $fecha_larga = date('His', time()); 
	$sql = "";	
	$id_session = '1';///datos session
	$id = unique($fecha_larga);	
		
	
	
    ///////////////////////guardar factura compra////////////////////
   $num_serie = $_POST['fecha_registro'];

	$sql = "insert into factura_compra values ('$id','$_POST[id_proveedor]','$id_session','$id','$_POST[fecha_actual]','$_POST[hora_actual]','$_POST[fecha_registro]','$_POST[fecha_emision]','$_POST[fecha_caducidad]','$_POST[tipo_comprobante]','$num_serie','$_POST[autorizacion]','$_POST[fecha_cancelacion]','$_POST[formas]','$_POST[tarifa0]','$_POST[tarifa12]','$_POST[iva]','$_POST[descuento_total]','$_POST[total]','Activo','$fecha')";	
		
	$guardar = guardarSql($conexion,$sql);
	if( $guardar == 'true'){
		$data = 0; ////datos guardados
	}else{
		$data = 2; /// error al guardar
	}			
		
    /////datos detalle factura/////
	$campo1 = $_POST['campo1'];
	$campo2 = $_POST['campo2'];
	$campo3 = $_POST['campo3'];
	$campo4 = $_POST['campo4'];
	$campo5 = $_POST['campo5'];
	///////////////////////////////

	////////////descomponer detalle_factura_compra////////
	$arreglo1 = explode(',', $campo1);
	$arreglo2 = explode(',', $campo2);
	$arreglo3 = explode(',', $campo3);
	$arreglo4 = explode(',', $campo4);
	$arreglo5 = explode(',', $campo5);
	$nelem = count($arreglo1);
   
   //print_r($arreglo1);


	for ($i = 0; $i < $nelem; $i++) {
		$sql2 = "";	
		date_default_timezone_set('America/Guayaquil');
	    $fecha=date('Y-m-d H:i:s', time()); 
	    $fecha_larga = date('His', time()); 
		$id2 = unique($fecha_larga);
		//echo $id2;
		print_r($arreglo1[$i]);

       $sql2 = "insert into detalle_factura_compra values (
       	'$id2','$id','".$arreglo1[$i]."','".$arreglo2[$i]."','".$arreglo3[$i]."','".$arreglo4[$i]."','".$arreglo5[$i]."','Activo','$fecha')"; 

	}
	$guardar = guardarSql($conexion,$sql2); 
   
	//if( $guardar == 'true'){
	//	$data = 0; ////datos guardados
	//}else{
	//	$data = 2; /// error al guardar
	//}

	
	echo $data;
?>