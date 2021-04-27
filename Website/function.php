<?php
//This file contains all of the different functions in one place to make it easier for a future configuration and updates

function fill_category_list($pdo)
{
	$query = "
	SELECT * FROM category 
	WHERE category_status = 'active' 
	ORDER BY category_name ASC
	";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["category_id"].'">'.$row["category_name"].'</option>';
	}
	return $output;
}

function fill_brand_list($pdo, $category_id)
{
	$query = "SELECT * FROM brand 
	WHERE brand_status = 'active' 
	AND category_id = '".$category_id."'
	ORDER BY brand_name ASC";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '<option value="">Select Brand</option>';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["brand_id"].'">'.$row["brand_name"].'</option>';
	}
	return $output;
}

function get_user_name($pdo, $user_id)
{
	$query = "
	SELECT user_name FROM user_details WHERE user_id = '".$user_id."'
	";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row['user_name'];
	}
}

function fill_product_list($pdo)
{
	if($_SESSION["user_access"] == '1')
	{
		$query = "
		SELECT * FROM products 
		WHERE available = '0' 
		ORDER BY ProductName ASC
		";
		$statement = $pdo->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$output = '';
		foreach($result as $row)
		{
			
			$output .= '<option value="'.$row["ID"].'">'.$row["ProductName"].'</option>';
	
		}
		return $output;
	}
	elseif($_SESSION["user_access"] == '6')
	{
		$query = "
		SELECT * FROM products 
		WHERE ProductType = 'gadgets' 
		ORDER BY ProductName ASC
		";
		$statement = $pdo->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$output = '';
		foreach($result as $row)
		{
			
			$output .= '<option value="'.$row["ID"].'">'.$row["ProductName"].'</option>';
	
		}
		return $output;
	}
	elseif($_SESSION["user_access"] == '5')
	{
		$query = "
		SELECT * FROM products 
		WHERE ProductType = 'toys' 
		ORDER BY ProductName ASC
		";
		$statement = $pdo->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$output = '';
		foreach($result as $row)
		{
			
			$output .= '<option value="'.$row["ID"].'">'.$row["ProductName"].'</option>';
	
		}
		return $output;
	}
}

function fill_order_product_list($pdo)
{
		$query = "
		SELECT * FROM products 
		WHERE available = '0' 
		ORDER BY ProductName ASC
		";
		$statement = $pdo->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$output = '';
		foreach($result as $row)
		{
			
			$output .= '<option value="'.$row["ID"].'">'.$row["ProductName"].'</option>';
	
		}
		return $output;
}

function fetch_product_details($product_id, $pdo)
{
	$query = "
	SELECT * FROM products 
	WHERE ID = '".$product_id."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output['product_name'] = $row["ProductName"];
		$output['quantity'] = $row["ProductQuantity"];
		$output['price'] = $row['ProductPrice'];
		$output['tax'] = $row['ProductTax'];
	}
	return $output;
}

function available_product_quantity($pdo, $products_id)
{
	$product_data = fetch_product_details($products_id, $pdo);
	$query = "
	SELECT 	products_order_list_id.quantity FROM products_order_list_id
	INNER JOIN products_order ON products_order.products_order_id = products_order_list.products_order_list_id
	WHERE products_order_list_id.products_id = '".$products_id."' AND
	products_order.products_order_status = 'active'
	";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total = 0;
	foreach($result as $row)
	{
		$total = $total + $row['quantity'];
	}
	$available_quantity = intval($product_data['quantity']) - intval($total);
	if($available_quantity == 0)
	{
		$update_query = "
		UPDATE products SET 
		products_status = 'inactive' 
		WHERE products_id = '".$products_id."'
		";
		$statement = $pdo->prepare($update_query);
		$statement->execute();
	}
	return $available_quantity;
}

function count_total_user($pdo)
{
	$query = "
	SELECT * FROM accounts WHERE user_level >= 0";
	$statement = $pdo->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function count_total_category($pdo)
{
	$query = "
	SELECT * FROM category WHERE category_status='active'
	";
	$statement = $pdo->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function count_total_brand($pdo)
{
	$query = "
	SELECT * FROM brand WHERE brand_status='active'
	";
	$statement = $pdo->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function count_total_product($pdo)
{
	$query = "
	SELECT * FROM products WHERE available='0'
	";
	$statement = $pdo->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function count_total_product_value($pdo)
{
	$query = "
	SELECT sum(ProductPrice * ProductQuantity) as total_product_value FROM products
	WHERE available='0'
	";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return number_format($row['total_product_value'], 2);
	}
}

function count_total_cash_order_value($pdo)
{
	$query = "
	SELECT sum(products_order_total) as total_order_value FROM products_order 
	WHERE products_payment_status = 'cash' 
	AND products_order_status='active'
	";
	if($_SESSION['type'] == 'user')
	{
		$query .= ' AND user_id = "'.$_SESSION["user_id"].'"';
	}
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return number_format($row['total_order_value'], 2);
	}
}

function count_total_credit_order_value($pdo)
{
	$query = "
	SELECT sum(products_order_total) as total_order_value FROM products_order WHERE payment_status = 'credit' AND inventory_order_status='active'
	";
	if($_SESSION['type'] == 'user')
	{
		$query .= ' AND user_id = "'.$_SESSION["user_id"].'"';
	}
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return number_format($row['total_order_value'], 2);
	}
}

function get_user_wise_total_order($pdo)
{
	$query = '
	SELECT sum(inventory_order.inventory_order_total) as order_total, 
	SUM(CASE WHEN inventory_order.payment_status = "cash" THEN inventory_order.inventory_order_total ELSE 0 END) AS cash_order_total, 
	SUM(CASE WHEN inventory_order.payment_status = "credit" THEN inventory_order.inventory_order_total ELSE 0 END) AS credit_order_total, 
	user_details.user_name 
	FROM inventory_order 
	INNER JOIN user_details ON user_details.user_id = inventory_order.user_id 
	WHERE inventory_order.inventory_order_status = "active" GROUP BY inventory_order.user_id
	';
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '
	<div class="table-responsive">
		<table class="table table-bordered table-striped">
			<tr>
				<th>User Name</th>
				<th>Total Order Value</th>
				<th>Total Cash Order</th>
				<th>Total Credit Order</th>
			</tr>
	';

	$total_order = 0;
	$total_cash_order = 0;
	$total_credit_order = 0;
	foreach($result as $row)
	{
		$output .= '
		<tr>
			<td>'.$row['user_name'].'</td>
			<td align="right">$ '.$row["order_total"].'</td>
			<td align="right">$ '.$row["cash_order_total"].'</td>
			<td align="right">$ '.$row["credit_order_total"].'</td>
		</tr>
		';

		$total_order = $total_order + $row["order_total"];
		$total_cash_order = $total_cash_order + $row["cash_order_total"];
		$total_credit_order = $total_credit_order + $row["credit_order_total"];
	}
	$output .= '
	<tr>
		<td align="right"><b>Total</b></td>
		<td align="right"><b>$ '.$total_order.'</b></td>
		<td align="right"><b>$ '.$total_cash_order.'</b></td>
		<td align="right"><b>$ '.$total_credit_order.'</b></td>
	</tr></table></div>
	';
	return $output;
}

?>