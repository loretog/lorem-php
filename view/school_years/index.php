<!--<a class="add" href="<?php echo URL ?>/school_years/add"></a>-->
<?php if(isset($school_years)) : ?>
<table class="grid" style="width: 70%" align="center">
	<tr class="ghead">
		<!--<td></td>-->
		<td>School Year</td>
		<!--<td>Activated</td>-->
		<td>Created</td>
		<!--<td>Updated</td>-->
		<td></td>
	</tr>
	<?php while($sy = $school_years->fetch_object()) : ?>
	<tr>
		<!--<td>
			<a class="edit" href="<?php echo URL ?>/school_years/edit/<?php echo $sy->id ?>"></a>
			<a class="delete" href="<?php echo URL ?>/school_years/delete/<?php echo $sy->id ?>" onclick="return confirm('Are you sure you want to delete?');"></a>
		</td>-->
		<td><?php echo $sy->year_start . " - " . $sy->year_end ?></td>
		<!--<td>
			<?php if($sy->active == 0) : ?>
				No				
			<?php else : ?>
				Yes
			<?php endif; ?>						
		</td>-->
		<td><?php echo $sy->created ?></td>
		<!--<td><?php echo $sy->updated ?></td>-->
		<td>
			<?php if($sy->active == 0) : ?>				
				<a href="<?php echo URL ?>/school_years/change_status/<?php echo $sy->id . "/1" ?>" onclick="return confirm('Do you really want to Activate this School Year?');">Activate</a>			
			<?php else: ?>
				<b>Currently used School Year</b>
			<?php endif; ?>						
		</td>
	</tr>
	<?php endwhile; ?>
</table>
<?php endif; ?>