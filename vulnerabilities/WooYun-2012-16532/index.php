<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'WooYun-2012-16532';
$page[ 'page_id' ] = 'WooYun-2012-16532';

dvwaDatabaseConnect();

$vulnerabilityFile = '';
switch( $_COOKIE[ 'security' ] ) {
	case 'low':
		$vulnerabilityFile = 'low.php';
		break;

	case 'medium':
		$vulnerabilityFile = 'medium.php';
		break;

	case 'high':
	default:
		$vulnerabilityFile = 'high.php';
		break;
}

require_once DVWA_WEB_PAGE_TO_ROOT."vulnerabilities/WooYun-2012-16532/source/{$vulnerabilityFile}";

$page[ 'help_button' ] = 'WooYun-2012-16532';
$page[ 'source_button' ] = 'WooYun-2012-16532';

$magicQuotesWarningHtml = '';

// Check if Magic Quotes are on or off
if( ini_get( 'magic_quotes_gpc' ) == true ) {
	$magicQuotesWarningHtml = "	<div class=\"warning\">Magic Quotes are on, you will not be able to inject SQL.</div>";
}

$page[ 'body' ] .= "
<div class=\"body_padded\">

	<HeadlineFont><span class=\"label label-primary\">WooYun-2012-16532</span></HeadlineFont>

	<br>	<br>	<br>	<br>	<br>

	{$magicQuotesWarningHtml}

	<div class=\"vulnerable_code_area\">
		<div class=\"well\">
		请使用IE或者其他支持flash的浏览器（不要禁止flash的使用！）:
		</div>
		<h3>输入点什么:</h3>

		<form action=\"WooYun-2012-16532.swf\" method=\"GET\">
			<input type=\"text\" name=\"func\" class=\"form-control\" style=\"width:50%;\">
			<input type=\"submit\" name=\"Submit\" value=\"Submit\" class=\"btn btn-lg btn-info\">
		</form>

		{$html}


	</div>

	<br>
	<br>
	<br>
	<div class=\"panel panel-primary\">
            <div class=\"panel-heading\">
              <h3 class=\"panel-title\">Original Bug Report</h3>
            </div>
            <div class=\"panel-body\">
              	<li>".dvwaExternalLinkUrlGet( 'http://www.wooyun.org/bugs/wooyun-2010-016532')."</li>
            </div>
       </div>

</div>
";

dvwaHtmlEcho( $page );

?>
