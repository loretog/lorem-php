<?php
class Schedules extends Controller
{
  public function index() {
    
  }
  public function create_schedule($args = null) {
    $output = "";
    if(!empty($_POST)) {
      $subjects = $this->registry->select("subjects", "*", "year_level_id={$_POST['year_level_id']}");
      var_dump($subjects);
    } else {
      $q = "select yl.id, concat(p.program_name, ' - ', yl.name) as name from year_levels as yl, programs as p where p.id = yl.program_id order by p.program_name asc, yl.year_order asc";
      $year_levels = $this->registry->db->query($q);
      $this->registry->template->year_levels = $year_levels;
    }
    
    $programs = $this->registry->db->select("programs");
    
    while($program = $programs->fetch_object()) {
      $output .=  "<table class='schedules'>";
      $output .= "<tr>";
      $output .= "<td><p>[{$program->id}]" . $program->program_name . "</p>";
      $year_levels = $this->registry->db->query("select * from year_levels where program_id={$program->id}");
      $output .= "<table>";
      while($year_level = $year_levels->fetch_object()) {
        //echo "<p>select * from sections where year_level_id={$year_level->id}</p>";
        $sections = $this->registry->db->query("select * from sections where year_level_id={$year_level->id}");				
				$subjects = $this->get_subjects($year_level->id);								
        $sectable = "";
        while($section = $sections->fetch_object()) {
					$subjs = $subjects;
					$subjtable = "<table>";
					foreach($subjs as $key => $value) {
						$subjtable .= "<tr>";
						$subjtable .= "<td>";
						$subjtable .= $value['name'];
						$subjtable .= "</td>";
						$subjtable .= "</tr>";
					}
					$subjtable .= "</table>";
          $sectable .= "<table>";
          $sectable .= "<tr>";
          $sectable .= "<td><p>[{$section->id}]" . $section->name . "</p>$subjtable</td>";
          $sectable .= "</tr>";
          $sectable .= "</table>";
        }
        $output .= "<tr><td><p>[{$year_level->id}]" . $year_level->name . "</p>" . $sectable . "</td></tr>";        
      }
      $output .= "</table>";
      $output .= "</td>";
      $output .= "</tr>";
      $output .= "</table>";
    }
			
    $this->registry->template->output = $output;
  }
	private function get_table($table_name, $columns = null, $id = null) {
		$arr = array();
		$table = $this->registry->db->select($table_name, $columns, $id);
		while($t = $table->fetch_object()) {
			$fields = explode(",", $columns);
			$a = array();
			foreach($fields as $value) {
				$a[$value] = $t->$value;
			}
			$arr[] = $a;
		}
		return $arr;
	}
	private function get_subjects($yl_id) {	
		$arr = array();
		$subjs = $this->registry->db->query("select * from subjects where year_level_id={$yl_id}");
		while($subj = $subjs->fetch_object()) {
			$arr[] = array('id' => $subj->id, 'name' => $subj->name);
		}
		return $arr;
	}
}