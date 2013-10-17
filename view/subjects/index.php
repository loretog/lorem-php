<div>
	<form action="<?php echo URL ?>/subjects" method="post">
	<select name="year_level_id">
		<option value="">All</option>
		<?php while($year_level = $year_levels->fetch_object()) : ?>
		<?php $selected = ""; if(isset($year_level_id) && $year_level_id == $year_level->id) { $selected = "selected='selected'"; } ?>
		<option <?php echo $selected ?> value="<?php echo $year_level->id ?>"><?php echo $year_level->name ?></option>
		<?php endwhile; ?>
	</select>
	<input type="submit" value="Filter" />
	</form>
</div>

<p><a title="Add Subject" class="add" href="<?php echo DIR ?>/subjects/add/<?php echo isset($year_level_id) ? $year_level_id : '' ?>"></a></p>

<?php if(isset($_SESSION['message'])) { echo $_SESSION['message']; unset($_SESSION['message']); } ?>
<table class="grid">
	<tr class="ghead">
		<td></td>
		<td>Program</td>
		<td>Year Name</td>
		<td>Name</td>		
		<td>Description</td>		
		<td>Unit</td>		
		<td>Created</td>		
		<td>Updated</td>		
		<td>Teachers</td>		
	</tr>
	<?php if($subjects->num_rows > 0) : ?>
	<?php while($subject = $subjects->fetch_object()) : ?>
	<tr>
		<td>
			<a title="Edit" class="edit" href="<?php echo DIR ?>/subjects/edit/<?php echo $subject->id ?>"></a>
			<a title="Delete" class="delete" href="<?php echo DIR ?>/subjects/delete/<?php echo $subject->id?>" onclick="return confirm('Are you sure?');"></a>			
		</td>
		<td><?php echo $subject->program_name ?></td>
		<td><?php echo $subject->year_name ?></td>
		<td><?php echo $subject->subject_name ?></td>
		<td><?php echo $subject->description ?></td>
		<td><?php echo $subject->unit ?></td>
		<td><?php echo $subject->created ?></td>
		<td><?php echo $subject->updated ?></td>
		<td><a href="<?php echo DIR ?>/teachers/index/<?php echo $subject->id?>">View All</a></td>
	</tr>
	<?php endwhile; ?>
	<?php else: ?>
	<tr>
		<td colspan="8">No current subjects.</td>
	</tr>
	<?php endif; ?>
</table>