<?php

//order_action.php

include('data/db.php');

session_start();

include('function.php');


if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'Add')
	{
		$query = "
		INSERT INTO products_order (account_id, products_order_total, products_order_date, products_order_notes, products_order_supplier, products_order_status, products_order_process) 
		VALUES (:account_id, :products_order_total, :products_order_date, :products_order_notes, :products_order_supplier, :products_order_status, :products_order_process)
		";
		$statement = $pdo->prepare($query);
		$statement->execute(
			array(
				':account_id'					=>	$_SESSION["user_login"],
				':products_order_total'			=>	0,
				':products_order_date'			=>	date("Y-m-d"),
				':products_order_notes'			=>	$_POST['products_order_notes'],
				':products_order_supplier'		=>	$_POST['products_order_supplier'],
				':products_order_status'		=>	'active',
				':products_order_process'		=>	'Raised but not checked by SSA',
			)
		);
		$result = $statement->fetchAll();
		$statement = $pdo->query("SELECT LAST_INSERT_ID()");
		$products_order_id = $statement->fetchColumn();

		if(isset($products_order_id))
		{
			$total_amount = 0;
			for($count = 0; $count<count($_POST["product_id"]); $count++)
			{
				$product_details = fetch_product_details($_POST["product_id"][$count], $pdo);
				$sub_query = "
				INSERT INTO products_order_list (products_order_id, product_id, quantity, price, tax) VALUES (:products_order_id, :product_id, :quantity, :price, :tax)
				";
				$statement = $pdo->prepare($sub_query);
				$statement->execute(
					array(
						':products_order_id'	=>	$products_order_id,
						':product_id'			=>	$_POST["product_id"][$count],
						':quantity'				=>	$_POST["quantity"][$count],
						':price'				=>	$product_details['price'],
						':tax'					=>	$product_details['tax']
					)
				);
				$base_price = $product_details['price'] * $_POST["quantity"][$count];
				$tax = ($base_price/100)*$product_details['tax'];
				$total_amount = $total_amount + ($base_price + $tax);
			}
			$update_query = "
			UPDATE products_order 
			SET products_order_total = '".$total_amount."' 
			WHERE products_order_id = '".$products_order_id."'
			";
			$statement = $pdo->prepare($update_query);
			$statement->execute();
			$result = $statement->fetchAll();
			if(isset($result))
			{
				echo 'Order Created...';
				echo '<br />';
				echo 'Total price for the order is £';
				echo $total_amount;
				echo '<br />';
				echo 'Order id number: ';
				echo $products_order_id;
			}
		}
	}

	if($_POST['btn_action'] == 'fetch_single')
	{
		$query = "
		SELECT * FROM products_order WHERE products_order_id = :products_order_id
		";
		$statement = $pdo->prepare($query);
		$statement->execute(
			array(
				':products_order_id'	=>	$_POST["products_order_id"]
			)
		);
		$result = $statement->fetchAll();
		$output = array();
		foreach($result as $row)
		{
			$output['products_order_date'] = $row['products_order_date'];
			$output['products_order_supplier'] = $row['products_order_supplier'];
			$output['products_order_notes'] = $row['products_order_notes'];
			$output['products_order_status'] = $row['products_order_status'];
			$output['products_order_process'] = $row['products_order_process'];
		}
		$sub_query = "
		SELECT * FROM products_order_list
		WHERE products_order_id = '".$_POST["products_order_id"]."'
		";
		$statement = $pdo->prepare($sub_query);
		$statement->execute();
		$sub_result = $statement->fetchAll();
		$product_details = '';
		$count = '';
		foreach($sub_result as $sub_row)
		{
			$product_details .= '
			<script>
			$(document).ready(function(){
				$("#product_id'.$count.'").selectpicker("val", '.$sub_row["product_id"].');
				$(".selectpicker").selectpicker();
			});
			</script>
			<span id="row'.$count.'">
				<div class="row">
					<div class="col-md-8">
						<select name="product_id[]" id="product_id'.$count.'" class="form-control selectpicker" data-live-search="true" required>
							'.fill_order_product_list($pdo).'
						</select>
						<input type="hidden" name="hidden_product_id[]" id="hidden_product_id'.$count.'" value="'.$sub_row["product_id"].'" />
					</div>
					<div class="col-md-3">
						<input type="text" name="quantity[]" class="form-control" value="'.$sub_row["quantity"].'" required />
					</div>
					<div class="col-md-1">
			';
			$product_details .= '
						</div>
					</div>
				</div><br />
			</span>
			';
			$count = $count + 1;
		}
		$output['product_details'] = $product_details;
		echo json_encode($output);
	}

	if($_POST['btn_action'] == 'Edit')
	{
		$delete_query = "
		DELETE FROM products_order_list 
		WHERE products_order_id = '".$_POST["products_order_id"]."'
		";
		$statement = $pdo->prepare($delete_query);
		$statement->execute();
		$delete_result = $statement->fetchAll();
		if(isset($delete_result))
		{
			$total_amount = 0;
			for($count = 0; $count < count($_POST["product_id"]); $count++)
			{
				$product_details = fetch_product_details($_POST["product_id"][$count], $pdo);
				$sub_query = "
				INSERT INTO products_order_list (products_order_id, product_id, quantity, price, tax) VALUES (:products_order_id, :product_id, :quantity, :price, :tax)
				";
				$statement = $pdo->prepare($sub_query);
				$statement->execute(
					array(
						':products_order_id'	=>	$_POST["products_order_id"],
						':product_id'			=>	$_POST["product_id"][$count],
						':quantity'				=>	$_POST["quantity"][$count],
						':price'				=>	$product_details['price'],
						':tax'					=>	$product_details['tax']
					)
				);
				$base_price = $product_details['price'] * $_POST["quantity"][$count];
				$tax = ($base_price/100)*$product_details['tax'];
				$total_amount = $total_amount + ($base_price + $tax);
			}
			$update_query = "
			UPDATE products_order 
			SET products_order_supplier = :products_order_supplier, 
			products_order_date = :products_order_date,
			products_order_notes = :products_order_notes, 
			products_order_process = :products_order_process, 
			products_order_total = :products_order_total, 
			products_order_status = :products_order_status
			WHERE products_order_id = :products_order_id
			";
			$statement = $pdo->prepare($update_query);
			$statement->execute(
				array(
					':products_order_supplier'		=>	$_POST["products_order_supplier"],
					':products_order_date'			=>	$_POST["products_order_date"],
					':products_order_notes'         =>  $_POST["products_order_notes"],
					':products_order_process'		=>	$_POST["products_order_process"],
					':products_order_total'			=>	$total_amount,
					':products_order_status'		=>	$_POST["products_order_status"],
					':products_order_id'			=>	$_POST["products_order_id"]
				)
			);
			$result = $statement->fetchAll();
			if(isset($result))
			{
				echo 'Order Edited...';
			}
		}
	}

	if($_POST['btn_action'] == 'delete')
	{
		$status = 'active';
		if($_POST['status'] == 'active')
		{
			$status = 'inactive';
		}
		$query = "
		UPDATE products_order 
		SET products_order_status = :products_order_status 
		WHERE products_order_id = :products_order_id
		";
		$statement = $pdo->prepare($query);
		$statement->execute(
			array(
				':products_order_status'	=>	$status,
				':products_order_id'		=>	$_POST["products_order_id"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Order status change to ' . $status;
		}
	}

	if($_POST['btn_action'] == 'fetch_confirm')
	{
		$query = "
		SELECT * FROM products_order WHERE products_order_id = :products_order_id
		";
		$statement = $pdo->prepare($query);
		$statement->execute(
			array(
				':products_order_id'	=>	$_POST["products_order_id"]
			)
		);
		$result = $statement->fetchAll();
		$output = array();
		foreach($result as $row)
		{
			$output['products_order_date'] = $row['products_order_date'];
			$output['products_order_supplier'] = $row['products_order_supplier'];
			$output['products_order_notes'] = $row['products_order_notes'];
			$output['products_order_status'] = $row['products_order_status'];
			$output['products_order_process'] = $row['products_order_process'];
		}
		$sub_query = "
		SELECT * FROM products_order_list
		WHERE products_order_id = '".$_POST["products_order_id"]."'
		";
		$statement = $pdo->prepare($sub_query);
		$statement->execute();
		$sub_result = $statement->fetchAll();
		$product_details = '';
		$count = '';
		foreach($sub_result as $sub_row)
		{
			$product_details .= '
			<script>
			$(document).ready(function(){
				$("#product_id'.$count.'").selectpicker("val", '.$sub_row["product_id"].');
				$(".selectpicker").selectpicker();
			});
			</script>
			<span id="row'.$count.'">
				<div class="row">
					<div class="col-md-8">
						<select name="product_id[]" id="product_id'.$count.'" class="form-control selectpicker" data-live-search="true" required>
							'.fill_order_product_list($pdo).'
						</select>
						<input type="hidden" name="hidden_product_id[]" id="hidden_product_id'.$count.'" value="'.$sub_row["product_id"].'" />
					</div>
					<div class="col-md-3">
						<input type="text" name="quantity[]" class="form-control" value="'.$sub_row["quantity"].'" required />
					</div>
					<div class="col-md-1">
			';
			$product_details .= '
						</div>
					</div>
				</div><br />
			</span>
			';
			$count = $count + 1;
		}
		$output['product_details'] = $product_details;
		echo json_encode($output);
	}

	if($_POST['btn_action'] == 'confirm')
	{
		
		$products_order_process = $_POST['products_order_process'];

		if($_POST['products_order_process'] == 'Raised but not checked by SSA')
		{
			$query = "
			UPDATE products_order 
			SET products_order_process = :products_order_process
			WHERE products_order_id = :products_order_id
			";
			$statement = $pdo->prepare($query);
			$statement->execute(
				array(
					':products_order_process'	=>	'Checked by SSA, but not confirmed by QA',
					':products_order_id'		=>	$_POST["products_order_id"]
				)
			);
			$result = $statement->fetchAll();
			if(isset($result))
			{
				echo 'Order state has been changed ';
			}
		}

		if($_POST['products_order_process'] == 'Checked by SSA, but not confirmed by QA')
		{
			$query = "
			UPDATE products_order 
			SET products_order_process = :products_order_process
			WHERE products_order_id = :products_order_id
			";
			$statement = $pdo->prepare($query);
			$statement->execute(
				array(
					':products_order_process'	=>	'Confirmed but not sent',
					':products_order_id'		=>	$_POST["products_order_id"]
				)
			);
			$result = $statement->fetchAll();
			if(isset($result))
			{
				echo 'Order state has been changed ';
			}
		}

		if($_POST['products_order_process'] == 'Confirmed but not sent')
		{
			$query = "
			UPDATE products_order 
			SET products_order_process = :products_order_process
			WHERE products_order_id = :products_order_id
			";
			$statement = $pdo->prepare($query);
			$statement->execute(
				array(
					':products_order_process'	=>	'Sent awaiting delivery',
					':products_order_id'		=>	$_POST["products_order_id"]
				)
			);
			$result = $statement->fetchAll();
			if(isset($result))
			{
				echo 'Order state has been changed ';
			}
		}

		if($_POST['products_order_process'] == 'Sent awaiting delivery')
		{
			$total_amount = 0;
			for($count = 0; $count < count($_POST["product_id"]); $count++)
			{
				$product_details = fetch_product_details($_POST["product_id"][$count], $pdo);
				$sub_query = "
				UPDATE products SET (ID, ProductQuantity) VALUES (:ID, :ProductQuantity)
				";
				$statement = $pdo->prepare($sub_query);
				$statement->execute(
					array(
						':ID'			=>	$_POST["product_id"][$count],
						':ProductQuantity'		=>	$_POST["quantity"][$count]
					)
				);
				$base_price = $product_details['price'] * $_POST["quantity"][$count];
				$tax = ($base_price/100)*$product_details['tax'];
				$total_amount = $total_amount + ($base_price + $tax);
			}
			$update_query = "
			UPDATE products_order 
			SET products_order_status = :products_order_status
			WHERE products_order_id = :products_order_id
			";
			$statement = $pdo->prepare($update_query);
			$statement->execute(
				array(
					//':products_order_process' 		=>	'Delivered',
					':products_order_status'		=>	'inactive',
					':products_order_id'			=>	$_POST["products_order_id"]
				)
			);
			$result = $statement->fetchAll();
			if(isset($result))
			{
				echo 'Order signed off...';
			}
		}
	}

	if($_POST['btn_action'] == 'confirm_test')
	{
		$total_amount = 0;
		for($count = 0; $count < count($_POST["product_id"]); $count++)
		{
			$product_details = fetch_product_details($_POST["product_id"][$count], $pdo);
			$sub_query = "
			UPDATE products, products_order_list
			SET products.ProductQuantity = ProductQuantity + :ProductQuantity
			WHERE ID = :product_id
			AND products_order_id = :products_order_id
			";
			$statement = $pdo->prepare($sub_query);
			$statement->execute(
				array(
					':ProductQuantity'	 =>	  $_POST["quantity"][$count],
					':products_order_id' =>	$_POST["products_order_id"],
					':product_id'			=>	$_POST["product_id"][$count]
				)
			);
		}
		$update_query = "
		UPDATE products_order 
		SET products_order_status = :products_order_status
		WHERE products_order_id = :products_order_id
		";
		$statement = $pdo->prepare($update_query);
		$statement->execute(
			array(
				//':products_order_process' 		=>	'Delivered',
				':products_order_status'		=>	'inactive',
				':products_order_id'			=>	$_POST["products_order_id"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Order signed off...';
		}
	}
}

?>
