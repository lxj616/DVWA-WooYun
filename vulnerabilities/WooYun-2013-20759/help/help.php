<div class="body_padded">
	<h1>Help - SQL Injection</h1>
	
	<div id="code">
	<table width='100%' bgcolor='white' style="border:2px #C0C0C0 solid">
	<tr>
	<td><div id="code">

		<p> 试着找出 $cookie_key 是什么 , 你已经拥有明密文和加密算法了 , 去wooyun.org查看原始的漏洞报告！ </p>

&lt?php

function eccode($string, $operation = 'DECODE', $key = '@LFK24s224%@safS3s%1f%') {   <br>
   <br>
	$result = '';   <br>
	if ($operation == 'ENCODE') {   <br>
		for ($i = 0; $i < strlen($string); $i++) {   <br>
			$char = substr($string, $i, 1);   <br>
			$keychar = substr($key, ($i % strlen($key)) - 1, 1);   <br>
			$char = chr(ord($char) + ord($keychar));   <br>
			$result.=$char;   <br>
		}   <br>
		$result = base64_encode($result);   <br>
		$result = str_replace(array('+', '/', '='), array('-', '_', ''), $result);   <br>
	} elseif ($operation == 'DECODE') {   <br>
		$data = str_replace(array('-', '_'), array('+', '/'), $string);   <br>
		$mod4 = strlen($data) % 4;   <br>
		if ($mod4) {   <br>
			$data .= substr('====', $mod4);   <br>
		}   <br>
		$string = base64_decode($data);   <br>
		for ($i = 0; $i < strlen($string); $i++) {   <br>
			$char = substr($string, $i, 1);   <br>
			$keychar = substr($key, ($i % strlen($key)) - 1, 1);   <br>
			$char = chr(ord($char) - ord($keychar));   <br>
			$result.=$char;   <br>
		}   <br>
	}   <br>
	return $result;   <br>
}   <br>
   <br>
$encrypted='lJamnKA';   <br>
   <br>
$name='admin';   <br>
   <br>
for($key=99;$key<1000;$key++)   <br>
{   <br>
	echo '[+]Testing:'.$key.'||';   <br>
	if(eccode($name,'ENCODE',$key)==$encrypted)   <br>
	{   <br>
		echo '---==========Key found:'.$key.'==========---||';   <br>
		die('Success');   <br>
	}   <br>
}   <br>
die('Fail');   <br>
?&gt   <br>
		
	</div></td>
	</tr>
	</table>
	
	</div>
	
	<br />
	
	<p>Reference: http://www.wooyun.org/bugs/wooyun-2013-020759</p>

</div>
		