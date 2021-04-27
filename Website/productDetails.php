<?php
include 'data/db.php';
include 'navbar.php';
include 'function.php';
$ID = $_GET['ID'];
?>

<?php

$query = $pdo->query("SELECT * FROM products WHERE ID = ".$ID);

while($row = $query->fetch())
{	
	/*
	echo "<div class='container'>";
	echo "<div class='col-md-6'>";
				echo "<form method='post' id='order_form'>";
					echo "<div class='modal-content'>";
						echo "<div class='modal-header'>";
							echo "<h4 class='modal-title'><i class='fa fa-plus'></i> Order Informations</h4>";
						echo "</div>";
						echo "<div class='modal-body'>";
							echo "<div class='row'>";
								echo "<div class='col-md-6'>";
									echo "<div class='form-group'>";
										echo "<label>Product Price </label>";
										echo "<hr />";
										echo "<button type='button' name='add' id='add_button' class='btn btn-success btn-xs'>Add</button>";
										echo "<hr />";
										echo "<input type='text' name='inventory_order_name' id='inventory_order_name' class='form-control' required />";
										echo "<hr />";
									echo "</div>";
								echo "</div>";
								echo "<div class='col-md-6'>";
									echo "<div class='form-group'>";
										echo "<label>Product Quantity</label>";
										echo "<hr />";
										echo $row['ProductQuantity'];
										echo "<hr />";
									echo "</div>";
								echo "</div>";
							echo "</div>";
							echo "<div class='form-group'>";
								echo "<label>Product Image</label>";
								echo "<hr />";
								echo "<IMG SRC='style/images/".$row['ProductImage']."' width=300px heigh=300px>";
								echo "<hr />";
							echo "</div>";
							echo "<div class='form-group'>";
								echo "<label>Product Name</label>";
								echo "<hr />";
								echo $row['ProductName'];
								echo "<hr />";
							echo "</div>";
							echo "<div class='form-group'>";
								echo "<label>Suppliers</label>";
								echo "<hr />";
								echo $row['SupplierID'];
								echo "<hr />";
							echo "</div>";
							echo "<div class='form-group'>";
								echo "<label>products</label>";
								echo "<hr />";
								echo "<span id='span_product_details'></span>";
								echo "<hr />";
							echo "</div>";
							echo "<div class='modal-footer'>";
    							echo "<input type='hidden' name='inventory_order_id' id='inventory_order_id' />";
    							echo "<input type='hidden' name='btn_action' id='btn_action' />";
    							echo "<input type='submit' name='action' id='action' class='btn btn-info' value='Add' />";
    						echo "</div>";
						echo "</div>";
					echo "</div>";
				echo "</form>";
			echo "</div>";
			*/
			echo "<div class='container'>";
			echo "<div class='col-md-12'>";
			echo "<form method='post' id='order_form'>";
				echo "<div class='modal-content'>";
					echo "<div class='modal-header'>";
						echo "<h4 class='modal-title'><i class='fa fa-plus'></i> Product Informations</h4>";
					echo "</div>";
					echo "<div class='modal-body'>";
						echo "<div class='row'>";
							echo "<div class='col-md-6'>";
								echo "<div class='form-group'>";
									echo "<label>Product Price </label>";
									echo "<hr />";
									echo $row['ProductPrice'];
									echo "<hr />";
								echo "</div>";
							echo "</div>";
							echo "<div class='col-md-6'>";
								echo "<div class='form-group'>";
									echo "<label>Product Quantity</label>";
									echo "<hr />";
									echo $row['ProductQuantity'];
									echo "<hr />";
								echo "</div>";
							echo "</div>";
						echo "</div>";
						echo "<div class='form-group'>";
							echo "<label>Product Image</label>";
							echo "<hr />";
							echo "<IMG SRC='style/images/".$row['ProductImage']."' width=300px heigh=300px>";
							echo "<hr />";
						echo "</div>";
						echo "<div class='form-group'>";
							echo "<label>Product Name</label>";
							echo "<hr />";
							echo $row['ProductName'];
							echo "<hr />";
						echo "</div>";
						echo "<div class='form-group'>";
							echo "<label>Suppliers</label>";
							echo "<hr />";
							echo $row['SupplierID'];
							echo "<hr />";
						echo "</div>";
					echo "</div>";
				echo "</div>";
			echo "</form>";
		echo "</div>";
	echo "</div>";
}

?>
