<?php
class M_undiancrud2 extends CI_Model {
////////////////////////////////////////
	var $ipaddress;
	var $nomor_undian ; 
	var $hasil_pencarian ; 
	var $result;
	var $list_nomor_undian;
	var $arr_nomor_undian = array();
	var $arr2;
	var $i;
	/**************************************************************************************************/
	function __construct() 
	{
		parent::__construct();
		$config['hostname'] = "localhost";
		$config['dbdriver'] = "mysqli";
		$config['database'] = "db_undian";
		$config['username'] = "root";
		$config['password'] = "";
		$this->load->database($config);



		$this->ipaddress = $this->get_client_ip(); /*get client's ip first*/
		$this->hasil_pencarian = $this->periksaIpAddress($this->ipaddress); /*cek if ip address is exist in db*/
		if(is_null($this->hasil_pencarian)) /*if ip not in db then insert everything */
		{
			$this->list_nomor_undian = $this->periksaNomorUndian(); /*check if nomor_undian existed in db or not*/

			$this->nomor_undian = $this->undian();
			$this->result = $this->tambah($this->ipaddress,$this->nomor_undian);
		}
		else 
		{
			
			$this->list_nomor_undian = $this->periksaNomorUndian(); /*check if nomor_undian existed in db or not */

			foreach($this->list_nomor_undian->result_array() as $row){
				array_push($this->arr_nomor_undian,$row);
				
				// $this->arr2 = $row;

			}
			// print_r($this->arr2);
			echo "array = ".array_search(53,$this->arr_nomor_undian[0]);
			echo br();
			print_r($this->arr_nomor_undian);echo br();
			var_dump($this->arr_nomor_undian);
		}
	
	}

	/*************************************************************************************************/


	function tambah($data1,$data2) {
		
		$sqlstr="insert into ip (id,ipaddress,nomor_undian) values (0,'$data1','$data2')";
		$this->db->query($sqlstr);
		return (($this->db->affected_rows()>0) ? TRUE: FALSE);
	}


	/************************************************************************************************/

	function periksaIpAddress($data){ /*This method to find if IP if existed in db , if exist it return object result, if not return null */
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

	/*************************************************************************************************/

	function undian(){
		$random = random_int(1, 100);
		return $random;
	}

	/************************************************************************************************/

	function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
	}

	/********************************************************************************************************/

	function periksaNomorUndian(){

		$sqlstr="SELECT nomor_undian FROM ip";
		$result = $this->db->query($sqlstr);
		
		return $result;
		// echo $result->num_rows();

		// if(!$result->num_rows()){
		// 	return NULL;
		// } else {
		// 	return $result;
		// }
		
	
	}

}

?>