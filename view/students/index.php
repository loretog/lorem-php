<div style="margin: 10px 0px;">
	<form method="post" action="">
	SIDN: <input type="text" name="sidn" value="" />
	<input type="submit" value="Search SIDN" />	
	<a href="<?php echo URL . "/" . $controller . "/" . $action ?>">Show All</a>
	</form>	
</div>

<?php if( ! empty( $students ) ) : ?>
<?php if( ! isset( $sidn ) ) : ?>
<?php 
	$nav = "Pages: "; 
	for($i = 0; $i < $total_page; $i++) {
		if($current_page == ($i + 1))
			$nav .= "<b><a href='" . URL . "/$controller/$action/page/" . ($i + 1) . "'>" . ($i + 1) . "</a></b> ";
		else
			$nav .= "<a href='" . URL . "/$controller/$action/page/" . ($i + 1) . "'>" . ($i + 1) . "</a> ";
	}
?>
<div class="page_nav">
<?php 
	echo $nav;
	$row_count = ( ($current_page - 1) * $row_per_page ) + 1;
?>
</div>
<?php endif; ?>
<table class="grid">
	<tr class="ghead">				
		<td style="width: 1%;">#</td>
		<td style="width: 5%;">SIDN</td>
		<td style="width: 20%;" colspan="3">Full Name [Last, First, Middle]</td>		
		<td style="width: 5%;">Gender</td>
		<td style="width: 69%;"></td>
	</tr>
	<?php foreach( $students as $student ) : ?>	
	<tr>				
		<td>
			<b>
			<?php 
				if(isset($row_count)) 
					echo $row_count;
				else {
					$row_count = 1;
					echo $row_count;
				}
			?>
			</b>
		</td>
		<td><?php echo $student['details']['sidn'] ?></td>		
		<td colspan="3">
			<b style="color: green">
			<?php echo $student['details']['last'] ?>,
			<?php echo $student['details']['first'] ?>,
			<?php echo $student['details']['middle'] ?>
			</b>
		</td>				
		<td><?php echo $student['details']['gender'] ?></td>		
		<td>
			[ <a href="<?php echo URL ?>/students/view/<?php echo $student['details']['id'] ?>">View/Update Profile</a> ]
			<div style="float: right; width: 130px; text-align: right;">
				Status:
				<select name="status">
					<option value="">Enrolled</option>					
					<option value="">Transfered</option>
					<option value="">Dropped</option>
					<option value="">Graduated</option>
				</select>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="7">
			<?php if( ! empty( $student[ 'levels' ] ) ) : ?>
				<table style="width: 95%; margin: 0 auto;">
					<tr>					
						<td style="width: 10%;"><b>SY</b></td>
						<td style="width: 30%;"><b>Program</b></td>
						<td style="width: 15%;"><b>Year Level</b></td>
						<td style="width: 15%;"><b>Section</b></td>
						<td style="width: 5s%;"><b>Final Grade</b></td>
						<td style="width: 5%;"><b>Balance</b></td>						
						<td style="width: 20%;" colspan="2"></td>
					</tr>
					<?php foreach( $student['levels'] as $levels ) : ?>
					<tr>					
						<td><?php echo $levels['sy_range'] ?></td>
						<td><?php echo $levels['program_name'] ?></td>					
						<td><?php echo $levels['yl_name'] ?></td>					
						<td><?php echo $levels['sect_name'] ?></td>					
						<td><?php echo sprintf("%10.2f", $levels['final_grade']) ?></td>
						<td>
							<?php 
								$miscs = $this->registry->db->select("miscellaneous", "*", "year_level_id={$levels['yl_id']}");
								$total_misc = 0;
								while($misc = $miscs->fetch_object()) {
									if($students[0]['details']['gender'] == "male" && $misc->required_by_gender == 2)
										continue;
									elseif($students[0]['details']['gender'] == "female" && $misc->required_by_gender == 1)
										continue;
									$total_misc += $misc->amount;
								}
								//$balance = ( float ) $levels['total_misc'] - ( float ) $levels['total_amount_paid'];
								$balance = ( float ) $total_misc - ( float ) $levels['total_amount_paid'];
								echo sprintf("%10.2f", $balance); 
							?>
						</td>
						<td>
							<ul>
								<?php if($balance > 0) : ?>
								<li><a href="<?php echo URL ?>/payments/pay_balance/<?php echo $student['details']['id'] . "/" . $levels['yl_id'] . "/" . $levels['sy_id'] ?>">Pay Balance</a></li>
								<?php endif; ?>
								<li>
										<a href="" style="display: inline;" onclick="show_msgbox('payments', 'student_id=<?php echo $student['details']['id'] ?>&year_level_id=<?php echo $levels['yl_id'] ?>&school_year_id=<?php echo $levels['sy_id'] ?>'); return false;">Payment History</a>									
								</li>
								<li><a href="" style="display: inline;" onclick="show_msgbox('grades', 'student_id=<?php echo $student['details']['id'] ?>&program_id=<?php echo $levels['prog_id'] ?>&year_level_id=<?php echo $levels['yl_id'] ?>&section_id=<?php echo $levels['sect_id'] ?>'); return false;">Grades</a></li>
								<li><a href="<?php echo URL ?>/student_grades/view/<?php echo $student['details']['id'] . "/" . $levels['yl_id'] . "/" . $levels['sect_id'] ?>">Update Grades</a></li>
							</ul>							
						</td>
					</tr>
					<?php endforeach; ?>
				</table>
				<?php else : ?>
				<b style="color: red;">Not yet assigned</b>
			<?php endif; ?>
		</td>
	</tr>
	<?php 
	$row_count++;
	endforeach; 
	?>
</table>
<div class="page_nav">
<?php if(!isset($sidn)) : ?>
<?php echo $nav ?>
<?php endif; ?>
</div>
<?php endif; ?>