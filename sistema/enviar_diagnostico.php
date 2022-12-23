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
            //$idcliente  = $_POST['idcliente'];
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
?>
<?php 


