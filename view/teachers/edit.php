<form method="post" action="<?php echo DIR; ?>/teachers/save/">
	<input type="hidden" name="request" value="edit" />	
	<input type="hidden" name="subject_id" value="<?php echo $subject_id ?>" />	
	<input type="hidden" name="teacher_id" value="<?php echo $teacher_id ?>" />	
	<table>	
		<tr>
			<td>Room</td>
			<td><input type="text" name="room" value="<?php echo $room ?>" /></td>
		</tr>
		<tr>
			<td>First Name</td>
			<td><input type="text" name="first" value="<?php echo $first ?>" /></td>
		</tr>
		<tr>
			<td>Middle Name</td>
			<td><input type="text" name="middle" value="<?php echo $middle ?>" /></td>
		</tr>
		<tr>
			<td>Last Name</td>
			<td><input type="text" name="last" value="<?php echo $last ?>" /></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="Update" /></td>
		</tr>
		<tr>
			<td colspan="2">
				<a href="<?php echo DIR; ?>/teachers/index/<?php echo $subject_id ?>">back to Teachers</a>				
			</td>
		</tr>
	</table>
</form>