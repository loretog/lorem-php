<form method="post" action="<?php echo DIR; ?>/miscellaneous/save/">
	<input type="hidden" name="request" value="update" />	
	<input type="hidden" name="id" value="<?php echo $id; ?>" />	
	<table class="entry">
		<tr>
			<td>Year Levels</td>
			<td>				
				<select name="year_level_id">
				<?php 					
					while($pyl = $pyls->fetch_object()) : 
						$selected = "";
						if(isset($yl_id) && ($yl_id == $pyl->id)) {
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
			<td><input type="text" name="misc_name" value="<?php echo $misc->misc_name ?>" /></td>
		</tr>
		<tr>
			<td>Description</td>
			<td>
				<textarea name="description" style="width: 100%;"><?php echo $misc->description ?></textarea>
			</td>
		</tr>
		<tr>
			<td>Amount</td><td><input type="text" name="amount" value="<?php echo $misc->amount ?>" /></td>
		</tr>
		<tr>
			<td>Require By Subject</td>
			<td>
				<select name="required_by_subject">
					<option <?php echo ($misc->required_by_subject == "" ? "selected='selected'" : "") ?> value="0">None</option>
					<?php while($subject = $subjects->fetch_object()) : ?>
					<option <?php echo ($misc->required_by_subject == $subject->id ? "selected='selected'" : "") ?> value="<?php echo $subject->id ?>"><?php echo $subject->name ?></option>
					<?php endwhile; ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Require By Gender</td>
			<td>
				<input type="radio" <?php echo ($misc->required_by_gender == 0 ? "checked='checked'" : "") ?> value="0" name="required_by_gender" /> Both
				<input type="radio" <?php echo ($misc->required_by_gender == 1 ? "checked='checked'" : "") ?>value="1" name="required_by_gender" /> Male
				<input type="radio" <?php echo ($misc->required_by_gender == 2 ? "checked='checked'" : "") ?>value="2" name="required_by_gender" /> Female
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