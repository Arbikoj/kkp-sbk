<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Surat_model');
		$this->load->library('Pdf');
	}

	public function nominatif()
	{
		$result = $this->Surat_model->data_sbk();
		if ($result) {
			$data = array(
				"id_sbk" => $result['id_sbk'],
				"tgl_sbk" => $result['tgl_sbk'],
				"no_st" => $result['no_st'],
				"petugas" => $this->Surat_model->data_petugas()
			);

			// $this->pdf->setPaper('folio', 'landscape');
			// $this->pdf->filename = 'Dokumen Nominatif ' . $result->tgl_sbk . '.pdf';
			// $this->pdf->load_view('surat/sbk', $data);

			$this->load->view('surat/nominatif', $data);
		} else {
			return;
		}
	}

	public function sbk()
	{
		$result = $this->Surat_model->data_sbk();
		if ($result) {
			$data = array(
				"id_sbk" => $result['id_sbk'],
				"tgl_sbk" => $result['tgl_sbk'],
				"tgl" => $result['tgl'],
				// "no_st" => $result['no_st'],
				"t1_psw_d" => $result['t1_psw_d'],
				"t1_kru_psw_d" => $result['t1_kru_psw_d'],
				"t1_pnp_psw_d" => $result['t1_pnp_psw_d'],
				"t1_pnp_psw_d_suhu" => $result['t1_pnp_psw_d_suhu'],
				"t1_psw_b" => $result['t1_psw_b'],
				"t1_kru_psw_b" => $result['t1_kru_psw_b'],
				"t1_pnp_psw_b" => $result['t1_pnp_psw_b'],
				"t1_pmrksn_sts_vksnasi" => $result['t1_pmrksn_sts_vksnasi'],
				"t1_pmrksn_sts_vksnasi_ms" => $result['t1_pmrksn_sts_vksnasi_ms'],
				"t1_pmrksn_sts_vksnasi_tms" => $result['t1_pmrksn_sts_vksnasi_tms'],
				"t1_pmrksn_sts_vksnasi_tms_als" => $result['t1_pmrksn_sts_vksnasi_tms_als'],
				"t1_plyn_kshtn" => $result['t1_plyn_kshtn'],
				"t1_poli_tdk_mnlr" => $result['t1_poli_tdk_mnlr'],
				"t1_poli_mnlr" => $result['t1_poli_mnlr'],
				"t1_kgwtdrtn_mds" => $result['t1_kgwtdrtn_mds'],
				"t1_plyn_kshtn_rujukan" => $result['t1_plyn_kshtn_rujukan'],
				"t1_pmrksn_laik_trbng" => $result['t1_pmrksn_laik_trbng'],
				"t1_laik_trbng" => $result['t1_laik_trbng'],
				"t1_tdk_laik_trbng" => $result['t1_tdk_laik_trbng'],
				"t1_tdk_laik_trbng_dgnosa" => $result['t1_tdk_laik_trbng_dgnosa'],
				"t1_ijn_org_skt" => $result['t1_ijn_org_skt'],
				"t1_org_skt_d" => $result['t1_org_skt_d'],
				"t1_org_skt_b" => $result['t1_org_skt_b'],
				"t1_org_skt_tdk_mnlr" => $result['t1_org_skt_tdk_mnlr'],
				"t1_org_skt_mnlr" => $result['t1_org_skt_mnlr'],
				"t1_kmtn_jnzh" => $result['t1_kmtn_jnzh'],
				"t1_kmtn_jnzh_dgnosa" => $result['t1_kmtn_jnzh_dgnosa'],
				"t1_jnzh_tdk_mnlr" => $result['t1_jnzh_tdk_mnlr'],
				"t1_jnzh_mnlr" => $result['t1_jnzh_mnlr'],
				"t1_vksnasi_covid" => $result['t1_vksnasi_covid'],
				"t1_jml_dsnfksi" => $result['t1_jml_dsnfksi'],
				"t1_lks_dsnfksi" => $result['t1_lks_dsnfksi'],
				"t2_psw_d" => $result['t2_psw_d'],
				"t2_kru_psw_d" => $result['t2_kru_psw_d'],
				"t2_pnp_psw_d" => $result['t2_pnp_psw_d'],
				"t2_pnp_psw_d_suhu" => $result['t2_pnp_psw_d_suhu'],
				"t2_psw_b" => $result['t2_psw_b'],
				"t2_kru_psw_b" => $result['t2_kru_psw_b'],
				"t2_pnp_psw_b" => $result['t2_pnp_psw_b'],
				"t2_pmrksn_sts_vksnasi" => $result['t2_pmrksn_sts_vksnasi'],
				"t2_pmrksn_sts_vksnasi_ms" => $result['t2_pmrksn_sts_vksnasi_ms'],
				"t2_pmrksn_sts_vksnasi_tms" => $result['t2_pmrksn_sts_vksnasi_tms'],
				"t2_pmrksn_sts_vksnasi_tms_als" => $result['t2_pmrksn_sts_vksnasi_tms_als'],
				"t2_plyn_kshtn" => $result['t2_plyn_kshtn'],
				"t2_poli_tdk_mnlr" => $result['t2_poli_tdk_mnlr'],
				"t2_poli_mnlr" => $result['t2_poli_mnlr'],
				"t2_kgwtdrtn_mds" => $result['t2_kgwtdrtn_mds'],
				"t2_plyn_kshtn_rujukan" => $result['t2_plyn_kshtn_rujukan'],
				"t2_pmrksn_laik_trbng" => $result['t2_pmrksn_laik_trbng'],
				"t2_laik_trbng" => $result['t2_laik_trbng'],
				"t2_tdk_laik_trbng" => $result['t2_tdk_laik_trbng'],
				"t2_tdk_laik_trbng_dgnosa" => $result['t2_tdk_laik_trbng_dgnosa'],
				"t2_ijn_org_skt" => $result['t2_ijn_org_skt'],
				"t2_org_skt_d" => $result['t2_org_skt_d'],
				"t2_org_skt_b" => $result['t2_org_skt_b'],
				"t2_org_skt_tdk_mnlr" => $result['t2_org_skt_tdk_mnlr'],
				"t2_org_skt_mnlr" => $result['t2_org_skt_mnlr'],
				"t2_kmtn_jnzh" => $result['t2_kmtn_jnzh'],
				"t2_kmtn_jnzh_dgnosa" => $result['t2_kmtn_jnzh_dgnosa'],
				"t2_jnzh_tdk_mnlr" => $result['t2_jnzh_tdk_mnlr'],
				"t2_jnzh_mnlr" => $result['t2_jnzh_mnlr'],
				"t2_jml_dsnfksi" => $result['t2_jml_dsnfksi'],
				"t2_lks_dsnfksi" => $result['t2_lks_dsnfksi'],
				"t2_pmrksn_snts_psw" => $result['t2_pmrksn_snts_psw'],
				"t2_snts_psw_laik" => $result['t2_snts_psw_laik'],
				"t2_snts_psw_tdk_laik" => $result['t2_snts_psw_tdk_laik'],
				"t2_snts_psw_tdk_laik_tndkn" => $result['t2_snts_psw_tdk_laik_tndkn'],
				"crg_ijn_angkt_jnzh" => $result['crg_ijn_angkt_jnzh'],
				"crg_ijn_angkt_jnzh_d" => $result['crg_ijn_angkt_jnzh_d'],
				"crg_ijn_angkt_jnzh_b" => $result['crg_ijn_angkt_jnzh_b'],
				"crg_jnzh_tdk_mnlr" => $result['crg_jnzh_tdk_mnlr'],
				"crg_jnzh_mnlr" => $result['crg_jnzh_mnlr'],
				"crg_jnzh_luar_ngri" => $result['crg_jnzh_luar_ngri'],
				"crg_jnzh_dlm_ngri" => $result['crg_jnzh_dlm_ngri'],
				"crg_pmrksn_jnzh" => $result['crg_pmrksn_jnzh'],
				"crg_pmrksn_jnzh_d" => $result['crg_pmrksn_jnzh_d'],
				"crg_pmrksn_jnzh_b" => $result['crg_pmrksn_jnzh_b'],
				"crg_ijn_angkt_abu_jnzh" => $result['crg_ijn_angkt_abu_jnzh'],
				"crg_ijn_angkt_abu_jnzh_d" => $result['crg_ijn_angkt_abu_jnzh_d'],
				"crg_ijn_angkt_abu_jnzh_b" => $result['crg_ijn_angkt_abu_jnzh_b'],
				"perwira_jaga" => $result['perwira_jaga'],
				"nip_perwira_jaga" => $result['nip_perwira_jaga'],
				"jml_petugas" => $result['jml_petugas'],
				"masalah" => $this->Surat_model->data_poin_masalah(),
				"saran" => $this->Surat_model->data_poin_saran(),
				// "petugas" => $this->Surat_model->data_petugas(),
				"role_petugas" => $this->Surat_model->data_role_petugas()
			);

			$this->pdf->setPaper('folio', 'potrait');
			$this->pdf->set_option('isRemoteEnabled', true);
			$this->pdf->filename = 'Laporan SBK ' . $result->tgl_sbk . '.pdf';
			$this->pdf->load_view('surat/sbk', $data);

			// $this->load->view('surat/sbk', $data);
		} else {
			return;
		}
	}

	public function sbk_word()
	{
		$result = $this->Surat_model->data_sbk();
		if ($result) {
			$data = array(
				"id_sbk" => $result['id_sbk'],
				"tgl_sbk" => $result['tgl_sbk'],
				"no_st" => $result['no_st'],
				"t1_psw_d" => $result['t1_psw_d'],
				"t1_kru_psw_d" => $result['t1_kru_psw_d'],
				"t1_pnp_psw_d" => $result['t1_pnp_psw_d'],
				"t1_pnp_psw_d_suhu" => $result['t1_pnp_psw_d_suhu'],
				"t1_psw_b" => $result['t1_psw_b'],
				"t1_kru_psw_b" => $result['t1_kru_psw_b'],
				"t1_pnp_psw_b" => $result['t1_pnp_psw_b'],
				"t1_pmrksn_sts_vksnasi" => $result['t1_pmrksn_sts_vksnasi'],
				"t1_pmrksn_sts_vksnasi_ms" => $result['t1_pmrksn_sts_vksnasi_ms'],
				"t1_pmrksn_sts_vksnasi_tms" => $result['t1_pmrksn_sts_vksnasi_tms'],
				"t1_pmrksn_sts_vksnasi_tms_als" => $result['t1_pmrksn_sts_vksnasi_tms_als'],
				"t1_plyn_kshtn" => $result['t1_plyn_kshtn'],
				"t1_poli_tdk_mnlr" => $result['t1_poli_tdk_mnlr'],
				"t1_poli_mnlr" => $result['t1_poli_mnlr'],
				"t1_kgwtdrtn_mds" => $result['t1_kgwtdrtn_mds'],
				"t1_plyn_kshtn_rujukan" => $result['t1_plyn_kshtn_rujukan'],
				"t1_pmrksn_laik_trbng" => $result['t1_pmrksn_laik_trbng'],
				"t1_laik_trbng" => $result['t1_laik_trbng'],
				"t1_tdk_laik_trbng" => $result['t1_tdk_laik_trbng'],
				"t1_tdk_laik_trbng_dgnosa" => $result['t1_tdk_laik_trbng_dgnosa'],
				"t1_ijn_org_skt" => $result['t1_ijn_org_skt'],
				"t1_org_skt_d" => $result['t1_org_skt_d'],
				"t1_org_skt_b" => $result['t1_org_skt_b'],
				"t1_org_skt_tdk_mnlr" => $result['t1_org_skt_tdk_mnlr'],
				"t1_org_skt_mnlr" => $result['t1_org_skt_mnlr'],
				"t1_kmtn_jnzh" => $result['t1_kmtn_jnzh'],
				"t1_kmtn_jnzh_dgnosa" => $result['t1_kmtn_jnzh_dgnosa'],
				"t1_jnzh_tdk_mnlr" => $result['t1_jnzh_tdk_mnlr'],
				"t1_jnzh_mnlr" => $result['t1_jnzh_mnlr'],
				"t1_vksnasi_covid" => $result['t1_vksnasi_covid'],
				"t1_jml_dsnfksi" => $result['t1_jml_dsnfksi'],
				"t1_lks_dsnfksi" => $result['t1_lks_dsnfksi'],
				"t2_psw_d" => $result['t2_psw_d'],
				"t2_kru_psw_d" => $result['t2_kru_psw_d'],
				"t2_pnp_psw_d" => $result['t2_pnp_psw_d'],
				"t2_pnp_psw_d_suhu" => $result['t2_pnp_psw_d_suhu'],
				"t2_psw_b" => $result['t2_psw_b'],
				"t2_kru_psw_b" => $result['t2_kru_psw_b'],
				"t2_pnp_psw_b" => $result['t2_pnp_psw_b'],
				"t2_pmrksn_sts_vksnasi" => $result['t2_pmrksn_sts_vksnasi'],
				"t2_pmrksn_sts_vksnasi_ms" => $result['t2_pmrksn_sts_vksnasi_ms'],
				"t2_pmrksn_sts_vksnasi_tms" => $result['t2_pmrksn_sts_vksnasi_tms'],
				"t2_pmrksn_sts_vksnasi_tms_als" => $result['t2_pmrksn_sts_vksnasi_tms_als'],
				"t2_plyn_kshtn" => $result['t2_plyn_kshtn'],
				"t2_poli_tdk_mnlr" => $result['t2_poli_tdk_mnlr'],
				"t2_poli_mnlr" => $result['t2_poli_mnlr'],
				"t2_kgwtdrtn_mds" => $result['t2_kgwtdrtn_mds'],
				"t2_plyn_kshtn_rujukan" => $result['t2_plyn_kshtn_rujukan'],
				"t2_pmrksn_laik_trbng" => $result['t2_pmrksn_laik_trbng'],
				"t2_laik_trbng" => $result['t2_laik_trbng'],
				"t2_tdk_laik_trbng" => $result['t2_tdk_laik_trbng'],
				"t2_tdk_laik_trbng_dgnosa" => $result['t2_tdk_laik_trbng_dgnosa'],
				"t2_ijn_org_skt" => $result['t2_ijn_org_skt'],
				"t2_org_skt_d" => $result['t2_org_skt_d'],
				"t2_org_skt_b" => $result['t2_org_skt_b'],
				"t2_org_skt_tdk_mnlr" => $result['t2_org_skt_tdk_mnlr'],
				"t2_org_skt_mnlr" => $result['t2_org_skt_mnlr'],
				"t2_kmtn_jnzh" => $result['t2_kmtn_jnzh'],
				"t2_kmtn_jnzh_dgnosa" => $result['t2_kmtn_jnzh_dgnosa'],
				"t2_jnzh_tdk_mnlr" => $result['t2_jnzh_tdk_mnlr'],
				"t2_jnzh_mnlr" => $result['t2_jnzh_mnlr'],
				"t2_jml_dsnfksi" => $result['t2_jml_dsnfksi'],
				"t2_lks_dsnfksi" => $result['t2_lks_dsnfksi'],
				"t2_pmrksn_snts_psw" => $result['t2_pmrksn_snts_psw'],
				"t2_snts_psw_laik" => $result['t2_snts_psw_laik'],
				"t2_snts_psw_tdk_laik" => $result['t2_snts_psw_tdk_laik'],
				"t2_snts_psw_tdk_laik_tndkn" => $result['t2_snts_psw_tdk_laik_tndkn'],
				"crg_ijn_angkt_jnzh" => $result['crg_ijn_angkt_jnzh'],
				"crg_ijn_angkt_jnzh_d" => $result['crg_ijn_angkt_jnzh_d'],
				"crg_ijn_angkt_jnzh_b" => $result['crg_ijn_angkt_jnzh_b'],
				"crg_jnzh_tdk_mnlr" => $result['crg_jnzh_tdk_mnlr'],
				"crg_jnzh_mnlr" => $result['crg_jnzh_mnlr'],
				"crg_jnzh_luar_ngri" => $result['crg_jnzh_luar_ngri'],
				"crg_jnzh_dlm_ngri" => $result['crg_jnzh_dlm_ngri'],
				"crg_pmrksn_jnzh" => $result['crg_pmrksn_jnzh'],
				"crg_pmrksn_jnzh_d" => $result['crg_pmrksn_jnzh_d'],
				"crg_pmrksn_jnzh_b" => $result['crg_pmrksn_jnzh_b'],
				"crg_ijn_angkt_abu_jnzh" => $result['crg_ijn_angkt_abu_jnzh'],
				"crg_ijn_angkt_abu_jnzh_d" => $result['crg_ijn_angkt_abu_jnzh_d'],
				"crg_ijn_angkt_abu_jnzh_b" => $result['crg_ijn_angkt_abu_jnzh_b'],
				"perwira_jaga" => $result['perwira_jaga'],
				"nip_perwira_jaga" => $result['nip_perwira_jaga'],
				"jml_petugas" => $result['jml_petugas'],
				"masalah" => $this->Surat_model->data_poin_masalah(),
				"saran" => $this->Surat_model->data_poin_saran(),
				"petugas" => $this->Surat_model->data_petugas(),
				"role_petugas" => $this->Surat_model->data_role_petugas()
			);

			$this->load->view('surat/sbk_word', $data);
		} else {
			return;
		}
	}

	public function st()
	{
		$result = $this->Surat_model->data_st();
		if ($result) {
			$data = array(
				"id_sbk" => $result['id_sbk'],
				"tgl_sbk" => $result['tgl_sbk'],
				"no_st" => $result['no_st'],
				"petugas" => $this->Surat_model->data_petugas(),
				"tgl" => $result['tgl']
			);

			$this->pdf->setPaper('folio', 'potrait');
			$this->pdf->set_option('isRemoteEnabled', true);
			$this->pdf->filename = 'Dokumen SBK ' . $result->tgl_sbk . '.pdf';
			$this->pdf->load_view('surat/st', $data);

			// $this->load->view('surat/sbk', $data);
		} else {
			return;
		}
	}
}
