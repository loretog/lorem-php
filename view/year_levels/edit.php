<form method="post" action="<?php echo DIR; ?>/year_levels/save">
	<input type="hidden" name="request" value="edit" />
	<input type="hidden" name="id" value="<?php echo $year->id; ?>" />	
	<table class="entry">
		<tr>
			<td>Programs</td>
			<td>
				<select name="program_id">
					<?php while($program = $programs->fetch_object()) : ?>
					<option value="<?php echo $program->id ?>" <?php if($year->program_id == $program->id) echo "selected='selected'"; ?>><?php echo $program->program_name ?></option>
					<?php endwhile; ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Year Name</td>
			<td><input type="text" name="name" value="<?php echo $year->name; ?>" /></td>
		</tr>
		<tr>
			<td>Year Order</td>
			<td><input type="text" name="year_order" value="<?php echo $year->year_order; ?>" /></td>
		</tr>
		<tr>
			<td colspan="2">				
				<input title="Save" type="submit" value="" class="save" />
				<a title="Cancel" class="cancel"  href="<?php echo DIR; ?>/year_levels/"></a>
			</td>
		</tr>
	</table>
</form>