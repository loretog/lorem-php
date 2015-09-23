<?php include './elements/header.php'; ?>

<?php
	$products = $DB->query( "SELECT * FROM products" );	
?>

<h1>Products</h1>

<a class="btn btn-success btn-sm" href="./?page=add_product">Add New Product</a>

<hr>

<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th>Name</th>
			<th></th>
		</tr>
	</thead>

	<tbody>
	<?php if( $products && $products->num_rows ) { ?>
		<?php 
			$cnt = 1;
			while( $product = $products->fetch_object() ) { ?>
		<tr>
			<td><?php echo $cnt; ?></td>
			<td><?php echo $product->name ?></td>
			<th>
				<a href="./?page=edit_product&id=<?php echo $product->id ?>">Edit</a>
				<a href="./?page=delete_product&id=<?php echo $product->id ?>&action=delete_product">Delete</a>
			</th>
		</tr>
		<?php 
				$cnt++;
			} 
		?>
	<?php } else { ?>

	<?php } ?>
	</tbody>
</table>


<?php include './elements/footer.php'; ?>