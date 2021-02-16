<?php 
  include 'data/db.php';

  include 'navbar.php';

	if(!isset($_SESSION['user_login']))	//check unauthorize user not access in "welcome.php" page
	{
		header("location: ./login.php");
  }
  
?>
<body>
<div class='footer-container'>
        <div class='footer-links'>
          <div class='footer-link-wrapper'>
            <div class='footer-link-items'>
              <h2>Temp(h2)</h2>
              <a href='#'>Category 1</a>
              <a href='#'>Category 2</a>
              <a href='#'>Category 3</a>
            </div>
          </div>
        </div>
        <section class='social-media'>
          <div class='social-media-wrap'>
            <small class='website-rights'>
  
  (Company to edit). All rights reserved.
  
  </small>
          </div>
        </section>
      </div>
</body>