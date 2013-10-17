<h2>Update Subject</h2>
<form method="post" action="<?php echo DIR; ?>/subjects/save/">
	<input type="hidden" name="request" value="edit" />
	<input type="hidden" name="subject_id" value="<?php echo $subject_id ?>" />	
	<table class="grid" style="width: 80%;" align="center">
		<tr>
			<td>Year Level</td>
			<td>
				<select name="year_level_id">
				<?php while($year_level = $year_levels->fetch_object()) : ?>
					<?php if($year_level->id == $year_level_id) : ?>
					<option value="<?php echo $year_level->id ?>" selected="selected"><?php echo $year_level->name ?></option>
					<?php else: ?>
					<option value="<?php echo $year_level->id ?>"><?php echo $year_level->name ?></option>
					<?php endif; ?>
				<?php endwhile; ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Subject Name</td>
			<td><input type="text" name="subject_name" value="<?php echo $subject_name; ?>" /></td>
		</tr>
		<tr>
			<td>Description</td>
			<td><input type="text" name="subject_description" value="<?php echo $description; ?>" /></td>
		</tr>
		<tr>
			<td>Unit</td>
			<td><input type="text" name="subject_unit" value="<?php echo $unit; ?>" /></td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="submit" value="Update" />
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<a href="<?php echo DIR; ?>/year_levels/">back to Year Levels</a>
				|
				<a href="<?php echo DIR; ?>/subjects/index/<?php echo $year_level_id ?>">back to Subjects</a>
			</td>
		</tr>
	</table>
</form>