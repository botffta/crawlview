<?php 

$urltarget = $_GET['param'];
$regexp_name = $ini_array['name'];
$regexp_url = $ini_array['url'];
$regexp_date = $ini_array['date'];

$dom = new DOMDocument;
@$dom->loadHTMLFile($urltarget);
$xpath = new DOMXPath($dom);
$names = $xpath->query($regexp_name);
$urls = $xpath->query($regexp_url);
$dates = $xpath->query($regexp_date);

$num = 0;
$toview = $ini_array['toview'];
$urlhead = $ini_array['urlhead'];
foreach($names as $name)
{
	echo "<ul>\n";
	echo '<a target="_blank" href="';
	echo $toview.$urls->item($num)->nodeValue;
	echo '">';
	echo $name->nodeValue;
	echo "</a>\n";
	echo "&emsp;".'<font>'.$dates->item($num)->nodeValue;
	echo '</ul>';
	$num++;
}

?>
