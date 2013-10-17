<style type="text/css">
	.grid tr td input[type='text'] { width: 95%; font-size: 11px; padding: 5px; border: 1px solid #000; }
	.grid tr td:first-child { width: 30%; font-weight: bold; }
	.star { color: red; font-size: 14px; }
	.required { color: #000; }
</style>

<script type="text/javascript">
	$(document).ready(function() {
		$("#prof_form").submit(function() {
			error = 0;
			
			$(".number").each(function() {
				var value = $(this).val();
				if(value.search(/^\s*(\+|-)?\d+\s*$/) == -1) {					
					alert("Please enter a valid number for field: \n\n\r" + $(this).parent().parent().children("td:first-child").html());
					$(this).css('background-color', 'red');
					$(this).css('color', '#fff');
					error++;
				}
			});
			
			$(".required").each(function() {
				var value = $(this).val();
				if(value == "") {
					alert("Please enter value for field: \n\n\r" + $(this).parent().parent().children("td:first-child").html());
					$(this).css('background-color', 'red');
					$(this).css('color', '#fff');
					error++;
				}
			});
			
			if(error > 0)
				return false;
		});
	});
</script>

<form id="prof_form" method="post" action="<?php echo URL ?>/students/update_profile">
	<input type="hidden" name="id" value="<?php echo $student->id ?>" />
<table class="grid" style="width: 80%; margin: 0 auto;">
	<tr class="ghead">
		<td colspan="2">Student's Information</td>
	</tr>
	<tr>
		<td>SIDN:</td>
		<td><input type="text" name="sidn" value="<?php echo $student->sidn ?>" readonly="readonly" style="background-color: #eee;" /></td>
	</tr>
	<tr>
		<td>First:</td>
		<td>
			<input class="required" type="text" name="first" value="<?php echo $student->first ?>" />
			<b class="star">*</b>
		</td>
	</tr>
	<tr>
		<td>Middle:</td>
		<td>
			<input class="required" type="text" name="middle" value="<?php echo $student->middle ?>" />
			<b class="star">*</b>
		</td>
	</tr>
	<tr>
		<td>Last:</td>
		<td>
			<input class="required" type="text" name="last" value="<?php echo $student->last ?>" />
			<b class="star">*</b>
		</td>
	</tr>
	<tr>
		<td>Gender:</td>
		<td>			
			<select name="gender">
				<option value="male" <?php echo ($student->gender == 'male' ? 'selected="selected"' : '') ?>>Male</option>
				<option value="female" <?php echo ($student->gender == 'female' ? 'selected="selected"' : '') ?>>Female</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Citizenship:</td>
		<td><input type="text" name="citizenship" value="<?php echo $student->citizenship ?>" /></td>
	</tr>
	<tr>
		<td>Entrance Exam Score:</td>
		<td>
			<input type="text" class="requried number" name="entrance_exam_score" value="<?php echo $student->entrance_exam_score ?>" />
			<b class="star">*</b>
		</td>
	</tr>
	<tr>
		<td>Interview Score:</td>
		<td>
			<input type="text" class="required number" name="interview_score" value="<?php echo $student->interview_score ?>" />
			<b class="star">*</b>
		</td>
	</tr>
	<tr>
		<td>Birthday:</td>
		<td><input type="text" name="birthday" value="<?php echo $student->birthday ?>" /></td>
	</tr>
	<tr>
		<td>Place of Birth:</td>
		<td><input type="text" name="place_of_birth" value="<?php echo $student->place_of_birth ?>" /></td>
	</tr>
	<tr>
		<td>Permanent Address:</td>
		<td><input type="text" name="permanent_address" value="<?php echo $student->permanent_address ?>" /></td>
	</tr>
	<tr>
		<td>Parent's Address:</td>
		<td><input type="text" name="parents_address" value="<?php echo $student->parents_address ?>" /></td>
	</tr>
	<tr>
		<td>Student Contact Number:</td>
		<td><input type="text" name="student_contact_no" value="<?php echo $student->student_contact_no ?>" /></td>
	</tr>
	<tr class="ghead">
		<td colspan="2">Last School</td>
	</tr>
	<tr>
		<td>Last Attended School:</td>
		<td><input type="text" name="school_last_attended" value="<?php echo $student->school_last_attended ?>" /></td>
	</tr>
	<tr>
		<td>School Address:</td>
		<td><input type="text" name="school_address" value="<?php echo $student->school_address ?>" /></td>
	</tr>
	<tr>
		<td>School Year:</td>
		<td><input type="text" name="school_year" value="<?php echo $student->school_year ?>" /></td>
	</tr>
	<tr>
		<td>Grade and Section:</td>
		<td><input type="text" name="grade_and_section" value="<?php echo $student->grade_and_section ?>" /></td>
	</tr>
	<tr>
		<td>General Average:</td>
		<td>
			<input type="text" class="required number" name="general_average" value="<?php echo $student->general_average ?>" />
			<b class="star">*</b>
		</td>
	</tr>
	<tr class="ghead">
		<td colspan="2">Father's Information</td>
	</tr>
	<tr>
		<td>First Name:</td>
		<td><input type="text" name="father_first" value="<?php echo $student->father_first ?>" /></td>
	</tr>
	<tr>
		<td>Middle Name:</td>
		<td><input type="text" name="father_first" value="<?php echo $student->father_first ?>" /></td>
	</tr>
	<tr>
		<td>Last Name:</td>
		<td><input type="text" name="father_last" value="<?php echo $student->father_last ?>" /></td>
	</tr>
	<tr>
		<td>Occupation:</td>
		<td><input type="text" name="father_occupation" value="<?php echo $student->father_occupation ?>" /></td>
	</tr>
	<tr>
		<td>Office Address:</td>
		<td><input type="text" name="father_office_address" value="<?php echo $student->father_office_address ?>" /></td>
	</tr>
	<tr>
		<td>Contact Number:</td>
		<td><input type="text" name="father_contact_no" value="<?php echo $student->father_contact_no ?>" /></td>
	</tr>
	<tr class="ghead">
		<td colspan="2">Mother's Information</td>
	</tr>
	<tr>
		<td>First Name:</td>
		<td><input type="text" name="mother_first" value="<?php echo $student->mother_first ?>" /></td>
	</tr>
	<tr>
		<td>Maiden Name:</td>
		<td><input type="text" name="mother_middle" value="<?php echo $student->mother_middle ?>" /></td>
	</tr>
	<tr>
		<td>Last Name:</td>
		<td><input type="text" name="mother_last" value="<?php echo $student->mother_last ?>" /></td>
	</tr>
	<tr>
		<td>Occupation:</td>
		<td><input type="text" name="mother_occupation" value="<?php echo $student->mother_occupation ?>" /></td>
	</tr>
	<tr>
		<td>Office Address:</td>
		<td><input type="text" name="mother_office_address" value="<?php echo $student->mother_office_address ?>" /></td>
	</tr>
	<tr>
		<td>Contact Number:</td>
		<td><input type="text" name="mother_contact_no" value="<?php echo $student->mother_contact_no ?>" /></td>
	</tr>
	<tr class="ghead">
		<td colspan="2">Guardian's Information</td>
	</tr>
	<tr>
		<td>First Name:</td>
		<td><input type="text" name="guardian_first" value="<?php echo $student->guardian_first ?>" /></td>
	</tr>
	<tr>
		<td>Middle Name:</td>
		<td><input type="text" name="guardian_middle" value="<?php echo $student->guardian_middle ?>" /></td>
	</tr>
	<tr>
		<td>Last Name:</td>
		<td><input type="text" name="guardian_last" value="<?php echo $student->guardian_last ?>" /></td>
	</tr>
	<tr>
		<td>Occupation:</td>
		<td><input type="text" name="guardian_occupation" value="<?php echo $student->guardian_occupation ?>" /></td>
	</tr>
	<tr>
		<td>Address:</td>
		<td><input type="text" name="guardian_address" value="<?php echo $student->guardian_address ?>" /></td>
	</tr>
	<tr>
		<td>Contact Number:</td>
		<td><input type="text" name="guardian_contact_no" value="<?php echo $student->guardian_contact_no ?>" /></td>
	</tr>
	<tr>
		<td>Created:</td>
		<td><?php echo date('Y-m-d h:i A', $student->created) ?></td>
	</tr>
	<tr>
		<td>Updated:</td>
		<td><?php echo date('Y-m-d h:i A', $student->updated) ?></td>
	</tr>
	<tr>
		<td colspan="2">
			<input type="submit" value="Update Profile" />
			<a href="<?php echo URL ?>/students">Cancel</a>
		</td>
	</tr>
</table>

</form>