<?php	

if(isset($_GET['Submit'])){
	
	// Retrieve data

	if($_GET['Submit']=='login')
	{
		$id=intval($_GET['id']);
		$getid = "SELECT first_name, last_name FROM users WHERE user_id = '$id'";
		$result = mysql_query($getid) or die('<pre>' . mysql_error() . '</pre>' );
		setcookie('id',$id);
		setcookie('name',mysql_result($result,0,"first_name"));
		$html .= '<pre>';
		$html .= 'ID: ' . $id . '<br>First name: ' . $_COOKIE['name'] . '<br> Login success!';
		$html .= '</pre>';
	}
	elseif($_GET['Submit']=='edit')
	{
		if($_COOKIE['id']==null)
		{
			$html .= '<pre>';
			$html .= 'Please login first';
			$html .= '</pre>';
		}
		else
		{
			setcookie('name',addslashes($_GET['name']));
			$html .= '<pre>';
			$html .= '(Data has been saved into database)Edit success:'.addslashes($_GET['name']);
			$html .= '</pre>';
		}
	}
	elseif($_GET['Submit']=='view')
	{
		if($_COOKIE['id']==null)
		{
			$html .= '<pre>';
			$html .= 'Please login first';
			$html .= '</pre>';
		}
		else
		{
			$getid = "SELECT user_id, first_name, last_name FROM users WHERE first_name = '".stripslashes($_COOKIE['name'])."'";
			$result= mysql_query($getid) or die('<pre>' . mysql_error() . '</pre>' );
			$id    = mysql_result($result,0,"user_id");
			$first = mysql_result($result,0,"first_name");
			$html .= '<pre>';
			$html .= 'ID: ' . $id . '<br>First name: ' . $first . '<br>If it is empty it means not found!';
			$html .= '</pre>';
		}
	}

}
?>
