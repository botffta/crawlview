<?php 

$regexp_previous = $ini_array['previous'];
$regexp_next = $ini_array['next'];

$previous_url = $xpath->query($regexp_previous);
$next_url = $xpath->query($regexp_next);

show_previous();
for($num = 0; $num<14; $num++)
	echo "&emsp;";
show_next();

?>

<?php
function formatstr($str)
{
	while($str[0]=='.' || $str[0]=='/')
		$str = substr($str, 1);	//去掉开头的.和/字符
	return $str;
}

function show_previous()
{
	global $previous_url;
	global $urlhead;
	$tourl = 'index.php';
	if($previous_url->length == 0)
		echo '<span class="pagebox">上一页</span>';
	else
	{
		echo '<a class="pagebox" href="';
		echo $tourl.'?param='.$urlhead;
		echo formatstr($previous_url->item(0)->nodeValue);
		echo '">上一页</a>';
	}
	echo "\n";
}

function show_next()
{
	global $next_url;
	global $urlhead;
	$tourl = 'index.php';
	if($next_url->length == 0)
		echo '<span class="pagebox">下一页</span>';
	else
	{
		echo '            <a class="pagebox" href="';
		echo $tourl.'?param='.$urlhead;
		echo formatstr($next_url->item(0)->nodeValue);
		echo '">下一页</a>';
	}
	echo "\n";
}
?>
