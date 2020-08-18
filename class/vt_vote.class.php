<?php
// Class for Table - vt_vote

class vt_vote{
	 private $id;
	 private $candidate_id;
	 private $vdate;


	public function get_id() {
			return $this->id;
	}
	public function set_id($p_value) {
			$this->id = $p_value;
	}
	public function get_candidate_id() {
			return $this->candidate_id;
	}
	public function set_candidate_id($p_value) {
			$this->candidate_id = $p_value;
	}
	public function get_vdate() {
			return $this->vdate;
	}
	public function set_vdate($p_value) {
			$this->vdate = $p_value;
	}


}
?>