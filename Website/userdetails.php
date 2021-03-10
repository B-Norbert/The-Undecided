<?php

include './data/db.php';
include './navbar.php';

if(!isset($_SESSION['user_login']))	//check unauthorize user not access in "welcome.php" page
{
    header("location: ../../index.php");
}
echo "<div class='form'>";
echo "<tr><form action='../../data/user_update.php' method='POST'>";
echo "<td>".$row['email']."</td><br />";
echo "<td><input type='text' name='first_name' value='".$row['first_name']."'></td><br />";
echo "<td><input type='text' name='last_name' value='".$row['last_name']."'></td><br />";
echo "<td>".$row['username']."</td><br />";
echo "<td>".$row['created']."</td><br />";
echo "<td><button type='submit' class='button' >Change Details</td><br />";
echo "</form></tr>";


?>