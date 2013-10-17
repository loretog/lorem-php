<a title="Add" class="add" href="<?php echo DIR ?>/year_levels/add"></a>

<table class="grid">
<tr class="ghead">
<td></td>
<td>Program Name</td>
<td>Year Level Name</td>
<td>Year Order</td>
<td>Total Sections</td>
<td>Created</td>
<td>Updated</td>
<td>Sections</td>
<td>Subjects</td>
<td>Miscellaneous</td>
</tr>
<?php if(isset($years) && ($years->num_rows > 0)) : ?>
	<?php while($year = $years->fetch_object()) : ?>
		<tr>
		<td>		
			<ul class="control">
				<li><a class="edit" title="Edit" href="<?php echo DIR ?>/year_levels/edit/<?php echo $year->year_id ?>"></a></li>
				<li><a class="delete" title="Delete" href="<?php echo DIR ?>/year_levels/delete/<?php echo $year->year_id ?>" onclick="return confirm('Are you sure?');"></a></li>
			</ul>
		</td>
		<td><?php echo $year->program_name ?></td>
		<td><?php echo $year->name ?></td>
		<td><?php echo $year->year_order ?></td>
		<td><?php echo $year->total_sections ?></td>
		<td><?php echo $year->created ?></td>
		<td><?php echo $year->updated ?></td>
		<td><a href="<?php echo URL ?>/sections/index/<?php echo $year->year_id ?>">View All</a></td>
		<td><a href="<?php echo URL ?>/subjects/index/<?php echo $year->year_id ?>">View All</a></td>
		<td><a href="<?php echo URL ?>/miscellaneous/index/<?php echo $year->year_id ?>">View All</a></td>
		</tr>	
	<?php endwhile; ?>
<?php else: ?>
	<tr>
		<td colspan="8">No Current record.</td>
	</tr>
<?php endif; ?>
</table>