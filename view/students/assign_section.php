<h2>Student Lined-up</h2>
<p>
<?php while($year_level = $year_levels->fetch_object()) : ?>
	<a href="<?php echo DIR ?>/students/assign_section/<?php echo $year_level->id ?>"><?php echo $year_level->name ?></a> |
<?php endwhile; ?>
</p>
<?php if(isset($students) && !empty($students)) : 	?>
<form method="post" action="<?php echo DIR ?>/students/save_sectioning">
	<table class="grid">
		<tr class="ghead">
			<td></td>
			<td>Section</td>
			<td>Last Name</td>
			<td>First Name</td>
			<td>Middle Name</td>
			<td>Entrace Exam Score</td>
		</tr>		
	<pre>		
	</pre>
	<?php for($i = 0; $i < count($students); $i++) : ?>
		<input type="hidden" name="sections[<?php echo $students[$i]['section']->id ?>][]" value="<?php echo $students[$i]['student']->id ?>" />
		<tr>
			<td><a href="<?php echo DIR ?>/students/view/<?php echo $students[$i]['student']->id ?>">View</a> | 
			<a href="<?php echo DIR ?>/students/edit/<?php echo $students[$i]['student']->id ?>">Edit</a></td>
			<td>
				<?php echo $students[$i]['section']->name; ?>
			</td>
			<td><?php echo $students[$i]['student']->last; ?></td>
			<td><?php echo $students[$i]['student']->first; ?></td>
			<td><?php echo $students[$i]['student']->middle; ?></td>
			<td><?php echo ($students[$i]['student']->exam_percentage) ? $students[$i]['student']->exam_percentage : '0'; ?>%</td>						
		</tr>		
	<?php endfor; ?> 
	</table>
	<br />
	<input type="submit" value="Save Sectioning" />
</form>
<?php endif; ?>