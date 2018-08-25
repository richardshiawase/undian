<?php
class C_undian4 extends CI_Controller {
	var $list=array();
	function index(){
		$this->load->helper("html");
		$this->load->model("m_undiancrud4");
		$data["old_nomor_undian"] = $this->m_undiancrud4->hasil_pencarian;
		$data["messageQuotaHabis"] = $this->m_undiancrud4->messageQuotaHabis;
		$data["messageRecorded"] = $this->m_undiancrud4->messageRecorded;
		// echo $data['messageQuotaHabis']." "."nomor undian kamu adalah: ".$data["old_nomor_undian"];
		// echo br();
		// echo $data['messageRecorded'];
		
	}
}


?>