<?php
	include './data/db.php';
	session_start();
	
if(isset($_SESSION['user_login']))
{
$id = $_SESSION['user_login'];
$select_stmt = $pdo->prepare("SELECT * FROM accounts WHERE id=:uid");
$select_stmt->execute(array(":uid"=>$id));

$row=$select_stmt->fetch(PDO::FETCH_ASSOC);
}

?>
<head>
	<title>G4U</title>
	<link rel="stylesheet" href="style/style.css">
	<script src="style/js/jquery-1.10.2.min.js"></script>
	<link rel="stylesheet" href="style/bootstrap.min.css" />
	<script src="style/js/jquery.dataTables.min.js"></script>
	<script src="style/js/dataTables.bootstrap.min.js"></script>		
	<link rel="stylesheet" href="style/dataTables.bootstrap.min.css" />
	<script src="style/js/bootstrap.min.js"></script>
</head>
	<body>
		<br />
		<div class="container"> 
		<img src="style/images/logo3.png" width="275" height="275" title="G4U" alt="G4U" />
			<?php
			if(isset($_SESSION['user_login']))
			{
			?>
			<nav class="navbar navbar-inverse">
				<div class="container-fluid">
					<div class="navbar-header">
						<a href="index.php" class="navbar-brand">Home</a>
					</div>
					<ul class="nav navbar-nav navbar-right">
					<?php
					if($_SESSION["user_access"] == '1')
					{
						echo "<li><a href='../admin_panel.php'>Admin Panel</a></li>";
					}
					?>
					<?php	
						echo "<li><a href='../userdetails.php'>" .$row['first_name']."</a></li>";
						echo "<li><a href='../logout.php'> Logout</a></li>";
						echo "<br / >";
					}
					?>
					</ul>
			</nav>
				</div>
</body>
