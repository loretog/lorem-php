<?php
Class School_Years extends Controller
{
	public function index($args = null) {
		$school_years = $this->registry->db->select("school_years", "*", null, "year_start desc");
		if($school_years)
			$this->registry->template->school_years = $school_years;
	}
	public function add() {
	}
	public function edit($args = null) {
		if(!empty($args[0])) {
			$school_year = $this->registry->db->select("school_years", "*", "id={$args[0]}");
			if($school_year) {
				$this->registry->template->sy = $school_year->fetch_object();
			} else {
				$_SESSION['message'] = 'Schol Year not found.';
			}
		}
	}
	public function save() {
		if(!empty($_POST)) {
			if($_POST['request'] == 'update') {
				$this->registry->db->query("update school_years set active=0 where id!={$_POST['id']}");
				if($this->registry->db->update("school_years", $_POST)) {
					$_SESSION['message'] = 'School Year updated successfully.';
					header("Location: " . DIR . "/school_years/");
				} else {
					$_SESSION['message'] = 'School Year not updated.';
					header("Location: " . DIR . "/school_years/edit/" . $_POST['id']);
				}				
				exit;
			} elseif($_POST['request'] == 'add') {				
				if($this->registry->db->insert("school_years", $_POST)) {
					$_SESSION['message'] = 'School Year added successfully.';
					header("Location: " . DIR . "/school_years/");
				} else {
					$_SESSION['message'] = 'School Year not added.';
					header("Location: " . DIR . "/school_years/edit/" . $_POST['id']);
				}				
				exit;
			}
		}
	}
	public function delete($args = null) {
		if(!empty($args[0])) {
			if($this->registry->db->delete("school_years", $args[0])) {
				$_SESSION['message'] = 'School Year successfully deleted.';
			} else {
				$_SESSION['message'] = 'Deleting School Year failed.';
			}
		}
		header("Location: " . DIR . "/school_years");
		exit;
	}
	public function change_status($args = null) {
		if(!empty($args)) {
			$id = $args[0];
			$status = $args[1];
			$data = array('id' => $id, 'active' => $status);
			if($this->registry->db->multi_query("update school_years set active=0; update school_years set active=1 where id = $id")) {
				$_SESSION['message'] = 'School Year - ' . (($status == 0) ? 'Deactivated' : 'Activated');
			} else {
				$_SESSION['message'] = 'An Error Occured. ' . $this->registry->db->error;
			}
			header("Location: " . DIR . "/school_years");
			exit;
		}
	}
}