<?php
	if($flag==1)
	{
		$color = ' bgcolor="#FFFFFF" id="c'.$g.'" onMouseOver="Color(\'#83BCF1\', \'c'.$g.'\');" onMouseOut="Color(\'#FFFFFF\', \'c'.$g++.'\');"';
		$flag=0;
	}
	else
	{
		$color = ' bgcolor="#E0F1FF" id="c'.$g.'" onMouseOver="Color(\'#83BCF1\', \'c'.$g.'\');" onMouseOut="Color(\'#E0F1FF\', \'c'.$g++.'\');"';
		$flag=1;
	}
?>