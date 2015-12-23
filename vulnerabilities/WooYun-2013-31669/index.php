<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'WooYun-2013-31669';
$page[ 'page_id' ] = 'WooYun-2013-31669';

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

require_once DVWA_WEB_PAGE_TO_ROOT."vulnerabilities/WooYun-2013-31669/source/{$vulnerabilityFile}";

$page[ 'help_button' ] = 'WooYun-2013-31669';
$page[ 'source_button' ] = 'WooYun-2013-31669';

$magicQuotesWarningHtml = '';

// Check if Magic Quotes are on or off
if( ini_get( 'magic_quotes_gpc' ) == true ) {
	$magicQuotesWarningHtml = "	<div class=\"warning\">Magic Quotes are on, you will not be able to inject SQL.</div>";
}

$page[ 'body' ] .= "
<div class=\"body_padded\">

	<HeadlineFont><span class=\"label label-primary\">WooYun-2013-31669</span></HeadlineFont>

	<br>	<br>	<br>	<br>	<br>

	{$magicQuotesWarningHtml}

	<div class=\"vulnerable_code_area\">

		<div class=\"well\">
		We used cookie to simulate the db in&out,you can view your own cookie to see what's inside your database.And bear in mind you don't actually have the data shown in your cookies
		我们使用了cookie来模拟数据库输入与输出，你可以直接查看你的cookie看到数据库里存储了什么，不过要记住在现实环境下你是不知道这些信息的！
		</div>

		<h3>Login User ID:</h3>


		<form action=\"#\" method=\"GET\">
			<input type=\"text\" name=\"id\" class=\"form-control\" style=\"width:50%;\">
			<input type=\"submit\" name=\"Submit\" value=\"login\" class=\"btn btn-lg btn-info\">
		</form>
		<br>
		<h3>编辑用户名:</h3>

		<form action=\"#\" method=\"GET\">
			<input type=\"text\" name=\"name\" class=\"form-control\" style=\"width:50%;\">
			<input type=\"submit\" name=\"Submit\" value=\"edit\" class=\"btn btn-lg btn-info\">
		</form>

		<br>
		<h3>查看用户信息:</h3>

		<form action=\"#\" method=\"GET\">
			<input type=\"submit\" name=\"Submit\" value=\"view\" class=\"btn btn-lg btn-info\">
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
              	<li>".dvwaExternalLinkUrlGet( 'http://www.wooyun.org/bugs/wooyun-2010-031669')."</li>
            </div>
       </div>

</div>
";

dvwaHtmlEcho( $page );

?>
