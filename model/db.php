<?php
Class Db extends Mysqli
{	
	private $dbhost = "";
	private $dbuser = "";
	private $dbpwd = "";
	private $dbname  = "";
	public function __construct() {
		parent::__construct("localhost", "root", "", "inhs");
	}
	public function select($table_name, $fields = "*", $where = null, $order_by = null) {
		$append = "";
		if(!empty($where)) {
			$append = "where $where";
		}
		if(!empty($order_by)) {
			$append .= " order by $order_by";
		}
		return $this->query("select $fields from $table_name $append");
	}
	public function insert($table_name, $post) {
		$fields = $this->query("describe $table_name");		
		if($post) {
			$cols = "";
			$values = "";			
			while($field = $fields->fetch_object()) { // loop through all table fields
				foreach($post as $key => $value) { // loop through all available post					
					if(strtolower($key) == strtolower($field->Field) && ($value != "" || $value != null)) { // make sure the field name and post index/key is equal and isn't empty or null
						$cols .= $key . ",";
						if(preg_match('/float/', $field->Type)) { // look for float data type
							$values .= (float) $value . ",";
						} elseif(preg_match('/int/', $field->Type)) { // look for int data type
							$values .= (int) $value . ",";
						} else { // the rest goes here
							$values .= "'" . htmlentities($this->real_escape_string($value)) . "',";							
						}
					}
				}
				if(strtolower($field->Field) == "created") {
					$cols .= "created,";
					$values .= time() . ",";
				}
			} // while
			$cols = substr($cols, 0, -1); // remove trailing comma
			$values = substr($values, 0, -1); // remove trailing comma			
			$query = $this->query("insert into $table_name ($cols) values($values)");			
			if($query) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		} 
	} // insert
	public function update($table_name, $post) {
		$fields = $this->query("describe $table_name");		
		if($post) {
			$cols = "";
			$values = "";			
			while($field = $fields->fetch_object()) { // loop through all table fields
				if($field->Key != "PRI") { // we make sure that the primary will not be change
					foreach($post as $key => $value) { // loop through all available post						
						if(strtolower($key) == strtolower($field->Field) && ($value != "" || $value != null)) { // make sure the field name and post index/key is equal and isn't empty or null
							$cols .= $key . "=";
							if(preg_match('/float/', $field->Type)) { // look for float data type
								$cols .= (float) $value . ", ";
							} elseif(preg_match('/int/', $field->Type)) { // look for int data type
								$cols .= (int) $value . ",";
							} else { // the rest goes here
								$cols .= "'" . htmlentities($this->real_escape_string($value)) . "',";
							}
						}
					}
				}
				if(strtolower($field->Field) == "updated") {
					$cols .= "updated=" . time() . ",";					
				}
			} // while
			$cols = substr($cols, 0, -1); // remove trailing comma			
			$query = $this->query("update $table_name set $cols where id={$post['id']}");				
			if($query) {
				return true;
			} else {				
				return false;
			}
		} else {
			return false;
		} 
	} // udpate
	public function delete($table_name, $id = null) {
		if($this->query("delete from $table_name where id=$id"))
			return true;
		else
			return false;
	}
}