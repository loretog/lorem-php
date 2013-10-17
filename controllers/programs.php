<?php
Class Programs extends Controller
{
	public function index() {		
		$this->registry->template->programs = $this->registry->db->query("select *, (select count(*) from year_levels as yl where yl.program_id=d.id) as total_year_levels from programs as d");		
	}
	public function add() {		
	}
	public function edit($id = null) {
		$this->registry->template->program = $this->registry->db->query("select * from programs where id={$id[0]}")->fetch_object();		
	}
	public function save() {
		if(!empty($_POST)) {
			if($_POST['request'] == 'add') {			
				if($this->registry->db->insert("programs", $_POST)) {
					$_SESSION['message'] = 'Successfully created a new program.';
				} else {
					$_SESSION['message'] = 'Failed in creating a new program. Please try again.' . $this->registry->db->error;
				}			
			} elseif($_POST['request'] == 'edit') {			
				if($this->registry->db->update("programs", $_POST)) {
					$_SESSION['message'] = 'Successfully updated the record.';
				} else {
					$_SESSION['message'] = 'Failed in updating the record. Please try again.' . $this->registry->db->error;
				}
			}
		}
		header("Location: " . DIR . "/programs");
		exit;
	}
	public function delete($id = null) {
		if(!empty($id)) {
			$counts = $this->registry->db->query("select count(*) as total from year_levels where program_id={$id[0]}")->fetch_object();
			if($counts->total == 0) {
				if($this->registry->db->delete("programs", $id[0]))
					$_SESSION['message'] = 'Delete successful!';
				else
					$_SESSION['message'] = 'Error deleting the record.' . $this->registry->db->error;
			} else {
				$_SESSION['message'] = 'This program has ' . $counts->total . ' Year Levels. Delete those first before deleting this program.';
			}
		} else {
			$_SESSION['message'] = 'Please specify what program to be deleted.';
		}
		header("Location: " . DIR . "/programs");
		exit;
	}
}