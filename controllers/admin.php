<?php

Class Admin extends Controller
{
	public function index() {
    
  }
  public function user_profile($args = null) {    
    if(!empty($args)) {
      $q = "select * from groups as g inner join admins as a on a.group_id=g.id and a.id={$args[0]}";
      $profile = $this->registry->db->query($q);
      $this->registry->template->profile = $profile;
    }    
  }
  public function update_profile() {
    if(!empty($_POST)) {
      if($this->registry->db->update("admins", $_POST)) {
        echo "Updating profile successful.";
      } else {
        echo "Error updating profile";
      }   
    }
    exit;
  }
  public function update_password() {
    if(!empty($_POST)) {     
      $profile = $this->registry->db->select("admins", "*", "id={$_POST['id']}")->fetch_object();
      if($profile->password != md5($_POST['cur_pwd'])) {
        echo "Current password do not match";
        exit;
      }
      if($_POST['new_pwd'] != $_POST['confirm_pwd']) {
        echo "New password do not match. Please check.";
        exit;
      }
      $data = array('id' => $_POST['id'], 'password' => md5($_POST['new_pwd']));
      if($this->registry->db->update("admins", $data)) {
        echo "New Password update";
      } else {
        echo "Error updating password";
      }
    }
    exit;
  }
  public function users() {
    //$this->registry->template->users = $this->registry->db->select("admins");	
	}
	public function add_new_user() {
		if($this->registry->db->insert("admins", $_POST)) {
		} else {
		}
		//var_dump($_POST['send']);
		exit;
	}
	public function load_user_table() {
		$users = $this->registry->db->select("admins");	
		$table = '<table class="grid">
								<tr class="ghead">
									<td>Group</td>
									<td>Username</td>
									<td>Last Name</td>
									<td>First Name</td>
									<td>Email</td>
									<td>Created</td>
									<td>Updated</td>
								</tr>';
		while($user = $users->fetch_object()) {
			$table .= '<tr><td>';					
						if($user->group_id == 1)
							$table .= 'Administrator';
						elseif($user->group_id == 2)
							$table .= 'Registrar';				
						elseif($user->group_id == 3)
							$table .= 'Cashier';
						elseif($user->group_id == 4)
							$table .= 'Teacher';
			$table .= '</td>';
			$table .= '<td>' . $user->username . '</td>';
			$table .= '<td>' . $user->lastname . '</td>';
			$table .= '<td>' . $user->firstname . '</td>';
			$table .= '<td>' . $user->email . '</td>';
			$table .= '<td>' . $user->created . '</td>';
			$table .= '<td>' . $user->updated . '</td>';
			$table .= '</tr>';
		}
		echo $table;
		exit;
	}
}