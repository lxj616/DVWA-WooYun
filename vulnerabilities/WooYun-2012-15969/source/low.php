<?php	

if(isset($_GET['Submit'])){
	
	// Retrieve data
	$str = addslashes($_GET['str']);

	$html2="";

	$html2 .= "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\n";
	$html2 .= "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
	$html2 .= "	<head>\n";
	$html2 .= "		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=GBK\" />\n";
	$html2 .= "		<title>Damn Vulnerable Web App (DVWA) v1.8 :: WooYun-2012-15969</title>\n";
	$html2 .= "		<script type=\"text/javascript\">\n";
	$html2 .= "			var str=\"".$str."\";\n";
	$html2 .= "		</script>\n";
	$html2 .= "	</head>\n";
	$html2 .= "	<body>\n";
	$html2 .= "	</body>\n";
	$html2 .= "</html>\n";

	die($html2);

}

?>
