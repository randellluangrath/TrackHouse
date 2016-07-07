<!DOCTYPE html>
<html>
<head>
<style type="text/css">
table
{
	font-family: "Trebuchet MS", Verdana, sans-serif;
	margin: 20px auto;
	width: 100%;
	border-collapse: collapse;
	text-align: center;
	overflow: scroll;
}
table, td, th
{
	padding: 5px;
}
th 
{
	text-align: center;
}
</style>

</head>

<body>

<?php
// get value
$q = ($_GET['q']);
// variable declarations
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "trackhouse_db";

// create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// validate connection
if($connection->connect_error){
	// if no connection, kill
	die("Connection Failed:" . connect_error);
}
// if "#" button is selected, search for all numbers in trackhouse_db
		else
			if($q == 'num'){ 
				$sql = "select * from words where word > 0 
					order by frequency desc limit 50";

}
// else respective button is searched for in trackhouse_db
						else
							$sql = "select * from words where word like '".$q."%' 
								order by frequency desc limit 50";



$result = $connection->query($sql);

if ($result->num_rows > 0){
$count = 1;

// output column names
echo '
<table class="table table-striped table-hover">
<tr>
<th><b>#</b></th>
<th><b>Word</b></th>
<th><b>Frequency</b></th>
</tr>';

// while loop to output rows
	while($row = $result->fetch_assoc()){

		echo "<tr>";
		echo "<td>" . $count . "</td>";
		echo "<td>" . $row['word'] . "</td>";
		echo "<td>" . $row['frequency'] . "</td>";
		$count++;
	}
echo '</table>';
}
else
	echo '<h1 class="center" id="table-h">No results...</h1>';


// close connection
mysqli_close($connection);

?>

</body>
</html>