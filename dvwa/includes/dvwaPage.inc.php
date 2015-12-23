<?php

if( !defined( 'DVWA_WEB_PAGE_TO_ROOT' ) ) {

	define( 'DVWA System error- WEB_PAGE_TO_ROOT undefined' );
	exit;

}


session_start(); // Creates a 'Full Path Disclosure' vuln.


// Include configs
require_once DVWA_WEB_PAGE_TO_ROOT.'config/config.inc.php';

require_once( 'dvwaPhpIds.inc.php' );

// Declare the $html variable
if(!isset($html)){

	$html = "";

}

// Valid security levels
$security_levels = array('low', 'medium', 'high');

if (!isset($_COOKIE['security']) || !in_array($_COOKIE['security'], $security_levels))
{
    // Set security cookie to high if no cookie exists
    if (in_array($_DVWA['default_security_level'], $security_levels))
    {
        setcookie( 'security', $_DVWA['default_security_level'] );
    } else setcookie('security', 'high');
}

// DVWA version
function dvwaVersionGet() {

	return '1.8';

}

// DVWA release date
function dvwaReleaseDateGet() {

	return '11/01/2011';

}


// Start session functions -- 

function &dvwaSessionGrab() {

	if( !isset( $_SESSION[ 'dvwa' ] ) ) {

		$_SESSION[ 'dvwa' ] = array();

	}

	return $_SESSION[ 'dvwa' ];
}


function dvwaPageStartup( $pActions ) {

	if( in_array( 'authenticated', $pActions ) ) {

		if( !dvwaIsLoggedIn()){

			dvwaRedirect( DVWA_WEB_PAGE_TO_ROOT.'login.php' );

		}
	}

	if( in_array( 'phpids', $pActions ) ) {

		if( dvwaPhpIdsIsEnabled() ) {

			dvwaPhpIdsTrap();

		}
	}
}


function dvwaPhpIdsEnabledSet( $pEnabled ) {

	$dvwaSession =& dvwaSessionGrab();

	if( $pEnabled ) {

		$dvwaSession[ 'php_ids' ] = 'enabled';

	} else {

		unset( $dvwaSession[ 'php_ids' ] );

	}
}


function dvwaPhpIdsIsEnabled() {

	$dvwaSession =& dvwaSessionGrab();

	return isset( $dvwaSession[ 'php_ids' ] );

}


function dvwaLogin( $pUsername ) {

	$dvwaSession =& dvwaSessionGrab();

	$dvwaSession['username'] = $pUsername;

}


function dvwaIsLoggedIn() {

	$dvwaSession =& dvwaSessionGrab();

	return isset( $dvwaSession['username'] );

}


function dvwaLogout() {

	$dvwaSession =& dvwaSessionGrab();

	unset( $dvwaSession['username'] );

}


function dvwaPageReload() {

	dvwaRedirect( $_SERVER[ 'PHP_SELF' ] );

}

function dvwaCurrentUser() {

	$dvwaSession =& dvwaSessionGrab();

	return ( isset( $dvwaSession['username']) ? $dvwaSession['username'] : '') ;

}

// -- END

function &dvwaPageNewGrab() {

	$returnArray = array(
		'title' => 'Damn Vulnerable Web App (DVWA) v'.dvwaVersionGet().'',
		'title_separator' => ' :: ',
		'body' => '',
		'page_id' => '',
		'help_button' => '',
		'source_button' => '',
	);

	return $returnArray;
}


function dvwaSecurityLevelGet() {

	return isset( $_COOKIE[ 'security' ] ) ? $_COOKIE[ 'security' ] : 'low';

}



function dvwaSecurityLevelSet( $pSecurityLevel ) {

	setcookie( 'security', $pSecurityLevel );

}



// Start message functions -- 
function dvwaMessagePush( $pMessage ) {

	$dvwaSession =& dvwaSessionGrab();

	if( !isset( $dvwaSession[ 'messages' ] ) ) {

		$dvwaSession[ 'messages' ] = array();

	}

	$dvwaSession[ 'messages' ][] = $pMessage;
}



function dvwaMessagePop() {

	$dvwaSession =& dvwaSessionGrab();

	if( !isset( $dvwaSession[ 'messages' ] ) || count( $dvwaSession[ 'messages' ] ) == 0 ) {

		return false;

	}

	return array_shift( $dvwaSession[ 'messages' ] );
}


function messagesPopAllToHtml() {

	$messagesHtml = '';

	while( $message = dvwaMessagePop() ) {	// TODO- sharpen!

		$messagesHtml .= "<div class=\"message\">{$message}</div>";

	}

	return $messagesHtml;
}
// --END

function dvwaHtmlEcho( $pPage ) {

	$menuBlocks = array();

	$menuBlocks['home'] = array();
	$menuBlocks['home'][] = array( 'id' => 'home', 'name' => 'Home', 'url' => '.' );
	$menuBlocks['home'][] = array( 'id' => 'instructions', 'name' => 'Instructions', 'url' => 'instructions.php' );

	$menuBlocks['vulnerabilities'] = array();

	$menuBlocks['vulnerabilities'][] = array( 'id' => 'WooYun-2014-63321', 'name' => 'Regex #02-Domain too', 'url' => 'vulnerabilities/WooYun-2014-63321/.' );
	$menuBlocks['vulnerabilities'][] = array( 'id' => 'WooYun-2014-61978', 'name' => 'CSRF #01-Flash Upload', 'url' => 'vulnerabilities/WooYun-2014-61978/.' );
	$menuBlocks['vulnerabilities'][] = array( 'id' => 'WooYun-2014-61361', 'name' => 'Sqli QUERY_STRING', 'url' => 'vulnerabilities/WooYun-2014-61361/.' );
	$menuBlocks['vulnerabilities'][] = array( 'id' => 'WooYun-2014-59940', 'name' => 'Regex #01-Domain fraud', 'url' => 'vulnerabilities/WooYun-2014-59940/.' );
	$menuBlocks['vulnerabilities'][] = array( 'id' => 'WooYun-2014-53384', 'name' => 'Sqli filter #02-Once', 'url' => 'vulnerabilities/WooYun-2014-53384/.' );
	$menuBlocks['vulnerabilities'][] = array( 'id' => 'WooYun-2014-52257', 'name' => 'Sqli Mysql #01', 'url' => 'vulnerabilities/WooYun-2014-52257/.' );
	$menuBlocks['vulnerabilities'][] = array( 'id' => 'WooYun-2014-52248', 'name' => 'No [Comma] Sqli', 'url' => 'vulnerabilities/WooYun-2014-52248/.' );
	$menuBlocks['vulnerabilities'][] = array( 'id' => 'WooYun-2014-51950', 'name' => 'Sqli using [Slashes]', 'url' => 'vulnerabilities/WooYun-2014-51950/.' );
	$menuBlocks['vulnerabilities'][] = array( 'id' => 'WooYun-2014-51687', 'name' => 'Sqli filter #02-80sec', 'url' => 'vulnerabilities/WooYun-2014-51687/.' );
	$menuBlocks['vulnerabilities'][] = array( 'id' => 'WooYun-2014-51536', 'name' => 'XSS #08-mXSS', 'url' => 'vulnerabilities/WooYun-2014-51536/.' );
	$menuBlocks['vulnerabilities'][] = array( 'id' => 'WooYun-2014-51505', 'name' => 'Sqli filter #01', 'url' => 'vulnerabilities/WooYun-2014-51505/.' );
	$menuBlocks['vulnerabilities'][] = array( 'id' => 'WooYun-2014-50644', 'name' => 'No [Space] Sqli', 'url' => 'vulnerabilities/WooYun-2014-50644/.' );
	$menuBlocks['vulnerabilities'][] = array( 'id' => 'WooYun-2014-50315', 'name' => 'XSS #07-SVG', 'url' => 'vulnerabilities/WooYun-2014-50315/.' );
	$menuBlocks['vulnerabilities'][] = array( 'id' => 'WooYun-2013-34885', 'name' => 'Contradiction #01', 'url' => 'vulnerabilities/WooYun-2013-34885/.' );
	$menuBlocks['vulnerabilities'][] = array( 'id' => 'WooYun-2013-31669', 'name' => 'Indirect SQLi #01', 'url' => 'vulnerabilities/WooYun-2013-31669/.' );
	$menuBlocks['vulnerabilities'][] = array( 'id' => 'WooYun-2013-20759', 'name' => 'Decrypt #01-CCA2', 'url' => 'vulnerabilities/WooYun-2013-20759/.' );
	$menuBlocks['vulnerabilities'][] = array( 'id' => 'WooYun-2013-19115', 'name' => 'Workflow #1-302', 'url' => 'vulnerabilities/WooYun-2013-19115/.' );
	$menuBlocks['vulnerabilities'][] = array( 'id' => 'WooYun-2012-16598', 'name' => 'XSS #06-Flash02', 'url' => 'vulnerabilities/WooYun-2012-16598/.' );
	$menuBlocks['vulnerabilities'][] = array( 'id' => 'WooYun-2012-16532', 'name' => 'XSS #05-Flash01', 'url' => 'vulnerabilities/WooYun-2012-16532/.' );
	$menuBlocks['vulnerabilities'][] = array( 'id' => 'WooYun-2012-16041', 'name' => 'XSS #04-Encoding', 'url' => 'vulnerabilities/WooYun-2012-16041/.' );
	$menuBlocks['vulnerabilities'][] = array( 'id' => 'WooYun-2012-16003', 'name' => 'XSS #03-InComment', 'url' => 'vulnerabilities/WooYun-2012-16003/.' );
	$menuBlocks['vulnerabilities'][] = array( 'id' => 'WooYun-2012-15979', 'name' => 'XSS #02-TwoVars', 'url' => 'vulnerabilities/WooYun-2012-15979/.' );
	$menuBlocks['vulnerabilities'][] = array( 'id' => 'WooYun-2012-15969', 'name' => 'XSS #01-GBK', 'url' => 'vulnerabilities/WooYun-2012-15969/.' );
	$menuBlocks['vulnerabilities'][] = array( 'id' => 'WooYun-2011-02236', 'name' => 'LFI+log', 'url' => 'vulnerabilities/WooYun-2011-02236/.' );
	$menuBlocks['vulnerabilities'][] = array( 'id' => 'Drops-1015', 'name' => 'Linux pentest tricks', 'url' => 'vulnerabilities/Drops-1015/.' );

	$menuBlocks['meta'] = array();
	$menuBlocks['meta'][] = array( 'id' => 'about', 'name' => 'About', 'url' => 'about.php' );

	$menuBlocks['logout'] = array();
	$menuBlocks['logout'][] = array( 'id' => 'logout', 'name' => 'Logout', 'url' => 'logout.php' );

	$menuHtml = '';

	foreach( $menuBlocks as $menuBlock ) {

		$menuBlockHtml = '';

		foreach( $menuBlock as $menuItem ) {

			$selectedClass = ( $menuItem[ 'id' ] == $pPage[ 'page_id' ] ) ? 'list-group-item active' : 'list-group-item';

			$fixedUrl = DVWA_WEB_PAGE_TO_ROOT.$menuItem['url'].'#here_body';

			$menuBlockHtml .= "<a href=\"{$fixedUrl}\" onclick=\"window.location='{$fixedUrl}'\" class=\"{$selectedClass}\">{$menuItem['name']}</a>";

		}

		$menuHtml .= "<ul>{$menuBlockHtml}</ul>";
	}

	
	// Get security cookie --
	$securityLevelHtml = '';

	switch( dvwaSecurityLevelGet() ) {

		case 'low':
			$securityLevelHtml = 'low';
			break;

		case 'medium':
			$securityLevelHtml = 'medium';
			break;

		case 'high':
			$securityLevelHtml = 'high';
			break;
		default:
			$securityLevelHtml = 'low';
			break;
	}
	// -- END
	
	$phpIdsHtml = '<b>PHPIDS:</b> '.( dvwaPhpIdsIsEnabled() ? 'enabled' : 'disabled' );

	$userInfoHtml = '<b>Username:</b> '.( dvwaCurrentUser() );

	$messagesHtml = messagesPopAllToHtml();

	if( $messagesHtml ) {

		$messagesHtml = "<div class=\"body_padded\">{$messagesHtml}</div>";

	}
	
	$systemInfoHtml = "<div align=\"left\">{$userInfoHtml}<br /><b>Security Level:</b> {$securityLevelHtml}<br />{$phpIdsHtml}</div>";

	if( $pPage[ 'source_button' ] ) {

		$systemInfoHtml = dvwaButtonSourceHtmlGet( $pPage[ 'source_button' ] )." $systemInfoHtml";

	}

	if( $pPage[ 'help_button' ] ) {

		$systemInfoHtml = dvwaButtonHelpHtmlGet( $pPage[ 'help_button' ] )." $systemInfoHtml";

	}
	
	
	// Send Headers + main HTML code
	Header( 'Cache-Control: no-cache, must-revalidate');		// HTTP/1.1
	Header( 'Content-Type: text/html;charset=utf-8' );		// TODO- proper XHTML headers...
	Header( "Expires: Tue, 23 Jun 2009 12:00:00 GMT");		// Date in the past

	echo "
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">

<html xmlns=\"http://www.w3.org/1999/xhtml\">

	<head>
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />

		<title>{$pPage['title']}</title>

		<link rel=\"stylesheet\" type=\"text/css\" href=\"".DVWA_WEB_PAGE_TO_ROOT."dvwa/css/main.css\" />

		<link rel=\"stylesheet\" type=\"text/css\" href=\"".DVWA_WEB_PAGE_TO_ROOT."dvwa/css/bootstrap.min.css\" />
		<link rel=\"stylesheet\" type=\"text/css\" href=\"".DVWA_WEB_PAGE_TO_ROOT."dvwa/css/bootstrap-theme.min.css\" />
		<link rel=\"stylesheet\" type=\"text/css\" href=\"".DVWA_WEB_PAGE_TO_ROOT."dvwa/css/navbar-fixed-top.css\" />

		<link rel=\"icon\" type=\"\image/ico\" href=\"".DVWA_WEB_PAGE_TO_ROOT."favicon.ico\" />

		<script type=\"text/javascript\" src=\"".DVWA_WEB_PAGE_TO_ROOT."dvwa/js/dvwaPage.js\"></script>

	</head>

	<body class=\"home\">

			<div id=\"header\" style=\"text-align:center;\">

				<img src=\"".DVWA_WEB_PAGE_TO_ROOT."dvwa/images/wooyun_logo.jpg\" alt=\"WooYun DVWA\" height=\"200\" width=\"800\"/>

			</div>

		<div id=\"container\" align=\"center\">

    <div class=\"navbar navbar-default navbar-fixed-top\" role=\"navigation\" >
      <div class=\"container\">
        <div class=\"navbar-header\">
          <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\".navbar-collapse\">
            <span class=\"sr-only\">Toggle navigation</span>
            <span class=\"icon-bar\"></span>
            <span class=\"icon-bar\"></span>
            <span class=\"icon-bar\"></span>
          </button>
          <a class=\"navbar-brand\" href=\"#\">DVWA WooYun</a>
        </div>
        <div class=\"navbar-collapse collapse\">
          <ul class=\"nav navbar-nav\">
            <li><a href=\"/\">Home</a></li>
            <li><a href=\"http://wooyun.org\">Wooyun</a></li>
            <li><a href=\"/instructions.php#here_body\">Instructions</a></li>
          </ul>
          <ul class=\"nav navbar-nav navbar-right\">
            <li><a href=\"/about.php#here_body\">About</a></li>
            <li><a href=\"/logout.php\">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

<a name=\"here_body\"></a><!-- 定义锚点 -->  
<br>
<br>
<br>

			<div id=\"main_menu\" style=\"width:20%;float:left;padding-left: 15px;\">

				<div class=\"row\">
					<div class=\"list-group\">
						{$menuHtml}
					</div>
				</div>

			</div>

			<div id=\"main_body\" style=\"width:75%;float:right\">

				{$pPage['body']}
				<br />
				<br />
				{$messagesHtml}
				{$systemInfoHtml}

			</div>

			<div class=\"clear\">
			</div>

			<div id=\"footer\">

				<p>WooYun DVWA v".dvwaVersionGet()."</p>

			</div>

		</div>

	</body>

</html>";
}


function dvwaHelpHtmlEcho( $pPage ) {
	// Send Headers
	Header( 'Cache-Control: no-cache, must-revalidate');		// HTTP/1.1
	Header( 'Content-Type: text/html;charset=utf-8' );		// TODO- proper XHTML headers...
	Header( "Expires: Tue, 23 Jun 2009 12:00:00 GMT");		// Date in the past

	echo "
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">

<html xmlns=\"http://www.w3.org/1999/xhtml\">

	<head>

		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />

		<title>{$pPage['title']}</title>

		<link rel=\"stylesheet\" type=\"text/css\" href=\"".DVWA_WEB_PAGE_TO_ROOT."dvwa/css/help.css\" />

		<link rel=\"icon\" type=\"\image/ico\" href=\"".DVWA_WEB_PAGE_TO_ROOT."favicon.ico\" />

	</head>

	<body>
	
	<div id=\"container\">

			{$pPage['body']}

		</div>

	</body>

</html>";
}


function dvwaSourceHtmlEcho( $pPage ) {
	// Send Headers
	Header( 'Cache-Control: no-cache, must-revalidate');		// HTTP/1.1
	Header( 'Content-Type: text/html;charset=utf-8' );		// TODO- proper XHTML headers...
	Header( "Expires: Tue, 23 Jun 2009 12:00:00 GMT");		// Date in the past

	echo "
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">

<html xmlns=\"http://www.w3.org/1999/xhtml\">

	<head>

		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />

		<title>{$pPage['title']}</title>

		<link rel=\"stylesheet\" type=\"text/css\" href=\"".DVWA_WEB_PAGE_TO_ROOT."dvwa/css/source.css\" />

		<link rel=\"icon\" type=\"\image/ico\" href=\"".DVWA_WEB_PAGE_TO_ROOT."favicon.ico\" />

	</head>

	<body>

		<div id=\"container\">

			{$pPage['body']}

		</div>

	</body>

</html>";
}

// To be used on all external links --
function dvwaExternalLinkUrlGet( $pLink,$text=null ) {

	if (is_null($text)){

		return '<a href="'.$pLink.'" target="_blank">'.$pLink.'</a>';

	}

	else {

		return '<a href="'.$pLink.'" target="_blank">'.$text.'</a>';

	}
}
// -- END

function dvwaButtonHelpHtmlGet( $pId ) {

	$security = dvwaSecurityLevelGet();

	return "<input type=\"button\" value=\"View Help\" class=\"popup_button btn btn-lg btn-primary\" onClick=\"javascript:popUp( '".DVWA_WEB_PAGE_TO_ROOT."vulnerabilities/view_help.php?id={$pId}&security={$security}' )\">";

}


function dvwaButtonSourceHtmlGet( $pId ) {

	$security = dvwaSecurityLevelGet();

	return "<input type=\"button\" value=\"View Source\" class=\"popup_button btn btn-lg btn-primary\" onClick=\"javascript:popUp( '".DVWA_WEB_PAGE_TO_ROOT."vulnerabilities/view_source.php?id={$pId}&security={$security}' )\">";

}

// Database Management --

if ($DBMS == 'MySQL') {

 $DBMS = htmlspecialchars(strip_tags($DBMS));

 $DBMS_errorFunc = 'mysql_error()';

}
elseif ($DBMS == 'PGSQL') {

 $DBMS = htmlspecialchars(strip_tags($DBMS));

 $DBMS_errorFunc = 'pg_last_error()';

}
else {

 $DBMS = "No DBMS selected.";

 $DBMS_errorFunc = '';

}

$DBMS_connError = '<div align="center">
		<img src="'.DVWA_WEB_PAGE_TO_ROOT.'dvwa/images/logo.png">
		<pre>Unable to connect to the database.<br>'.$DBMS_errorFunc.'<br /><br /></pre>
		Click <a href="'.DVWA_WEB_PAGE_TO_ROOT.'setup.php">here</a> to setup the database.
		</div>';

function dvwaDatabaseConnect() {

	global $_DVWA;
	global $DBMS;
	global $DBMS_connError;

	if ($DBMS == 'MySQL') {

		if( !@mysql_connect( $_DVWA[ 'db_server' ], $_DVWA[ 'db_user' ], $_DVWA[ 'db_password' ] )
		|| !@mysql_select_db( $_DVWA[ 'db_database' ] ) ) {
			die( $DBMS_connError );
		}

	}
	
	elseif ($DBMS == 'PGSQL') {

		$dbconn = pg_connect("host=".$_DVWA[ 'db_server' ]." dbname=".$_DVWA[ 'db_database' ]." user=".$_DVWA[ 'db_user' ]." password=".$_DVWA[ 'db_password' ])
		or die( $DBMS_connError );

	}
}

// -- END


function dvwaRedirect( $pLocation ) {

	session_commit();
	header( "Location: {$pLocation}" );
	exit;

}

// XSS Stored guestbook function --
function dvwaGuestbook(){

	$query  = "SELECT name, comment FROM guestbook";
	$result = mysql_query($query);

	$guestbook = '';
	
	while($row = mysql_fetch_row($result)){	
		
		if (dvwaSecurityLevelGet() == 'high'){

			$name    = htmlspecialchars($row[0]);
			$comment = htmlspecialchars($row[1]);
	
		}

		else {

			$name    = $row[0];
			$comment = $row[1];

		}
		
		$guestbook .= "<div id=\"guestbook_comments\">Name: {$name} <br />" . "Message: {$comment} <br /></div>";
	} 
	
return $guestbook;
}
// -- END


?>
