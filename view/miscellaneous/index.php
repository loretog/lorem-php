<h3><?php echo $yl_name; ?></h3>
<p>
<form action="<?php echo URL ?>/miscellaneous/index" method="post">
<select name="yl_id">
<?php 
	while($pyl = $pyls->fetch_object()) : 
		$selected = "";
	if(isset($yl_id) && $yl_id == $pyl->id) {
		$selected = "selected='selected'";
	}
?>
<option <?php echo $selected ?> value="<?php echo $pyl->id ?>"><?php echo $pyl->name ?></option>
<?php endwhile; ?>
</select>
<input type="submit" value="Filter" />
</form>
</p>
<a class="add" href="<?php echo URL ?>/miscellaneous/add/<?php echo isset($yl_id) ? $yl_id : '' ?>"></a>
<table class="grid">
	<tr class="ghead">
		<td></td>		
		<td>Misc Name</td>
		<td>Description</td>
		<td>Amount</td>
		<td>Require By Subject</td>
		<td>Require By Gender</td>
		<td>Created</td>
		<td>Updated</td>	
	</tr>
	<?php if(isset($miscs) && $miscs->num_rows > 0) : $total = 0; ?>
	<?php while($misc = $miscs->fetch_object()) : ?>
	<tr>
		<td>
			<a class="edit" href="<?php echo URL ?>/miscellaneous/edit/<?php echo $misc->id . "/" . (isset($yl_id) ? $yl_id : '') ?>"></a>
			<a class="delete" href="<?php echo URL ?>/miscellaneous/delete/<?php echo $misc->id ?>" onclick="return confirm('Are you sure you want to delete this?');"></a>
		</td>		
		<td><?php echo $misc->misc_name ?></td>		
		<td><?php echo $misc->description ?></td>		
		<td><?php echo $misc->amount ?></td>		
		<td><?php echo ($misc->required_by_subject == "" ? "None" : $misc->required_by_subject) ?></td>		
		<td>
			<?php 
				if($misc->required_by_gender == 0) echo "Both";
				elseif($misc->required_by_gender == 1) echo "Male";
				elseif($misc->required_by_gender == 2) echo "Female" ;
			?>
		</td>		
		<td><?php echo $misc->created ?></td>		
		<td><?php echo $misc->updated ?></td>		
	</tr>	
	<?php 
		$total += $misc->amount;
		endwhile; 
	?>
	<tr>
		<td colspan="8">Total Amount: <b style="font-size: 15px;"><?php echo $total; ?></b></td>
	</tr>
	<?php else : ?>
	<tr>
		<td colspan="8">No current record</td>
	</tr>
	<?php endif; ?>
</table>