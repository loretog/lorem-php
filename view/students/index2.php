<div style="margin-bottom: 10px;">
	<form method="post" action="<?php echo URL ?>/students/index">
		School Years
		<select id="school_year_id" name="school_year_id">	
			<option></option>
			<?php while($sy = $school_years->fetch_object()) : ?>
				<?php if(isset($sy_id) && ($sy_id == $sy->id)) : ?>
					<option selected="selected" value="<?php echo $sy->id ?>"><?php echo $sy->years ?></option>
				<?php else : ?>
					<option value="<?php echo $sy->id ?>"><?php echo $sy->years ?></option>
				<?php endif; ?>
			<?php endwhile; ?>	
		</select>
		Sections
		<select id="section_id" name="section_id">	
			<option></option>
			<?php while($sect = $sections->fetch_object()) : ?>
				<?php if(isset($s_id) && ($s_id == $sect->id)) : ?>
					<option selected="selected" value="<?php echo $sect->id ?>"><?php echo $sect->names ?></option>
				<?php else : ?>
					<option value="<?php echo $sect->id ?>"><?php echo $sect->names ?></option>
				<?php endif; ?>
			<?php endwhile; ?>	
		</select>
		<input type="submit" value="Search" />		
	</form>
</div>

<script type="text/javascript">
	function search_sidn(obj) {
		var action = $(obj).attr('action');
		action += $("#sidn").val();
		$(obj).attr('action', action);
		window.location = action;		
	}
</script>

<div style="margin-bottom: 10px;">
	<form method="post" action="<?php echo URL ?>/students/index/sidn/" onsubmit="return search_sidn(this);">
		SIDN <input type="text" name="sidn" id="sidn" value="" />
		<input type="submit" value="Search by SIDN" />
		<a href="<?php echo URL ?>/students">Show All</a>
	</form>
</div>
<table class="grid">
<tr class="ghead">
	<td></td>
	<td>Year Level</td>
	<td>Section</td>
	<td>School Year</td>
	<td>SIDN</td>
	<td>Last Name</td>
	<td>First Name</td>
	<td>Middle Name</td>
	<td>Balance</td>	
</tr>
<?php if(isset($students) && $students->num_rows > 0) : ?>
<?php while($student = $students->fetch_object()) : ?>
	<tr>
		<td style="width: 180px;">
			<p>
				<a href="<?php echo URL ?>/students/view/<?php echo $student->id ?>">View/Update Profile</a> |
				<a href="<?php echo URL ?>/student_grades/view/<?php echo $student->id . "/" . $student->year_level_id . "/" . $student->section_id ?>">Grades</a>				
			</p>
			<p>
				<?php 
					$balance = ((float)$student->amount) - ((float)$student->paid); 
					if($balance > 0) :
				?>
				<a href="<?php echo URL ?>/payments/pay_balance/<?php echo $student->id . "/" . $student->year_level_id . "/" . $student->school_year_id ?>">Pay Balance</a> |
				<?php endif; ?>
				<a href="<?php echo URL ?>/payments/history/<?php echo $student->id . "/" . $student->year_level_id . "/" . $student->school_year_id. "/" . $student->section_id ?>">Payment History</a>
			</p>
		</td>
		<td><?php echo $student->year_name; ?></td>
		<td><?php echo $student->section_name; ?></td>
		<td><?php echo $student->school_year; ?></td>
		<td><?php echo $student->sidn; ?></td>
		<td><?php echo $student->last; ?></td>
		<td><?php echo $student->first; ?></td>
		<td><?php echo $student->middle; ?></td>
		<td><?php echo sprintf("%1.2f", $balance); ?></td>		
	</tr>
<?php endwhile; ?>
<?php else : ?>
	<tr>
		<td colspan="9">No current record</td>
	</tr>
<?php endif; ?>
</table>