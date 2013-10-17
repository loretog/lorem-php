<h2>Add Subject</h2>
<form method="post" action="<?php echo DIR; ?>/subjects/save/">
	<input type="hidden" name="request" value="add" />	
	<input type="hidden" name="year_level_id" value="<?php echo isset($year_level_id) ? $year_level_id : '' ?>" />	
	<table class="entry">
		<tr>
			<td>Year Level</td>
			<td>			
				<select name="year_level_id">
				<?php while($year_level = $year_levels->fetch_object()) : ?>
					<?php if(isset($year_level_id) && $year_level->id == $year_level_id) : ?>
					<option value="<?php echo $year_level->id ?>" selected="selected"><?php echo $year_level->name ?></option>
					<?php else: ?>
					<option value="<?php echo $year_level->id ?>"><?php echo $year_level->name ?></option>
					<?php endif; ?>
				<?php endwhile; ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Name</td>
			<td><input type="text" name="name" value="" /></td>
		</tr>
		<tr>
			<td>Description</td>
			<td><input type="text" name="description" value="" /></td>
		</tr>
		<tr>
			<td>Unit</td>
			<td><input type="text" name="unit" value="" /></td>
		</tr>
		<tr>
			<td colspan="2">
				<input title="Save" class="save" type="submit" value="" />
				<a title="Cancel" class="cancel" href="<?php echo URL ?>/subjects"></a>
			</td>
		</tr>		
	</table>
</form>