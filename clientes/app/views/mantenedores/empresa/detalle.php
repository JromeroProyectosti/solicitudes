<h3>Modificar</h3>
<fieldset>
    <p><label>Rut Empresa: <strong><?=$detalle['RutProveedor']?></strong></label></p>
    <p><label>Nombre Empresa: <strong><?=$detalle['NombreProveedor']?></strong></label></p>
    <p><label>Razon Social: <strong><?=$detalle['RazonSocial']?></strong></label><label></label></p>
    <p><label>Telefono:<strong> <?=$detalle['Telefonocontacto1Proveedor']?></strong></label><label></label></p>
    <p><label>Direccion:<strong> <?=$detalle['Correocontacto1Proveedor']?></strong></label><label></label></p>    
        <p><label class="content">Region</label><select id='cboRegion'  class="text-long" disabled>
	<?php foreach($region as $row):?>
	<option value='<?=$row['IdRegion']?>' 
        <?php if($row['IdRegion']==$IdRegion) echo " Selected"; ?>
        ><?=$row['NombreRegion']?></option>
	<?php endforeach ?>
        </select>*</p>
        <p><label class="content">Ciudad</label><select id='cboCiudad' disabled  class="text-long">
        <?php foreach($ciudad as $row):?>
                <option value='<?=$row['IdCiudad']?>'><?=$row['NombreCiudad']?></option>
	<?php endforeach ?>
        </select>*</p>
        <p><label class="content">Comuna</label><select id='cboComuna' name='cboComuna' disabled class="text-long">
                <?php foreach($comuna as $row):?>
                <option value='<?=$row['IdComuna']?>'><?=$row['NombreComuna']?></option>
	<?php endforeach ?>
        </select>*</p>
        
</fieldset>