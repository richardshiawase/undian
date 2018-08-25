<?php
class M_undiancrud extends CI_Model {

	function __construct() {
		parent::__construct();
		$config['hostname'] = "localhost";
		$config['dbdriver'] = "mysqli";
		$config['database'] = "db_undian";
		$config['username'] = "root";
		$config['password'] = "";
		$this->load->database($config);
	}
	function tambah($data1,$data2) {
		
		$sqlstr="insert into ip (id,ipaddress,nomor_undian) values (0,'$data1','$data2')";
		$this->db->query($sqlstr);
		return (($this->db->affected_rows()>0) ? TRUE: FALSE);
	}
	function periksa($data){
		$sqlstr="SELECT * FROM ip where ipaddress = '$data'";
		$result = $this->db->query($sqlstr);
		$row = $result->row();
		if(isset($row)){
			return $row->nomor_undian;
		}
		else {
			return null;
		}
		// echo $result->num_rows();

		// if(!$result->num_rows()){
		// 	return NULL;
		// } else {
		// 	return $result;
		// }
		
	}


}
?>