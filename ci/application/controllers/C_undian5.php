<?php
class C_undian5 extends CI_Controller {
	var $list=array();
	function index(){
		$this->load->helper("html");
		$this->load->helper("url");
		$this->load->model("m_undiancrud5");
		$data["old_nomor_undian"] = $this->m_undiancrud5->hasil_pencarian;
		$data["messageQuotaHabis"] = $this->m_undiancrud5->messageQuotaHabis;
		$data["messageRecorded"] = $this->m_undiancrud5->messageRecorded;
		$this->load->view("v_c_undian5",$data);
		// echo $data["messageQuotaHabis"];
		// echo $data['messageRecorded'];
	}
}


?>