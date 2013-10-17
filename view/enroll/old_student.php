<?php
	$active_sy = null;
	$school_year = "<select name='school_year_id' style='width: 203px;'>";
	while($sy = $school_years->fetch_object()) {
		if($sy->active == 1) {
			$active_sy = array('id' => $sy->id, 'range' => $sy->year_start . ' - ' . $sy->year_end);
		}
		$school_year .= "<option value='{$sy->id}'>{$sy->year_start} - {$sy->year_end}</option>\n";
	}
	$school_year .= "</select>";		
?>
<form method="post" action="<?php echo URL ?>/enroll/old_student">
<table class="grid" style="margin: 15px auto; width: 80%;">
	<tr class="ghead">
		<td colspan="2">Search Student</td>
	</tr>
	<tr>
		<td style="width: 20%;">School Year:</td>
		<td>
			<?php echo $school_year; ?>
		</td>
	</tr>
	<tr>
		<td>Enter Student ID Number:</td>
		<td>
			<input type="text" name="sidn" style="width: 200px" />
		</td>
	</tr>		
	<tr>
		<td colspan="2">
			<input type="submit" value="Search" />
		</td>
	</tr>	
</table>
</form>
<?php if(isset($student)) : ?>
	<table class="grid" style="margin: 15px auto; width: 80%;">
		<tr class="ghead">
			<td colspan="2">Student Found</td>
		</tr>
		<tr>
			<td style="width: 20%;">Student ID Number</td>
			<td><?php echo $student->sidn; ?></td>
		</tr>
		<tr>
			<td>Last Name</td>
			<td><?php echo $student->last; ?></td>
		</tr>
		<tr>
			<td>First Name</td>
			<td><?php echo $student->first; ?></td>
		</tr>
		<tr>
			<td>Middle Name</td>
			<td><?php echo $student->middle; ?></td>
		</tr>
		<tr>
			<td>Student Average</td>
			<?php $average = sprintf("%10.2f", $student->student_average); ?>
			<td><b <?php echo ($average < 85) ? 'style="color: red;"' : '' ?>><?php echo $average ?></b></td>
		</tr>
		<tr>
			<td>Miscellaneous</td>
			<td>Php <?php echo $student->misc; ?></td>
		</tr>
		<tr>
			<td>Total Payment</td>
			<td>Php <?php echo (int)$student->paid; ?></td>
		</tr>
		<tr>
			<td>Remaining Balance</td>
			<?php $balance = ((int)$student->misc) - ((int)$student->paid); ?>
			<td><b <?php echo ($balance > 0) ? 'style="color: red;"' : '' ?>>Php <?php echo $balance ?></b></td>
		</tr>		
	</table>
	
	<table class="grid" style="margin: 15px auto; width: 80%;">
		<tr class="ghead">
			<td colspan="2">Current</td>
		</tr>
		<tr>
			<td style="width: 20%;">Program</td>
			<td><?php echo $student->program_name; ?></td>
		</tr>		
		<tr>
			<td style="width: 20%;">Year Level</td>
			<td><?php echo $student->yl_name; ?></td>
		</tr>
		<tr>
			<td style="width: 20%;">Section</td>
			<td><?php echo $student->sect_name; ?></td>
		</tr>
	</table>
<script type="text/javascript">
	window.onload = function() {
		var enroll_student = document.getElementById("enroll_student");
		enroll_student.onsubmit = function() {
			var balance = document.getElementById("balance").value;
			var average = document.getElementById("average").value;
			if(balance > 0) {
				alert("Student still has a remaining balance of " + balance);
				return false;
			}
			if(average < 85) {
				alert("Passing average must be greater than or equal to 85.");
				return false;
			}
			return true;
		};
	};
</script>
	<?php if($student->next_year_level_id != null) : ?>
	<form id="enroll_student" method="post" action="<?php echo URL ?>/enroll/line_up_old_student">
		<input type="hidden" name="program_id" value="<?php echo $student->program_id ?>" />
		<input type="hidden" name="year_level_id" value="<?php echo $student->next_year_level_id ?>" />	
		<input type="hidden" name="student_id" value="<?php echo $student->id ?>" />
		<input type="hidden" id="balance" name="balance" value="<?php echo $balance ?>" />
		<input type="hidden" id="average" name="average" value="<?php echo $average ?>" />
		<table class="grid" style="margin: 15px auto; width: 80%;">
			<tr class="ghead">
				<td colspan="2">Proceeding</td>
			</tr>
			<tr>
				<td style="width: 20%;">Next School Year</td>			
				<td><?php echo $active_sy['range']; ?>
					<input type="hidden" name="school_year_id" value="<?php echo $active_sy['id'] ?>" />
				</td>
			</tr>
			<tr>
				<td style="width: 20%;">Next Year Level</td>			
				<td><?php echo $student->next_year_level_name ?></td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" value="Line Up Student" />
				</td>
			</tr>
		</table>
	</form>
	<?php else : ?>
		<table class="grid" style="margin: 15px auto; width: 80%;">
			<tr class="ghead">
				<td colspan="2">Proceeding</td>
			</tr>
			<tr>
				<td>
					<b style="color: green;">There are no next year level left.</b>
				</td>
			</tr>
		</table>		
	<?php endif; ?>
<?php endif; ?>