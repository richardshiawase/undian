<?php
class C_v_m_hellomethod extends CI_Controller {
	function index() {
		$this->load->model("m_hello");
		$data=array();
		$data["halo"]=$this->m_hello->randomize();
		$this->load->view("v_c_v_hellovar",$data);
	}
}



?>