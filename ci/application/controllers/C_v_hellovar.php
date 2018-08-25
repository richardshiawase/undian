<?php
class C_v_hellovar extends CI_Controller {
	function index() {
		$data=array();
		$this->load->helper('html');
		$this->load->helper('url');
		
		
		
		$this->load->view("v_c_undian5",$data);
	}
}


?>