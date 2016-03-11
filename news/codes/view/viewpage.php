<?php require_once("../head.php"); ?>

<?php
$urltarget = $_GET["param"];
$ini_array = parse_ini_file("regexps.ini");
$regexp = $ini_array['passage'];
?>


<body>
<div id="header">
	<div class="menu">
	</div>
	<div class="menu">
	</div>
</div>

<div id="body">
	<div class="passage">
<?php
$ucontent = file_get_contents($urltarget);
//$ucontent = htmlentities($ucontent);//处理内容含有实体引用&的Warning
$res = mb_convert_encoding($ucontent, 'HTML-ENTITIES', 'UTF-8');//解决乱码
$dom = new DOMDocument;
@$dom->loadHTML($res);
$xpath = new DOMXPath($dom);
$contents = $xpath->query($regexp);
foreach($contents as $c)
{
	echo '<p>';
	print($c->nodeValue);
	echo '</p>';
}

?>
	</div>
</div>


</body>


<?php require_once("../tail.php"); ?>
