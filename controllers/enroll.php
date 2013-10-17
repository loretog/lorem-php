<?php 

Class Enroll extends Controller
{
	public function index() {
		
	}
	public function new_student() {
    // check if sy exist if not create a current sy
    $check_sy = $this->registry->db->query("select * from school_years where year_start=(year(now())) and year_end=(year(now()) + 1)");
    $school_year = null;
    if($check_sy->num_rows > 0) {
      $sy = $check_sy->fetch_object();
      $school_year = array('id' => $sy->id, 'start_end' => $sy->year_start . " - " . $sy->year_end);
    } else {
      $data = array('year_start' => date('Y'), 'year_end' => (date('Y') + 1));
      $this->registry->db->insert("school_years",$data);
      $data = null;
      $data['id'] = $this->registry->db->insert_id;
      $data['start_end'] = date('Y') . ' - ' . (date('Y') + 1);
      $school_year = $data;
    }
    
		//$school_year = $this->registry->db->query("select * from school_years where active=1")->fetch_object();
		$this->registry->template->school_year = $school_year;
		
		$this->registry->template->programs = $this->registry->db->query("select CONCAT(prog.id, '_', yl.id) as ids, CONCAT(prog.program_name, ' - ', yl.name) as names from programs as prog, year_levels as yl, settings as sett where prog.id=yl.program_id and yl.id=sett.year_level_id and sett.enrollment_open=1 order by prog.program_name asc, yl.year_order asc");
		$this->registry->template->total_students = $this->registry->db->query("select count(*) as total from students")->fetch_object()->total;
	}
	public function old_student() {
		if(isset($_POST) && !empty($_POST)) {
			if(isset($_POST['sidn'])) {
				$student = $this->registry->db->query("select 
																								stud.id, stud.sidn, stud.last, stud.first, stud.middle,
																								prog.id as program_id, prog.program_name,
																								yl.id as year_level_id, yl.name as yl_name,
																								sect.id as section_id, sect.name as sect_name,
																								sy.id as school_year_id, concat(sy.year_start, ' - ', sy.year_end) as sy_range,
																								(
																									select
																										avg((first + second + third + fourth) / 4) as average
																									from 
																										subjects as subj, 
																										student_grades as sg
																									where
																										subj.year_level_id=yl.id and
																										subj.id=sg.subject_id and
																										sg.student_id=stud.id
																								) as student_average,
																								(
																									select
																										sum(amount)
																									from
																										miscellaneous
																									where
																										year_level_id=yl.id
																								) as misc,
																								(
																									select
																										sum(amount_paid)
																									from
																										student_payments
																									where
																										school_year_id={$_POST['school_year_id']} and
																										year_level_id=yl.id and
																										student_id=stud.id
																								) as paid,
																								(
																									select 
																										id
																									from
																										year_levels
																									where
																										year_order=(yl.year_order + 1) and
																										program_id=prog.id
																								) as next_year_level_id,
																								(
																									select 
																										name
																									from
																										year_levels
																									where
																										year_order=(yl.year_order + 1) and
																										program_id=prog.id
																								) as next_year_level_name
																							from 
																								students as stud, 
																								student_sections as ss, 
																								school_years as sy, 
																								sections as sect, 
																								year_levels as yl,
																								programs as prog
																							where 
																								ss.student_id=stud.id and
																								ss.school_year_id=sy.id and
																								ss.section_id=sect.id and
																								sect.year_level_id=yl.id and
																								yl.program_id=prog.id and
																								sy.id={$_POST['school_year_id']} and
																								stud.sidn='{$_POST['sidn']}'"
																							)->fetch_object();
				if($student)
					$this->registry->template->student = $student;
				else
					$_SESSION['message'] = 'Student not found.' . $this->registry->db->error;;
			} else {
				$_SESSION['message'] = 'Please enter Student ID Number.';
			}
		}
		$this->registry->template->school_years = $this->registry->db->select("school_years", "*", null, "year_start desc");
	}
	public function line_up_old_student() {
		if(!empty($_POST)) {
			$data = array('student_id' => $_POST['student_id'], 'school_year_id' => $_POST['school_year_id'], 'program_id' => $_POST['program_id'], 'year_level_id' => $_POST['year_level_id']);
			if($this->registry->db->insert("student_lineups", $data)) {
				$_SESSION['message'] = 'Students Lined Up Successfully.';
			} else {
				$_SESSION['message'] = 'Students Lined Up Failed.';
			}
			header("Location: " . DIR . "/enroll/old_student");
			exit;
		}
	}
	public function line_up_new_student() {
		if(!empty($_POST)) {
			if($this->registry->db->insert("students", $_POST)) {
				list($prog_id, $yl_id) = explode("_", $_POST['ids']);
				$post = array('school_year_id' => $_POST['school_year_id'], 'student_id' => $this->registry->db->insert_id, 'program_id' => $prog_id, 'year_level_id' => $yl_id);
				if($this->registry->db->insert("student_lineups", $post)) {
					$_SESSION['message'] = "Student line up was successful.";
				} else {
					$_SESSION['message'] = "Student line up failed. " . $this->registry->db->error;
				}
			} else {
				$_SESSION['message'] = "Student line up failed. " . $this->registry->db->error;
			}
		}
		header("Location: " . DIR . "/enroll/new_student/");
		exit;
	}
	public function line_ups() {
		$lineups = null;
		$program_id = null;
		$year_level_id = null;
		if(!empty($_POST)) {
			$program_id = $_POST['program_id'];
			$year_level_id = $_POST['year_level_id'];
		} else {
			$program_id = $this->registry->db->query("select id from programs limit 1")->fetch_object()->id;
			$year_level_id = $this->registry->db->query("select id from year_levels where program_id=$program_id and year_order=1")->fetch_object()->id;
		}
		//if(!empty($_POST)) {
		//if($_POST['program_id'] != "" && $_POST['year_level_id'] != "") {
		$lineups = $this->registry->db->query("SELECT 
																						stud.id, stud.sidn, sl.id as sl_id, CONCAT(sy.year_start, ' - ', sy.year_end) AS school_year, prog.program_name, yl.name, stud.last, stud.first, stud.middle,
																						(
																							SELECT 
																								(year_order-1) 
																							FROM 
																								year_levels 
																							WHERE 
																								id={$year_level_id}
																						) AS last_year_level_order,																						
																						(
																							SELECT 
																								avg(sg.fourth) 
																							FROM 
																								student_grades AS sg, 
																								subjects AS subj 
																							WHERE 
																								sg.student_id=stud.id and 
																								subj.id=sg.subject_id and 
																								subj.year_level_id=(
																																			SELECT 
																																				id 
																																			FROM 
																																				year_levels 
																																			WHERE 
																																				year_order=last_year_level_order and 
																																				program_id={$program_id}
																																		)
																							group by
																								sg.student_id
																						) AS average,
																						(
																							((stud.entrance_exam_score * 0.5) + (stud.interview_score * 0.2) + (stud.general_average * 0.3))
																						) AS entrance_average
																					FROM 
																						school_years AS sy, 
																						programs AS prog, 
																						year_levels AS yl, 
																						students AS stud, 
																						student_lineups AS sl
																					WHERE 
																						sl.done = 0 AND 
																						sl.student_id = stud.id AND 
																						sl.school_year_id = sy.id AND 
																						sl.program_id = prog.id AND 
																						sl.year_level_id = yl.id AND 
																						--sy.active = 1 AND 
																						prog.id={$program_id} AND 
																						yl.id = {$year_level_id}
																					ORDER BY 
																						entrance_average DESC, 
																						prog.program_name ASC, 
																						yl.year_order ASC, 
																						stud.last ASC, 
																						stud.first ASC, 
																						stud.middle ASC");																							

			if(!$lineups) $_SESSION['message'] = $this->registry->db->error;
			$this->registry->template->enrolling_year_level = $year_level_id;
			$settings = $this->registry->db->query("SELECT distinct(sect.id), sect.name, sett.max_number_per_section
																							FROM sections as sect, settings as sett, year_levels as yl, programs as prog
																							WHERE sect.year_level_id=yl.id and sett.year_level_id=yl.id and yl.id={$year_level_id}
																							ORDER BY sect.section_order asc");				
			$sections = array();
			if($settings->num_rows == 0) {
				$_SESSION['message'] = 'Current year level has no settings setup.';
			}
			while($sett = $settings->fetch_object()) {
				$sections[] = $sett->id . "_" . $sett->name;
				$this->registry->template->max = $sett->max_number_per_section;
			}
			//var_dump($sections);
			//echo "<br />";
			$this->registry->template->sections = $sections;				
			$this->registry->template->yl_id = $year_level_id;
		//}
		//}
		//if(isset($_POST['program_id']) && isset($_POST['year_level_id'])) {
			$this->registry->template->program_id = $program_id;
			$this->registry->template->year_level_id = $year_level_id;
			$this->registry->template->year_levels = $this->registry->db->query("select id, name from year_levels where program_id={$program_id} order by year_order asc");
		//}
		$this->registry->template->lineups = $lineups;
		$this->registry->template->programs = $this->registry->db->query("select * from programs");
	}
	public function assign_sections() {		
		if(!empty($_POST)) {			
			$school_year_id = $this->registry->db->query("select id from school_years where year_start=(year(now())) and year_end=(year(now()) + 1)")->fetch_object()->id;
			foreach($_POST['section'] as $sect_id => $students) {
				foreach($students as $key => $stud_id) {					
					$post = array('school_year_id' => $school_year_id, 'section_id' => $sect_id, 'student_id' => $stud_id);
					if($this->registry->db->insert("student_sections", $post)) {
						$_SESSION['message'] = "Student Successfully Assigned";
					} else {
						$_SESSION['message'] = "Failed Assigning Students" . $this->registry->db->error;
					}
				}
			}
			foreach($_POST['sl_id'] as $key => $id) { // flag each student_lineups record to done
				$post = array('id' => $id, 'done' => 1);
				$this->registry->db->update("student_lineups", $post);
			}
			header("Location: " . DIR . "/enroll");
			exit;
		}
	}
	public function remove_student($args = null) {
		if(!empty($args)) {
			$this->registry->db->delete("student_lineups", $args[0]);
		}
	}
}