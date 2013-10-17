<p><a href="<?php echo DIR ?>/students/index">Back to Students</a></p>
<?php if(isset($subjects)) : ?>
<table>
	<tr>
		<td>Subject</td>
		<td>Unit</td>
		<td>Grade</td>
	</tr>
<?php while($subject = $subjects->fetch_object()) : ?>
	<tr>
		<td><?php echo $subject->name ?></td>
		<td><?php echo $subject->unit ?></td>
		<td><?php echo $subject->name ?></td>
	</tr>
<?php endwhile; ?>
</table>
<?php endif; ?>