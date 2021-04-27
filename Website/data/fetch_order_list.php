<?php

include ('db.php');

include ('../order_action.php');



$limit = '10';
$page = 1;
if($_POST['page'] > 1)
{
  $start = (($_POST['page'] - 1) * $limit);
  $page = $_POST['page'];
}
else
{
  $start = 0;
}

$query = "
SELECT * FROM products_order
";

if($_POST['query'] != '')
{
  $query .= 'WHERE products_order_id LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" ';
	$query .= 'OR products_order_supplier LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" ';
	$query .= 'OR products_order_total LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" ';
	$query .= 'OR products_order_status LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" ';
	$query .= 'OR products_order_date LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" ';
}

$query .= 'ORDER BY products_order_id DESC ';

$filter_query = $query . 'LIMIT '.$start.', '.$limit.'';

$statement = $pdo->prepare($query);
$statement->execute();
$total_data = $statement->rowCount();

$statement = $pdo->prepare($filter_query);
$statement->execute();
$result = $statement->fetchAll();
$total_filter_data = $statement->rowCount();

$output = '
<label>Total Records - '.$total_data.'</label>
<div class="panel-body">
<table id="user_data" class="table table-bordered table-striped">
<thead>
  <tr>
    <th>Order ID</th>
    <th>Account ID</th>
    <th>Product Order Total</th>
    <th>Product Order Date</th>
    <th>Supplier</th>
    <th>Order Status</th>
    <th>Order State</th>
    <th colspan="3">Info</th>
  </tr>
</thead>
</div>
';
if($total_data > 0)
{
  foreach($result as $row)
  {

    $order_confirm_button = '';

    $order_decline_button = '';

    $order_info_button = '<button type="button" name="update" id="'.$row["products_order_id"].'" class="btn btn-warning btn-xs update">Info</button>';

    //Confirmation button script
    if($row["products_order_process"] == 'Raised but not checked by SSA' && ($_SESSION["user_access"] == '4')) 
    {
      $order_confirm_button = '<button type="button" name="confirm" id="'.$row["products_order_id"].'" class="btn btn-warning btn-xs confirm" data-products_order_process="'.$row["products_order_process"].'">Confirm</button>';
    }
    else if($row["products_order_process"] == 'Checked by SSA, but not confirmed by QA' && ($_SESSION["user_access"] == '5'))
    {
      $order_confirm_button = '<button type="button" name="confirm" id="'.$row["products_order_id"].'" class="btn btn-warning btn-xs confirm" data-products_order_process="'.$row["products_order_process"].'">Confirm</button>';
    }
    else if($row["products_order_process"] == 'Confirmed but not sent' && ($_SESSION["user_access"] == '1'))
    {
      $order_confirm_button = '<button type="button" name="confirm" id="'.$row["products_order_id"].'" class="btn btn-warning btn-xs confirm" data-products_order_process="'.$row["products_order_process"].'">Confirm</button>';
    }
    else if($row["products_order_process"] == 'Sent awaiting delivery' && ($_SESSION["user_access"] == '1'))
    {
      $order_confirm_button = '<button type="button" name="confirm" id="'.$row["products_order_id"].'" class="btn btn-warning btn-xs confirm" data-products_order_process="'.$row["products_order_process"].'">Confirm</button>';
    }
    else
    {
      $order_confirm_button = '';
    }
    if($row["products_order_status"] == 'active')
    {
      $order_decline_button = '<button type="button" name="decline" id="'.$row["products_order_id"].'" class="btn btn-warning btn-xs decline">Decline</button>';
    }
    else
    {
      $order_decline_button = 'Already confirmed';
    }


    $output .= '
    <tr>
      <td>'.$row["products_order_id"].'</td>
      <td>'. $row['account_id'] .'</td>
      <td>£'.$row["products_order_total"].'</td>
      <td>'.$row["products_order_date"].'</td>
      <td>'.$row["products_order_supplier"].'</td>
      <td>'.$row["products_order_status"].'</td>
      <td>'.$row["products_order_process"].'</td>
      <td>'.$order_info_button.'</td>
      <td>'.$order_confirm_button.'</td>
      <td>'.$order_decline_button.'</td>
    </tr>
    ';
  }
}
else
{
  $output .= '
  <tr>
    <td colspan="5" align="center">No Data Found</td>
  </tr>
  ';
}

$output .= '
</table>
<br />
<div align="center">
  <ul class="pagination">
';

$total_links = ceil($total_data/$limit);
$previous_link = '';
$next_link = '';
$page_link = '';

//echo $total_links;

if($total_links > 4)
{
  if($page < 5)
  {
    for($count = 1; $count <= 5; $count++)
    {
      $page_array[] = $count;
    }
    $page_array[] = '...';
    $page_array[] = $total_links;
  }
  else
  {
    $end_limit = $total_links - 5;
    if($page > $end_limit)
    {
      $page_array[] = 1;
      $page_array[] = '...';
      for($count = $end_limit; $count <= $total_links; $count++)
      {
        $page_array[] = $count;
      }
    }
    else
    {
      $page_array[] = 1;
      $page_array[] = '...';
      for($count = $page - 1; $count <= $page + 1; $count++)
      {
        $page_array[] = $count;
      }
      $page_array[] = '...';
      $page_array[] = $total_links;
    }
  }
}
else
{
  for($count = 1; $count <= $total_links; $count++)
  {
    $page_array[] = $count;
  }
}

for($count = 0; $count < count($page_array); $count++)
{
  if($page == $page_array[$count])
  {
    $page_link .= '
    <li class="page-item active">
      <a class="page-link" href="#">'.$page_array[$count].' <span class="sr-only">(current)</span></a>
    </li>
    ';

    $previous_id = $page_array[$count] - 1;
    if($previous_id > 0)
    {
      $previous_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$previous_id.'">Previous</a></li>';
    }
    else
    {
      $previous_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">Previous</a>
      </li>
      ';
    }
    $next_id = $page_array[$count] + 1;
    if($next_id >= $total_links)
    {
      $next_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">Next</a>
      </li>
        ';
    }
    else
    {
      $next_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$next_id.'">Next</a></li>';
    }
  }
  else
  {
    if($page_array[$count] == '...')
    {
      $page_link .= '
      <li class="page-item disabled">
          <a class="page-link" href="#">...</a>
      </li>
      ';
    }
    else
    {
      $page_link .= '
      <li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$page_array[$count].'">'.$page_array[$count].'</a></li>
      ';
    }
  }
}

$output .= $previous_link . $page_link . $next_link;
$output .= '
  </ul>

</div>
';

echo $output;

?>
