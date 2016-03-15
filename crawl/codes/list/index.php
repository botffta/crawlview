<?php require_once "../head.php"; ?>


<body>
<!--menu-->
<div id="header">
	<div class="menu">
	</div>
	<div class="menu">
	</div>
</div>

<div id="body">
	<div class="listname">
	<center>
<?php	//list content
require_once "listname.php"; 
$listname = new Listname("../regexps.ini");	//get exps from ini document
$listname->listall();	//list
?>
	</center>
	</div>
	<div class="page">
	<center>
<?php	//list page
require_once "page.php"; 
$page = new Page($listname);	
$page->listall();	//list
?>	
	</center>
	</div>
</div>


</body>

<?php 
include_once("../tail.php");
?>
