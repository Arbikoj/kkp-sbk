<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model');
		$this->load->model('Surat_model');
	}

	public function index()
	{
		$this->load->view('main_view');
	}

	public function ambil_data_sbk()
	{
		$data = $this->Main_model->ambil_data_sbk();
		echo json_encode($data);
	}

	public function ambil_data_pegawai()
	{
		$data = $this->Main_model->ambil_data_pegawai();
		echo json_encode($data);
	}

	public function ambil_data_role()
	{
		$data = $this->Main_model->ambil_data_role();
		echo json_encode($data);
	}

	public function ambil_data_petugas()
	{
		$data = $this->Main_model->ambil_data_petugas();
		echo json_encode($data);
	}

	public function simpan_data()
	{
		$cek = $this->Main_model->cek_data();
		if ($cek > 0) {
			$data = false;
		} else {
			$data = $this->Main_model->simpan_data();
		}
		echo json_encode($data);
	}

	public function hapus_petugas()
	{
		$data = $this->Main_model->hapus_petugas();
		echo json_encode($data);
	}

	public function ambil_data_laporan()
	{
		$data = $this->Main_model->ambil_data_laporan();
		echo json_encode($data);
	}

	public function ambil_data_permasalahan()
	{
		$data = $this->Main_model->ambil_data_permasalahan();
		echo json_encode($data);
	}

	public function ambil_data_saran()
	{
		$data = $this->Main_model->ambil_data_saran();
		echo json_encode($data);
	}

	public function simpan_laporan()
	{
		$cekst = $this->Main_model->cek_st();
		if ($cekst == 0) {
			$datast = $this->Main_model->simpan_st();
		}

		$cek = $this->Main_model->cek_laporan();
		if ($cek > 0) {
			$data = $this->Main_model->edit_laporan();
		} else {
			$data = $this->Main_model->simpan_laporan();
		}
		echo json_encode($data);
	}

	public function ambil_data_st()
	{
		$data = $this->Main_model->ambil_data_st();
		echo json_encode($data);
	}

	public function simpan_st()
	{
		$cek = $this->Main_model->cek_st();
		if ($cek > 0) {
			$data = $this->Main_model->edit_st();
		} else {
			$data = $this->Main_model->simpan_st();
		}
		echo json_encode($data);
	}

}
