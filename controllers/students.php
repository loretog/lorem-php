<?php

Class Students extends Controller
{		
	public function index2($args = null) {
		$school_year_id = !empty($_POST['school_year_id']) ? $_POST['school_year_id'] : (!empty($args[0]) ? $args[0] : null);
		$section_id = !empty($_POST['section_id']) ? $_POST['section_id'] : (!empty($args[0]) ? $args[0] : null);
		if(!empty($args) && $args[0] == 'sidn' && !empty($args[1])) {
			$students = $this->registry->db->query("SELECT distinct(stud.id), stud.sidn, sy.id as school_year_id, yl.id as year_level_id, sect.id as section_id, CONCAT(p.program_name, ' - ', yl.name) as year_name, sect.name as section_name, concat(sy.year_start,' - ', sy.year_end) as school_year, stud.last, stud.first, stud.middle,
																								(select sum(m.amount) as a from miscellaneous as m where m.year_level_id=yl.id) as amount,
																								(select sum(sp.amount_paid) from student_payments as sp where sp.year_level_id=yl.id and sp.student_id=stud.id and sp.school_year_id=sy.id) as paid
																						FROM programs AS p																						
																						INNER JOIN year_levels AS yl ON p.id=yl.program_id
																						INNER JOIN sections AS sect ON yl.id = sect.year_level_id
																						INNER JOIN student_sections AS ss ON sect.id = ss.section_id
																						INNER JOIN students AS stud ON ss.student_id = stud.id
																						INNER JOIN school_years as sy ON ss.school_year_id = sy.id
																						WHERE stud.sidn='{$args[1]}'
																						ORDER BY yl.year_order asc, sect.section_order asc, stud.last asc, stud.first asc, stud.middle asc
																						LIMIT 0 , 30");	
		} else {					
			if(!empty($school_year_id) && !empty($section_id)) {
				$students = $this->registry->db->query("SELECT distinct(stud.id), stud.sidn, sy.id as school_year_id, yl.id as year_level_id, sect.id as section_id, CONCAT(p.program_name, ' - ', yl.name) as year_name, sect.name as section_name, concat(sy.year_start,' - ', sy.year_end) as school_year, stud.last, stud.first, stud.middle,
																									(select sum(m.amount) as a from miscellaneous as m where m.year_level_id=yl.id) as amount,
																									(select sum(sp.amount_paid) from student_payments as sp where sp.year_level_id=yl.id and sp.student_id=stud.id and sp.school_year_id=sy.id) as paid
																							FROM programs AS p																						
																							INNER JOIN year_levels AS yl ON p.id=yl.program_id
																							INNER JOIN sections AS sect ON yl.id = sect.year_level_id
																							INNER JOIN student_sections AS ss ON sect.id = ss.section_id
																							INNER JOIN students AS stud ON ss.student_id = stud.id
																							INNER JOIN school_years as sy ON ss.school_year_id = sy.id
																							WHERE sect.id={$section_id} and sy.id={$school_year_id}
																							ORDER BY yl.year_order asc, sect.section_order asc, stud.last asc, stud.first asc, stud.middle asc
																							LIMIT 0 , 30");			
			} else {
				$students = $this->registry->db->query("SELECT distinct(stud.id), stud.sidn, sy.id as school_year_id, yl.id as year_level_id, sect.id as section_id, CONCAT(p.program_name, ' - ', yl.name) as year_name, sect.name as section_name, concat(sy.year_start,' - ', sy.year_end) as school_year, stud.last, stud.first, stud.middle,
																									(select sum(m.amount) as a from miscellaneous as m where m.year_level_id=yl.id) as amount,
																									(select sum(sp.amount_paid) from student_payments as sp where sp.year_level_id=yl.id and sp.student_id=stud.id and sp.school_year_id=sy.id) as paid
																							FROM programs AS p																						
																							INNER JOIN year_levels AS yl ON p.id=yl.program_id
																							INNER JOIN sections AS sect ON yl.id = sect.year_level_id
																							INNER JOIN student_sections AS ss ON sect.id = ss.section_id
																							INNER JOIN students AS stud ON ss.student_id = stud.id
																							INNER JOIN school_years as sy ON ss.school_year_id = sy.id
																							ORDER BY yl.year_order asc, sect.section_order asc, stud.last asc, stud.first asc, stud.middle asc
																							LIMIT 0 , 30");
			}
		}
		$this->registry->template->sy_id = $school_year_id;	
		$this->registry->template->s_id = $section_id;
		echo $this->registry->db->error;
		$this->registry->template->students = $students;			
		$school_years = $this->registry->db->query("select id, CONCAT(year_start, ' - ', year_end) as years from school_years order by year_start desc, year_end desc");
		echo $this->registry->db->error;
		$this->registry->template->school_years = $school_years;
		$this->registry->template->sections = $this->registry->db->query("select sect.id, CONCAT(prog.program_name, ' - ', yl.name, ' - ', sect.name) as names from programs as prog, year_levels as yl, sections as sect where prog.id=yl.program_id and yl.id=sect.year_level_id order by prog.program_name desc, yl.year_order asc, sect.section_order asc");
		
	}
	public function index($args = null) {
		$students = array();
		
		if(isset($_POST['sidn'])) {
			$sidn = $_POST['sidn'];
		} else {
			if(isset($args[0]) && $args[0] == 'sidn') {
				$sidn = $args[1];
			}	else {
				$sidn = null;
			}
		}				
		$this->registry->template->sidn = $sidn;
		
		if(!empty($sidn)) {			
			$student_results = $this->registry->db->query("select id, sidn, first, middle, last, gender from students where sidn='$sidn' order by last asc, first asc, middle asc");
			while($sr = $student_results->fetch_object()) {
				// save all student's detail in an array
				$details = array('id' => $sr->id, 'sidn' => $sr->sidn, 'first' => $sr->first, 'middle' => $sr->middle, 'last' => $sr->last, 'gender' => $sr->gender);				
				// fetch all sy, prog, yl, sects of the student
				$level_results = $this->registry->db->query
					("
						select
							sy.id as sy_id, concat(sy.year_start, ' - ', sy.year_end) as sy_range,
							sect.id as sect_id, sect.name as sect_name, sect.section_order,
							yl.id as yl_id, yl.name as yl_name, yl.year_order,
							prog.id as prog_id, prog.program_name,
							-- get total amount paid
							(select sum(amount_paid) from student_payments where year_level_id = yl.id and school_year_id = sy.id and student_id = {$sr->id})
								as total_amount_paid,
							-- get total miscellaneous per year level
							(select sum(amount) from miscellaneous where year_level_id = yl.id)
								as total_misc,
							-- calculate final grade
							(select avg((sg.first + sg.second + sg.third + sg.fourth) / 4) from student_grades as sg, subjects as subj where sg.student_id = {$sr->id} and sg.subject_id = subj.id and subj.year_level_id = yl.id group by yl.id)
								as final_grade
						from							
							student_sections as ss,
							school_years as sy,
							sections as sect,
							year_levels as yl,
							programs as prog
						where
							yl.program_id = prog.id and
							sect.year_level_id = yl.id and
							ss.school_year_id = sy.id and																								
							ss.section_id = sect.id and
							ss.student_id = {$sr->id}
						order by
							sy.year_start asc,
							prog.program_name asc,
							yl.year_order asc,
							sect.section_order asc
					");
				// end of fetch
				
				$levels = array(); // reset the array to empty so that previous data will not be included to the new loop
				while($lr = $level_results->fetch_object()) {					
					$levels[] = array(
														'sy_id' => $lr->sy_id, 
														'sy_range' => $lr->sy_range,
														'prog_id' => $lr->prog_id,
														'program_name' => $lr->program_name,
														'yl_id' => $lr->yl_id,
														'yl_name' => $lr->yl_name,
														'year_order' => $lr->year_order,
														'sect_id' => $lr->sect_id,
														'sect_name' => $lr->sect_name,
														'section_order' => $lr->section_order,										
														'total_amount_paid' => $lr->total_amount_paid,
														'total_misc' => $lr->total_misc,													
														'final_grade' => $lr->final_grade														
														);
				}
				
				$students[] = array('details' => $details, 'levels' => $levels);
			}
			$this->registry->template->students = $students;
		} else {
			/* Table Nav */
			$total_students = $this->registry->db->query("select count(*) as total from students")->fetch_object()->total;			
			$row_per_page = 15;
			$current_page = isset($args[1]) ? $args[1] : 1;
			$total_page = ceil($total_students / $row_per_page); // round off to the highest value
			
			$this->registry->template->total_students = $total_students;
			$this->registry->template->row_per_page = $row_per_page;		
			$this->registry->template->current_page = $current_page;
			$this->registry->template->total_page = $total_page;			
			
			$limit = (($current_page - 1) * $row_per_page) . ", " . ($row_per_page * $current_page);
			/* Table Nav */
			
			// if sidn not given, then will fetch all students
			$student_results = $this->registry->db->query("select id, sidn, first, middle, last, gender from students order by last asc, first asc, middle asc limit $limit");
			while($sr = $student_results->fetch_object()) {				
				// save all student's detail in an array
				$details = array('id' => $sr->id, 'sidn' => $sr->sidn, 'first' => $sr->first, 'middle' => $sr->middle, 'last' => $sr->last, 'gender' => $sr->gender);				
				// fetch all sy, prog, yl, sects of the student
				$level_results = $this->registry->db->query
					("
						select
							sy.id as sy_id, concat(sy.year_start, ' - ', sy.year_end) as sy_range,
							sect.id as sect_id, sect.name as sect_name, sect.section_order,
							yl.id as yl_id, yl.name as yl_name, yl.year_order,
							prog.id as prog_id, prog.program_name,
							-- get total amount paid
							(select sum(amount_paid) from student_payments where year_level_id = yl.id and school_year_id = sy.id and student_id = {$sr->id})
								as total_amount_paid,
							-- get total miscellaneous per year level
							(select sum(amount) from miscellaneous where year_level_id = yl.id)
								as total_misc,
							-- calculate final grade
							(select avg((sg.first + sg.second + sg.third + sg.fourth) / 4) from student_grades as sg, subjects as subj where sg.student_id = {$sr->id} and sg.subject_id = subj.id and subj.year_level_id = yl.id group by yl.id)
								as final_grade
						from							
							student_sections as ss,
							school_years as sy,
							sections as sect,
							year_levels as yl,
							programs as prog
						where
							yl.program_id = prog.id and
							sect.year_level_id = yl.id and
							ss.school_year_id = sy.id and																								
							ss.section_id = sect.id and
							ss.student_id = {$sr->id}
						order by
							sy.year_start asc,
							prog.program_name asc,
							yl.year_order asc,
							sect.section_order asc
					");
				// end of fetch
				echo $this->registry->db->error;
				$levels = array(); // reset the array to empty so that previous data will not be included to the new loop
				while($lr = $level_results->fetch_object()) {					
					$levels[] = array(
														'sy_id' => $lr->sy_id, 
														'sy_range' => $lr->sy_range,
														'prog_id' => $lr->prog_id,
														'program_name' => $lr->program_name,
														'yl_id' => $lr->yl_id,
														'yl_name' => $lr->yl_name,
														'year_order' => $lr->year_order,
														'sect_id' => $lr->sect_id,
														'sect_name' => $lr->sect_name,
														'section_order' => $lr->section_order,										
														'total_amount_paid' => $lr->total_amount_paid,
														'total_misc' => $lr->total_misc,													
														'final_grade' => $lr->final_grade														
														);
				}
				
				$students[] = array('details' => $details, 'levels' => $levels);
			}
			$this->registry->template->students = $students;						
		}
	}
	public function enroll_new() {
		$school_years = $this->registry->db->query("select * from school_years where active=1 limit 1");
		$this->registry->template->school_year = $school_years->fetch_object();
		$year_levels = $this->registry->db->query("select * from year_levels order by year_order asc");
		$this->registry->template->year_levels = $year_levels;		
	}
	public function enroll_old() {
		$school_years = $this->db->query("select * from year_levels order by year_order asc");
		echo $this->db->error;
		var_dump($school_years);
	}
	public function view($args = null) {
		if(!empty($args[0])) {
			$this->registry->template->student = $this->registry->db->select("students", "*", "id={$args[0]}")->fetch_object();
		}
	}
	public function update_profile() {
		if(!empty($_POST)) {
			if($this->registry->db->update("students", $_POST)) {
				$_SESSION['message'] = 'Student Profile updated.';
			} else {
				$_SESSION['message'] = 'Failed updating Student Profile.';
			}
			header("Location: " . DIR . "/students/index/sidn/" . $_POST['sidn']);
			exit;
		}
	}
	public function save() {	
		if(isset($_POST['request']) == 'add') {
			if($this->registry->db->insert("students", $_POST)) {
				echo $this->registry->db->insert_id;
				$post = array('student_id' => $this->registry->db->insert_id, 'year_level_id' => $_POST['year_level_id']);
				if($this->registry->db->insert("student_lineups", $post)) {
					$_SESSION['message'] = 'Enrolling and Lining-up student was successful.';
				} else {
					$_SESSION['message'] = 'Failed lining-up student.';
				}
			} else {
				$_SESSION['message'] = 'Failed enrolling student.';
			}
			header("Location: " . DIR);
			exit;
		}
	}
	public function delete() {}
	public function assign_section($year_level = null) {
		if(!empty($year_level)) {
			$year_level_id = $year_level[0];
			$year_levels = $this->registry->db->query("select * from year_levels where id=$year_level_id");
			$year_level = $year_levels->fetch_object();
			$settings = $this->registry->db->query("select * from settings where year_level_id=$year_level_id");
			if($year_level->year_order == 1) { // first year				
				$setting = $settings->fetch_object();
				$max_number_per_section = $setting->max_number_per_section;
				
				$sections = $this->registry->db->query("select id, name from sections where year_level_id=$year_level_id order by section_order asc");				
				$ordered_sections = array();
				while($section = $sections->fetch_object()) {
					$ordered_sections[] = $section;
				}
				
				$lineups = $this->registry->db->query("select s.id,s.last,s.first,s.middle,((s.entrance_exam_score/sets.entrance_exam_total_score)*100) as exam_percentage from students as s, student_lineups as sl, settings as sets where s.id=sl.student_id and sets.year_level_id=sl.year_level_id and sl.year_level_id=$year_level_id and done=0 order by s.entrance_exam_score desc, s.last asc");								
				$this->registry->template->lineups = $lineups;				
				$students = array();
				$student_count = 1;
				$section_index = 0;				
				if($lineups) {
					while($lineup = $lineups->fetch_object()) {		
						$students[] = array('section' => $ordered_sections[$section_index], 'student' => $lineup);						
						if($student_count == $max_number_per_section) {					
							$student_count = 1;
							$section_index++;
						} else {							
							$student_count++;	
						}
					}
					$this->registry->template->students = $students;
				} else
					echo $this->registry->db->error;
			} // if first year
		}
		$year_levels = $this->registry->db->query("select * from year_levels order by year_order asc");
		$this->registry->template->year_levels = $year_levels;
		$this->registry->template->render("students_assign_section");
	}
	public function save_sectioning() {
		$query = "";
		foreach($_POST['sections'] as $sect_key => $sect_value) {					
			foreach($sect_value as $stud_key => $stud_id) {
				$date = date("Y-m-d H:i:s");
				$query .= "insert into student_sections (section_id, student_id) values($sect_key, $stud_id); update student_lineups set done=1, updated='$date' where student_id=$stud_id;";
			}
		}
		echo $query;
		if($this->registry->db->multi_query($query)) {
			echo "success";
		} else 
			echo $this->registry->db->error;
	}
}