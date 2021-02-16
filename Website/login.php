<?php
//Database Connectivity
include 'data/db.php';

include 'navbar.php';

if(isset($_SESSION["user_login"]))	//check condition user login not direct back to index.php page
{
	header("location: welcome.php");
}

if(isset($_REQUEST['btn_login']))	//button name is "btn_login" 
{
	$username	=strip_tags($_REQUEST["txt_username"]);	//textbox name "txt_username_email"
	$password	=strip_tags($_REQUEST["txt_password"]);			//textbox name "txt_password"
		
	if(empty($username)){						
		$errorMsg[]="please enter username";	//check "username/email" textbox not empty 
	}
	else if(empty($password)){
		$errorMsg[]="please enter password";	//check "passowrd" textbox not empty 
	}
	else
	{
		try
		{
			$select_stmt=$pdo->prepare("SELECT * FROM accounts WHERE username=:uname"); //sql select query
			$select_stmt->execute(array(':uname'=>$username));	//execute query with bind parameter
			$row=$select_stmt->fetch(PDO::FETCH_ASSOC);
			
			if($select_stmt->rowCount() > 0)	//check condition database record greater zero after continue
			{
				if($username==$row["username"]) //check condition user taypable "username or email" are both match from database "username or email" after continue
				{
					if($password == $row["password"]) //check condition user taypable "password" are match from database "password" using password_verify() after continue
					{
						$_SESSION["user_login"] = $row["id"];	//session name is "user_login"
						$loginMsg = "Successfully Login...";		//user login success message
						header("refresh:2; index.php");			//refresh 2 second after redirect to "welcome.php" page
					}
					else
					{
						$errorMsg[]="wrong username or password";
					}
				}
				else
				{
					$errorMsg[]="wrong username or password";
				}
			}
			else
			{
				$errorMsg[]="wrong username or password";
			}
		}
		catch(PDOException $e)
		{
			$e->getMessage();
		}		
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
<title>Login</title>
		
<link rel="stylesheet" href="style/style.css">
<script src="js/jquery-1.12.4-jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>	
</head>
	<body>	
	<div class="wrapper">
	
	<div class="container">
			
		<div class="col-lg-12">
			<div class="login">
				<h1>Login</h1>
				<form method="post" class="form">
					<input type="text" name="txt_username" class="form-control" placeholder="enter username" />
					<input type="password" name="txt_password" class="form-control" placeholder="enter password" />
					<input type="submit" name="btn_login" class="btn btn-success" value="Login">
					<?php
		if(isset($errorMsg))
		{
			foreach($errorMsg as $error)
			{
			?>
				<div class="alert alert-danger">
					<strong><?php echo $error; ?></strong>
				</div>
            <?php
			}
		}
		if(isset($loginMsg))
		{
		?>
			<div class="alert alert-success">
				<strong><?php echo $loginMsg; ?></strong>
			</div>
        <?php
		}
		?>   
				</form>
			</div>
		
		</div>
	</div>		
	</div>									
	</body>
</html>