<h2><?php echo $student->last . ", " . $student->first . " " . $student->middle ?></h2>
<p>Program: <b><?php echo $level->program_name ?></p></b>
<p>Year Level: <b><?php echo $level->name ?></p></b>
<p>Section: <b><?php echo $level->sname ?></p></b>

<table class="grid">
	<tr class="ghead">		
		<td>Subject Name</td>
		<td>Unit</td>		
		<td>1st</td>		
		<td>2nd</td>		
		<td>3rd</td>		
		<td>4th</td>		
		<td>Note</td>		
		<td></td>		
	</tr>
<?php if(isset($student_subjects) && $student_subjects->num_rows > 0) : ?>
<?php while($sg = $student_subjects->fetch_object()) : ?>
	<tr>		
		<td><h2><?php echo $sg->name ?></h2></td>
		<td><?php echo $sg->unit ?></td>
		<!--<td><?php echo is_null($sg->student_grade_id) ?></td>-->
	<form method="post" action="<?php echo URL ?>/grades/<?php echo ($sg->grade != null) ? 'update' : 'add' ?>" onsubmit="return check_grade(this);">
		<td><input name="first" type="text" value="<?php echo (int)$sg->first ?>" style="width: 30px;" /></td>
		<td><input name="second" type="text" value="<?php echo (int)$sg->second ?>" style="width: 30px;" /></td>
		<td><input name="third" type="text" value="<?php echo (int)$sg->third ?>" style="width: 30px;" /></td>
		<td><input name="fourth" type="text" value="<?php echo (int)$sg->fourth ?>" style="width: 30px;" /></td>
		<td style="width: 300px;">
			<textarea name="note" style="width: 98%"><?php echo ($sg->grade != null) ? ($sg->note != null ? $sg->note : '') : 'No grades yet' ?></textarea>
		</td>
		<td class="controls" style="text-align: center;">
				<input type="hidden" value="<?php echo $year_level_id ?>" name="year_level_id" />
				<input type="hidden" value="<?php echo $student_id ?>" name="student_id" />
				<input type="hidden" value="<?php echo $sg->id ?>" name="subject_id" />
				<?php if($sg->student_grade_id != null) : ?>
				<input type="hidden" value="<?php echo $sg->student_grade_id ?>" name="id" />
				<?php endif; ?>
				<!--<input type="text" value="<?php echo ($sg->student_grade_id != null) ? $sg->grade : '' ?>" name="grade" style="width: 95%; display: block; margin-bottom: 5px;" />-->
				<input type="submit" value="<?php echo ($sg->student_grade_id != null) ? 'Update' : 'Add' ?> Grade" />						
		</td>	
	</form>
	</tr>
<?php endwhile; ?>
<?php else : ?>
	<tr>
		<td colspan="3">No current record</td>
	</tr>
<?php endif; ?>
</table>
<br />
<p><a href="<?php echo URL ?>/students/index/sidn/<?php echo $student->sidn ?>"><< Back</a></p>