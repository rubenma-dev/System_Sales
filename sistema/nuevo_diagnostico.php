<?php 
	session_start();
	
	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['vehiculo']) || empty($_POST['comentario']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{
            
			$nombre     = $_POST['nombre'];
			$telefono   = $_POST['telefono'];
			$vehiculo  = $_POST['vehiculo']; 
            $usuario_id = $_SESSION['idUser'];
			$comentario   = $_POST['comentario'];
			$servicio   = $_POST['servicio'];
            
            $result = 0;
            

            if ($result >0) {
                $alert='<p class="msg_error">El numero de NIT ya existe.</p>';
            }else {
                $query_insert = mysqli_query($conection,"INSERT INTO diagnostico(nombre,telefono,vehiculo,usuario_id,servicio,comentario)
																	VALUES('$nombre','$telefono','$vehiculo','$usuario_id','$servicio','$comentario')");
                if($query_insert){
					$alert='<p class="msg_save">Cliente creado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al crear el cliente.</p>';
				}
            }
        }
	}


	//Mostrar Datos
	if(empty($_REQUEST['id']))
	{
		header('Location: lista_cliente.php');
		mysqli_close($conection);
	}
	$idcliente = $_REQUEST['id'];

	$sql= mysqli_query($conection,"SELECT * FROM cliente WHERE idcliente= $idcliente and estatus =1");
	//mysqli_close($conection);
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header('Location: lista_cliente.php');
	}else{
		while ($data = mysqli_fetch_array($sql)) {
			# code...
			$idcliente       = $data['idcliente'];
			$nombre          = $data['nombre'];
			$mail			 = $data['email'];
			$telefono        = $data['telefono'];
			$direccion       = $data['direccion'];
			$vehiculo        = $data['vehiculo'];
		}
	}

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title><i class="fas fa-users"></i> Nuevo Diagnostico</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1><i class="fas fa-user-plus"></i>Nuevo Diagnostico</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

            <form action="enviar_diagnostico.php" method="post" enctype="multipart/form-data">

			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" id="nombre" placeholder="Nombre completo" value="<?php echo $nombre;?>">
			<label for="usuario">Telefono</label>
			<input type="number" name="telefono" id="telefono" placeholder="Telefono" value="<?php echo $telefono;?>">
			
			<label for="email">Correo</label>
			<input type="email" name="email" id="email" placeholder="Correo" value="<?php echo $mail;?>">
			<label for="text">Vehiculo</label>
            <input type="text" name="vehiculo" id="vehiculo" placeholder="Marca, Modelo" value="<?php echo $vehiculo;?>">                
                
				<label for="nombre">Servicio</label>
				<?php 

					$query_producto = mysqli_query($conection, "SELECT codproducto, descripcion FROM producto WHERE estatus = 1");
					 $result_producto = mysqli_num_rows($query_producto);
					 mysqli_close($conection);
				?>
                <select name="servicio" id="servicio">
					<?php
						if ($result_producto > 0) {
							while ($producto = mysqli_fetch_array($query_producto)) {
					?>
							
							<option value="<?php echo $producto['descripcion'];?>"><?php echo $producto['descripcion']; ?> </option>
					<?php
							}
						}
					?>
				</select>
            
			<label for="comentario">Comentario</label>
			<textarea name="comentario" id="comentario" cols="30" rows="10"></textarea>

				<button type="submit" class="btn_save"><i class="far fa-save"></i> Nuevo Diagnostico</button>
			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>