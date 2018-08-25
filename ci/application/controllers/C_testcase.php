<?php
class C_testcase extends CI_Controller {
	var $arr;
	function index(){
		$this->load->helper("html");
		
		echo "hello world";
		$this->arr = $this->periksaNomorUndian(7);
		var_dump($this->arr);
	}
	function __construct() 
	{
		parent::__construct();
		$config['hostname'] = "localhost";
		$config['dbdriver'] = "mysqli";
		$config['database'] = "db_undian";
		$config['username'] = "root";
		$config['password'] = "";
		$this->load->database($config);
	}

	function periksaNomorUndian($data) //works.
	{
	$sqlstr="SELECT nomor_undian FROM ip where nomor_undian=$data";
	$result = $this->db->query($sqlstr);
	$row = $result->row();
	if(isset($row)){
		return $row->nomor_undian;
	} else return false;

	}

	function countNomorUndian(){ //works
		$sqlstr="SELECT * FROM ip";
		$result = $this->db->query($sqlstr);
		$nm =  $result->num_rows();
		echo $nm;
		
	}
}


?>