<?php
class M_undiancrud4 extends CI_Model {
////////////////////////////////////////
	var $ipaddress;
	var $nomor_undian; 
	var $hasil_pencarian ; 
	var $result;
	var $ctr;
	var $maxUndian;
	var $availableQuota;
	var $jumlahRecord;
	var $messageQuotaHabis;
	var $messageRecorded;
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
		$this->maxUndian=5; 

		$this->ipaddress = $this->get_client_ip(); /*get client's ip first*/
		$this->hasil_pencarian = $this->periksaIpAddress($this->ipaddress); /*cek if ip address is exist in db*/
		$this->jumlahRecord =  $this->countNomorUndian(); /*menghitung jumlah nomor undian yang sudah ada*/
		$this->availableQuota = $this->statusUndian($this->jumlahRecord); /*mendapatkan status quota undian*/

		if(is_null($this->hasil_pencarian) && $this->availableQuota>0){ 
			/*if ip  not in db and quota still available then insert everything */
		
			do{
			$this->nomor_undian = $this->undian();
			$res = $this->periksaNomorUndian($this->nomor_undian);
			/*cek nomor undian yang ada di db, kalo return true maka loop diulang, rand diulang*/
			}while($res);
			$this->result = $this->tambah($this->ipaddress,$this->nomor_undian); 
			echo "record added with nomor undian ".$this->nomor_undian;
		}
		else 
		{
			// $this->list_nomor_undian = $this->periksaNomorUndian($this->nomor_undian); /*check if nomor_undian existed in db or not ,returns object*/
			if($this->availableQuota==0) {
				$this->messageQuotaHabis = "Quota habis";
			}else {
				$this->messageQuotaHabis = "";
			}

			echo $this->messageRecorded = "Kamu sudah terdaftar, nomor undian kamu adalah : ".$this->hasil_pencarian;
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
		$random = random_int(1, 5);
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

	function periksaNomorUndian($data){

		$sqlstr="SELECT nomor_undian FROM ip where nomor_undian=$data";
		$result = $this->db->query($sqlstr);
		$row = $result->row();
		if(isset($row)){
			// return $row->nomor_undian;
			return true;
		} else {
			return false;
		}
	}
	/*****************************************************************************************************/
	function countNomorUndian(){ //works
		$sqlstr="SELECT * FROM ip";
		$result = $this->db->query($sqlstr);
		return $result->num_rows();
	}
	/*****************************************************************************************************/
	function statusUndian($data){
		
		$selisih = $this->maxUndian-$this->jumlahRecord;
		return  $selisih;
	}

}

?>