<?php
	if($flag==1)
	{
		$color = ' bgcolor="#FFFFFF" id="'.$g.'" onMouseOver="Color(\'#83BCF1\', \''.$g.'\');" onMouseOut="Color(\'#FFFFFF\', \''.$g++.'\');"';
		$flag=0;
	}
	else
	{
		$color = ' bgcolor="#E0F1FF" id="'.$g.'" onMouseOver="Color(\'#83BCF1\', \''.$g.'\');" onMouseOut="Color(\'#E0F1FF\', \''.$g++.'\');"';
		$flag=1;
	}
?>