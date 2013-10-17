<?php

Class Subjects extends Controller
{
	function index($args = null) {
		$year_level_id = (isset($_POST['year_level_id']) ? $_POST['year_level_id'] : (isset($args[0]) ? $args[0] : 0));
		if($year_level_id != 0) {
			$subjects = $this->registry->db->query("SELECT sub.id, prog.program_name, yl.name as year_name, sub.name as subject_name, sub.description, sub.unit, sub.created, sub.updated
																							FROM subjects as sub, year_levels as yl, programs as prog
																							where prog.id=yl.program_id and sub.year_level_id = yl.id and yl.id={$year_level_id}
																							order by sub.year_level_id, yl.name");
			$this->registry->template->year_level_id = $year_level_id;
		} else {			
			$subjects = $this->registry->db->query("SELECT sub.id, prog.program_name, yl.name as year_name, sub.name as subject_name, sub.description, sub.unit, sub.created, sub.updated
																							FROM subjects as sub, year_levels as yl, programs as prog
																							where prog.id=yl.program_id and sub.year_level_id = yl.id
																							order by sub.year_level_id, yl.name");
		}
		$this->registry->template->subjects = $subjects;		
		$this->registry->template->year_levels = $this->registry->db->query("select yl.id, CONCAT(prog.program_name, ' - ', yl.name) as name from year_levels as yl, programs as prog where prog.id=yl.program_id order by prog.program_name asc, yl.year_order asc");
	}
	function add($args = null) {		
		if(!empty($args)) {
			$this->registry->template->year_level_id = $args[0];		
		} 
		$year_levels = $this->registry->db->query("select yl.id, CONCAT(prog.program_name, ' - ', yl.name) as name from year_levels as yl, programs as prog where prog.id=yl.program_id order by prog.program_name ASC, yl.year_order ASC");

		$this->registry->template->year_levels = $year_levels;		
	}
	public function edit($subject_id = null) {
		if(!empty($subject_id)) {
			$year_levels = $this->registry->db->query("select * from year_levels");			
			$rec = $this->registry->db->query("select * from subjects where id=" . $subject_id[0] . " limit 1");
			$subjects = $rec->fetch_object();
			$this->registry->template->subject_id = $subjects->id;
			$this->registry->template->year_level_id = $subjects->year_level_id;			
			$this->registry->template->subject_name = $subjects->name;
			$this->registry->template->description = $subjects->description;
			$this->registry->template->unit = $subjects->unit;
			$this->registry->template->year_levels = $year_levels;			
		}		
	}
	public function save() {
		if(!empty($_POST)) {
			$request = $_POST['request'];			
			$year_level_id = $_POST['year_level_id'];
			if($request == 'add') {								
				$this->registry->db->insert("subjects", $_POST);
			} elseif ($request == 'edit') {
				$subject_id = $_POST['subject_id'];				
				if($this->registry->db->query("update subjects set year_level_id=$year_level_id, name='$name', description='$description', unit=$unit, updated='$date' where id=$subject_id"))
					$_SESSION['message'] = '<p>Update successful!</p>';
				else
					$_SESSION['message'] = '<p>Error updating the record</p>';
				
			}						
			header("Location: " . DIR . "/subjects/index/" . $year_level_id);
			exit;
		} else { 
			header("Location: " . DIR . "/year_levels");
			exit;
		}		
	}
	public function delete($subject_id = null) {
		if(!empty($subject_id)) {
			$this->registry->db->query("delete from subjects where id=" . $subject_id[0]);
		}
		header("Location: " . DIR . "/subjects/");
	}
}