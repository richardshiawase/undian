<?php
class C_dbqcrud extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper(array("html","form","url","text"));
		$this->load->model("m_dbqcrud");
	}
	function tambahdata(){
		$adata = array (
						"noteman"=> 7
						,"namateman"=>"Sabiq"
						,"notelp"=>"08555555"
						,"email"=>"sabiq@gmail.com");
		$data["hslquery"]=$this->m_dbqcrud->tambah($adata);
		$data["judulapp"]="Tambah Data";
		$hsltambah=($data["hslquery"]) ? "Berhasil ditambahkan!" : "Gagal Ditambahkan!";
		echo $data["judulapp"];
		echo $hsltambah;
		echo anchor("c_dbmteman/baca","Tampilan seluruh data");
	}

	function formadd() {
		$data = $this->m_dbqcrud->defform();
		$data["judulapp"]="Tambah Data";
		$data["scriptaksi"]="c_dbqcrud/tambahdariform";
		$this->load->view("v_dbqcrud_form",$data);
	}

	function tambahdariform(){
		$adata = $this->m_dbqcrud->readinput();
		$data["adata"] = $adata;
		$data["hslquery"]=$this->m_dbqcrud->tambah($adata);
		$data["judulapp"]="Tambah Data";
		$data["message"] = ($data["hslquery"]) ? "Berhasil ditambahkan!" : "Gagal ditambahkan!";
		$this->load->view("v_cdbqcrud_message",$data);
	}
}


?>