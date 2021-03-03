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
                <a class='menu_box' href='./products.php'>Category 1</a>
                <a class='menu_box' href='#'>Category 2</a>
                <a class='menu_box' href='#'>Category 3</a>
              </div>
            </div>
          </div>
        </div>
      <div class='footer'>
      (Company to edit). All rights reserved.
      </div>
    </div>
</body>