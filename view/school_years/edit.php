<form method="post" action="<?php echo DIR; ?>/school_years/save/">
	<input type="hidden" name="request" value="update" />		
	<input type="hidden" name="id" value="<?php echo $sy->id ?>" />		
	<table class="entry">		
		<tr>
			<td>Year Start</td>
			<td><input type="text" name="year_start" value="<?php echo $sy->year_start ?>" /></td>
		</tr>		
		<tr>
			<td>Year End</td>
			<td><input type="text" name="year_end" value="<?php echo $sy->year_end ?>" /></td>
		</tr>		
		<tr>
			<td colspan="2">
				<input title="Save" type="submit" value="" class="save" />
				<a title="Cancel" class="cancel"  href="<?php echo DIR; ?>/school_years/"></a>
			</td>
		</tr>		
	</table>
</form>