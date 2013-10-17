<h2><?php echo $student->last . ", " . $student->first . " " . $student->middle ?></h2>
<p>Program: <b><?php echo $level->program_name ?></p></b>
<p>Year Level: <b><?php echo $level->name ?></p></b>
<p>Section: <b><?php echo $level->sname ?></p></b>

<?php if(isset($payments)) : ?>
	<?php $total = 0; ?>
	<?php $total_fee = 0; ?>
	<table class="grid" style="width: 90%; margin: 0 auto;">
		<tr class="ghead">
			<td>Date and Time</td>
			<td>Amount Paid</td>
			<td>Amount Received</td>			
		</tr>
	<?php while($payment = $payments->fetch_object()) : ?>
		<tr>			
			<td><?php echo date("M Y h:i A", $payment->created) ?></td>
			<td><?php echo $payment->amount_paid ?></td>
			<td><?php echo $payment->amount_received ?></td>
		</tr>
		<?php $total += $payment->amount_paid ?>
		<?php $total_fee = $payment->total_fee ?>
	<?php endwhile; ?>
		<tr>
			<td style="text-align: right; font-weight: bold;">Total Amount Paid</td>
			<td><?php echo $total ?></td>
			<td></td>
		</tr>
		<tr>
			<td style="text-align: right; font-weight: bold;">Total Fee</td>
			<td><?php echo $total_fee ?></td>
			<td></td>
		</tr>
		<tr>
			<td style="text-align: right; font-weight: bold;">Remaining Balance</td>
			<td><?php echo $total_fee - $total ?></td>
			<td></td>
		</tr>
	</table>
<?php endif; ?>

<br />
<p><a href="<?php echo URL ?>/students/index/sidn/<?php echo $student->sidn ?>"><< Back</a></p>