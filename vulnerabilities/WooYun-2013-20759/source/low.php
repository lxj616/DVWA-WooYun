<?php	

include('config.php');

//$cookie_key=rand(99,999);

if(isset($_GET['Submit'])){
	
	// Retrieve data

	if($_GET['Submit']=='login')
	{
		$id=intval($_GET['id']);
		$getid = "SELECT first_name, last_name FROM users WHERE user_id = '$id'";
		$result = mysql_query($getid) or die('<pre>' . mysql_error() . '</pre>' );
		setcookie('name',eccode(mysql_result($result,0,"first_name"),'ENCODE',$cookie_key));
		$html .= '<pre>';
		$html .= 'ID: ' . $id . '<br>First name: ' . mysql_result($result,0,"first_name") . '<br> Login success!';
		$html .= '</pre>';
	}
	elseif($_GET['Submit']=='view')
	{
		if($_COOKIE['name']==null)
		{
			$html .= '<pre>';
			$html .= '请先登录';
			$html .= '</pre>';
		}
		else
		{
			$getid = "SELECT user_id, first_name, last_name FROM users WHERE first_name = '".eccode($_COOKIE['name'],'DECODE',$cookie_key)."'";
			$result= mysql_query($getid) or die('<pre>' . mysql_error() . '</pre>' );
			$id    = mysql_result($result,0,"user_id");
			$first = mysql_result($result,0,"first_name");
			$html .= '<pre>';
			$html .= 'ID: ' . $id . '<br>First name: ' . $first . '<br>If it is empty it means not found!';
			$html .= '</pre>';
		}
	}

}

function eccode($string, $operation = 'DECODE', $key = '@LFK24s224%@safS3s%1f%') {

	$result = '';
	if ($operation == 'ENCODE') {
		for ($i = 0; $i < strlen($string); $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key)) - 1, 1);
			$char = chr(ord($char) + ord($keychar));
			$result.=$char;
		}
		$result = base64_encode($result);
		$result = str_replace(array('+', '/', '='), array('-', '_', ''), $result);
	} elseif ($operation == 'DECODE') {
		$data = str_replace(array('-', '_'), array('+', '/'), $string);
		$mod4 = strlen($data) % 4;
		if ($mod4) {
			$data .= substr('====', $mod4);
		}
		$string = base64_decode($data);
		for ($i = 0; $i < strlen($string); $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key)) - 1, 1);
			$char = chr(ord($char) - ord($keychar));
			$result.=$char;
		}
	}
	return $result;
}

?>
