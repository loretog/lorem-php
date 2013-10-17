<form method="post" action="<?php echo DIR; ?>/miscellaneous/save/">
	<input type="hidden" name="request" value="add" />	
	<table class="entry">
		<tr>
			<td>Year Levels</td>
			<td>			
				<select name="year_level_id">
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
			</td>
		</tr>
		<tr>
			<td>Name</td>
			<td><input type="text" name="misc_name" value="" /></td>
		</tr>
		<tr>
			<td>Description</td>
			<td>
				<textarea name="description" style="width: 100%;"></textarea>
			</td>
		</tr>
		<tr>
			<td>Amount</td><td><input type="text" name="amount" value="" /></td>
		</tr>
		<tr>
			<td>Require By Subject</td>
			<td>
				<select name="required_by_subject">
					<option value="0">None</option>
					<?php while($subject = $subjects->fetch_object()) : ?>
					<option value="<?php echo $subject->id ?>"><?php echo $subject->name ?></option>
					<?php endwhile; ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Require By Gender</td>
			<td>
				<input type="radio" checked="checked" value="0" name="required_by_gender" /> Both
				<input type="radio" value="1" name="required_by_gender" /> Male
				<input type="radio" value="2" name="required_by_gender" /> Female
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input title="Save" type="submit" value="" class="save" />
				<a title="Cancel" class="cancel"  href="<?php echo DIR; ?>/miscellaneous/"></a>
			</td>
		</tr>		
	</table>
</form>