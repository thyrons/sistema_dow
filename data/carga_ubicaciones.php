<?php
	include 'conexion.php';
	include 'funciones_generales.php';		
	$conexion = conectarse();
	$sql = "";
	if($_GET['fun'] == "1"){//para paises
		if($_GET['tipo'] == "0"){//indica que se carga al inicio de la pagina
			$sql = "select id_pais,descripcion from pais";
			cargarSelect($conexion,$sql);
		}else{

		}
	}else{
		if($_GET['fun'] == "2"){//para provincias
			if($_GET['tipo'] == "0"){//indica que se carga al inicio de la pagina
				$sql = "select id_provincia,descripcion from provincia where id_pais = '$_GET[id]'";
				cargarSelect($conexion,$sql);
			}else{

			}
		}else{
			if($_GET['fun'] == "3"){//para ciudades
				if($_GET['tipo'] == "0"){//indica que se carga al inicio de la pagina
					$sql = "select id_ciudad,descripcion from ciudad where id_provincia = '$_GET[id]'";
					cargarSelect($conexion,$sql);
				}else{

				}
			}else{
				if($_GET['fun'] == "4"){//para cargos
					if($_GET['tipo'] == "0"){//indica que se carga al inicio de la pagina
						$sql = "select id_cargo,descripcion from cargo";
						cargarSelect($conexion,$sql);
					}else{

					}
				}else{
					if($_GET['fun'] == "5"){//para pais modificar
						if($_GET['tipo'] == "0"){//indica que se carga al inicio de la pagina
							$sql = "select id_provincia from ciudad where id_ciudad = '$_GET[id]'";							
							id($conexion,$sql);
						}else{

						}
					}else{
						if($_GET['fun'] == "6"){//para pais modificar
							if($_GET['tipo'] == "0"){//indica que se carga al inicio de la pagina
								$sql = "select id_pais from provincia where id_provincia = '$_GET[id]'";															
								id($conexion,$sql);
							}else{

							}
						}	
					}	
				}
			}
		}
	}

?>