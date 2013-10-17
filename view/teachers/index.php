<h2>Teachers</h2
<p><a href="<?php echo DIR ?>/teachers/add/<?php echo $subject_id ?>">Add Teacher</a> | <a href="<?php echo DIR ?>/subjects/">back to Subjects</a></p>
<?php if(isset($_SESSION['message'])) { echo $_SESSION['message']; unset($_SESSION['message']); } ?>
<table class="grid">
	<tr class="ghead">
		<td></td>
		<td>Subject Name</td>
		<td>Last Name</td>
		<td>First Name</td>
		<td>Middle Name</td>
		<td>Created</td>
		<td>Updated</td>
	</tr>
<?php while($teacher = $teachers->fetch_object()) : ?>
	<tr>
		<td>
			<a href="<?php echo DIR ?>/teachers/edit/<?php echo $teacher->id ?>">Edit</a>
			|
			<a href="<?php echo DIR ?>/teachers/delete/<?php echo $teacher->id ?>" onclick="return confirm('Are you sure?');">Delete</a>
		</td>
		<td><?php echo $teacher->name ?></td>
		<td><?php echo $teacher->last ?></td>
		<td><?php echo $teacher->first ?></td>
		<td><?php echo $teacher->middle ?></td>
		<td><?php echo $teacher->created ?></td>
		<td><?php echo $teacher->updated ?></td>
	</tr>
<?php endwhile; ?>
</table>