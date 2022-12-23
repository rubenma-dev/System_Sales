		<nav>
			<ul>
				<li><a href="index.php"><i class="fas fa-home"></i> Inicio</a></li>
			<?php
				if($_SESSION['rol'] == 1){
			 ?>
			 <li class="principal">
					<a href="#"><i class="fas fa-user"></i> Clientes <span class="arrow"><i class="fas fa-angle-down"></i></span></a>
					<ul>
						<li><a href="registro_cliente.php"><i class="fas fa-user-plus"></i> Nuevo Cliente</a></li>
						<li><a href="lista_clientes.php"><i class="far fa-list-alt"></i> Lista de Clientes</a></li>
					</ul>
				</li>
				
			<?php } ?>
			<li class="principal">

					<a href="#"><i class="fas fa-users"></i> Diagnostico <span class="arrow"><i class="fas fa-angle-down"></i></span></a>
					<ul>
						<li><a href="diagnostico.php"><i class="fas fa-user-plus"></i> Nuevo Diagnostico</a></li>
						<li><a href="lista_diagnostico.php"><i class="fas fa-users"></i> Lista de Diagnostico</a></li>
					</ul>
				</li>
			<?php
				if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2){
			 ?>
				
			<?php } ?>
				<li class="principal">
					<a href="#"><i class="fas fa-cubes"></i> Cotizacion <span class="arrow"><i class="fas fa-angle-down"></i></span></a>
					<ul>
						<?php
							if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2){
						 ?>
							<li><a href="nueva_cotizacion.php"><i class="fas fa-plus"></i> Nueva Cotizacion</a></li>
						<?php } ?>
						<li><a href="cotizacion.php"><i class="far fa-newspaper"></i> Cotizaciones</a></li>
					</ul>
				</li>
				<li class="principal">
					<a href="#"><i class="far fa-file-alt"></i> Ventas <span class="arrow"><i class="fas fa-angle-down"></i></span></a>
					<ul>
						<li><a href="nueva_venta.php"><i class="fas fa-plus"></i> Nueva Venta</a></li>
						<li><a href="ventas.php"><i class="far fa-newspaper"></i> Ventas</a></li>
					</ul>
				</li>
			</ul>
		</nav>