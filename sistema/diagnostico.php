<?php 
	session_start();	
	include "../conexion.php";	
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Diagnostico</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<h1>Diagnostico</h1>
		
		<form action="buscar_diagnostico.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
			<button type="submit" class="btn_search"><i class="fas fa-search"></i></button>
		</form>

		<table>
			<tr>
				<th>ID</th>
				<th>NIT</th>
				<th>Nombre</th>
				<th>Telefono</th>
				<th>Direccion</th>
				<th>Vehiculo</th>
				<th>Placa</th>
				<th>Acciones</th>
			</tr>
		<?php 
			//Paginador
			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM Cliente WHERE estatus = 1 ");
			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];

			$por_pagina = 10;

			if(empty($_GET['pagina']))
			{
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);

			$query = mysqli_query($conection,"SELECT * FROM cliente
                     WHERE estatus = 1 ORDER BY idcliente ASC LIMIT $desde,$por_pagina 
				");

			mysqli_close($conection);

			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
                    if ($data["nit"]== 0) {
                        $nit = 'C/F';
                    }else {
                        $nit = $data["nit"];
                    }
					
			?>
				<tr>
					<td><?php echo $data["idcliente"]; ?></td>
					<td><?php echo $nit;?></td>
					<td><?php echo $data["nombre"]; ?></td>
					<td><?php echo $data["telefono"]; ?></td>
					<td><?php echo $data["direccion"]; ?></td>
					<td><?php echo $data['vehiculo'] ?></td>
					<td><?php echo $data['placa'] ?></td>
					<td>
						<a class="link_edit" href="nuevo_diagnostico.php?id=<?php echo $data["idcliente"]; ?>">Nuevo Diagnostico</a>
						<?php if ($_SESSION['rol'] == 1 ){} {
							# code...
						} ?>
						|

						<a class="link_delete" target="_blank" href="https://declaraguate.sat.gob.gt/declaraguate-web/">Eliminar</a>
					<?php }?>
						
					</td>
				</tr>
			
		<?php 
				}

			
		 ?>


		</table>
		<div class="paginador">
			<ul>
			<?php 
				if($pagina != 1)
				{
			 ?>
				<li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>"><<</a></li>
			<?php 
				}
				for ($i=1; $i <= $total_paginas; $i++) { 
					# code...
					if($i == $pagina)
					{
						echo '<li class="pageSelected">'.$i.'</li>';
					}else{
						echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
					}
				}

				if($pagina != $total_paginas)
				{
			 ?>
				<li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
				<li><a href="?pagina=<?php echo $total_paginas; ?> ">>|</a></li>
			<?php } ?>
			</ul>
		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>