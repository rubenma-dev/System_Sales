<?php 
	session_start();
	
	include "../conexion.php";
	



	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['direccion']) || empty($_POST['vehiculo']) || empty($_POST['kilometraje']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{
            
			$nit        = $_POST['nit'];
			$nombre     = $_POST['nombre'];
			$telefono   = $_POST['telefono'];
			$mail   = $_POST['email'];
			$direccion  = $_POST['direccion']; 
            $usuario_id = $_SESSION['idUser'];
            $vehiculo   = $_POST['vehiculo'];
            $placa   = $_POST['placa'];
			$kilometraje= $_POST['kilometraje'];

			$foto   	 = $_FILES['foto'];
			$nombre_foto = $foto['name'];
			$type 		 = $foto['type'];
			$url_temp    = $foto['tmp_name'];

			$imgProducto = 'img_producto.png';

			if($nombre_foto != '')
			{
				$destino    = 'img/uploads/';
				$img_nombre = 'img_'.md5(date('d-m-Y H:m:s'));
				$imgProducto= $img_nombre.'.jpg';
				$src        = $destino.$imgProducto;
			}
			
            $result = 0;
            if (is_numeric($nit) and $nit !=0) {
            $query = mysqli_query($conection,"SELECT * FROM cliente WHERE nit = '$nit'");
            $result = mysqli_fetch_array($query);
            }

            if ($result >0) {
                $alert='<p class="msg_error">El numero de NIT ya existe.</p>';
            }else {
                $query_insert = mysqli_query($conection,"INSERT INTO cliente(nit,nombre,telefono,email,direccion,usuario_id,vehiculo,placa,kilometraje,foto)
																	VALUES('$nit','$nombre','$telefono','$mail','$direccion','$usuario_id','$vehiculo','$placa','$kilometraje','$imgProducto')");
				
				if($query_insert){
					if($nombre_foto != '')
					{
						move_uploaded_file($url_temp, $src);
					}
					$alert='<p class="msg_save">Cliente creado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al crear el cliente.</p>';
				}
            }
        }
        mysqli_close($conection);
	}


?>
