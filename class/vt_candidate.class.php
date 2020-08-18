<?php
// Class for Table - vt_candidate

class vt_candidate{
	 private $id;
	 private $cname;
	 private $classname;
	 private $status;


	public function get_id() {
			return $this->id;
	}
	public function set_id($p_value) {
			$this->id = $p_value;
	}
	public function get_cname() {
			return $this->cname;
	}
	public function set_cname($p_value) {
			$this->cname = $p_value;
	}
	public function get_classname() {
			return $this->classname;
	}
	public function set_classname($p_value) {
			$this->classname = $p_value;
	}
	public function get_status() {
			return $this->status;
	}
	public function set_status($p_value) {
			$this->status = $p_value;
	}


}
?>