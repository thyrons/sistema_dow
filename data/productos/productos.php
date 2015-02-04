<?php
	include '../conexion.php';
	include '../funciones_generales.php';		
	$conexion = conectarse();	
    date_default_timezone_set('America/Guayaquil');
	$fecha = date('Y-m-d H:i:s', time());
	$fecha_larga = date('His', time());
	$sql = "";	
	$id = unique($fecha_larga);			
	$sin_existencia = "off";	///checks
	$iva_producto = "off";	///checks
	$expiracion_producto = "off";	///checks
	$producto_series = "off";	///checks
	$producto_activo = "off";	///checks
	if(isset($_POST["sin_existencia"]))
		$sin_existencia = "on";	
	if(isset($_POST["iva_producto"]))
		$iva_producto = "on";	
	if(isset($_POST["expiracion_producto"]))
		$expiracion_producto = "on";	
	if(isset($_POST["producto_series"]))
		$producto_series = "on";	
	if(isset($_POST["producto_activo"]))
		$producto_activo = "on";	
	/////////////validacion de los checks

	$cadena = " ".$_POST['img'];	
	$buscar = 'data:image/png;base64,';		
	if($_POST['tipo'] == "g"){
		//verifica codigo
		$repetidos = repetidos($conexion, "codigo", strtoupper($_POST['txt_1']), "productos", "g", "", "");		
    	if ($repetidos == 'true') {				
    		$data = 1;///codigo repetido		
    	}else{
    		$repetidos = repetidos($conexion, "codigo_barras", strtoupper($_POST['txt_8']), "productos", "g", "", "");
	    	if ($repetidos == 'true') {				
	    		$data = 2;///codigo barras repetido		
	    	}else{
	    		$repetidos = repetidos($conexion, "descripcion", strtoupper($_POST['txt_2']), "productos", "g", "", "");
		    	if ($repetidos == 'true') {				
		    		$data = 3;///nombre repetido		
		    	}else{
		    		$data = 0;
		    	}    
	    	}	
    	}    	    		    	
    	if($data == 0){
			if (strpos($cadena, $buscar) ==  FALSE) {
				$sql ="insert into productos values ('$id','$_POST[txt_1]','$_POST[txt_8]','".strtoupper($_POST['txt_2'])."','$_POST[txt_9]','$_POST[txt_3]','$_POST[txt_10]','$_POST[txt_4]','$_POST[txt_11]','$_POST[txt_5]','$_POST[txt_12]','$_POST[txt_6]','$_POST[txt_13]','$_POST[txt_7]','$_POST[txt_14]','$sin_existencia','$_POST[txt_16]','$_POST[txt_17]','$producto_series','$expiracion_producto','$_POST[txt_18]','default.png','$producto_activo','$fecha','$iva_producto')";					
			}else{					
				$resp = img_64("img",$_POST['img'],'png',$id);					
				if($resp == "true"){
					$sql ="insert into productos values ('$id','$_POST[txt_1]','$_POST[txt_8]','".strtoupper($_POST['txt_2'])."','$_POST[txt_9]','$_POST[txt_3]','$_POST[txt_10]','$_POST[txt_4]','$_POST[txt_11]','$_POST[txt_5]','$_POST[txt_12]','$_POST[txt_6]','$_POST[txt_13]','$_POST[txt_7]','$_POST[txt_14]','$sin_existencia','$_POST[txt_16]','$_POST[txt_17]','$producto_series','$expiracion_producto','$_POST[txt_18]','".$id.".png','$producto_activo','$fecha','$iva_producto')";			
				}
				else{
					$sql ="insert into productos values ('$id','$_POST[txt_1]','$_POST[txt_8]','".strtoupper($_POST['txt_2'])."','$_POST[txt_9]','$_POST[txt_3]','$_POST[txt_10]','$_POST[txt_4]','$_POST[txt_11]','$_POST[txt_5]','$_POST[txt_12]','$_POST[txt_6]','$_POST[txt_13]','$_POST[txt_7]','$_POST[txt_14]','$sin_existencia','$_POST[txt_16]','$_POST[txt_17]','$producto_series','$expiracion_producto','$_POST[txt_18]','default.png','$producto_activo','$fecha','$iva_producto')";		
				}
			}
			$guardar = guardarSql($conexion,$sql);
			if( $guardar == 'true'){
				$data = 0; ////datos guardados
			}else{
				$data = 4; /// error al guardar
			}			
    	}										
	}else{
		$repetidos = repetidos($conexion, "codigo", strtoupper($_POST['txt_1']), "productos", "m", $_POST['txt_0'], "id_productos");
		if ($repetidos == 'true') {				
    		$data = 1;///codigo repetido		
    	}
    	$repetidos = repetidos($conexion, "codigo", strtoupper($_POST['txt_8']), "productos", "m", $_POST['txt_0'], "id_productos");
		if ($repetidos == 'true') {				
    		$data = 2;///codigo barras repetido		
    	}
    	$repetidos = repetidos($conexion, "codigo", strtoupper($_POST['txt_2']), "productos", "m", $_POST['txt_0'], "id_productos");
		if ($repetidos == 'true') {				
    		$data = 3;///nombre repetido		
    	}

		if (strpos($cadena, $buscar) ==  FALSE) {
			$sql = "update productos set codigo='$_POST[txt_1]',codigo_barras='$_POST[txt_8]',descripcion='".strtoupper($_POST['txt_2'])."',precio='$_POST[txt_9]',utilidad_minorista='$_POST[txt_3]',utilidad_moyorista='$_POST[txt_10]',precio_minorista='$_POST[txt_4]',precio_mayorista='$_POST[txt_11]',id_tipo='$_POST[txt_5]',stock='$_POST[txt_12]',id_categoria='$_POST[txt_6]',id_marca='$_POST[txt_13]',id_bodega='$_POST[txt_7]',id_unidad='$_POST[txt_14]',facturar_existencia='$sin_existencia',cantidad_minima='$_POST[txt_16]',cantidad_maxima='$_POST[txt_17]',id_series_venta='$producto_series',id_lotes='$expiracion_producto',comentario='$_POST[txt_18]',imagen='default.png',estado='$producto_activo',iva_producto='$iva_producto' where id_producto = '$_POST[txt_0]'";					
		}else{					
			$resp = img_64("img",$_POST['img'],'png',$id);					
			if($resp == "true"){				
				$sql = "update productos set codigo='$_POST[txt_1]',codigo_barras='$_POST[txt_8]',descripcion='".strtoupper($_POST['txt_2'])."',precio='$_POST[txt_9]',utilidad_minorista='$_POST[txt_3]',utilidad_moyorista='$_POST[txt_10]',precio_minorista='$_POST[txt_4]',precio_mayorista='$_POST[txt_11]',id_tipo='$_POST[txt_5]',stock='$_POST[txt_12]',id_categoria='$_POST[txt_6]',id_marca='$_POST[txt_13]',id_bodega='$_POST[txt_7]',id_unidad='$_POST[txt_14]',facturar_existencia='$sin_existencia',cantidad_minima='$_POST[txt_16]',cantidad_maxima='$_POST[txt_17]',id_series_venta='$producto_series',id_lotes='$expiracion_producto',comentario='$_POST[txt_18]',imagen='".$id.".png',estado='$producto_activo',iva_producto='$iva_producto' where id_producto = '$_POST[txt_0]'";								
			}
			else{
				$sql = "update productos set codigo='$_POST[txt_1]',codigo_barras='$_POST[txt_8]',descripcion='".strtoupper($_POST['txt_2'])."',precio='$_POST[txt_9]',utilidad_minorista='$_POST[txt_3]',utilidad_moyorista='$_POST[txt_10]',precio_minorista='$_POST[txt_4]',precio_mayorista='$_POST[txt_11]',id_tipo='$_POST[txt_5]',stock='$_POST[txt_12]',id_categoria='$_POST[txt_6]',id_marca='$_POST[txt_13]',id_bodega='$_POST[txt_7]',id_unidad='$_POST[txt_14]',facturar_existencia='$sin_existencia',cantidad_minima='$_POST[txt_16]',cantidad_maxima='$_POST[txt_17]',id_series_venta='$producto_series',id_lotes='$expiracion_producto',comentario='$_POST[txt_18]',imagen='default.png',estado='$producto_activo',iva_producto='$iva_producto' where id_producto = '$_POST[txt_0]'";					
			}
		}	
		$guardar = guardarSql($conexion,$sql);
		if( $guardar == 'true'){
			$data = 0; ////datos guardados
		}else{
			$data = 3; /// error al guardar
		}	
	}	
	echo $data;
?>