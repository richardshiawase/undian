<?php
class M_hello extends CI_Model {
	var $halo = "Hello World!";
	var $dump = 0;
	function katakata(){
		$kalimat=$this->halo." I'm from model!";
		return $kalimat;
	}
	function randomize(){
		$random = random_int(1,100);
		$tampung = array();
		$tampung = $random;
	

		return $tampung;
	}
}

?>