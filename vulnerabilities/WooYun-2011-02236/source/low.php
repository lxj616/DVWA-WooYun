<?php	

include('dolog.php');

if(isset($_GET['Submit'])){
	
	// Retrieve data
	if(strstr($_GET['Submit'],'lxj616_is_handsome'))
	{
		//log to log.txt
		log2logtxt($_GET['Submit']);
	}
	else
	{
		log2logtxt('lxj616_is_handsome_anyway');
	}
	include($_GET['Submit']);
}

?>
