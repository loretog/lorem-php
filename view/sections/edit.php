<form method="post" action="<?php echo DIR; ?>/sections/save/">
	<input type="hidden" name="request" value="edit" />
	<input type="hidden" name="section_id" value="<?php echo $section_id; ?>" />	
	<table class="entry">
		<tr>
			<td>Year Level</td>
			<td>
				<select name="year_level_id">
				<?php while($year_level = $year_levels->fetch_object()) : ?>
					<?php if($year_level->id == $year_level_id) : ?>
					<option value="<?php echo $year_level->id ?>" selected="selected"><?php echo $year_level->program_name . " - " . $year_level->name ?></option>
					<?php else: ?>
					<option value="<?php echo $year_level->id ?>"><?php echo $year_level->program_name . " - " . $year_level->name ?></option>
					<?php endif; ?>
				<?php endwhile; ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Section Order</td>
			<td><input type="text" name="section_order" value="<?php echo $section_order; ?>" /></td>
		</tr>
		<tr>
			<td>Section Name</td>
			<td><input type="text" name="name" value="<?php echo $section_name; ?>" /></td>
		</tr>
		<tr>
			<td colspan="2">
				<input class="save" type="submit" value="" />
				<a title="Cancel" class="cancel"  href="<?php echo DIR; ?>/sections/"></a>
			</td>
		</tr>	
	</table>
</form>