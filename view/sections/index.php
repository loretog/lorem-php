<div><a class="add" title="Add" href="<?php echo DIR ?>/sections/add/<?php echo isset($year_level_id) ? $year_level_id : ''; ?>"></a></div>
<div style="clear: both; margin-bottom: 10px;">
	<ul class="cmenu">
		<li><a href="<?php echo DIR ?>/sections">All</a><li>
	<?php foreach($dys as $dept_id => $dept) : ?>			
		<?php foreach($dept as $dept_name => $v) : ?>			
			<li>
				<a href="#"><?php echo $dept_name ?></a>
				<ul>
				<?php foreach($v as $i => $j) : ?>
				<li><a href="<?php echo DIR ?>/sections/index/<?php echo $j['year_id'] ?>"><?php echo $j['year_name'] ?></a></li>
				<?php endforeach; ?>
				</ul>
			</li>
		<?php endforeach; ?>	
	<?php endforeach; ?>
	</ul>
	<div style="clear: both;"></div>
</div>
<table class="grid">
	<tr class="ghead">
		<td></td>
		<td>Program</td>
		<td>Year Name</td>
		<td>Section Name</td>	
		<td>Section Order</td>			
		<td>Created</td>		
		<td>Updated</td>		
	</tr>
<?php if($sections->num_rows > 0) : ?>
	<?php while($section = $sections->fetch_object()) : ?>
	<tr>
		<td>
			<ul class="control">
				<li><a class="edit" title="Edit" href="<?php echo DIR ?>/sections/edit/<?php echo $section->id ?>"></a></li>
				<li><a class="delete" title="Delete" href="<?php echo DIR ?>/sections/delete/<?php echo $section->id?>" onclick="return confirm('Are you sure?');"></a></li>
			</ul>			
		</td>
		<td><?php echo $section->program_name ?></td>
		<td><?php echo $section->year_name ?></td>
		<td><?php echo $section->section_name ?></td>
		<td><?php echo $section->section_order ?></td>		
		<td><?php echo $section->created ?></td>
		<td><?php echo $section->updated ?></td>
	</tr>
	<?php endwhile; ?>
<?php else: ?>
	<tr>
		<td colspan="7">No current record.</td>
	</tr>
<?php endif; ?>
</table>