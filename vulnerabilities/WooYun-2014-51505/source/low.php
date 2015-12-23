<?php	

if(isset($_GET['Submit'])){
	
	// Retrieve data
	
	$id = inject_check($_GET['id']);

	$getid = "SELECT first_name, last_name FROM users WHERE user_id = $id";
	$result = mysql_query($getid) or die('<pre>' . mysql_error() . '</pre>' );

	$num = mysql_numrows($result);

	$i = 0;

	while ($i < $num) {

		$first = mysql_result($result,$i,"first_name");
		$last = mysql_result($result,$i,"last_name");
		
		$html .= '<pre>';
		$html .= 'ID: ' . $id . '<br>First name: ' . $first . '<br>Surname: ' . $last;
		$html .= '</pre>';

		$i++;
	}
}

function inject_check($str) { //防注入函数开始
	$check=preg_match('/select|order|insert|update|eval|document|delete|injection|jection|link|\'|\%|\/\*|\*|\.\.\/|\.\/|\,|\.|--|\"|and|or|from|union|into|load_file|outfile|<script>/',$str);
	if($check){
		echo "<script>alert('Filtered!!!');window.history.go(-1);</script>";
		exit();
	}else{
		return $str;
	}
}	

?>
