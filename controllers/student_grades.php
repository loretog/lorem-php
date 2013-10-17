<?php

Class Student_Grades extends Controller
{
	public function index() {
	}
	public function view($args) {
		if(!empty($args)) {
			$student_id = $args[0];
			$year_level_id = $args[1];
			$section_id = $args[2];
			
			/*$student_grades = $this->registry->db->query("select * 
																										from student_grades as sg, students as stud, subjects as subj, student_sections as ss, year_levels as yl
																										where sg.student_id={$student_id} 
																											and sg.student_id=stud.id 
																											and subj.id=sg.subject_id
																											and ss.student_id=stud.id
																											and yl.id={$year_level_id}
																											and subj.year_level_id=yl.id");*/
			
			$student_subjects = $this->registry->db->query("select subj.id, subj.name, subj.description, subj.unit, 
																												(select id from student_grades where student_id={$student_id} and subject_id=subj.id) as student_grade_id, 
																												(select first from student_grades where student_id={$student_id} and subject_id=subj.id) as first, 
																												(select second from student_grades where student_id={$student_id} and subject_id=subj.id) as second, 
																												(select third from student_grades where student_id={$student_id} and subject_id=subj.id) as third, 
																												(select fourth from student_grades where student_id={$student_id} and subject_id=subj.id) as fourth, 
																												(select grade from student_grades where student_id={$student_id} and subject_id=subj.id) as grade, 
																												(select note from student_grades where student_id={$student_id} and subject_id=subj.id) as note 
																											from subjects as subj where subj.year_level_id={$year_level_id} order by subj.name asc");			
			$this->registry->template->student_subjects = $student_subjects;
			$this->registry->template->year_level_id = $year_level_id;
			$this->registry->template->student_id = $student_id;
			$this->registry->template->student = $this->registry->db->select("students", "*", "id=" . $student_id)->fetch_object();
			$this->registry->template->level = $this->registry->db->query("select p.program_name, yl.name, s.name as sname from programs as p, year_levels as yl, sections as s where p.id=yl.program_id and yl.id=s.year_level_id and yl.id={$year_level_id} and s.id={$section_id}")->fetch_object();
		}
	}
	public function ajax_view() {
		if(!empty($_POST)) {
			$student_id = $_POST['student_id'];
			$program_id = $_POST['program_id'];
			$year_level_id = $_POST['year_level_id'];
			$section_id = $_POST['section_id'];
			
			$student_subjects = $this->registry->db->query("select subj.id, subj.name, subj.description, subj.unit, 
																												(select id from student_grades where student_id={$student_id} and subject_id=subj.id) as student_grade_id, 
																												(select first from student_grades where student_id={$student_id} and subject_id=subj.id) as first, 
																												(select second from student_grades where student_id={$student_id} and subject_id=subj.id) as second, 
																												(select third from student_grades where student_id={$student_id} and subject_id=subj.id) as third, 
																												(select fourth from student_grades where student_id={$student_id} and subject_id=subj.id) as fourth, 
																												(select grade from student_grades where student_id={$student_id} and subject_id=subj.id) as grade, 
																												(select note from student_grades where student_id={$student_id} and subject_id=subj.id) as note 
																											from subjects as subj where subj.year_level_id={$year_level_id} order by subj.name asc");			
					
			$student = $this->registry->db->select("students", "*", "id=$student_id")->fetch_object();
			$program = $this->registry->db->select("programs", "program_name", "id=$program_id")->fetch_object();
			$year = $this->registry->db->select("year_levels", "name", "id=$year_level_id")->fetch_object();
			$section = $this->registry->db->select("sections", "name", "id=$section_id")->fetch_object();
			
			?>			
			<table style="text-transform: capitalize;">
				<tr>
					<td style="width: 100px;">Name:</td>
					<td><?php echo $student->last . ", " . $student->first . " " . $student->middle; ?></td>
				</tr>
				<tr>
					<td>Program:</td>
					<td><?php echo $program->program_name; ?></td>
				</tr>
				<tr>
					<td>Year Level:</td>
					<td><?php echo $year->name; ?></td>
				</tr>
				<tr>
					<td>Section:</td>
					<td><?php echo $section->name?></td>
				</tr>
			</table>
			<br />			
			<table class="grid">
				<tr class="ghead">		
					<td style="width: 20%;">Subject Name</td>
					<td>Unit</td>		
					<td>1st</td>		
					<td>2nd</td>		
					<td>3rd</td>		
					<td>4th</td>		
					<td>Note</td>
					<td>Average</td>
				</tr>
			<?php 
				if(isset($student_subjects) && $student_subjects->num_rows > 0) : 
				$count = 0;
				$sum_average = 0;
			?>
			<?php while($sg = $student_subjects->fetch_object()) : ?>
				<?php
					$first = (int)$sg->first;
					$second = (int)$sg->second;
					$third = (int)$sg->third;
					$fourth = (int)$sg->fourth;
					$average = ($first + $second + $third + $fourth) / 4;
				?>
				<tr>		
					<td><b><?php echo $sg->name ?></b></td>
					<td><?php echo $sg->unit ?></td>
					<td><?php echo $first ?></td>
					<td><?php echo $second ?></td>
					<td><?php echo $third ?></td>
					<td><?php echo $fourth ?></td>
					<td>
						<?php echo $sg->note ?>
					</td>
					<td>
						<?php echo $average ?>
					</td>
				</tr>
			<?php 
				$count++;
				$sum_average += $average;
				endwhile; 
			?>
			<?php else : ?>
				<tr>
					<td colspan="3">No current record</td>
				</tr>
			<?php endif; ?>
			</table>
			<br />
			Final Average: <?php echo sprintf("%10.2f", $sum_average / $count) ?>
			<?php
		}
		exit;
	}
}