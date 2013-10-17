<?php

Class Sections extends Controller
{
	public function index($year_level_id = null) {
		$sections = null;
		$id = $year_level_id[0];
		if(!empty($id)) {
			$sections = $this->registry->db->query("SELECT sect.id, dept.program_name, yl.name as year_name, sect.section_order, sect.name as section_name, sect.created, sect.updated
																							FROM sections as sect, year_levels as yl, programs as dept
																							where sect.year_level_id = $id and sect.year_level_id = yl.id and yl.program_id = dept.id
																							order by dept.program_name asc, yl.year_order asc, sect.section_order asc");
			$this->registry->template->year_level_id = $id;
		} else {			
			$sections = $this->registry->db->query("SELECT sect.id, dept.program_name, yl.name as year_name, sect.section_order, sect.name as section_name, sect.created, sect.updated
																							FROM sections as sect, year_levels as yl, programs as dept
																							where sect.year_level_id = yl.id and yl.program_id = dept.id
																							order by dept.program_name asc, yl.year_order asc, sect.section_order asc");
		}
		$depts_and_yls = $this->registry->db->query("SELECT yl.id as year_id, dept.id as dept_id, yl.name as year_name, dept.program_name
																								FROM year_levels as yl, programs as dept
																								where yl.program_id = dept.id
																								order by dept.program_name asc, yl.year_order asc");		
		$dys = array();
		while($dy = $depts_and_yls->fetch_object()) {
			$dys[$dy->dept_id][$dy->program_name][] = array('year_id' => $dy->year_id, 'year_name' => $dy->year_name);
		}				
		$this->registry->template->dys = $dys;
		$this->registry->template->sections = $sections;		
	}
	public function add($year_level_id = null) {
		$year_levels = $this->registry->db->query("select yl.id, dept.program_name, yl.name from year_levels as yl, programs as dept where yl.program_id=dept.id order by dept.program_name asc, yl.year_order asc");
		if(!empty($year_level_id)) {
			$this->registry->template->year_level_id = $year_level_id[0];			
		}
		$this->registry->template->year_levels = $year_levels;		
	}
	public function edit($section_id = null) {
		if(!empty($section_id)) {
			$year_levels = $this->registry->db->query("select yl.id, dept.program_name, yl.name from year_levels as yl, programs as dept where yl.program_id=dept.id order by dept.program_name asc, yl.year_order asc");
			$rec = $this->registry->db->query("select * from sections where id=" . $section_id[0]);
			$section = $rec->fetch_object();
			$this->registry->template->section_id = $section->id;
			$this->registry->template->year_level_id = $section->year_level_id;			
			$this->registry->template->section_order = $section->section_order;			
			$this->registry->template->section_name = $section->name;
			$this->registry->template->year_levels = $year_levels;
		}		
	}
	public function save() {
		if($_POST) {			
			$request = $_POST['request'];
			$section_order = $_POST['section_order'];
			$name = $_POST['name'];
			$date = date("Y-m-d H:i:s");
			$year_level_id = $_POST['year_level_id'];
			if($request == 'add') {				
				$this->registry->db->query("insert into sections (year_level_id, section_order, name, created) values($year_level_id, $section_order, '$name', '$date')");
			} else if($request == 'edit') {
				$section_id = $_POST['section_id'];
				$this->registry->db->query("update sections set section_order=$section_order, name='$name', year_level_id=$year_level_id, updated='$date' where id=$section_id");
			}
			header("Location: " . DIR . "/sections/index/" . $year_level_id);
		} else {
			header("Location: " . DIR . "/sections/");
		}		
	}
	public function delete($section_id = null) {
		if(!empty($section_id)) {
			$this->registry->db->query("delete from sections where id=" . $section_id[0]);
			header("Location: " . DIR . "/sections/index/" . $section[0]);
		}		
	}
}