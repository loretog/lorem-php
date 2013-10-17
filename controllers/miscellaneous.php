<?php
Class Miscellaneous extends Controller
{
	public function index($args = null) {	
		$yl_id = 0;
		$yl_name = "";
		if(!empty($_POST['yl_id']) || !empty($args)) {
			$yl_id = !empty($args[0]) ? $args[0] : $_POST['yl_id'];
			$yl = $this->registry->db->query("select yl.id, concat(p.program_name, ' - ', yl.name) as name from year_levels as yl, programs as p where p.id=yl.program_id and yl.id=$yl_id order by p.program_name asc, yl.year_order asc limit 1")->fetch_object();
			$yl_name = $yl->name;
			//$miscs = $this->registry->db->query("select m.id, p.program_name, yl.name, m.misc_name, m.description, m.amount, m.created, m.updated from miscellaneous as m, year_levels as yl, programs as p where p.id=yl.program_id and yl.id=m.year_level_id and m.year_level_id=$yl_id order by p.program_name asc, yl.year_order asc, m.misc_name asc");
		} else {
			$yl = $this->registry->db->query("select yl.id, concat(p.program_name, ' - ', yl.name) as name from year_levels as yl, programs as p where p.id=yl.program_id order by p.program_name asc, yl.year_order asc limit 1")->fetch_object();
			$yl_id = $yl->id;
			$yl_name = $yl->name;
			//$miscs = $this->registry->db->query("select m.id, p.program_name, yl.name, m.misc_name, m.description, m.amount, m.created, m.updated from miscellaneous as m, year_levels as yl, programs as p where p.id=yl.program_id and yl.id=m.year_level_id and m.year_level_id=$yl_id order by p.program_name asc, yl.year_order asc, m.misc_name asc");			
		}
		$miscs = $this->registry->db->query("select m.id, p.program_name, yl.name, m.misc_name, m.description, m.amount,(select name from subjects where year_level_id={$yl_id} and id=m.required_by_subject) as required_by_subject, m.required_by_gender, m.created, m.updated from miscellaneous as m, year_levels as yl, programs as p where p.id=yl.program_id and yl.id=m.year_level_id and m.year_level_id=$yl_id order by p.program_name asc, yl.year_order asc, m.misc_name asc");			
		$this->registry->template->yl_id = $yl_id;
		$this->registry->template->yl_name = $yl_name;
		$this->registry->template->pyls = $this->registry->db->query("select yl.id, CONCAT(p.program_name, ' - ', yl.name) as name from year_levels as yl, programs as p where p.id=yl.program_id order by p.program_name asc, yl.year_order asc");
		$this->registry->template->miscs = $miscs;
	}
	public function add($args = null) {
		if(!empty($args))
			$this->registry->template->yl_id = $args[0];
		$this->registry->template->pyls = $this->registry->db->query("select yl.id, CONCAT(p.program_name, ' - ', yl.name) as name from year_levels as yl, programs as p where p.id=yl.program_id order by p.program_name asc, yl.year_order asc");
		$this->registry->template->subjects = $this->registry->db->select("subjects", "*", "year_level_id={$args[0]}");
	}
	public function edit($args = null) {
		if(!empty($args)) {
			$id = $args[0];
			$yl_id = $args[1];
			$this->registry->template->pyls = $this->registry->db->query("select yl.id, CONCAT(p.program_name, ' - ', yl.name) as name from year_levels as yl, programs as p where p.id=yl.program_id order by p.program_name asc, yl.year_order asc");
			$this->registry->template->misc = $this->registry->db->query("select * from miscellaneous where id=$id")->fetch_object();
			$this->registry->template->id = $id;
			$this->registry->template->yl_id = $yl_id;
			$this->registry->template->subjects = $this->registry->db->select("subjects", "*", "year_level_id={$args[1]}");
		}
	}
	public function save() {
		if(!empty($_POST)) {			
			switch($_POST['request']) {
				case "add":
					if($this->registry->db->insert("miscellaneous", $_POST)) {
						$_SESSION['message'] = 'Miscellaneous Successfully Added!';
					} else {
						$_SESSION['message'] = 'Adding Miscellaneous Failed.' . $this->registry->db->error;
					}					
				break;
				case "update":
					if($this->registry->db->update("miscellaneous", $_POST)) {
						$_SESSION['message'] = 'Miscellaneous Successfully Updated!';
					} else {
						$_SESSION['message'] = 'Updating Miscellaneous Failed.' . $this->registry->db->error;
					}					
				break;				
			}
			header("Location: " . DIR . "/miscellaneous/index/" . $_POST['year_level_id']);
		}
		exit;
	}
	public function delete($args = null) {
		if(!empty($args)) {
			if($this->registry->db->delete("miscellaneous", $args[0])) {
				$_SESSION['message'] = 'Record deleted';
			} else {
				$_SESSION['message'] = 'Failed in deleting the record' . $this->registry->db->error;
			}
		} else {
			$_SESSION['message'] = 'No ID defined';
		}
		header("Location: " . DIR . "/miscellaneous/");
		exit;
	}
}