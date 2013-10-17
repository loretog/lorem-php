<form method="post" action="<?php echo URL; ?>/programs/save/">
	<input type="hidden" name="request" value="add" />		
	<table class="entry">		
		<tr>
			<td>Program Name</td>
			<td><input type="text" name="program_name" value="" /></td>
		</tr>		
		<tr>
			<td>Initial</td>
			<td><input type="text" name="initial" value="" /></td>
		</tr>		
		<tr>
			<td colspan="2">
				<input title="Save" type="submit" value="" class="save" />
				<a title="Cancel" class="cancel"  href="<?php echo URL; ?>/programs/"></a>
			</td>
		</tr>		
	</table>
</form>