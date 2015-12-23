<?php

if(strstr($_GET['Submit'],'log.txt'))
{
	if(strstr($_COOKIE["log"],'<?php'))
	{
		die('成功检测到php标签，你已经成功完成了一次lfi攻击');
	}
	else
	{
		die($_COOKIE["log"]);
	}
}

if($_GET['Submit']=='/etc/passwd')
{
	include('passwd_lxj616');
	die();
}

if($_GET['Submit']=='dolog.php')
{
	die('<?php fuction log2logtxt($str){setcookie(\"log.txt\",$str,time()+3600*24,$path=\'/\')}?>');
}

if($_GET['Submit']=='low.php')
{
	die('<?php you include it ?>');
}

function log2logtxt($str)
{
	setcookie("log",$str,time()+3600*24,$path='/');
}

?>