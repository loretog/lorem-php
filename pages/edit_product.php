<?php include './elements/header.php'; ?>

<h1>Edit Product</h1>

<hr>

<?php
	$product_id = $_GET[ 'id' ];

	$products = $DB->query( "SELECT * FROM products WHERE id=$product_id" );

	$product = $products->fetch_object();
?>

<form class="form-horizontal" method="post" action="">	
	<input type="hidden" name="action" value="update_product">
	<input type="hidden" name="id" value="<?php echo $product->id ?>">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
      <input name="name" type="text" value="<?php echo $product->name ?>" class="form-control" id="inputEmail3" placeholder="Name of the product">
    </div>
  </div>  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Update</button>
      <a href="./?page=products" class="btn btn-danger">Cancel</a>
    </div>
  </div>
</form


<?php include './elements/footer.php'; ?>