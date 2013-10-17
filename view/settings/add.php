<form method="post" action="<?php echo URL ?>/settings/save">
<input type="hidden" name="request" value="add" />
<table class="entry">
	<tr>
		<td>Programs and Year Levels</td>
		<td>
			<select name="year_level_id">
			<?php while($yl = $year_levels->fetch_object()) : ?>
			<option value="<?php echo $yl->id ?>"><?php echo $yl->program_name . " - " . $yl->name ?></option>
			<?php endwhile; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Entrance exam total score</td>
		<td><input type="text" name="entrance_exam_total_score" value="" /></td>
	</tr>
	<tr>
		<td>Max number per section</td>
		<td><input type="text" name="max_number_per_section" value="" /></td>
	</tr>
	<tr>
		<td>Enrollment open</td>
		<td>
			<select name="enrollment_open">
				<option value="1">Yes</option>
				<option value="0">No</option>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit" value="Add" /></td>
	</tr>
</table>
</form>