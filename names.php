<?php

class names {

	public static $version = "1.1.0";


	public function insert($args) {



	}


	public function delete($args) {



	}



	public function update($args) {



	}



	public function version() {

		return self::$version;

	}

}

function insertName($db, $names,$race,$female,$last_name,$contributor) {
	$m = "";

	foreach($names as $name) {
		//              $name = preg_replace('/^\s+([A-Za-z'-])\s+$/', ' ', $name)
		$name = ltrim(rtrim($name));
		$name = mysql_real_escape_string(htmlspecialchars(trim($name,"\x22\x27")));
		if (empty($name))
			continue;

		if (checkName($db, $name,$race,$female,$last_name)) {
			$m .= "Error: name '$name' exists<br />\n";
			continue;
		}

		$contributor= mysql_real_escape_string(htmlspecialchars(trim(rtrim(ltrim($contributor)))));
		if (empty($contributor))
			$contributor = "default";
		mysqli_query($db, "INSERT INTO names(name,race,female,last_name,contributor) VALUES('$name','$race',$female,$last_name,'$contributor')") or die(mysql_error());
		$m .= "Name added successfully<br />\n";
	}
	return $m;
}

function deleteEntry($id) {
	mysqli_query($db, "DELETE FROM names WHERE id=$id") or die(mysql_error());
}

function checkName($db, $name,$race,$female,$last_name) {
	$q = mysqli_query($db, "SELECT COUNT(id) as count FROM names WHERE name = '$name' AND race = '$race' AND female = $female AND last_name = $last_name") or die(mysql_error());
	$row = mysqli_fetch_object($q);
        //print_r($row);
        if ($row->count > 0)
		return true;
	return false;
}

function updateTags($id, $tags) {
	if (empty($id))
		return;
	if (empty($tags))
		return;
	$name = $tags['name'];
	$race = $tags['race'];
	$female = $tags['female'];
	$last_name = $tags['last_name'];
	$query = "";

	if (!empty($name))
		$query .= " SET name = '$name'";
	if (!empty($race))
		$query .= " SET race = '$race'";
	if ($female != null)
		$query .= " SET female = $female";
	if ($last_name != null)
		$query .= " SET last_name = $last_name";

	mysqli_query($db, "UPDATE names $query WHERE id=$id") or die(mysql_error());
}

function deleteDuplicates() {
	$q = mysqli_query($db, "SELECT *, COUNT(*) AS total FROM names GROUP BY race");
	while ($row = mysqli_fetch_object($q)) {
		$max = $row->total-1;
		$name = $row->name;
		$race = $row->race;
		$female = $row->female;
		$last_name = $row->last_name;
		if ($row->total > 1) {
			mysqli_query($db, "DELETE FROM names WHERE name='$name' AND female=$female AND race='$race' AND last_name=$last_name LIMIT $max") or die(mysql_error());
			print "deleted $name";
		}
	}
}

function cleanWhiteSpace($db) {
	$q = mysqli_query($db, "SELECT * FROM names");
	while ($row = mysqli_fetch_object($db, $q))
	{
//		print_r($row);
		$id = $row->id;
		$name = ltrim(rtrim($row->name));
		mysqli_query($db, "UPDATE names SET name = '$name' WHERE id=$id") or die(mysql_error());
	}
}

function dumpList($db) {
	return;
	$q = mysqli_query($db, "SELECT name FROM names WHERE race = 'Human' AND female = 0 AND last_name = 1 ORDER BY name ASC");
	while ($row = mysqli_fetch_object($q))
	{
		print "\"";
		print $row->name;
		print "\",";
	}
}

?>
