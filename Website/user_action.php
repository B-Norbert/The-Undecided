<?php


include('data/db.php'); // file that has all the database connection

if(isset($_POST['btn_action']))
{
	// This section of the code is used for adding/creating user accounts that are directly going to the database 
	if($_POST['btn_action'] == 'Add')
	{
		if($_POST['appointment'] == 'MD & Chairman of G4U Board')
		{
			$query = "
			INSERT INTO accounts (email, password, username, appointment, user_level) 
			VALUES (:email, :password, :username, :appointment, :user_level)
			";	
			$statement = $pdo->prepare($query);
			$statement->execute(
				array(
					':email'		=>	$_POST["email"],
					':password'	=>	password_hash($_POST["password"], PASSWORD_DEFAULT),
					':username'		=>	$_POST["username"],
					':appointment'  => $_POST["appointment"],
					':user_level'		=>	'1'
				)
			);
		}
		else if($_POST['appointment'] == 'CEO PG4U')
		{
			$query = "
			INSERT INTO accounts (email, password, username, appointment, user_level) 
			VALUES (:email, :password, :username, :appointment, :user_level)
			";	
			$statement = $pdo->prepare($query);
			$statement->execute(
				array(
					':email'		=>	$_POST["email"],
					':password'	=>	password_hash($_POST["password"], PASSWORD_DEFAULT),
					':username'		=>	$_POST["username"],
					':appointment'  => $_POST["appointment"],
					':user_level'		=>	'2'
				)
			);
		}
		else if($_POST['appointment'] == 'Mgr PG4U GT Dept')
		{
			$query = "
			INSERT INTO accounts (email, password, username, appointment, user_level) 
			VALUES (:email, :password, :username, :appointment, :user_level)
			";	
			$statement = $pdo->prepare($query);
			$statement->execute(
				array(
					':email'		=>	$_POST["email"],
					':password'	=>	password_hash($_POST["password"], PASSWORD_DEFAULT),
					':username'		=>	$_POST["username"],
					':appointment'  => $_POST["appointment"],
					':user_level'		=>	'3'
				)
			);
		}
		else if($_POST['appointment'] == 'Senior Sales GT')
		{
			$query = "
			INSERT INTO accounts (email, password, username, appointment, user_level) 
			VALUES (:email, :password, :username, :appointment, :user_level)
			";	
			$statement = $pdo->prepare($query);
			$statement->execute(
				array(
					':email'		=>	$_POST["email"],
					':password'	=>	password_hash($_POST["password"], PASSWORD_DEFAULT),
					':username'		=>	$_POST["username"],
					':appointment'  => $_POST["appointment"],
					':user_level'		=>	'4'
				)
			);
		}
		else if($_POST['appointment'] == 'Assistant QA Controller ACC Dept')
		{
			$query = "
			INSERT INTO accounts (email, password, username, appointment, user_level) 
			VALUES (:email, :password, :username, :appointment, :user_level)
			";	
			$statement = $pdo->prepare($query);
			$statement->execute(
				array(
					':email'		=>	$_POST["email"],
					':password'	=>	password_hash($_POST["password"], PASSWORD_DEFAULT),
					':username'		=>	$_POST["username"],
					':appointment'  => $_POST["appointment"],
					':user_level'		=>	'5'
				)
			);
		}
		else if($_POST['appointment'] == 'Sales Assistant GT')
		{
			$query = "
			INSERT INTO accounts (email, password, username, appointment, user_level) 
			VALUES (:email, :password, :username, :appointment, :user_level)
			";	
			$statement = $pdo->prepare($query);
			$statement->execute(
				array(
					':email'		=>	$_POST["email"],
					':password'	=>	password_hash($_POST["password"], PASSWORD_DEFAULT),
					':username'		=>	$_POST["username"],
					':appointment'  => $_POST["appointment"],
					':user_level'		=>	'6'
				)
			);
		}
		
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'New User Added';
		}
	}
	// This section of the code is used for administration purposes that allows administrator to update users account directly
	if($_POST['btn_action'] == 'update')
	{
		$query = "
		SELECT * FROM accounts WHERE id = :id
		";
		$statement = $pdo->prepare($query);
		$statement->execute(
			array(
				':id'	=>	$_POST["id"]
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['email'] = $row['email'];
			$output['username'] = $row['username'];
			$output['appointment'] = $row['appointment'];
		}
		echo json_encode($output);
	}
	// This section of the code is used for modifying users credentials by themselfes
	if($_POST['btn_action'] == 'Edit')
	{
		if($_POST['password'] != '')
		{
			$query = "
			UPDATE accounts SET 
				username = '".$_POST["username"]."', 
				email = '".$_POST["email"]."',
				password = '".password_hash($_POST["password"], PASSWORD_DEFAULT)."' 
				WHERE id = '".$_POST["id"]."'
			";
		}
		else if($_POST['appointment'] == 'MD & Chairman of G4U Board')
		{
			$query= "
			UPDATE accounts SET
			username = '".$_POST["username"]."', 
			email = '".$_POST["email"]."',
			appointment = '".$_POST["appointment"]."',
			password = '".password_hash($_POST["password"], PASSWORD_DEFAULT)."',
			user_level = '1'
			WHERE id = '".$_POST["id"]."'
			
			";
		}
		else if($_POST['appointment'] == 'CEO PG4U')
		{
			$query= "
			UPDATE accounts SET
			username = '".$_POST["username"]."', 
			email = '".$_POST["email"]."',
			appointment = '".$_POST["appointment"]."',
			password = '".password_hash($_POST["password"], PASSWORD_DEFAULT)."',
			user_level = '2'
			WHERE id = '".$_POST["id"]."'
			
			";
		}
		else if($_POST['appointment'] == 'Mgr PG4U GT Dept')
		{
			$query= "
			UPDATE accounts SET
			username = '".$_POST["username"]."', 
			email = '".$_POST["email"]."',
			appointment = '".$_POST["appointment"]."',
			password = '".password_hash($_POST["password"], PASSWORD_DEFAULT)."',
			user_level = '3'
			WHERE id = '".$_POST["id"]."'
			
			";
		}
		else if($_POST['appointment'] == 'Senior Sales GT')
		{
			$query= "
			UPDATE accounts SET
			username = '".$_POST["username"]."', 
			email = '".$_POST["email"]."',
			appointment = '".$_POST["appointment"]."',
			password = '".password_hash($_POST["password"], PASSWORD_DEFAULT)."',
			user_level = '4'
			WHERE id = '".$_POST["id"]."'
			
			";
		}
		else if($_POST['appointment'] == 'Assistant QA Controller ACC Dept')
		{
			$query= "
			UPDATE accounts SET
			username = '".$_POST["username"]."', 
			email = '".$_POST["email"]."',
			appointment = '".$_POST["appointment"]."',
			password = '".password_hash($_POST["password"], PASSWORD_DEFAULT)."',
			user_level = '5'
			WHERE id = '".$_POST["id"]."'
			
			";
		}
		else if($_POST['appointment'] == 'Sales Assistant GT')
		{
			$query= "
			UPDATE accounts SET
			username = '".$_POST["username"]."', 
			email = '".$_POST["email"]."',
			appointment = '".$_POST["appointment"]."',
			password = '".password_hash($_POST["password"], PASSWORD_DEFAULT)."',
			user_level = '6'
			WHERE id = '".$_POST["id"]."'
			
			";
		}
		else
		{
			$query = "
			UPDATE accounts SET 
				username = '".$_POST["username"]."', 
				email = '".$_POST["email"]."',
				appointment = '".$_POST["appointment"]."'
				WHERE id = '".$_POST["id"]."'
			";
		}
		$statement = $pdo->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'User Details has been updated';
		}
	}
	// This section of the code is used for deleting users accounts
	if($_POST['btn_action'] == 'delete')
	{
		
		$query = "
		DELETE FROM accounts
		WHERE id = :id
		";
		$statement = $pdo->prepare($query);
		$statement->execute(
			array(
				':id'		=>	$_POST["id"]
			)
		);	
		$result = $statement->fetchAll();	
		if(isset($result))
		{
			echo "User with id ".$_POST['id']. " has been deleted ";
		}
	}
}

?>