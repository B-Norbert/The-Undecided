<?php 
  include 'data/db.php';

  include 'navbar.php';

	if(!isset($_SESSION['user_login']))	//check unauthorize user not access in "welcome.php" page
	{
		header("location: ./login.php");
  }
  
?>
<head>
<link rel="stylesheet" href="style/style.css">
</head>
<body>
<div class='footer-container'>
        <div class='footer-links'>
          <div class='footer-link-wrapper'>
            <div class='footer-link-items'>
              <h2 class='menu_h2'>Menu</h2>
              <div class='menu'>
                <a class='menu_box' href='./products.php'>Products</a>
                <?php 
                if($_SESSION["user_access"] == '1')
                {
                ?>
                  <a class='menu_box' href='./admin_panel.php'>Admin Panel</a>
                <?php
                }
                ?>
                <a class='menu_box' href='./product_orders.php'>Orders</a>
              </div>
            </div>
          </div>
        </div>
      <div class='footer'>
      G4U
      &copy; <?php echo date("Y"); ?>
      </div>
    </div>
</body>