<?php

include("./data/db.php");
include("./navbar.php");

if(!isset($_SESSION['user_login']))	//check unauthorize user not access in "welcome.php" page
{
    header("location: ../../index.php");
}

$output = '';

    $sqlQuery = ("SELECT * FROM products ");
    $sql = $pdo->prepare($sqlQuery);
    $sql->execute();

while($result = $sql->fetch())
{
    $output .= '
    <div class="latest_cars_container"  align="center";>
        <div class="latest_cars">
        <img src="style/images/'. $result['ProductImage'] .'" alt="" class="img-responsive" >
        <h4>£'. $result['ProductPrice'] .'</h4>
        <p><strong>'. $result['ProductName'] .' '. $result['SupplierID'] .'</strong></p>
        </div>
    </div>
    ';
}

?>
<body>
<head>
</head>
<?php echo $output; ?>
</body>