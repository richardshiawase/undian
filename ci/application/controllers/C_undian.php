<?php
class C_undian extends CI_Controller {

	function index(){
		$this->load->helper("html");
		$this->load->model("m_undian");
		$this->load->model("m_undiancrud");
		$data=array();
		
		$data['ip'] = $this->m_undian->get_client_ip();
	
		$data['hasil_pencarian'] = $this->m_undiancrud->periksa($data['ip']);
		// echo $data['hasil_pencarian'];
		echo br();
		if(is_null($data['hasil_pencarian'])){
			$data['nomorUndian'] = $this->m_undian->undian();
			$data['result'] = $this->m_undiancrud->tambah($data['ip'],$data['nomorUndian']);
			// echo "ditambahkan";
			echo "Nomor Undian adalah: ".$data['nomorUndian'];
			echo br();

		} else {
			
			echo "Nomor Undian adalah: ".$data['hasil_pencarian'];
			
			// echo "You are recorded";
		}

		// echo $data['nomorUndian'];
		// echo br();
		// echo $data['ip'];
	}
}


?>