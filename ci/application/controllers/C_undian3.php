<?php
class C_undian3 extends CI_Controller {
	var $list=array();
	function index(){
		$this->load->helper("html");
		$this->load->model("m_undiancrud3");
		$data["nomor_undian"] = $this->m_undiancrud3->nomor_undian;
		$data["old_nomor_undian"] = $this->m_undiancrud3->hasil_pencarian;
		echo "Nomor undian kamu adalah ".$data["old_nomor_undian"].$data["nomor_undian"];
	}
}


?>