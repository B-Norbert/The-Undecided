<?php 
include('data/db.php'); 

include('navbar.php');

include('function.php');

if(!isset($_SESSION["user_login"]))
{
	header('location:login.php');
}


?>

<!DOCTYPE html>
<html>
  <head>
    <title>Product Search</title>
    <link rel="stylesheet" href="style/style.css">
	<script src="style/js/jquery-1.10.2.min.js"></script>
	<link rel="stylesheet" href="style/bootstrap.min.css" />
	<script src="style/js/jquery.dataTables.min.js"></script>
	<script src="style/js/dataTables.bootstrap.min.js"></script>		
	<link rel="stylesheet" href="style/dataTables.bootstrap.min.css" />
	<script src="style/js/bootstrap.min.js"></script>
  </head>
  <body>
    <br />
    <div class="container">
	<span id="alert_action"></span>
      <h3 align="center">Product Search</h3>
	  <button type="button" name="add" id="add_button" class="btn btn-success btn-xs">Create Order</button>   
      <br />
      <div class="card">
        <div class="card-header">...</div>
        <div class="card-body">
          <div class="form-group">
            <input type="text" name="search_box" id="search_box" class="form-control" placeholder="Type your search query here" />
            
          </div>
          <div class="table-responsive" id="dynamic_content">
            
          </div>
        </div>
      </div>
    </div>

    <div id="orderModal" class="modal fade">
    	<div class="modal-dialog">
    		<form method="post" id="order_form">
    			<div class="modal-content">
    				<div class="modal-header">
    					<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> Create Order</h4>
    				</div>
    				<div class="modal-body">
    					<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Enter Supplier Name Temp</label>
									<input type="text" name="products_order_supplier" id="products_order_supplier" class="form-control" required />
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Choose Product</label>
							<hr />
							<span id="span_product_details"></span>
							<hr />
						</div>
						<div class="form-group">
							<label>Notes for the order</label>
							<textarea name="products_order_notes" id="products_order_notes" class="form-control"></textarea>
						</div> 
    				</div>
    				<div class="modal-footer">
    					<input type="hidden" name="products_order_id" id="products_order_id" />
    					<input type="hidden" name="btn_action" id="btn_action" />
    					<input type="submit" name="action" id="action" class="btn btn-info" value="Add" />
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
  </body>
</html>
<script>
  $(document).ready(function(){

    load_data(1);

    function load_data(page, query = '')
    {
      $.ajax({
        url:"fetch.php",
        method:"POST",
        data:{page:page, query:query},
        success:function(data)
        {
          $('#dynamic_content').html(data);
        }
      });
    }

    $(document).on('click', '.page-link', function(){
      var page = $(this).data('page_number');
      var query = $('#search_box').val();
      load_data(page, query);
    });

    $('#search_box').keyup(function(){
      var query = $('#search_box').val();
      load_data(1, query);
    });
  });
</script>
<script type="text/javascript">
    $(document).ready(function(){

		$('#add_button').click(function(){
			$('#orderModal').modal('show');
			$('#order_form')[0].reset();
			$('.modal-title').html("<i class='fa fa-plus'></i> Create Order");
			$('#action').val('Add');
			$('#btn_action').val('Add');
			$('#span_product_details').html('');
			add_product_row();
		});

		function add_product_row(count = '')
		{
			var html = '';
			html += '<span id="row'+count+'"><div class="row">';
			html += '<div class="col-md-8">';
			html += '<select name="product_id[]" id="product_id'+count+'" class="form-control selectpicker" data-live-search="true" required>';
			html += '<?php echo fill_product_list($pdo); ?>';
			html += '</select><input type="hidden" name="hidden_product_id[]" id="hidden_product_id'+count+'" />';
			html += '</div>';
			html += '<div class="col-md-3">';
			html += '<input type="text" name="quantity[]" class="form-control" required />';
			html += '</div>';
			html += '<div class="col-md-1">';
			if(count == '')
			{
				html += '<button type="button" name="add_more" id="add_more" class="btn btn-xs">+</button>';
			}
			else
			{
				html += '<button type="button" name="remove" id="'+count+'" class="btn btn-xs remove">-</button>';
			}
			html += '</div>';
			html += '</div></div><br /></span>';
			$('#span_product_details').append(html);

		}

		var count = 0;

		$(document).on('click', '#add_more', function(){
			count = count + 1;
			add_product_row(count);
		});
		$(document).on('click', '.remove', function(){
			var row_no = $(this).attr("id");
			$('#row'+row_no).remove();
		});

		$(document).on('submit', '#order_form', function(event){
			event.preventDefault();
			$('#action').attr('disabled', 'disabled');
			var form_data = $(this).serialize();
			$.ajax({
				url:"order_action.php",
				method:"POST",
				data:form_data,
				success:function(data){
					$('#order_form')[0].reset();
					$('#orderModal').modal('hide');
					$('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
					$('#action').attr('disabled', false);
					orderdataTable.ajax.reload();
				}
			});
		});

		$(document).on('click', '.update', function(){
			var inventory_order_id = $(this).attr("id");
			var btn_action = 'update';
			$.ajax({
				url:"order_action.php",
				method:"POST",
				data:{products_order_id:products_order_id, btn_action:btn_action},
				dataType:"json",
				success:function(data)
				{
					$('#orderModal').modal('show');
					$('#products_order_supplier').val(data.products_order_supplier);
					$('#products_order_date').val(data.products_order_date);
					$('#span_product_details').html(data.product_details);
					$('#products_order_process').val(data.products_order_process);
					$('#products_order_status').val(data.products_order_status);
					$('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit Order");
					$('#products_order_id').val(products_order_id);
					$('#action').val('Edit');
					$('#btn_action').val('Edit');
				}
			})
		});

		$(document).on('click', '.delete', function(){
			var inventory_order_id = $(this).attr("id");
			var status = $(this).data("status");
			var btn_action = "delete";
			if(confirm("Are you sure you want to change status?"))
			{
				$.ajax({
					url:"order_action.php",
					method:"POST",
					data:{products_order_id:products_order_id, status:status, btn_action:btn_action},
					success:function(data)
					{
						$('#alert_action').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
						orderdataTable.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
		});

    });
</script>