<?php 
include('data/db.php');

include('navbar.php');

include('function.php');

if(!isset($_SESSION["user_login"]))
{
	header('location:login.php');
}

if($_SESSION["user_access"] != '1')
{
	header("location:index.php");
}
  
?>
<head>
<link rel="stylesheet" href="style/style.css">
</head>
<body>
<div class="container">
<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading"><strong>Total number of Users</strong></div>
			<div class="panel-body" align="center">
				<h1><?php echo count_total_user($pdo); ?></h1>
			</div>
            <a class="links" href='./user.php'>More..</a>
		</div>
	</div>
    <div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading"><strong>Total Product in Stock</strong></div>
			<div class="panel-body" align="center">
				<h1><?php echo count_total_product($pdo); ?></h1>
			</div>
			<a class="links" href='./products.php'>More..</a>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading"><strong>Total Value of the Stock</strong></div>
			<div class="panel-body" align="center">
				<h1>£<?php echo count_total_product_value($pdo); ?></h1>
			</div>
			<a class="links" href='./products.php'>More..</a>
		</div>
	</div>
</div>
</body>
