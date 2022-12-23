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

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Registro Cliente</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1><i class="fas fa-user-plus"></i>Registro Cliente</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="envia.php" method="post" enctype="multipart/form-data">

				<label for="correo">NIT</label>
				<input type="number" name="nit" id="nit" placeholder="Numero de NIT">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre completo">
				<label for="email">Correo</label>
				<input type="email" name="email" id="email" placeholder="Correo">
				<label for="usuario">Telefono</label>
				<input type="number" name="telefono" id="telefono" placeholder="Telefono">

				<label for="clave">Direccion</label>
				<input type="text" name="direccion" id="direccion" placeholder="Direccion">
                <label for="text">Vehiculo</label>
                <input type="text" name="vehiculo" id="vehiculo" placeholder="Marca, Modelo, Color">
                
                <label for="text">Placa</label>
                <input type="text" name="placa" id="placa" placeholder="No. de Placa">
                <label for="text">Kilometraje</label>
				<input type="number" name="kilometraje" id="kilometraje" placeholder="kilometraje">
				
				<div class="photo">
					<label for="foto">Foto</label>
                    <div class="prevPhoto">
                    	<span class="delPhoto notBlock">X</span>
                    	<label for="foto"></label>
                    </div>
                    <div class="upimg">
                        <input type="file" name="foto" id="foto">
                    </div>
                    <div id="form_alert"></div>
				</div>


				<button type="submit" class="btn_save"><i class="far fa-save"></i> Crear Cliente</button>
			
				
			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>