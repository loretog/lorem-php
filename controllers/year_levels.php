<?php

Class Year_Levels extends Controller
{
	public function index($args = null) {
		if(!empty($args)) {
			$program_id = $args[0];
			$this->registry->template->years = $this->registry->db->query("select yl.id as year_id, yl.name, yl.year_order, yl.created, yl.updated, d.id as program_id, d.program_name, (select count(*) from sections as sect where sect.year_level_id=yl.id) as total_sections from year_levels as yl, programs as d where yl.program_id=d.id and yl.program_id=$program_id order by d.program_name asc, yl.year_order asc");
		} else {
			$this->registry->template->years = $this->registry->db->query("select yl.id as year_id, yl.name, yl.year_order, yl.created, yl.updated, d.id as program_id, d.program_name, (select count(*) from sections as sect where sect.year_level_id=yl.id) as total_sections from year_levels as yl, programs as d where yl.program_id=d.id order by d.program_name asc, yl.year_order asc");
		}
	}
	public function add() {
		$this->registry->template->programs = $this->registry->db->query("select * from programs");
	}
	public function edit($id = null) {		
		$this->registry->template->programs = $this->registry->db->query("select * from programs");
		$this->registry->template->year = $this->registry->db->query("select * from year_levels where id={$id[0]}")->fetch_object();		
	}
	public function save() {
		if(!empty($_POST)) {
			if($_POST['request'] == 'add') {			
				if($this->registry->db->insert("year_levels", $_POST)) {
					$_SESSION['message'] = 'Successfully created a new Year Level.';
				} else {
					$_SESSION['message'] = 'Failed in creating a new Year Level. Please try again.' . $this->registry->db->error;
				}			
			} elseif($_POST['request'] == 'edit') {			
				if($this->registry->db->update("year_levels", $_POST)) {
					$_SESSION['message'] = 'Successfully updated the record.';
				} else {
					$_SESSION['message'] = 'Failed in updating the record. Please try again.' . $this->registry->db->error;
				}
			}
		}
		header("Location: " . DIR . "/year_levels");
		exit;
	}
	public function delete($id = null) {
		if(!empty($id)) {
			$counts = $this->registry->db->query("select count(*) as total from sections where year_level_id={$id[0]}")->fetch_object();
			if($counts->total == 0) {
				if($this->registry->db->delete("year_levels", $id[0]))
					$_SESSION['message'] = 'Delete successful!';
				else
					$_SESSION['message'] = 'Error deleting the record.' . $this->registry->db->error;
			} else {
				$_SESSION['message'] = 'This Year Level has ' . $counts->total . ' Sections. Delete those first before deleting this Year Level.';
			}
		} else {
			$_SESSION['message'] = 'Please specify what Year Level to be deleted.';
		}
		header("Location: " . DIR . "/year_levels");
		exit;
	}
	public function get_year_levels($args = null) {		
		if(!empty($args)) {
			if($args[0] == "option") {
				$year_levels = $this->registry->db->query("select id, name from year_levels where program_id={$args[1]} order by year_order asc");
				echo "<option>-- Select Year Level --</option>";
				while($year_level = $year_levels->fetch_object()) {
					echo "<option value='{$year_level->id}'>{$year_level->name}</option>";
				}
			}
		}
		exit; // stop from displaying the whole layout of the page
	}
}