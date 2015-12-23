<?php	

include('config.php');

if(isset($_GET['Submit'])){
	
	header('Location: http://www.wooyun.org');

	echo $secret;

}

?>
