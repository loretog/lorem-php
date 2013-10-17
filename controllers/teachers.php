<?php

Class Teachers extends Controller
{
	function index($subject_id = null) {				
		$teachers = null;
		$id = $subject_id[0];
		if(!empty($id)) {
			$teachers = $this->registry->db->query("SELECT t.id, sub.name, t.first, t.middle ,t.last, t.created, t.updated
																							FROM teachers as t, subjects as sub
																							where t.subject_id = sub.id and sub.id = $id
																							order by t.subject_id, t.last");
			$this->registry->template->subject_id = $id;
			$this->registry->template->teachers = $teachers;
			$this->registry->template->render("teachers_index");
		} /*else {			
			$teachers = $this->registry->db->query("SELECT sub.id, yl.name as year_name, sub.name as subject_name, sub.description, sub.unit, sub.created, sub.updated
																							FROM subjects as sub, year_levels as yl
																							where sub.year_level_id = yl.id
																							order by sub.year_level_id, yl.name");
		}*/
	}
	function add($subject_id = null) {		
		if(!empty($subject_id)) {
			$this->registry->template->subject_id = $subject_id[0];			
			$this->registry->template->render("teachers_add");
		}		
	}
	public function edit($teacher_id = null) {
		if(!empty($teacher_id)) {			
			$rec = $this->registry->db->query("select * from teachers where id=" . $teacher_id[0]);
			$teachers = $rec->fetch_object();
			$this->registry->template->teacher_id = $teachers->id;
			$this->registry->template->subject_id = $teachers->subject_id;			
			$this->registry->template->room = $teachers->room;			
			$this->registry->template->first = $teachers->first;
			$this->registry->template->middle = $teachers->middle;
			$this->registry->template->last = $teachers->last;			
			$this->registry->template->render('teachers_edit');
		}		
	}
	public function save() {
		if(!empty($_POST)) {
			$request = $_POST['request'];
			$room = $_POST['room'];
			$first = $_POST['first'];
			$middle = $_POST['middle'];			
			$last = $_POST['last'];			
			$date = date("Y-m-d H:i:s");
			$subject_id = $_POST['subject_id'];			
			if($request == 'add') {				
				$this->registry->db->query("insert into teachers (subject_id, room, first, middle, last, created) values($subject_id, '$room', '$first', '$middle', '$last', '$date')");
				header("Location: " . DIR . "/teachers/index/" . $subject_id);
			} elseif ($request == 'edit') {					
				$teacher_id = $_POST['teacher_id'];
				if($this->registry->db->query("update teachers set subject_id=$subject_id, room='$room' first='$first', middle='$middle', last='$last', updated='$date' where id=$teacher_id"))
					$_SESSION['message'] = '<p>Update successful!</p>';
				else
					$_SESSION['message'] = '<p>Error updating the record</p>';
				//exit;
				header("Location: " . DIR . "/teachers/index/" . $subject_id);
			}			
		}		
	}
	public function delete($subject_id = null) {
		if(!empty($subject_id)) {
			$this->registry->db->query("delete from teachers where id=" . $subject_id[0]);
			header("Location: " . DIR . "/teachers/index/" . $subject_id[0]);
		} else 
			header("Location: " . DIR . "/teachers");
	}
}