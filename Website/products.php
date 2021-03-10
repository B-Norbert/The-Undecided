<?php require_once('data/db.php'); ?>

<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Search</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script src="style/javascript/jquery-1.10.2.min.js"></script>
    <script src="style/javascript/jquery-ui.js"></script>
    <script src="style/javascript/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <link href = "style/jquery-ui.css" rel = "stylesheet">
  </head>
  <?php include("navbar.php");?>
  <body>
    <div class="container">
        <div class="row">
        	<br />
        	<h2 align="center">Search</h2>
        	<br />
            <div class="col-md-3">                				
				<div class="list-group">
					<h3>Price</h3>
					<input type="hidden" id="hidden_minimum_price" value="0" />
                    <input type="hidden" id="hidden_maximum_price" value="65000" />
                    <p id="price_show">10 - 65000</p>
                    <div id="price_range"></div>
                </div>
                <!---<div class="list-group">
					<h3>Miles</h3>
					<input type="hidden" id="hidden_minimum_miles" value="10" />
                    <input type="hidden" id="hidden_maximum_miles" value="99000" />
                    <p id="miles_show">10 - 99000</p>
                    <div id="miles_range"></div>
                </div>	--->	
                <div class="list-group">
					<h3>ProductName</h3>
                    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
					<?php

                    $query = "SELECT DISTINCT(ProductName) FROM products  ORDER BY ProductName ASC";
                    $statement = $pdo->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector ProductName" value="<?php echo $row['ProductName']; ?>"  > <?php echo $row['ProductName']; ?></label>
                    </div>
                    <?php
                    }

                    ?>
                    </div>
                </div>

				<div class="list-group">
					<h3>ProductQuantity</h3>
                    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
                    <?php

                    $query = "
                    SELECT DISTINCT(ProductQuantity) FROM products ORDER BY ProductQuantity ASC
                    ";
                    $statement = $pdo->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector ProductQuantity" value="<?php echo $row['ProductQuantity']; ?>" > <?php echo $row['ProductQuantity']; ?></label>
                    </div>
                    <?php    
                    }

                    ?>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-md-9">
            	<br />
                <div class="row filter_data" id="filter_data">
                </div>
            </div>
        </div>
    </div>
<style>
#loading
{
 text-align:center; 
 background: url('images/loading.gif') no-repeat center; 
 height: 150px;
}
</style>
  </body>
</html>
<script>
  $(document).ready(function(){

    filter_data();

    function filter_data(page)
    {
    $('.filter_data').html('<div id="loading" style="" ></div>');
    var action = 'fetch_data';
    var minimum_price = $('#hidden_minimum_price').val();
    var maximum_price = $('#hidden_maximum_price').val();
    var minimum_miles = $('#hidden_minimum_miles').val();
    var maximum_miles = $('#hidden_maximum_miles').val();
    var ProductName = get_filter('ProductName');
    var ProductQuantity = get_filter('ProductQuantity');
      $.ajax({
        url:"data/fetch_data.php",
        method:"POST",
        data:{action:action,minimum_price:minimum_price, maximum_price:maximum_price, minimum_miles:minimum_miles, maximum_miles:maximum_miles, page:page, ProductName:ProductName, ProductQuantity:ProductQuantity},
        success:function(data)
        {
          $('#filter_data').html(data);
        }
      });
    }
    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }
    $(document).on('click', '.page-link', function(){
      var page = $(this).data('page_number');
      filter_data(page);
    });

    $('.common_selector').click(function(){
        filter_data(1);
    });

    $('#price_range').slider({
        range:true,
        min:10,
        max:65000,
        values:[10,65000],
        step:10,
        stop:function(event, ui)
        {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data(1);
        }

    });
    
    /*$('#miles_range').slider({
        range:true,
        min:10,
        max:99000,
        values:[10,99000],
        step:10,
        stop:function(event, ui)
        {
            $('#miles_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_miles').val(ui.values[0]);
            $('#hidden_maximum_miles').val(ui.values[1]);
            filter_data(1);
        }

    });*/
  });
</script>

