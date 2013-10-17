<form method="post" action="<?php echo URL ?>/settings/save">
<input type="hidden" name="request" value="edit" />
<input type="hidden" name="id" value="<?php echo $id ?>" />
<table class="entry">
	<tr>
		<td>Programs and Year Levels</td>
		<td>
			<b><?php echo $setting->program_name . " - " . $setting->name ?></b>
		</td>
	</tr>
	<tr>
		<td>Entrance exam total score</td>
		<td><input type="text" name="entrance_exam_total_score" value="<?php echo $setting->entrance_exam_total_score ?>" /></td>
	</tr>
	<tr>
		<td>Max number per section</td>
		<td><input type="text" name="max_number_per_section" value="<?php echo $setting->max_number_per_section ?>" /></td>
	</tr>
	<tr>
		<td>Enrollment open</td>
		<td>
			<select name="enrollment_open">
				<option value="1" <?php if($setting->enrollment_open == 1) echo "selected='selected'" ?>>Yes</option>
				<option value="0" <?php if($setting->enrollment_open == 0) echo "selected='selected'" ?>>No</option>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit" value="Update" /></td>
	</tr>
</table>
</form>