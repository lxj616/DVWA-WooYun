<?php	

if(isset($_GET['Submit'])){
	
	// Retrieve data
	
	$id = $_GET['id'];

	$id = tsFilter($id);

	$getid = "SELECT first_name, last_name FROM users WHERE user_id = '$id'";
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

function tsFilter($value){
	$value = trim($value);
	//定义不允许提交的SQl命令和关键字
	$words = array();
	$words[] = "add ";
	$words[] = "and ";
	$words[] = "count ";
	$words[] = "order ";
	$words[] = "table ";
	$words[] = "by ";
	$words[] = "create ";
	$words[] = "delete ";
	$words[] = "drop ";
	$words[] = "from ";
	$words[] = "grant ";
	$words[] = "insert ";
	$words[] = "select ";
	$words[] = "truncate ";
	$words[] = "update ";
	$words[] = "use ";
	$words[] = "--";
	$words[] = "#";
	$words[] = "group_concat";
	$words[] = "column_name";
	$words[] = "information_schema.columns";
	$words[] = "table_schema";
	$words[] = "union ";
	$words[] = "where ";
	$words[] = "alert";
	$value = strtolower($value);//转换为小写
	foreach($words as $word){
		if(strstr($value,$word)){
			$value = str_replace($word,'',$value);
		}
	}
	
	return $value;
}

?>
