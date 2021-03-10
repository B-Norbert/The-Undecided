<?php

include ('db.php');

$limit = '5';
$page = 1;

if(($_POST['page'] > 1))
{
  $start = (($_POST['page'] - 1) * $limit);
  $page = $_POST['page'];
}
else
{
  $start = 0;
}

if(isset($_POST["action"]))
{
	$query = "SELECT * FROM products WHERE available = '0'
	";
	if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	{
		$query .= "
		 AND ProductPrice BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
		";
	}
	/*if(isset($_POST["minimum_miles"], $_POST["maximum_miles"]) && !empty($_POST["minimum_miles"]) && !empty($_POST["maximum_miles"]))
	{
		$query .= "
		 AND miles BETWEEN '".$_POST["minimum_miles"]."' AND '".$_POST["maximum_miles"]."'
		";
	}*/
	if(isset($_POST["ProductName"]))
	{
		$ProductName_filter = implode("','", $_POST["ProductName"]);
		$query .= "
		 AND ProductName IN('".$ProductName_filter."')
		";
	}
	if(isset($_POST["ProductQuantity"]))
	{
		$ProductQuantity_filter = implode("','", $_POST["ProductQuantity"]);
		$query .= "
		 AND ProductQuantity IN('".$ProductQuantity_filter."')
		";
	}
	if(isset($_POST["SupplierID"]))
	{
		$SupplierID_filter = implode("','", $_POST["SupplierID"]);
		$query .= "
		 AND SupplierID IN('".$SupplierID_filter."')
		";
  }
}
$filter_query = $query . 'LIMIT '.$start.', '.$limit.'';

$statement = $pdo->prepare($query);
$statement->execute();
$total_data = $statement->rowCount();

$statement = $pdo->prepare($filter_query);
$statement->execute();
$result = $statement->fetchAll();
$total_filter_data = $statement->rowCount();

$output = '
<label>Total Products - '.$total_data.'</label>

';
if($total_data > 0)
{
  foreach($result as $row)
  {
    $output .= '
			<div class="container">
				<div style="border:4px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; height:400px; width:1000px;">
				<img class="searchcontent" src="style/images/'. $row['ProductImage'] .'" width="25%" alt="" class="img-responsive" >
				<div class="searchcontent">
				<h4 style="text-align:left;" class="text-danger" >£'. $row['ProductPrice'] .'</h4>
				<p align="left"><strong><a href="productDetails.php?ID='. $row['ID'] .'">'. $row['ProductName'] .'</a></strong></p>
					<p>Suppliers ID : '. $row['SupplierID'].'<br />
					Product Quantity : '. $row['ProductQuantity'] .' <br />
					</div>
				</div>

			</div>
			';
  }
}
else
{
  $output .= '
  <tr>
    <td colspan="2" align="center">No Data Found</td>
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