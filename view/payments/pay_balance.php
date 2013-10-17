<h2 style="text-transform: capitalize;">Name: <?php echo $student->last . ", " . $student->first . " " . $student->middle ?></h2>

<?php $total_amount = 0; ?>

<table class="grid" style="width: 80%;" align="center">
	<tr class="ghead">
		<td>Miscellaneous</td>
		<td>Description</td>
		<td>Amount</td>
	</tr>
<?php while($misc = $miscs->fetch_object()) : ?>
	<?php
		if($student->gender == "male" && $misc->required_by_gender == 2)
			continue;
		elseif($student->gender == "female" && $misc->required_by_gender == 1)
			continue;
	?>
	<tr>
		<td><?php echo $misc->misc_name ?></td>
		<td><?php echo $misc->description ?></td>
		<td>
			<?php 
				$total_amount += $misc->amount;
				echo $misc->amount;
			?>
		</td>
	</tr>
<?php endwhile; ?>
</table>

<!--<form method="post" action="<?php echo URL ?>/payments/save_payment">-->
	<input type="hidden" name="student_id" value="<?php echo $student_id ?>" />
	<input type="hidden" name="school_year_id" value="<?php echo $school_year_id ?>" />
	<input type="hidden" name="year_level_id" value="<?php echo $year_level_id ?>" />	
	<table class="entry">		
		<tr>
			<td>Total Amount</td>
			<td><b><?php echo sprintf("%01.2f", $total_amount); ?></b></td>
		</tr>
		<tr>
			<td>Total Amount Paid</td>
			<td><b><?php echo sprintf("%01.2f", $amount_paid); ?></b></td>
		</tr>
		<tr>
			<td>Remaining Balance</td>
			<td><b><?php echo sprintf("%01.2f", ($total_amount - $amount_paid)); ?></b></td>
		</tr>
		<tr>
			<td>Amount to Pay</td>
			<td><input type="text" id="amount_paid" name="amount_paid" /></td>
		</tr>
		<tr>
			<td>Cash Received</td>
			<td><input type="text" id="amount_received" name="amount_received" /></td>
		</tr>
		<tr>
			<td colspan="2"><input id="submit" type="submit" value="Submit Payment" /></td>
		</tr>
	</table>
<!--</form>-->

<a href="<?php echo URL ?>/students/index/sidn/<?php echo $sidn ?>"><< Back</a>
<script type="text/javascript">
	$(function() {
		var ok = 1;
		$("#submit").click(function() {
			if($("#amount_paid").val() == "" || $("#amount_received").val() == "") {
				alert("Please enter Amount to Pay and Cash Received field.");
				return false;
			}
			if(parseInt($("#amount_paid").val()) > parseInt($("#amount_received").val())) {
				alert("Amount received is not enough.");
				return false;
			}
			$.ajax({				
				type: "POST",
				url: "<?php echo URL ?>/payments/save_payment",
				data: "student_id=<?php echo $student_id ?>&school_year_id=<?php echo $school_year_id ?>&year_level_id=<?php echo $year_level_id ?>&amount_paid=" + $("#amount_paid").val() + "&amount_received=" + $("#amount_received").val(),
				success: function(data) {
					//alert(data);
					
					if(data == 0) {
						if(confirm("Show Receipt?") == true) {
							window.open('<?php echo URL ?>/payments/print_receipt','','width=500,height=500,resizable=0,toolbar=0,location=no');							
						}						
					}
					
					//location.reload(true);										
					window.location = "<?php echo URL ?>/students/index/sidn/<?php echo $sidn ?>";
				}
			});
		});			
	});
</script>