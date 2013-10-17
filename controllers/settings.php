<?php

Class Settings extends Controller
{
	public function index() {
		$this->registry->template->settings = $this->registry->db->query("select sett.id, prog.program_name, yl.name, sett.entrance_exam_total_score, sett.max_number_per_section, sett.enrollment_open from settings as sett, programs as prog, year_levels as yl where sett.year_level_id=yl.id and yl.program_id=prog.id");
	}
	public function add() {
		$year_levels = $this->registry->db->query("select yl.id, prog.program_name, yl.name from year_levels as yl, programs as prog where prog.id=yl.program_id and yl.id not in (select year_level_id from settings)");
		if($year_levels->num_rows > 0)
			$this->registry->template->year_levels = $year_levels;
		else {
			$_SESSION['message'] = "All Year Levels has been set. No need to add a new settings for now.";
			header("Location: " . DIR . "/settings");
			exit;
		}
	}
	public function edit($args) {
		if(!empty($args[0])) {
			$id = $args[0];
			$this->registry->template->id = $id;
			$this->registry->template->setting = $this->registry->db->query("select * from settings as s, year_levels as yl, programs as prog where yl.program_id=prog.id and s.year_level_id=yl.id and s.id={$id}")->fetch_object();
		} else {
			header("Location: " . DIR . "/settings");
		}
	}
	public function save() {
		if($_POST['request'] == "add") {
			if($this->registry->db->insert("settings", $_POST)) {
				$_SESSION['message'] = "Adding new setting was successful.";
			} else {
				$_SESSION['message'] = "Adding new settings failed.";
			}
		} elseif($_POST['request'] == "edit") {
			if($this->registry->db->update("settings", $_POST)) {
				$_SESSION['message'] = "Updating setting was successful.";
			} else {
				$_SESSION['message'] = "Updating settings failed.";
			}
		}
		header("Location: " . DIR . "/settings");
		exit;
	}
}