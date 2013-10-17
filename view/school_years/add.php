<form method="post" action="<?php echo DIR; ?>/school_years/save/">
	<input type="hidden" name="request" value="add" />
	<table class="entry">		
		<tr>
			<td>Year Start</td>
			<td><input type="text" name="year_start" value="" /></td>
		</tr>		
		<tr>
			<td>Year End</td>
			<td><input type="text" name="year_end" value="" /></td>
		</tr>		
		<tr>
			<td colspan="2">
				<input title="Save" type="submit" value="" class="save" />
				<a title="Cancel" class="cancel"  href="<?php echo DIR; ?>/school_years/"></a>
			</td>
		</tr>		
	</table>
</form>