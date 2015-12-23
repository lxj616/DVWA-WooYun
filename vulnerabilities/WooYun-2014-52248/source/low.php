<?php	

if(isset($_GET['Submit'])){
	
	// Retrieve data
	
	$id = $_GET['id'];

	$ids = explode(',',trim($id));

	$id = $ids[0];

	$getid = "SELECT first_name, last_name FROM users WHERE user_id = '$id'";
	$result = mysql_query($getid) or die('No Error Report!' );

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
?>
