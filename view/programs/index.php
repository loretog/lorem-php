<a title="Add" class="add" href="<?php echo DIR ?>/programs/add"></a>

<table class="grid">
	<tr class="ghead">
		<td></td>
		<td>Program Name</td>
		<td>Initial</td>
		<td>Total Year Levels</td>
		<td>Created</td>
		<td>Updated</td>
		<td>Year Levels</td>
	</tr>
<?php if(isset($programs) && ($programs->num_rows > 0)) : ?>
	<?php while($program = $programs->fetch_object()) : ?>
	<tr>
		<td>
			<ul class="control">
				<li><a class="edit" title="Edit" href="<?php echo DIR ?>/programs/edit/<?php echo $program->id ?>"></a></li>
				<li><a class="delete" title="Delete" href="<?php echo DIR ?>/programs/delete/<?php echo $program->id?>" onclick="return confirm('Are you sure?');"></a></li>
			</ul>
		</td>
		<td><?php echo $program->program_name ?></td>
		<td><?php echo $program->initial ?></td>		
		<td><?php echo $program->total_year_levels ?></td>		
		<td><?php echo $program->created ?></td>		
		<td><?php echo $program->updated ?></td>		
		<td><a href="<?php echo URL ?>/year_levels/index/<?php echo $program->id ?>">View	All</a></td>
	</tr>
	<?php endwhile; ?>
<?php else : ?>
	<tr>
		<td colspan="4">No current record.</td>
	</tr>
<?php endif; ?>
</table>