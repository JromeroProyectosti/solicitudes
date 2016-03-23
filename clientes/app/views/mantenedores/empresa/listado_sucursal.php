<table>
	<tr>
		<td>Nombre Sucursal</td>
		<td>Direccion</td>
		<td>Telefono</td>
		<td>Ciudad</td>
		<td>Comuna</td>
		<td>Modificar</td>
		<td>Eliminar</td>
	</tr>
	<?php foreach ($listado as $value): ?>
	
	<tr>
		<td><?=$value['NombreSucursal']?></td>
		<td><?=$value['DireccionSucursal']?></td>
		<td><?=$value['TelefonoSucursal']?></td>
		<td><?=$value['Ciudad']?></td>
		<td><?=$value['NombreComuna']?></td>
		<td>Modificar</td>
		<td>Eliminar</td>
	</tr>
	<?php endforeach ?>
</table>