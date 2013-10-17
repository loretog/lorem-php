<form method="post" action="<?php echo DIR; ?>/teachers/save/">
	<input type="hidden" name="request" value="add" />	
	<input type="hidden" name="subject_id" value="<?php echo $subject_id ?>" />	
	<table>		
		<tr>
			<td>Room</td>
			<td><input type="text" name="room" value="" /></td>
		</tr>
		<tr>
			<td>First Name</td>
			<td><input type="text" name="first" value="" /></td>
		</tr>
		<tr>
			<td>Middle Name</td>
			<td><input type="text" name="middle" value="" /></td>
		</tr>
		<tr>
			<td>Last Name</td>
			<td><input type="text" name="last" value="" /></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="Add" /></td>
		</tr>
		<tr>
			<td colspan="2">
				<a href="<?php echo DIR; ?>/teachers/index/<?php echo $subject_id ?>">back to Teachers</a>				
			</td>
		</tr>
	</table>
</form>