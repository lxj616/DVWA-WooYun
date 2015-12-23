<?php	

if(isset($_GET['Submit'])){
	
	if($_GET['Submit']=='AllowAccess')
	{
		setcookie("authen_cookie",'yes');
	}
	elseif($_GET['Submit']=='ViewSecret')
	{
		include('secret.php');
	}
}

?>
