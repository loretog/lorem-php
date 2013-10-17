<style type="text/css">
	fieldset.group > fieldset { width: 47%; float: left; margin-right: 10px; }	
	fieldset.group > fieldset input[type=text] { width: 98%; }
</style>
<script type="text/javascript">
	function submit_form() {
		var year = document.getElementById('b_year').value;
		var month = document.getElementById('b_month').value;
		var day = document.getElementById('b_day').value;
		document.getElementById("birthday").value = year + "-" + month + "-" + day;
	}
</script>
<form method="post" action="<?php echo DIR ?>/students/save" onsubmit="submit_form()">
<input type="hidden" id="birthday" name="birthday" value="" />
<input type="hidden" name="request" value="add" />
<h2>New Student</h2>
<fieldset class="group">
	<legend>Student</legend>
	<fieldset>
	<legend>Personal Information</legend>
	<p>School Year<br />	
	<input type="hidden" name="school_year_id" value="<?php echo $school_year->id ?>" />
	<b><?php echo $school_year->year_start . " - " . $school_year->year_end ?></b>
	</p>
	<p>
		Year Levels<br />
		<select name="year_level_id">
			<?php while($year_level = $year_levels->fetch_object()) : ?>
			<option value="<?php echo $year_level->id ?>"><?php echo $year_level->name ?></option>
			<?php endwhile; ?>
		</select>
	</p>
	<p>Entrance Exam Score<br /><input type="text" name="entrance_exam_score" value="" /></p>
	<p>First Name<br /><input type="text" name="first" value="" /></p>
	<p>Middle Name<br /><input type="text" name="middle" value="" /></p>
	<p>Last Name<br /><input type="text" name="last" value="" /></p>
	<p>Gender<br />
	<select name="gender">
		<option value="male">Male</option>
		<option value="female">Female</option>
	</select>
	</p>
	<p>Citizenship<br /><input type="text" name="citizenship" value="" /></p>
	<p>
	Birthday<br />
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
	</p>
	<p>Place of Birth<br /><input type="text" name="place_of_birth" value="" /></p>
	<p>Permanent Address<br /><input type="text" name="permanent_address" value="" /></p>
	<p>Parent's Address<br /><input type="text" name="parents_address" value="" /></p>
	<p>Contact Number<br /><input type="text" name="student_contact_no" value="" /></p>
	</fieldset>
	<fieldset>
		<legend>School Information</legend>
		<p>Last School Attended<br /><input type="text" name="last_school_attended" /></p>		
		<p>School Address<br /><input type="text" name="school_address" /></p>
		<p>School Year<br /><input type="text" name="school_year" /></p>
		<p>Grade and Section<br /><input type="text" name="grade_and_section" /></p>
		<p>General Average<br /><input type="text" name="general_average" /></p>		
	</fieldset>
	<fieldset>	
		<legend>Guardian</legend>
		<p>Last Name<br /><input type="text" name="guardian_last" value="" /></p>
		<p>First Name<br /><input type="text" name="guardian_first" value="" /></p>
		<p>Middle Name<br /><input type="text" name="guardian_middle" value="" /></p>
		<p>Occupation<br /><input type="text" name="guardian_occupation" value="" /></p>
		<p>Address<br /><input type="text" name="guardian_address" value="" /></p>
		<p>Contact No.<br /><input type="text" name="guardian_contact_no" value="" /></p>
	</fieldset>
</fieldset>

<fieldset class="group">
	<legend>Parents Information</legend>
	<fieldset class="father">	
		<legend>Father</legend>
		<p>Last Name<br /><input type="text" name="father_last" value="" /></p>
		<p>First Name<br /><input type="text" name="father_first" value="" /></p>
		<p>Middle Name<br /><input type="text" name="father_middle" value="" /></p>
		<p>Occupation<br /><input type="text" name="father_occupation" value="" /></p>
		<p>Office Address<br /><input type="text" name="father_office_address" value="" /></p>
		<p>Contact No.<br /><input type="text" name="father_contact_no" value="" /></p>
	</fieldset>
	<fieldset class="mother">
		<legend>Mother</legend>
		<p>Last Name<br /><input type="text" name="mother_last" value="" /></p>
		<p>First Name<br /><input type="text" name="mother_first" value="" /></p>
		<p>Middle Name<br /><input type="text" name="mother_middle" value="" /></p>
		<p>Occupation<br /><input type="text" name="mother_occupation" value="" /></p>
		<p>Office Address<br /><input type="text" name="mother_office_address" value="" /></p>
		<p>Contact No.<br /><input type="text" name="mother_contact_no" value="" /></p>
	</fieldset>
</fieldset>
<input type="submit" value="Enroll and Line-up Student" />
</form>