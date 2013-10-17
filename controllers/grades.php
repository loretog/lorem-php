<?php

Class Grades extends Controller
{
	public function index() {}
	public function view($args = null) {		
		if(!empty($args)) {
			$student_id = $args[0];
			$year_level_id = $args[1];
			$section_id = $args[2];

			$subjects = $this->registry->db->query("select * from subjects where year_level_id=$year_level_id");			
			$this->registry->template->subjects = $subjects;
			$student_grades = $this->registry->db->query("select * from student_grades where student_id=$student_id");
			$this->registry->template->student_subjects = $student_grades;
		} else {
			$_SESSION['message'] = 'Student not found';
		}		
	}
	public function add() {
		if(!empty($_POST)) {
			$_POST['note'] = (strtolower($_POST['note']) == 'no grades yet' ? '' : $_POST['note']);
			if($this->registry->db->insert("student_grades", $_POST)) {
				$_SESSION['message'] = 'Grade added successfully!';
				header("Location: " . DIR . "/student_grades/view/" . $_POST['student_id'] . "/" . $_POST['year_level_id'] . "/" . $_POST['subject_id']);
				exit;
			} else {
				$_SESSION['message'] = 'Error adding grade. ' . $this->registry->db->error;
				header("Location: " . DIR . "/student_grades/view/" . $_POST['student_id'] . "/" . $_POST['year_level_id'] . "/" . $_POST['subject_id']);
				exit;
			}
		}
	}
	public function update() {
		if(!empty($_POST)) {		
			if($this->registry->db->update("student_grades", $_POST)) {
				$_SESSION['message'] = 'Grade updated successfully!';
				header("Location: " . DIR . "/student_grades/view/" . $_POST['student_id'] . "/" . $_POST['year_level_id'] . "/" . $_POST['subject_id']);
				exit;
			} else {
				$_SESSION['message'] = 'Error updating grade. ' . $this->registry->db->error;
				header("Location: " . DIR . "/student_grades/view/" . $_POST['student_id'] . "/" . $_POST['year_level_id'] . "/" . $_POST['subject_id']);
				exit;
			}
		}
	}
}