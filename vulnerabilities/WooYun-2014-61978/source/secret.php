<?php

if($_COOKIE['authen_cookie']=='yes')
{
	die('Secret:You got it!');
}
else
{
	die('Fobbiden');
}

?>