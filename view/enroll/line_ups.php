<script type="text/javascript">
	$(function() {
		$("#lineup_form").submit(function() {
			var error = 0;
			if($("#program_id").val() == 0) {
				alert("Please select a Program.");
				error = 1;
			}			
			if($("#year_level_id").val() == "-- Select Year Level --") {
				alert("Please select a Year Level.");
				error = 1;
			}			
			if(error == 1)
				return false;
			else
				return true;
		});
	});
</script>
<h3>Upcoming Students</h3>
<form id="lineup_form" method="post" action="<?php echo URL ?>/enroll/line_ups">
Programs
<select id="program_id" name="program_id">
	<option value="0">-- Select Program --</option>
	<?php while($program = $programs->fetch_object()) : ?>
	<?php $selected = ""; if(isset($program_id) && $program_id == $program->id) { $selected = "selected='selected'"; } ?>
	<option <?php echo $selected; ?> value="<?php echo $program->id ?>"><?php echo $program->program_name ?></option>
	<?php endwhile; ?>
</select>

Year Levels
<select id="year_level_id" name="year_level_id">
	<option value="0">-- Select Year Level --</option>
	<?php if(isset($year_levels) && $year_levels->num_rows > 0) : ?>
	<?php while($yl = $year_levels->fetch_object()) : ?>
	<?php $selected = ""; if(isset($year_level_id) && $year_level_id == $yl->id) { $selected = "selected='selected'"; } ?>
	<option <?php echo $selected ?> value="<?php echo $yl->id ?>"><?php echo $yl->name ?></option>
	<?php endwhile; ?>
	<?php endif; ?>
</select>
<input type="submit" value="Open Lineups" />
</form>

<form method="post" action="<?php echo URL ?>/enroll/assign_sections">
<table class="grid">
	<tr class="ghead">		
		<td>ID</td>		
		<td>First Name</td>		
		<td>Last Name</td>		
		<td>Middle Name</td>		
		<td>Average</td>		
		<td>New Section</td>		
	</tr>
<?php if(isset($lineups) && $lineups->num_rows > 0) : ?>
<?php 
	$count = 0;
	$index = 0;
	while($lineup = $lineups->fetch_object()) : ?>
		<?php
		if(!isset($sections[$index])) {
				$order = (count($sections) + 1);
				$data = array('year_level_id' => $yl_id, 'section_order' => $order, 'name' => "Section $order");
				if($this->registry->db->insert("sections", $data)) {
					$last_id = $this->registry->db->insert_id;
					$sections[] = $last_id . "_" . "Section $order";
				}
			}
		?>
	<tr>		
		<td><?php echo $lineup->sidn ?></td>
		<td><?php echo $lineup->last ?></td>
		<td><?php echo $lineup->first ?></td>
		<td><?php echo $lineup->middle ?></td>		
		<td>			
			<?php $lineup->average; echo ($lineup->average != null) ? sprintf("%10.5f", $lineup->average) : (($lineup->entrance_average != null) ? sprintf("%10.5f", $lineup->entrance_average) : '0') ?>
		</td>		
		<?php			
			if(isset($max)) {				
				list($id, $name) = explode("_", $sections[$index]);
				if($count == ($max - 1)) {
					$index++;
					$count = 0;
				} else {
					$count++;				
				}
			}
		?>
		<td>
			<input type="hidden" name="year_level_id" value="<?php echo $enrolling_year_level ?>" />
			<input type="hidden" name="section[<?php echo isset($id) ? $id : '' ?>][]" value="<?php echo (isset($lineup->id)) ? $lineup->id : '' ?>" />
			<input type="hidden" name="sl_id[]" value="<?php echo $lineup->sl_id ?>" />
			<?php echo isset($name) ? $name : '' ?>
		</td>
	</tr>
<?php endwhile; ?>
<?php else : ?>
	<tr>
		<td colspan="6">No current Record</td>
	</tr>
<?php endif; ?>
</table>
<br />
<input type="submit" value="Assign Sections" />
</form>