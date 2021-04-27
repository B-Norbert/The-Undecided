<?php

include 'data/db.php';


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
SELECT * FROM products
";

if($_POST['query'] != '')
{
  $query .= '
  WHERE ProductName LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" 
  ';
}

$query .= 'ORDER BY ID ASC ';

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
    <th>ID</th>
    <th>Image</th>
    <th>Product Name</th>
    <th>Product Quantity</th>
    <th>Supplier ID</th>
    <th>Product Price</th>
    <th>Info</th>
  </tr>
</thead>
</div>
';
if($total_data > 0)
{
  foreach($result as $row)
  {
    $product_more = '';
    if($row["ProductQuantity"] >= 10000)
    {
      $product_more = 'N/A';
    }
    else
    {
      $product_more = '<button onclick=location.href="productDetails.php?ID='. $row['ID'] .'">More</button>';
    }
    $output .= '
    <tr>
      <td>'.$row["ID"].'</td>
      <td class="td_img"><img src="style/images/'. $row['ProductImage'] .'" width="100%" alt=""  ></td>
      <td>'. $row['ProductName'] .'</td>
      <td>'.$row["ProductQuantity"].'</td>
      <td>'.$row["SupplierID"].'</td>
      <td>£'.$row["ProductPrice"].'</td>
      <td>'.$product_more.'</td>
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
