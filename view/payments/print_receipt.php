 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html>
	<head>
		<style type="text/css">
			table { border: 1px solid #ccc; width: 90%; font-size: 13px; font-family: Arial, Helvetica, sans-serif; }
			table tr td { border: 1px solid #ccc; }
			table tr td:first-child { width: 30%; }
		</style>
	</head>
	<body>
		<?php if(isset($payment)) : ?> 		
		<table>
			<tr>
				<td>Last Name</td>
				<td><?php echo $payment->last ?></td>
			</tr>
			<tr>
				<td>First Name</td>
				<td><?php echo $payment->first ?></td>
			</tr>
			<tr>
				<td>Middle Name</td>
				<td><?php echo $payment->middle ?></td>
			</tr>
			<tr>
				<td>Program</td>
				<td><?php echo $payment->program_name ?></td>
			</tr>
			<tr>
				<td>Year Level</td>
				<td><?php echo $payment->year_name ?></td>
			</tr>
			<tr>
				<td>Section</td>
				<td><?php echo $payment->section_name ?></td>
			</tr>
		</table>
		<?php endif; ?>
	</body>
 </html>