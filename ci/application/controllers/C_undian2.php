<?php
class C_undian2 extends CI_Controller {
	var $list=array();
	function index(){
		$this->load->helper("html");
		
		$this->load->model("m_undiancrud2");
		$data["nomor_undian"] = $this->m_undiancrud2->nomor_undian;
		$data["arr_nomor_undian"] = $this->m_undiancrud2->arr_nomor_undian;
		$data["old_nomor_undian"] = $this->m_undiancrud2->hasil_pencarian;
		echo "Nomor undian kamu adalah ".$data["nomor_undian"].$data["old_nomor_undian"];
		// echo br();
		// echo "cari ".$data["cari"] = array_search(69,$data['arr_nomor_undian']);
		// echo br();
		// print_r($data['arr_nomor_undian']);
		// // echo "Nomor undian di db adalah:  ". $data["list_nomor_undian"];
		
	
	}
}


?>