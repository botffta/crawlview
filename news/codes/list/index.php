<?php require_once "../head.php"; ?>
<?php $ini_array = parse_ini_file("regexps.ini"); ?>

<body>

<div id="header">
	<div class="menu">
	</div>
	<div class="menu">
	</div>
</div>

<div id="body">
	<div class="listname">
	<center>
<?php require_once "listname.php"; ?>	<!--输出列表-->
	</center>
	</div>
	<div class="page">
<?php require_once "page.php"; ?>	<!--输出页码-->
	</div>
</div>


</body>

<?php 
include_once("../tail.php");
?>
