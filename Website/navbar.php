<?php
	include('./data/db.php');
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
</head>
<body>
	<div class="nav">
		<nav>
			<div class="logo">
				<h4 href="../../index.php">G4U</h4>
			</div>
			<ul class="nav-links">
				<?php
				if(isset($_SESSION['user_login']))
				{
				?>
				<?php	
						echo "<a href='../../index.php'>Home </a>";
						echo "<a href='#'>" .$row['username']."</a>";
						echo "<a href='../logout.php'> Logout</a>";
				}
				?>

			<ul>
			</nav>
		</div>
	</div>
</body>