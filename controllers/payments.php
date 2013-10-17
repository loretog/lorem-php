<?php

Class Payments extends Controller
{
	public function index() {}
	public function pay_balance($args = null) {
		$this->registry->template->student_id = $student_id = $args[0];		
		$this->registry->template->year_level_id = $year_level_id = $args[1];
		$this->registry->template->school_year_id = $school_year_id = $args[2];
		//$total_amount = $this->registry->db->query("select sum(amount) as total_amount from miscellaneous where year_level_id=$year_level_id")->fetch_object()->total_amount;
		$amount_paid = $this->registry->db->query("select sum(amount_paid) as amount_paid from student_payments where student_id=$student_id and school_year_id=$school_year_id and year_level_id=$year_level_id")->fetch_object()->amount_paid;
		//$this->registry->template->total_amount = $total_amount;
		$this->registry->template->amount_paid = $amount_paid;
		
		$this->registry->template->miscs = $this->registry->db->select("miscellaneous", "*", "year_level_id={$args[1]}");
		
		$this->registry->template->student = $this->registry->db->select("students", "*", "id=" . $student_id)->fetch_object();
		$this->registry->template->sidn = $this->registry->db->select("students", "sidn", "id={$args[0]}")->fetch_object()->sidn;
	}
	public function save_payment() {
		if(!empty($_POST)) {			
			if($this->registry->db->insert("student_payments", $_POST)) {
				$_SESSION['message'] = 'Payment Added';
				$_SESSION['payment_id'] = $this->registry->db->insert_id;
				echo '0';
			} else {
				$_SESSION['message'] = 'Payment not Added.' . $this->registry->db->error;
				echo 'Payment not Added.' . $this->registry->db->error;
			}
			$sidn = $this->registry->db->select("students", "sidn", "id={$_POST['student_id']}")->fetch_object();
			header("Location: " . DIR . "/students/index/sidn/{$sidn}");
			exit;
		}
	}
	public function history($args = null) {
		if(!empty($args)) {
			$payments = $this->registry->db->query("
																	select 																		
																		sp.amount_paid, sp.amount_received, sp.created, sp.amount_paid,
																		(select sum(amount) from miscellaneous where year_level_id = sp.year_level_id) as total_fee
																	from
																		student_payments as sp																
																	where																		
																		sp.student_id = {$args[0]} and
																		sp.year_level_id = {$args[1]} and
																		sp.school_year_id = {$args[2]}
																	order by
																		sp.created asc
																");
			echo $this->registry->db->error;
			$this->registry->template->payments = $payments;
			$this->registry->template->student = $this->registry->db->select("students", "*", "id={$args[0]}")->fetch_object();
			$this->registry->template->level = $this->registry->db->query("select p.program_name, yl.name, s.name as sname from programs as p, year_levels as yl, sections as s where p.id=yl.program_id and yl.id=s.year_level_id and yl.id={$args[1]} and s.id={$args[3]}")->fetch_object();
		}
	}
	public function ajax_history() {
		if(!empty($_POST)) {
			$payments = $this->registry->db->query("
																	select 																		
																		sp.amount_paid, sp.amount_received, sp.created, sp.amount_paid,
																		(select sum(amount) from miscellaneous where year_level_id = sp.year_level_id) as total_fee
																	from
																		student_payments as sp																
																	where																		
																		sp.student_id = {$_POST['student_id']} and
																		sp.year_level_id = {$_POST['year_level_id']} and
																		sp.school_year_id = {$_POST['school_year_id']}
																	order by
																		sp.created asc
																");
			echo $this->registry->db->error;
			?>
			<?php if(isset($payments)) : ?>
				<?php $total = 0; ?>
				<?php $total_fee = 0; ?>
				<h2>Payment History</h2>
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
			<?php
		}
		exit;
	}
	public function print_receipt() {		
		$payment = $this->registry->db->query("
																select 
																	stud.last, stud.first, stud.middle,
																	yl.name as year_name,
																	prog.program_name,
																	concat(sy.year_start, ' - ', sy.year_end) as school_year,
																	sect.name as section_name
																from
																	student_payments as sp, 
																	students as stud, 
																	year_levels as yl, 
																	school_years as sy, 
																	programs as prog,
																	sections as sect
																where
																	sp.student_id = stud.id and
																	sp.year_level_id = yl.id and
																	sp.school_year_id = sy.id and
																	yl.program_id = prog.id and
																	sect.year_level_id = yl.id and
																	sp.id = {$_SESSION['payment_id']}
															")->fetch_object();
		include ROOT . DS . "view" . DS . "payments" . DS . "print_receipt.php";
		exit;
	}
}