<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '' );

require_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'phpids' ) );

dvwaDatabaseConnect();

if( isset( $_POST[ 'Login' ] ) ) {


	$user = $_POST[ 'username' ];
	$user = stripslashes( $user );
	$user = mysql_real_escape_string( $user );

	$pass = $_POST[ 'password' ];
	$pass = stripslashes( $pass );
	$pass = mysql_real_escape_string( $pass );
	$pass = md5( $pass );

	$qry = "SELECT * FROM `users` WHERE user='$user' AND password='$pass';";

	$result = @mysql_query($qry) or die('<pre>' . mysql_error() . '</pre>' );

	if( $result && mysql_num_rows( $result ) == 1 ) {	// Login Successful...

		dvwaMessagePush( "You have logged in as '".$user."'" );
		dvwaLogin( $user );
		dvwaRedirect( 'index.php' );

	}

	// Login failed
	dvwaMessagePush( "Login failed" );
	dvwaRedirect( 'login.php' );
}

$messagesHtml = messagesPopAllToHtml();

Header( 'Cache-Control: no-cache, must-revalidate');		// HTTP/1.1
Header( 'Content-Type: text/html;charset=utf-8' );		// TODO- proper XHTML headers...
Header( "Expires: Tue, 23 Jun 2009 12:00:00 GMT");		// Date in the past

echo "

<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">

<html xmlns=\"http://www.w3.org/1999/xhtml\">

	<head>

		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />

		<title>DVWA Wooyun edition - Login</title>

		<link rel=\"stylesheet\" type=\"text/css\" href=\"".DVWA_WEB_PAGE_TO_ROOT."dvwa/css/bootstrap.min.css\" />
		<link rel=\"stylesheet\" type=\"text/css\" href=\"".DVWA_WEB_PAGE_TO_ROOT."dvwa/css/bootstrap-theme.min.css\" />

	</head>

	<body>

	<style type=\"text/css\">html,body{width:100%;height:100%;}body{margin:0px auto;padding:0px auto;background:#F0F0F0;}</style>

	<div align=\"center\">
	
	<br />

	<p><img src=\"".DVWA_WEB_PAGE_TO_ROOT."dvwa/images/login_logo.png\" />    <img src=\"".DVWA_WEB_PAGE_TO_ROOT."dvwa/images/wooyun_logo.png\" height=\"135\" width=\"135\" /></p>

	<br />
	
	<form action=\"login.php\" method=\"post\">
	
	<fieldset>

	<form class=\"form-signin\" role=\"form\" action=\"login.php\" method=\"post\">
        <h2 class=\"form-signin-heading\">Please sign in</h2>
        <input type=\"text\" class=\"form-control\" name=\"username\" placeholder=\"admin\" style=\"width:20%;\" required autofocus>
        <input type=\"password\" class=\"form-control\" name=\"password\" placeholder=\"password\" style=\"width:20%;\" required>
        <button class=\"btn btn-lg btn-primary btn-block\" type=\"submit\" name=\"Login\" style=\"width:20%;\">Sign in</button>
      </form>


	</fieldset>

	</form>

	
	<br />

	{$messagesHtml}

	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />	

	<!-- <img src=\"".DVWA_WEB_PAGE_TO_ROOT."dvwa/images/RandomStorm.png\" /> -->
	
	<footer>
		<p>DVWA Wooyun edition is a Wooyun OpenSource project based on DVWA project</p>
		<p>Damn Vulnerable Web Application (DVWA) is a RandomStorm OpenSource project</p>
	</footer>
	</div> <!-- end align div -->

	</body>

</html>
";

?>
