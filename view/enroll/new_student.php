<style type="text/css">
	.grid tr td input[type='text'] { width: 95%; font-size: 11px; padding: 5px; border: 1px solid #000; }
	.grid tr td:first-child { width: 30%; font-weight: bold; }
	.star { color: red; font-size: 14px; }
	.required { color: #000; }
</style>

<script type="text/javascript">
	function submit_form() {
		var year = $('#b_year').val();
		var month = $('#b_month').val();
		var day = $('#b_day').val();
		$("#birthday").val(year + "-" + month + "-" + day);
	}
	/*$(function() {
		$("#lineup_form").submit(function() {
			var error_count = 0;
			$(".required input[type=text]").each(function(i) {
				if($(this).val() == "") {
					++error_count;
				}
			});
			$(".required select").each(function(i) {
				if($(this).val() == "-- Select Program --" || $(this).val() == "") {
					++error_count;
				}
			});
			if(error_count > 0) {
				alert("Please fill in all required fields. It seems that you missed " + error_count + " of them.");
				return false;
			} else
				return true;
		});
	});*/	
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$("#lineup_form").submit(function() {
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

<form id="lineup_form" method="post" action="<?php echo URL ?>/enroll/line_up_new_student" onsubmit="submit_form()">
<input type="hidden" id="birthday" name="birthday" value="" />
<input type="hidden" name="request" value="add" />
<table class="grid" style="width: 80%; margin: 0 auto;">
	<tr class="ghead">
		<td colspan="2">Personal Information</td>
	</tr>
	<tr>
		<td>
			School Year: 
		</td>
		<td>
			<b><?php echo $school_year['start_end'] ?></b>
			<input type="hidden" name="school_year_id" value="<?php echo $school_year['id'] ?>" />	
		</td>
	</tr>
	<tr>
		<td>
			Programs and Year Levels
		</td>
		<td>
			<select id="ids" name="ids" class="required">
				<option value=""></option>
				<?php while($prog = $programs->fetch_object()) : ?>
				<option value="<?php echo $prog->ids ?>"><?php echo $prog->names ?></option>
				<?php endwhile; ?>
			</select> 
			<span class="star">*</span>
		</td>
	</tr>
	<tr>
		<td>
			Entrance Exam Score
		</td>
		<td>
			<input class="required number" type="text" name="entrance_exam_score" value="" /> <span class="star">*</span>
		</td>
	</tr>
	<tr>
		<td>
			Interview Score
		</td>
		<td>
			<input class="required number" type="text" name="interview_score" value="" /> <span class="star">*</span>
		</td>
	</tr>
	<tr>
		<td>
			ID Number
		</td>
		<td>
			<div style="margin-bottom: 10px;"><b><?php $sidn = date('Y') . "-" . sprintf("%05s", $total_students + 1); echo $sidn; ?></b></div>
			<input type="hidden" name="sidn" value="<?php echo $sidn ?>" />
		</td>
	</tr>
	<tr>
		<td>
			First Name
		</td>
		<td>
			<input class="required" type="text" name="first" value="" /> <span class="star">*</span>
		</td>
	</tr>
	<tr>
		<td>
			Middle Name
		</td>
		<td>
			<input class="required" type="text" name="middle" value="" /> <span class="star">*</span>
		</td>
	</tr>
	<tr>
		<td>
			Last Name
		</td>
		<td>
			<input class="required" type="text" name="last" value="" /> <span class="star">*</span>
		</td>
	</tr>
	<tr>
		<td>
			Gender
		</td>
		<td>
			<select name="gender">
				<option value="male">Male</option>
				<option value="female">Female</option>
			</select>	
		</td>
	</tr>
	<tr>
		<td>
			Citizenship
		</td>
		<td>
			<input type="text" name="citizenship" value="" />
		</td>
	</tr>
	<tr>
		<td>
			Birthday
		</td>
		<td>
			<select id="b_year" name="b_year">
				<?php for($i = 1980; $i <= date("Y"); $i++ ) : ?>
				<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
				<?php endfor; ?>
			</select>			
				-
			<select id="b_month" name="b_month">
				<?php for($i = 1; $i <= 12; $i++ ) : ?>
				<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
				<?php endfor; ?>
			</select>
				-
			<select id="b_day" name="b_day">
				<?php for($i = 1; $i <= 31; $i++ ) : ?>
				<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
				<?php endfor; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			Place of Birth
		</td>
		<td>
			<input type="text" name="place_of_birth" value="" />
		</td>
	</tr>
	<tr>
		<td>
			Permanent Address
		</td>
		<td>
			<input type="text" name="permanent_address" value="" />
		</td>
	</tr>
	<tr>
		<td>
			Parent's Address
		</td>
		<td>
			<input type="text" name="parents_address" value="" />
		</td>
	</tr>
	<tr>
		<td>
			Contact Number
		</td>
		<td>
			<input type="text" name="student_contact_no" value="" />
		</td>
	</tr>
	<tr class="ghead">
		<td colspan="2">School Information</td>
	</tr>
	<tr>
		<td>
			Last School Attended
		</td>
		<td>
			<input type="text" name="last_school_attended" />
		</td>
	</tr>
	<tr>
		<td>
			School Address
		</td>
		<td>
			<input type="text" name="school_address" />
		</td>
	</tr>
	<tr>
		<td>
			School Year
		</td>
		<td>
			<input type="text" name="school_year" />
		</td>
	</tr>
	<tr>
		<td>
			Grade and Section
		</td>
		<td>
			<input type="text" name="grade_and_section" />
		</td>
	</tr>
	<tr>
		<td>
			General Average
		</td>
		<td>
			<input class="required number" type="text" name="general_average" /> <span class="star">*</span>
		</td>
	</tr>
	<tr class="ghead">
		<td colspan="2">Guardian</td>
	</tr>
	<tr>
		<td>
			Last Name
		</td>
		<td>
			<input type="text" name="guardian_last" value="" />
		</td>
	</tr>
	<tr>
		<td>
			First Name
		</td>
		<td>
			<input type="text" name="guardian_first" value="" />
		</td>
	</tr>
	<tr>
		<td>
			Middle Name
		</td>
		<td>
			<input type="text" name="guardian_middle" value="" />
		</td>
	</tr>
	<tr>
		<td>
			Occupation
		</td>
		<td>
			<input type="text" name="guardian_occupation" value="" />
		</td>
	</tr>
	<tr>
		<td>
			Address
		</td>
		<td>
			<input type="text" name="guardian_address" value="" />
		</td>
	</tr>
	<tr>
		<td>
			Contact No.
		</td>
		<td>
			<input type="text" name="guardian_contact_no" value="" />
		</td>
	</tr>
	<tr class="ghead">
		<td colspan="2">Father Information</td>
	</tr>
	<tr>
		<td>
			Last Name
		</td>
		<td>
			<input type="text" name="father_last" value="" />
		</td>
	</tr>
	<tr>
		<td>
			First Name
		</td>
		<td>
			<input type="text" name="father_first" value="" />
		</td>
	</tr>
	<tr>
		<td>
			Middle Name
		</td>
		<td>
			<input type="text" name="father_middle" value="" />
		</td>
	</tr>
	<tr>
		<td>
			Occupation
		</td>
		<td>
			<input type="text" name="father_occupation" value="" />
		</td>
	</tr>
	<tr>
		<td>
			Office Address
		</td>
		<td>
			<input type="text" name="father_office_address" value="" />
		</td>
	</tr>
	<tr>
		<td>
			Contact No.
		</td>
		<td>
			<input type="text" name="father_contact_no" value="" />
		</td>
	</tr>
	<tr class="ghead">
		<td colspan="2">Mother Information</td>
	</tr>
	<tr>
		<td>
			Last Name
		</td>
		<td>
			<input type="text" name="mother_last" value="" />
		</td>
	</tr>
	<tr>
		<td>
			First Name
		</td>
		<td>
			<input type="text" name="mother_first" value="" />
		</td>
	</tr>
	<tr>
		<td>
			Middle Name
		</td>
		<td>
			<input type="text" name="mother_middle" value="" />
		</td>
	</tr>
	<tr>
		<td>
			Occupation
		</td>
		<td>
			<input type="text" name="mother_occupation" value="" />
		</td>
	</tr>
	<tr>
		<td>
			Office Address
		</td>
		<td>
			<input type="text" name="mother_office_address" value="" />
		</td>
	</tr>
	<tr>
		<td>
			Contact No.
		</td>
		<td>
			<input type="text" name="mother_contact_no" value="" />
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<input type="submit" value="Enroll and Line-up Student" /> <a href="<?php echo URL ?>/enroll">Cancel</a>
		</td>
	</tr>
</table>
</form>