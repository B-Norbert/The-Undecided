<?php
include('data/db.php');

$query = '';

$output = array();

$query .= "
SELECT * FROM accounts
WHERE user_level >= '0' AND 
";

if(isset($_POST["search"]["value"]))
{
	$query .= '(email LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR username LIKE "%'.$_POST["search"]["value"].'%") ';
}

if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id DESC ';
}

if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $pdo->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$data = array();

$filtered_rows = $statement->rowCount();

foreach($result as $row)
{
	$user_level = '';
	if($row["user_level"] == 1)
	{
		$user_level = 'N/A';
	}
	else
	{
		$user_level = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
	}

	$user_data = array();
	$user_data[] = $row['id'];
	$user_data[] = $row['email'];
	$user_data[] = $row['username'];
	$user_data[] = $row['first_name'];
	$user_data[] = $row['appointment'];
	$user_data[] = '<button type="button" name="update" id="'.$row["id"].'" class="btn btn-warning btn-xs update">Update</button>';	
	$user_data[] = $user_level;
	$data[] = $user_data;
}

$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"  	=>  $filtered_rows,
	"recordsFiltered" 	=> 	get_total_all_records($pdo),
	"data"    			=> 	$data
);
echo json_encode($output);

function get_total_all_records($pdo)
{
	$statement = $pdo->prepare("SELECT * FROM accounts");
	$statement->execute();
	return $statement->rowCount();
}

?>