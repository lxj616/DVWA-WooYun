<?php	

if(isset($_GET['Submit'])){
	
	// Retrieve data
	
	$str = htmlspecialchars($_GET['str']);

	$html .= "<div id=\"testa\">xx</div>\n";
	$html .= "<div id=\"testb\">xx</div>\n";
	$html .= "<script>\n";
	$html .= "var m=\"<LISTING>".$str."</LISTING>\";\n";
	$html .= "var x=document.getElementById(\"testa\");\n";
	$html .= "x.innerHTML=m;\n";
	$html .= "var html=x.innerHTML;\n";
	$html .= "document.getElementById(\"testb\").innerHTML = html;\n";
	$html .= "</script>\n";

}

?>
