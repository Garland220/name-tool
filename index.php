<?php

error_reporting(E_ALL);
ini_set('display_errors','On');

require_once('config.php');
require_once('functions.php');

$v = "v0.5a";
$e = "";
$n = "";

// cleanWhiteSpace();
// deleteDuplicates();
// dumpList();

if (!empty($_GET['delete']))
	deleteEntry($_GET['delete']);
if (!empty($_GET['update']))
	updateTags($_GET['update'], $_GET);

if (!empty($_POST['Names'])) {
	$names = explode(",",$_POST['Names']);
	$race = $_POST['Race'];
	if (!empty($_POST['Contributor']))
		$contributor = $_POST['Contributor'];

	$female = 0;
	if (!empty($_POST['Female']))
                $female = 1;

	$last = 0;
	if (!empty($_POST['Last']))
		$last = 1;

	$e = insertName($names,$race,$female,$last,$contributor);
}
$n = mysqli_query($db, "SELECT * FROM names ORDER BY race,female,last_name,name");
$c = mysqli_fetch_object(mysql_query($db, "SELECT COUNT(id) as count FROM names"));

?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="resources/css/default.css" />
		<title>Name Contributor <? print $v; ?></title>
		<script type="text/javascript" src="resources/js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="resources/js/util.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				if (readCookie("contrib") != null){
					contrib = readCookie("contrib");
					$("#Contributor").val(contrib);
				}
			});
		</script>
	</head>
	<body>
		<h1>Name Contributor <? print $v; ?></h1>
		<div><? print $e; ?></div>
		<form method="post" action="/">
			<input type="text" name="Contributor" id="Contributor" placeholder="Your Name!" onChange="createCookie('contrib', $('#Contributor').val(), 30);" /><label for="Contributor"> This is YOUR name. Used to identify who added these names</label><br />
			<textarea name="Names" id="Names" placeholder="Names go here (Comma-separated)" style="resize: none; width: 400px; height: 75px;"></textarea><br /><br />
			<select name="Race" id="Race">
				<option value="Human">Human</option>
				<option value="Human - Asian">Human - Asian</option>
				<option vlaue="Human - German">Human - German</option>
				<option value="Human - Spanish">Human - Spanish</option>
				<option value="Human - Nordic">Human - Nordic</option>
				<option value="Human - Russian">Human - Russian</option>
				<option value="Dwarf">Dwarf</option>
				<option value="Elf">Elf</option>
				<option value="Drow">Drow (Dark-Elf)</option>
				<option value="Orc">Orc</option>
				<option value="Gnome">Gnome</option>
				<option value="Halfling">Halfling</option>
				<option value="Gnoll">Gnoll</option>
				<option value="Demon">Demon</option>
				<option value="Dragon">Dragon</option>
			</select><label for="Race"> Race</label><br />
			<input type="checkbox" name="Female" id="Female" /><label for="Female"> Female</label><br />
			<input type="checkbox" name="Last" id="Last" /><label for="Last"> Last Name</label><br /><br />
			<input type="submit" name="submit" id="submit" value="Submit" />
		</form>
		<div>
		<?php
			if ($n != "")
			{
				print "Names submitted (<strong>$c->count</strong>):<br />\n<hr />";
				while ($list = mysqli_fetch_object($n))
				{
					//print "<a href=\"?delete=$list->id\">[delete] - </a>";
					print "<span class=\"";
					if ($list->last_name)
						print "last_name";
					else if ($list->female)
						print "female_name";
					else
						print "male_name";
					print "\">";
					print $list->name." : ".$list->race."</span>";
					$female = !$list->female;
					if (empty($female)) $female = 0;
					//print "<a href=\"?update=$list->id&female=$female\"> [change gender]</a>";
					print "<br />\n";
				}
				print "<hr />\n";
			}
		?>
		</div>
	</body>
</html>
