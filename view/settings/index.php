<a class="add" href="<?php echo URL ?>/settings/add"></a>
<table class="grid">
	<tr class="ghead">
		<td></td>
		<td>Program Name</td>
		<td>Year Level</td>
		<td>Entrance Exam Total Score</td>
		<td>Maximum Number of Student per Section</td>
		<td>Open for Enrollment</td>
	</tr>
	<?php if($settings->num_rows > 0) : ?>
	<?php while($setting = $settings->fetch_object()) : ?>
	<tr>
		<td>
			<a class="edit" href="<?php echo URL ?>/settings/edit/<?php echo $setting->id ?>"></a>
			<a class="delete" href="<?php echo URL ?>/settings/delete/<?php echo $setting->id ?>"></a>
		</td>
		<td><?php echo $setting->program_name ?></td>
		<td><?php echo $setting->name ?></td>
		<td><?php echo $setting->entrance_exam_total_score ?></td>
		<td><?php echo $setting->max_number_per_section ?></td>
		<td><?php echo $setting->enrollment_open == 0 ? 'No' : 'Yes' ?></td>
	</tr>
	<?php endwhile; ?>
	<?php else : ?>
	<tr>
		<td colspan="6">No current record.</td>
	</tr>
	<?php endif; ?>
</table>