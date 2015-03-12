<?php include './elements/header.php'; ?>

<?php
	$products = $DB->query( "SELECT * FROM products" );	
?>

<h1>Add Product</h1>

<hr>

<form class="form-horizontal" method="post" action="">	
	<input type="hidden" name="action" value="add_product">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
      <input name="name" type="text" class="form-control" id="inputEmail3" placeholder="Name of the product">
    </div>
  </div>  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Save</button>
      <a href="./?page=products" class="btn btn-danger">Cancel</a>
    </div>
  </div>
</form>


<?php include './elements/footer.php'; ?>