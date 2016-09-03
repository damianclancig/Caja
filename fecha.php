<?php
	if($fecha=="")
	{
		$diah = date("d");
	}
	else
	{
		$diah = $fecha[2];
	}
	if($fecha=="")
	{
		$mesh = date("m");
	}
	else
	{
		$mesh = $fecha[1];
	}
	if($fecha=="")
	{
		$añoh = date("Y");
	}
	else
	{
		$añoh = $fecha[0];
	}
?>
<select name="dia" class="tah11">
	<?php
		for($i=1;$i<=31;$i++)
		{
			if($i==$diah)
			{
				?>
				<option value="<?php echo $i?>" selected><?php echo $i?></option>
				<?php
			}
			else
			{
				?>
				<option value="<?php echo $i?>"><?php echo $i?></option>
				<?php
			}
		}
	?>
</select>
<select name="mes" class="tah11">
	<?php
		for($i=1;$i<=12;$i++)
		{
			if($i==$mesh)
			{
				?>
				<option value="<?php echo $i?>" selected><?php echo $meses[$i]?></option>
				<?php
			}
			else
			{
				?>
				<option value="<?php echo $i?>"><?php echo $meses[$i]?></option>
				<?php
			}
		}
	?>
</select>
<select name="año" class="tah11">
	<?php
		for($i=2000;$i<=2100;$i++)
		{
			if($i==$añoh)
			{
				?>
				<option value="<?php echo $i?>" selected><?php echo $i?></option>
				<?php
			}
			else
			{
				?>
				<option value="<?php echo $i?>"><?php echo $i?></option>
				<?php
			}
		}
	?>
</select>