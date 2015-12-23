<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'WooYun-2014-61978';
$page[ 'page_id' ] = 'WooYun-2014-61978';

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

require_once DVWA_WEB_PAGE_TO_ROOT."vulnerabilities/WooYun-2014-61978/source/{$vulnerabilityFile}";

$page[ 'help_button' ] = 'WooYun-2014-61978';
$page[ 'source_button' ] = 'WooYun-2014-61978';

$magicQuotesWarningHtml = '';

// Check if Magic Quotes are on or off
if( ini_get( 'magic_quotes_gpc' ) == true ) {
	$magicQuotesWarningHtml = "	<div class=\"warning\">Magic Quotes are on, you will not be able to inject SQL.</div>";
}

$page[ 'body' ] .= "
<div class=\"body_padded\">

	<HeadlineFont><span class=\"label label-primary\">WooYun-2014-61978</span></HeadlineFont>

	<br>	<br>	<br>	<br>	<br>

	{$magicQuotesWarningHtml}

	<div class=\"vulnerable_code_area\">

		<div class=\"well\">
		有很多种方式可以获取“机密信息” , 你能用乌云知识库文章中的方式 试一试嘛?
		</div>

		<form action=\"#\" method=\"GET\">
			<input type=\"submit\" name=\"Submit\" value=\"AllowAccess\" class=\"btn btn-lg btn-info\">
		</form>
		<br>

		<form action=\"#\" method=\"GET\">
			<input type=\"submit\" name=\"Submit\" value=\"ViewSecret\" class=\"btn btn-lg btn-info\">
		</form>
		<br>
		
		<div class=\"well\">
		实际上，我没办法模拟得非常好，你能做的只有按下这个按钮...
		</div>
	
		<br>
		<form action=\"test.html\" method=\"GET\">
			<input type=\"submit\" name=\"Submit\" value=\"press\" class=\"btn btn-lg btn-info\">
		</form>
		<br>
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
              	<li>".dvwaExternalLinkUrlGet( 'http://drops.wooyun.org/tips/2031')."</li>
			<li>".dvwaExternalLinkUrlGet( 'http://www.wooyun.org/bugs/wooyun-2010-061978')."</li>
            </div>
       </div>

</div>
";

dvwaHtmlEcho( $page );

?>
