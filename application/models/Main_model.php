<?php

class Main_model extends CI_Model
{
  function __construct()
  {
    parent::__construct();
    $this->db2 = $this->load->database('kepegawaian', TRUE);
  }

  function ambil_data_sbk()
  {
    $tgl = $this->input->post('tgl');

    $sql = "
      SELECT id_sbk, no_st
      FROM sbk
      WHERE tgl_sbk = STR_TO_DATE('$tgl', '%d/%m/%Y')
    ";
    $exe = $this->db->query($sql);
    $num = $exe->num_rows();

    if ($num == 0) {
      $sql2 = "
        SELECT CONCAT
        ( 'SBK',
          DATE_FORMAT(STR_TO_DATE('$tgl', '%d/%m/%Y'),'%y'),
          DATE_FORMAT(STR_TO_DATE('$tgl', '%d/%m/%Y'),'%m'),
          DATE_FORMAT(STR_TO_DATE('$tgl', '%d/%m/%Y'),'%d')
        ) AS id_sbk,
        '' AS no_st
        FROM DUAL
      ";
      $exe2 = $this->db->query($sql2);
      $data = $exe2->row_array();
    } else {
      $data = $exe->row_array();
    }

    return $data;
  }

  function ambil_data_pegawai()
  {
    $sql = "
      SELECT a.nip, a.nama, a.gol, a.status, b.pangkat, a.jabatan
      FROM pegawai a
      LEFT JOIN pangkat b ON b.gol = a.gol
      WHERE a.id_wilker = 'JNDA'
    ";
    $data = $this->db2->query($sql)->result();
    return $data;
  }

  function ambil_data_role()
  {
    $sql = "
      SELECT id_role, role
      FROM role
    ";
    $data = $this->db->query($sql)->result();
    return $data;
  }

  function ambil_data_petugas()
  {
    $tgl = $this->input->post('tgl');

    $sql = "
      SELECT a.nip, a.nama, b.role
      FROM petugas a
      LEFT JOIN role b ON b.id_role = a.role
      WHERE tgl = STR_TO_DATE('$tgl', '%d/%m/%Y')
      ORDER BY a.role, a.nama
    ";
    $data = $this->db->query($sql)->result();
    return $data;
  }

  function cek_data()
  {
    $tgl = $this->input->post('tgl');
    $nip = $this->input->post('nip');

    $sql = "
      SELECT nip
      FROM petugas
      WHERE tgl = STR_TO_DATE('$tgl', '%d/%m/%Y')
      AND nip = '$nip'
    ";
    $data = $this->db->query($sql)->num_rows();
    return $data;
  }

  function simpan_data()
  {
    $tgl = $this->input->post('tgl');
    $nip = $this->input->post('nip');
    $nama = $this->input->post('nama');
    $gol = $this->input->post('gol');
    $status = $this->input->post('status');
    $pangkat = $this->input->post('pangkat');
    $jabatan = $this->input->post('jabatan');
    $role = $this->input->post('role');
    // $sign = $this->input->post('sign');

    $this->db->trans_start();

    $this->db->query("
      INSERT INTO petugas (tgl, nip, nama, gol, status, pangkat, jabatan, role)
      VALUES (STR_TO_DATE('$tgl', '%d/%m/%Y'), '$nip', '$nama', '$gol', '$status', '$pangkat', '$jabatan', '$role')
    ");

    $exe = $this->db->trans_complete();
    // if ($exe) {
    //   $path = FCPATH . 'files/ttd/' . $nip . '.png';
    //   $img_parts = explode(";base64,", $sign);
    //   $img_base64 = base64_decode($img_parts[1]);
    //   file_put_contents($path, $img_base64);
    //   if (file_exists($path)) chmod($path, 0777);
    // }
    return $exe;
  }

  function hapus_petugas()
  {
    $tgl = $this->input->post('tgl');
    $nip = $this->input->post('nip');

    $this->db->trans_start();

    $this->db->query("
      DELETE FROM petugas
      WHERE tgl = STR_TO_DATE('$tgl', '%d/%m/%Y')
      AND nip = '$nip'
    ");

    $exe = $this->db->trans_complete();
    return $exe;
  }

  function ambil_data_laporan()
  {
    $id = $this->input->post('id');

    $sql = "
      SELECT
        t1_psw_d, 
        t1_kru_psw_d, 
        t1_pnp_psw_d, 
        t1_pnp_psw_d_suhu,
        t1_psw_b, 
        t1_kru_psw_b, 
        t1_pnp_psw_b, 
        t1_pmrksn_sts_vksnasi, 
        t1_pmrksn_sts_vksnasi_ms,
        t1_pmrksn_sts_vksnasi_tms,
        t1_pmrksn_sts_vksnasi_tms_als,
        t1_plyn_kshtn, 
        t1_poli_tdk_mnlr, 
        t1_poli_mnlr, 
        t1_kgwtdrtn_mds, 
        t1_plyn_kshtn_rujukan, 
        t1_pmrksn_laik_trbng, 
        t1_laik_trbng, 
        t1_tdk_laik_trbng, 
        t1_tdk_laik_trbng_dgnosa,
        t1_ijn_org_skt, 
        t1_org_skt_d,
        t1_org_skt_b,
        t1_org_skt_tdk_mnlr, 
        t1_org_skt_mnlr, 
        t1_kmtn_jnzh,
        t1_kmtn_jnzh_dgnosa, 
        t1_jnzh_tdk_mnlr, 
        t1_jnzh_mnlr, 
        t1_vksnasi_covid, 
        t1_jml_dsnfksi,
        t1_lks_dsnfksi,
        t2_psw_d, 
        t2_kru_psw_d, 
        t2_pnp_psw_d, 
        t2_pnp_psw_d_suhu,
        t2_psw_b, 
        t2_kru_psw_b, 
        t2_pnp_psw_b, 
        t2_pmrksn_sts_vksnasi, 
        t2_pmrksn_sts_vksnasi_ms,
        t2_pmrksn_sts_vksnasi_tms,
        t2_pmrksn_sts_vksnasi_tms_als,
        t2_plyn_kshtn, 
        t2_poli_tdk_mnlr, 
        t2_poli_mnlr, 
        t2_kgwtdrtn_mds, 
        t2_plyn_kshtn_rujukan, 
        t2_pmrksn_laik_trbng, 
        t2_laik_trbng, 
        t2_tdk_laik_trbng, 
        t2_tdk_laik_trbng_dgnosa,
        t2_ijn_org_skt, 
        t2_org_skt_d,
        t2_org_skt_b,
        t2_org_skt_tdk_mnlr, 
        t2_org_skt_mnlr, 
        t2_kmtn_jnzh,
        t2_kmtn_jnzh_dgnosa, 
        t2_jnzh_tdk_mnlr, 
        t2_jnzh_mnlr, 
        t2_jml_dsnfksi,
        t2_lks_dsnfksi,
        t2_pmrksn_snts_psw, 
        t2_snts_psw_laik,
        t2_snts_psw_tdk_laik,
        t2_snts_psw_tdk_laik_tndkn,
        crg_ijn_angkt_jnzh, 
        crg_ijn_angkt_jnzh_d,
        crg_ijn_angkt_jnzh_b,
        crg_jnzh_tdk_mnlr, 
        crg_jnzh_mnlr, 
        crg_jnzh_luar_ngri, 
        crg_jnzh_dlm_ngri,
        crg_pmrksn_jnzh,
        crg_pmrksn_jnzh_d,
        crg_pmrksn_jnzh_b,
        crg_ijn_angkt_abu_jnzh,
        crg_ijn_angkt_abu_jnzh_d,
        crg_ijn_angkt_abu_jnzh_b
      FROM laporan
      WHERE id_sbk = '$id'
    ";
    $data = $this->db->query($sql)->row_array();
    return $data;
  }

  function ambil_data_permasalahan()
  {
    $id = $this->input->post('id');

    $sql = "
      SELECT poin
      FROM laporan_masalah
      WHERE id_sbk = '$id'
      ORDER BY sub
    ";
    $data = $this->db->query($sql)->result();
    return $data;
  }

  function ambil_data_saran()
  {
    $id = $this->input->post('id');

    $sql = "
      SELECT poin
      FROM laporan_saran
      WHERE id_sbk = '$id'
      ORDER BY sub
    ";
    $data = $this->db->query($sql)->result();
    return $data;
  }

  function cek_laporan()
  {
    $id = $this->input->post('id');

    $sql = "
      SELECT id_sbk
      FROM laporan
      WHERE id_sbk = '$id'
    ";
    $data = $this->db->query($sql)->num_rows();
    return $data;
  }

  function simpan_laporan()
  {
    $id = $this->input->post('id');
    $tgl = $this->input->post('tgl');
    // $no_st = $this->input->post('no_st');
    $t1_psw_d = $this->input->post('t1_psw_d');
    $t1_kru_psw_d = $this->input->post('t1_kru_psw_d');
    $t1_pnp_psw_d = $this->input->post('t1_pnp_psw_d');
    $t1_pnp_psw_d_suhu = $this->input->post('t1_pnp_psw_d_suhu');
    $t1_psw_b = $this->input->post('t1_psw_b');
    $t1_kru_psw_b = $this->input->post('t1_kru_psw_b');
    $t1_pnp_psw_b = $this->input->post('t1_pnp_psw_b');
    $t1_pmrksn_sts_vksnasi = $this->input->post('t1_pmrksn_sts_vksnasi');
    $t1_pmrksn_sts_vksnasi_ms = $this->input->post('t1_pmrksn_sts_vksnasi_ms');
    $t1_pmrksn_sts_vksnasi_tms = $this->input->post('t1_pmrksn_sts_vksnasi_tms');
    $t1_pmrksn_sts_vksnasi_tms_als = $this->input->post('t1_pmrksn_sts_vksnasi_tms_als');
    $t1_plyn_kshtn = $this->input->post('t1_plyn_kshtn');
    $t1_poli_tdk_mnlr = $this->input->post('t1_poli_tdk_mnlr');
    $t1_poli_mnlr = $this->input->post('t1_poli_mnlr');
    $t1_kgwtdrtn_mds = $this->input->post('t1_kgwtdrtn_mds');
    $t1_plyn_kshtn_rujukan = $this->input->post('t1_plyn_kshtn_rujukan');
    $t1_pmrksn_laik_trbng = $this->input->post('t1_pmrksn_laik_trbng');
    $t1_laik_trbng = $this->input->post('t1_laik_trbng');
    $t1_tdk_laik_trbng = $this->input->post('t1_tdk_laik_trbng');
    $t1_tdk_laik_trbng_dgnosa = $this->input->post('t1_tdk_laik_trbng_dgnosa');
    $t1_ijn_org_skt = $this->input->post('t1_ijn_org_skt');
    $t1_org_skt_d = $this->input->post('t1_org_skt_d');
    $t1_org_skt_b = $this->input->post('t1_org_skt_b');
    $t1_org_skt_tdk_mnlr = $this->input->post('t1_org_skt_tdk_mnlr');
    $t1_org_skt_mnlr = $this->input->post('t1_org_skt_mnlr');
    $t1_kmtn_jnzh = $this->input->post('t1_kmtn_jnzh');
    $t1_kmtn_jnzh_dgnosa = $this->input->post('t1_kmtn_jnzh_dgnosa');
    $t1_jnzh_tdk_mnlr = $this->input->post('t1_jnzh_tdk_mnlr');
    $t1_jnzh_mnlr = $this->input->post('t1_jnzh_mnlr');
    $t1_vksnasi_covid = $this->input->post('t1_vksnasi_covid');
    $t1_jml_dsnfksi = $this->input->post('t1_jml_dsnfksi');
    $t1_lks_dsnfksi = $this->input->post('t1_lks_dsnfksi');
    $t2_psw_d = $this->input->post('t2_psw_d');
    $t2_kru_psw_d = $this->input->post('t2_kru_psw_d');
    $t2_pnp_psw_d = $this->input->post('t2_pnp_psw_d');
    $t2_pnp_psw_d_suhu = $this->input->post('t2_pnp_psw_d_suhu');
    $t2_psw_b = $this->input->post('t2_psw_b');
    $t2_kru_psw_b = $this->input->post('t2_kru_psw_b');
    $t2_pnp_psw_b = $this->input->post('t2_pnp_psw_b');
    $t2_pmrksn_sts_vksnasi = $this->input->post('t2_pmrksn_sts_vksnasi');
    $t2_pmrksn_sts_vksnasi_ms = $this->input->post('t2_pmrksn_sts_vksnasi_ms');
    $t2_pmrksn_sts_vksnasi_tms = $this->input->post('t2_pmrksn_sts_vksnasi_tms');
    $t2_pmrksn_sts_vksnasi_tms_als = $this->input->post('t2_pmrksn_sts_vksnasi_tms_als');
    $t2_plyn_kshtn = $this->input->post('t2_plyn_kshtn');
    $t2_poli_tdk_mnlr = $this->input->post('t2_poli_tdk_mnlr');
    $t2_poli_mnlr = $this->input->post('t2_poli_mnlr');
    $t2_kgwtdrtn_mds = $this->input->post('t2_kgwtdrtn_mds');
    $t2_plyn_kshtn_rujukan = $this->input->post('t2_plyn_kshtn_rujukan');
    $t2_pmrksn_laik_trbng = $this->input->post('t2_pmrksn_laik_trbng');
    $t2_laik_trbng = $this->input->post('t2_laik_trbng');
    $t2_tdk_laik_trbng = $this->input->post('t2_tdk_laik_trbng');
    $t2_tdk_laik_trbng_dgnosa = $this->input->post('t2_tdk_laik_trbng_dgnosa');
    $t2_ijn_org_skt = $this->input->post('t2_ijn_org_skt');
    $t2_org_skt_d = $this->input->post('t2_org_skt_d');
    $t2_org_skt_b = $this->input->post('t2_org_skt_b');
    $t2_org_skt_tdk_mnlr = $this->input->post('t2_org_skt_tdk_mnlr');
    $t2_org_skt_mnlr = $this->input->post('t2_org_skt_mnlr');
    $t2_kmtn_jnzh = $this->input->post('t2_kmtn_jnzh');
    $t2_kmtn_jnzh_dgnosa = $this->input->post('t2_kmtn_jnzh_dgnosa');
    $t2_jnzh_tdk_mnlr = $this->input->post('t2_jnzh_tdk_mnlr');
    $t2_jnzh_mnlr = $this->input->post('t2_jnzh_mnlr');
    $t2_jml_dsnfksi = $this->input->post('t2_jml_dsnfksi');
    $t2_lks_dsnfksi = $this->input->post('t2_lks_dsnfksi');
    $t2_pmrksn_snts_psw = $this->input->post('t2_pmrksn_snts_psw');
    $t2_snts_psw_laik = $this->input->post('t2_snts_psw_laik');
    $t2_snts_psw_tdk_laik = $this->input->post('t2_snts_psw_tdk_laik');
    $t2_snts_psw_tdk_laik_tndkn = $this->input->post('t2_snts_psw_tdk_laik_tndkn');
    $crg_ijn_angkt_jnzh = $this->input->post('crg_ijn_angkt_jnzh');
    $crg_ijn_angkt_jnzh_d = $this->input->post('crg_ijn_angkt_jnzh_d');
    $crg_ijn_angkt_jnzh_b = $this->input->post('crg_ijn_angkt_jnzh_b');
    $crg_jnzh_tdk_mnlr = $this->input->post('crg_jnzh_tdk_mnlr');
    $crg_jnzh_mnlr = $this->input->post('crg_jnzh_mnlr');
    $crg_jnzh_luar_ngri = $this->input->post('crg_jnzh_luar_ngri');
    $crg_jnzh_dlm_ngri = $this->input->post('crg_jnzh_dlm_ngri');
    $crg_pmrksn_jnzh = $this->input->post('crg_pmrksn_jnzh');
    $crg_pmrksn_jnzh_d = $this->input->post('crg_pmrksn_jnzh_d');
    $crg_pmrksn_jnzh_b = $this->input->post('crg_pmrksn_jnzh_b');
    $crg_ijn_angkt_abu_jnzh = $this->input->post('crg_ijn_angkt_abu_jnzh');
    $crg_ijn_angkt_abu_jnzh_d = $this->input->post('crg_ijn_angkt_abu_jnzh_d');
    $crg_ijn_angkt_abu_jnzh_b = $this->input->post('crg_ijn_angkt_abu_jnzh_b');
    $permasalahan = $this->input->post('permasalahan');
    $saran = $this->input->post('saran');

    $this->db->trans_start();

    // $this->db->query("
    //   INSERT INTO sbk (
    //     id_sbk,
    //     tgl_sbk,
    //     no_st
    //   )
    //   VALUES (
    //     '$id',
    //     STR_TO_DATE('$tgl', '%d/%m/%Y'),
    //     '$no_st'
    //   )
    // ");

    $this->db->query("
      INSERT INTO laporan (
        id_sbk,
        t1_psw_d,
        t1_kru_psw_d,
        t1_pnp_psw_d,
        t1_pnp_psw_d_suhu,
        t1_psw_b,
        t1_kru_psw_b,
        t1_pnp_psw_b,
        t1_pmrksn_sts_vksnasi,
        t1_pmrksn_sts_vksnasi_ms,
        t1_pmrksn_sts_vksnasi_tms,
        t1_pmrksn_sts_vksnasi_tms_als,
        t1_plyn_kshtn,
        t1_poli_tdk_mnlr,
        t1_poli_mnlr,
        t1_kgwtdrtn_mds,
        t1_plyn_kshtn_rujukan,
        t1_pmrksn_laik_trbng,
        t1_laik_trbng,
        t1_tdk_laik_trbng,
        t1_tdk_laik_trbng_dgnosa,
        t1_ijn_org_skt,
        t1_org_skt_d,
        t1_org_skt_b,
        t1_org_skt_tdk_mnlr,
        t1_org_skt_mnlr,
        t1_kmtn_jnzh,
        t1_kmtn_jnzh_dgnosa,
        t1_jnzh_tdk_mnlr,
        t1_jnzh_mnlr,
        t1_vksnasi_covid,
        t1_jml_dsnfksi,
        t1_lks_dsnfksi,
        t2_psw_d,
        t2_kru_psw_d,
        t2_pnp_psw_d,
        t2_pnp_psw_d_suhu,
        t2_psw_b,
        t2_kru_psw_b,
        t2_pnp_psw_b,
        t2_pmrksn_sts_vksnasi,
        t2_pmrksn_sts_vksnasi_ms,
        t2_pmrksn_sts_vksnasi_tms,
        t2_pmrksn_sts_vksnasi_tms_als,
        t2_plyn_kshtn,
        t2_poli_tdk_mnlr,
        t2_poli_mnlr,
        t2_kgwtdrtn_mds,
        t2_plyn_kshtn_rujukan,
        t2_pmrksn_laik_trbng,
        t2_laik_trbng,
        t2_tdk_laik_trbng,
        t2_tdk_laik_trbng_dgnosa,
        t2_ijn_org_skt,
        t2_org_skt_d,
        t2_org_skt_b,
        t2_org_skt_tdk_mnlr,
        t2_org_skt_mnlr,
        t2_kmtn_jnzh,
        t2_kmtn_jnzh_dgnosa,
        t2_jnzh_tdk_mnlr,
        t2_jnzh_mnlr,
        t2_jml_dsnfksi,
        t2_lks_dsnfksi,
        t2_pmrksn_snts_psw,
        t2_snts_psw_laik,
        t2_snts_psw_tdk_laik,
        t2_snts_psw_tdk_laik_tndkn,
        crg_ijn_angkt_jnzh,
        crg_ijn_angkt_jnzh_d,
        crg_ijn_angkt_jnzh_b,
        crg_jnzh_tdk_mnlr,
        crg_jnzh_mnlr,
        crg_jnzh_luar_ngri,
        crg_jnzh_dlm_ngri,
        crg_pmrksn_jnzh,
        crg_pmrksn_jnzh_d,
        crg_pmrksn_jnzh_b,
        crg_ijn_angkt_abu_jnzh,
        crg_ijn_angkt_abu_jnzh_d,
        crg_ijn_angkt_abu_jnzh_b
      )
      VALUES (
        '$id',
        '$t1_psw_d',
        '$t1_kru_psw_d',
        '$t1_pnp_psw_d',
        '$t1_pnp_psw_d_suhu',
        '$t1_psw_b',
        '$t1_kru_psw_b',
        '$t1_pnp_psw_b',
        '$t1_pmrksn_sts_vksnasi',
        '$t1_pmrksn_sts_vksnasi_ms',
        '$t1_pmrksn_sts_vksnasi_tms',
        '$t1_pmrksn_sts_vksnasi_tms_als',
        '$t1_plyn_kshtn',
        '$t1_poli_tdk_mnlr',
        '$t1_poli_mnlr',
        '$t1_kgwtdrtn_mds',
        '$t1_plyn_kshtn_rujukan',
        '$t1_pmrksn_laik_trbng',
        '$t1_laik_trbng',
        '$t1_tdk_laik_trbng',
        '$t1_tdk_laik_trbng_dgnosa',
        '$t1_ijn_org_skt',
        '$t1_org_skt_d',
        '$t1_org_skt_b',
        '$t1_org_skt_tdk_mnlr',
        '$t1_org_skt_mnlr',
        '$t1_kmtn_jnzh',
        '$t1_kmtn_jnzh_dgnosa',
        '$t1_jnzh_tdk_mnlr',
        '$t1_jnzh_mnlr',
        '$t1_vksnasi_covid',
        '$t1_jml_dsnfksi',
        '$t1_lks_dsnfksi',
        '$t2_psw_d',
        '$t2_kru_psw_d',
        '$t2_pnp_psw_d',
        '$t2_pnp_psw_d_suhu',
        '$t2_psw_b',
        '$t2_kru_psw_b',
        '$t2_pnp_psw_b',
        '$t2_pmrksn_sts_vksnasi',
        '$t2_pmrksn_sts_vksnasi_ms',
        '$t2_pmrksn_sts_vksnasi_tms',
        '$t2_pmrksn_sts_vksnasi_tms_als',
        '$t2_plyn_kshtn',
        '$t2_poli_tdk_mnlr',
        '$t2_poli_mnlr',
        '$t2_kgwtdrtn_mds',
        '$t2_plyn_kshtn_rujukan',
        '$t2_pmrksn_laik_trbng',
        '$t2_laik_trbng',
        '$t2_tdk_laik_trbng',
        '$t2_tdk_laik_trbng_dgnosa',
        '$t2_ijn_org_skt',
        '$t2_org_skt_d',
        '$t2_org_skt_b',
        '$t2_org_skt_tdk_mnlr',
        '$t2_org_skt_mnlr',
        '$t2_kmtn_jnzh',
        '$t2_kmtn_jnzh_dgnosa',
        '$t2_jnzh_tdk_mnlr',
        '$t2_jnzh_mnlr',
        '$t2_jml_dsnfksi',
        '$t2_lks_dsnfksi',
        '$t2_pmrksn_snts_psw',
        '$t2_snts_psw_laik',
        '$t2_snts_psw_tdk_laik',
        '$t2_snts_psw_tdk_laik_tndkn',
        '$crg_ijn_angkt_jnzh',
        '$crg_ijn_angkt_jnzh_d',
        '$crg_ijn_angkt_jnzh_b',
        '$crg_jnzh_tdk_mnlr',
        '$crg_jnzh_mnlr',
        '$crg_jnzh_luar_ngri',
        '$crg_jnzh_dlm_ngri',
        '$crg_pmrksn_jnzh',
        '$crg_pmrksn_jnzh_d',
        '$crg_pmrksn_jnzh_b',
        '$crg_ijn_angkt_abu_jnzh',
        '$crg_ijn_angkt_abu_jnzh_d',
        '$crg_ijn_angkt_abu_jnzh_b'
      )
    ");

    foreach ($permasalahan as $key => $val) {
      $this->db->query("
        INSERT INTO laporan_masalah (id_sbk, sub, poin)
        VALUES ('$id', " . ($key + 1) . ", '" . $val . "')
      ");
    }

    foreach ($saran as $key => $val) {
      $this->db->query("
        INSERT INTO laporan_saran (id_sbk, sub, poin)
        VALUES ('$id', " . ($key + 1) . ", '" . $val . "')
      ");
    }

    $exe = $this->db->trans_complete();
    return $exe;
  }

  function edit_laporan()
  {
    $id = $this->input->post('id');
    $tgl = $this->input->post('tgl');
    // $no_st = $this->input->post('no_st');
    $t1_psw_d = $this->input->post('t1_psw_d');
    $t1_kru_psw_d = $this->input->post('t1_kru_psw_d');
    $t1_pnp_psw_d = $this->input->post('t1_pnp_psw_d');
    $t1_pnp_psw_d_suhu = $this->input->post('t1_pnp_psw_d_suhu');
    $t1_psw_b = $this->input->post('t1_psw_b');
    $t1_kru_psw_b = $this->input->post('t1_kru_psw_b');
    $t1_pnp_psw_b = $this->input->post('t1_pnp_psw_b');
    $t1_pmrksn_sts_vksnasi = $this->input->post('t1_pmrksn_sts_vksnasi');
    $t1_pmrksn_sts_vksnasi_ms = $this->input->post('t1_pmrksn_sts_vksnasi_ms');
    $t1_pmrksn_sts_vksnasi_tms = $this->input->post('t1_pmrksn_sts_vksnasi_tms');
    $t1_pmrksn_sts_vksnasi_tms_als = $this->input->post('t1_pmrksn_sts_vksnasi_tms_als');
    $t1_plyn_kshtn = $this->input->post('t1_plyn_kshtn');
    $t1_poli_tdk_mnlr = $this->input->post('t1_poli_tdk_mnlr');
    $t1_poli_mnlr = $this->input->post('t1_poli_mnlr');
    $t1_kgwtdrtn_mds = $this->input->post('t1_kgwtdrtn_mds');
    $t1_plyn_kshtn_rujukan = $this->input->post('t1_plyn_kshtn_rujukan');
    $t1_pmrksn_laik_trbng = $this->input->post('t1_pmrksn_laik_trbng');
    $t1_laik_trbng = $this->input->post('t1_laik_trbng');
    $t1_tdk_laik_trbng = $this->input->post('t1_tdk_laik_trbng');
    $t1_tdk_laik_trbng_dgnosa = $this->input->post('t1_tdk_laik_trbng_dgnosa');
    $t1_ijn_org_skt = $this->input->post('t1_ijn_org_skt');
    $t1_org_skt_d = $this->input->post('t1_org_skt_d');
    $t1_org_skt_b = $this->input->post('t1_org_skt_b');
    $t1_org_skt_tdk_mnlr = $this->input->post('t1_org_skt_tdk_mnlr');
    $t1_org_skt_mnlr = $this->input->post('t1_org_skt_mnlr');
    $t1_kmtn_jnzh = $this->input->post('t1_kmtn_jnzh');
    $t1_kmtn_jnzh_dgnosa = $this->input->post('t1_kmtn_jnzh_dgnosa');
    $t1_jnzh_tdk_mnlr = $this->input->post('t1_jnzh_tdk_mnlr');
    $t1_jnzh_mnlr = $this->input->post('t1_jnzh_mnlr');
    $t1_vksnasi_covid = $this->input->post('t1_vksnasi_covid');
    $t1_jml_dsnfksi = $this->input->post('t1_jml_dsnfksi');
    $t1_lks_dsnfksi = $this->input->post('t1_lks_dsnfksi');
    $t2_psw_d = $this->input->post('t2_psw_d');
    $t2_kru_psw_d = $this->input->post('t2_kru_psw_d');
    $t2_pnp_psw_d = $this->input->post('t2_pnp_psw_d');
    $t2_pnp_psw_d_suhu = $this->input->post('t2_pnp_psw_d_suhu');
    $t2_psw_b = $this->input->post('t2_psw_b');
    $t2_kru_psw_b = $this->input->post('t2_kru_psw_b');
    $t2_pnp_psw_b = $this->input->post('t2_pnp_psw_b');
    $t2_pmrksn_sts_vksnasi = $this->input->post('t2_pmrksn_sts_vksnasi');
    $t2_pmrksn_sts_vksnasi_ms = $this->input->post('t2_pmrksn_sts_vksnasi_ms');
    $t2_pmrksn_sts_vksnasi_tms = $this->input->post('t2_pmrksn_sts_vksnasi_tms');
    $t2_pmrksn_sts_vksnasi_tms_als = $this->input->post('t2_pmrksn_sts_vksnasi_tms_als');
    $t2_plyn_kshtn = $this->input->post('t2_plyn_kshtn');
    $t2_poli_tdk_mnlr = $this->input->post('t2_poli_tdk_mnlr');
    $t2_poli_mnlr = $this->input->post('t2_poli_mnlr');
    $t2_kgwtdrtn_mds = $this->input->post('t2_kgwtdrtn_mds');
    $t2_plyn_kshtn_rujukan = $this->input->post('t2_plyn_kshtn_rujukan');
    $t2_pmrksn_laik_trbng = $this->input->post('t2_pmrksn_laik_trbng');
    $t2_laik_trbng = $this->input->post('t2_laik_trbng');
    $t2_tdk_laik_trbng = $this->input->post('t2_tdk_laik_trbng');
    $t2_tdk_laik_trbng_dgnosa = $this->input->post('t2_tdk_laik_trbng_dgnosa');
    $t2_ijn_org_skt = $this->input->post('t2_ijn_org_skt');
    $t2_org_skt_d = $this->input->post('t2_org_skt_d');
    $t2_org_skt_b = $this->input->post('t2_org_skt_b');
    $t2_org_skt_tdk_mnlr = $this->input->post('t2_org_skt_tdk_mnlr');
    $t2_org_skt_mnlr = $this->input->post('t2_org_skt_mnlr');
    $t2_kmtn_jnzh = $this->input->post('t2_kmtn_jnzh');
    $t2_kmtn_jnzh_dgnosa = $this->input->post('t2_kmtn_jnzh_dgnosa');
    $t2_jnzh_tdk_mnlr = $this->input->post('t2_jnzh_tdk_mnlr');
    $t2_jnzh_mnlr = $this->input->post('t2_jnzh_mnlr');
    $t2_jml_dsnfksi = $this->input->post('t2_jml_dsnfksi');
    $t2_lks_dsnfksi = $this->input->post('t2_lks_dsnfksi');
    $t2_pmrksn_snts_psw = $this->input->post('t2_pmrksn_snts_psw');
    $t2_snts_psw_laik = $this->input->post('t2_snts_psw_laik');
    $t2_snts_psw_tdk_laik = $this->input->post('t2_snts_psw_tdk_laik');
    $t2_snts_psw_tdk_laik_tndkn = $this->input->post('t2_snts_psw_tdk_laik_tndkn');
    $crg_ijn_angkt_jnzh = $this->input->post('crg_ijn_angkt_jnzh');
    $crg_ijn_angkt_jnzh_d = $this->input->post('crg_ijn_angkt_jnzh_d');
    $crg_ijn_angkt_jnzh_b = $this->input->post('crg_ijn_angkt_jnzh_b');
    $crg_jnzh_tdk_mnlr = $this->input->post('crg_jnzh_tdk_mnlr');
    $crg_jnzh_mnlr = $this->input->post('crg_jnzh_mnlr');
    $crg_jnzh_luar_ngri = $this->input->post('crg_jnzh_luar_ngri');
    $crg_jnzh_dlm_ngri = $this->input->post('crg_jnzh_dlm_ngri');
    $crg_pmrksn_jnzh = $this->input->post('crg_pmrksn_jnzh');
    $crg_pmrksn_jnzh_d = $this->input->post('crg_pmrksn_jnzh_d');
    $crg_pmrksn_jnzh_b = $this->input->post('crg_pmrksn_jnzh_b');
    $crg_ijn_angkt_abu_jnzh = $this->input->post('crg_ijn_angkt_abu_jnzh');
    $crg_ijn_angkt_abu_jnzh_d = $this->input->post('crg_ijn_angkt_abu_jnzh_d');
    $crg_ijn_angkt_abu_jnzh_b = $this->input->post('crg_ijn_angkt_abu_jnzh_b');
    $permasalahan = $this->input->post('permasalahan');
    $saran = $this->input->post('saran');

    $this->db->trans_start();

    // $this->db->query("
    //   UPDATE sbk SET
    //   no_st = '$no_st'
    //   WHERE id_sbk = '$id'
    // ");

    $this->db->query("
      UPDATE laporan SET
        t1_psw_d = '$t1_psw_d',
        t1_kru_psw_d = '$t1_kru_psw_d',
        t1_pnp_psw_d = '$t1_pnp_psw_d',
        t1_pnp_psw_d_suhu = '$t1_pnp_psw_d_suhu',
        t1_psw_b = '$t1_psw_b',
        t1_kru_psw_b = '$t1_kru_psw_b',
        t1_pnp_psw_b = '$t1_pnp_psw_b',
        t1_pmrksn_sts_vksnasi = '$t1_pmrksn_sts_vksnasi',
        t1_pmrksn_sts_vksnasi_ms = '$t1_pmrksn_sts_vksnasi_ms',
        t1_pmrksn_sts_vksnasi_tms = '$t1_pmrksn_sts_vksnasi_tms',
        t1_pmrksn_sts_vksnasi_tms_als = '$t1_pmrksn_sts_vksnasi_tms_als',
        t1_plyn_kshtn = '$t1_plyn_kshtn',
        t1_poli_tdk_mnlr = '$t1_poli_tdk_mnlr',
        t1_poli_mnlr = '$t1_poli_mnlr',
        t1_kgwtdrtn_mds = '$t1_kgwtdrtn_mds',
        t1_plyn_kshtn_rujukan = '$t1_plyn_kshtn_rujukan',
        t1_pmrksn_laik_trbng = '$t1_pmrksn_laik_trbng',
        t1_laik_trbng = '$t1_laik_trbng',
        t1_tdk_laik_trbng = '$t1_tdk_laik_trbng',
        t1_tdk_laik_trbng_dgnosa = '$t1_tdk_laik_trbng_dgnosa',
        t1_ijn_org_skt = '$t1_ijn_org_skt',
        t1_org_skt_d = '$t1_org_skt_d',
        t1_org_skt_b = '$t1_org_skt_b',
        t1_org_skt_tdk_mnlr = '$t1_org_skt_tdk_mnlr',
        t1_org_skt_mnlr = '$t1_org_skt_mnlr',
        t1_kmtn_jnzh = '$t1_kmtn_jnzh',
        t1_kmtn_jnzh_dgnosa = '$t1_kmtn_jnzh_dgnosa',
        t1_jnzh_tdk_mnlr = '$t1_jnzh_tdk_mnlr',
        t1_jnzh_mnlr = '$t1_jnzh_mnlr',
        t1_vksnasi_covid = '$t1_vksnasi_covid',
        t1_jml_dsnfksi = '$t1_jml_dsnfksi',
        t1_lks_dsnfksi = '$t1_lks_dsnfksi',
        t2_psw_d = '$t2_psw_d',
        t2_kru_psw_d = '$t2_kru_psw_d',
        t2_pnp_psw_d = '$t2_pnp_psw_d',
        t2_pnp_psw_d_suhu = '$t2_pnp_psw_d_suhu',
        t2_psw_b = '$t2_psw_b',
        t2_kru_psw_b = '$t2_kru_psw_b',
        t2_pnp_psw_b = '$t2_pnp_psw_b',
        t2_pmrksn_sts_vksnasi = '$t2_pmrksn_sts_vksnasi',
        t2_pmrksn_sts_vksnasi_ms = '$t2_pmrksn_sts_vksnasi_ms',
        t2_pmrksn_sts_vksnasi_tms = '$t2_pmrksn_sts_vksnasi_tms',
        t2_pmrksn_sts_vksnasi_tms_als = '$t2_pmrksn_sts_vksnasi_tms_als',
        t2_plyn_kshtn = '$t2_plyn_kshtn',
        t2_poli_tdk_mnlr = '$t2_poli_tdk_mnlr',
        t2_poli_mnlr = '$t2_poli_mnlr',
        t2_kgwtdrtn_mds = '$t2_kgwtdrtn_mds',
        t2_plyn_kshtn_rujukan = '$t2_plyn_kshtn_rujukan',
        t2_pmrksn_laik_trbng = '$t2_pmrksn_laik_trbng',
        t2_laik_trbng = '$t2_laik_trbng',
        t2_tdk_laik_trbng = '$t2_tdk_laik_trbng',
        t2_tdk_laik_trbng_dgnosa = '$t2_tdk_laik_trbng_dgnosa',
        t2_ijn_org_skt = '$t2_ijn_org_skt',
        t2_org_skt_d = '$t2_org_skt_d',
        t2_org_skt_b = '$t2_org_skt_b',
        t2_org_skt_tdk_mnlr = '$t2_org_skt_tdk_mnlr',
        t2_org_skt_mnlr = '$t2_org_skt_mnlr',
        t2_kmtn_jnzh = '$t2_kmtn_jnzh',
        t2_kmtn_jnzh_dgnosa = '$t2_kmtn_jnzh_dgnosa',
        t2_jnzh_tdk_mnlr = '$t2_jnzh_tdk_mnlr',
        t2_jnzh_mnlr = '$t2_jnzh_mnlr',
        t2_jml_dsnfksi = '$t2_jml_dsnfksi',
        t2_lks_dsnfksi = '$t2_lks_dsnfksi',
        t2_pmrksn_snts_psw = '$t2_pmrksn_snts_psw',
        t2_snts_psw_laik = '$t2_snts_psw_laik',
        t2_snts_psw_tdk_laik = '$t2_snts_psw_tdk_laik',
        t2_snts_psw_tdk_laik_tndkn = '$t2_snts_psw_tdk_laik_tndkn',
        crg_ijn_angkt_jnzh = '$crg_ijn_angkt_jnzh',
        crg_ijn_angkt_jnzh_d = '$crg_ijn_angkt_jnzh_d',
        crg_ijn_angkt_jnzh_b = '$crg_ijn_angkt_jnzh_b',
        crg_jnzh_tdk_mnlr = '$crg_jnzh_tdk_mnlr',
        crg_jnzh_mnlr = '$crg_jnzh_mnlr',
        crg_jnzh_luar_ngri = '$crg_jnzh_luar_ngri',
        crg_jnzh_dlm_ngri = '$crg_jnzh_dlm_ngri',
        crg_pmrksn_jnzh = '$crg_pmrksn_jnzh',
        crg_pmrksn_jnzh_d = '$crg_pmrksn_jnzh_d',
        crg_pmrksn_jnzh_b = '$crg_pmrksn_jnzh_b',
        crg_ijn_angkt_abu_jnzh = '$crg_ijn_angkt_abu_jnzh',
        crg_ijn_angkt_abu_jnzh_d = '$crg_ijn_angkt_abu_jnzh_d',
        crg_ijn_angkt_abu_jnzh_b = '$crg_ijn_angkt_abu_jnzh_b'
      WHERE id_sbk = '$id'
    ");

    $this->db->query("
      DELETE FROM laporan_masalah
      WHERE id_sbk = '$id'
    ");

    foreach ($permasalahan as $key => $val) {
      $this->db->query("
        INSERT INTO laporan_masalah (id_sbk, sub, poin)
        VALUES ('$id', " . ($key + 1) . ", '" . $val . "')
      ");
    }

    $this->db->query("
      DELETE FROM laporan_saran
      WHERE id_sbk = '$id'
    ");

    foreach ($saran as $key => $val) {
      $this->db->query("
        INSERT INTO laporan_saran (id_sbk, sub, poin)
        VALUES ('$id', " . ($key + 1) . ", '" . $val . "')
      ");
    }

    $exe = $this->db->trans_complete();
    return $exe;
  }

  function ambil_data_st()
  {
    $id = $this->input->post('id');

    $sql = "
      SELECT no_st 
      FROM sbk
      WHERE id_sbk = '$id'
    ";
    $data = $this->db->query($sql)->row_array();
    return $data;
  }

  function cek_st()
  {
    $id = $this->input->post('id');

    $sql = "
      SELECT id_sbk
      FROM sbk
      WHERE id_sbk = '$id'
    ";
    $data = $this->db->query($sql)->num_rows();
    return $data;
  }

  function simpan_st()
  {
    $id = $this->input->post('id');
    $tgl = $this->input->post('tgl');
    $no_st = $this->input->post('no_st');

    $this->db->trans_start();

    $this->db->query("
      INSERT INTO sbk (
        id_sbk,
        tgl_sbk,
        no_st
      )
      VALUES (
        '$id',
        STR_TO_DATE('$tgl', '%d/%m/%Y'),
        '$no_st'
      )
    ");

    $exe = $this->db->trans_complete();
    return $exe;
  }

  function edit_st()
  {
    $id = $this->input->post('id');
    $tgl = $this->input->post('tgl');
    $no_st = $this->input->post('no_st');

    $this->db->trans_start();

    $this->db->query("
      UPDATE sbk SET
      no_st = '$no_st'
      WHERE id_sbk = '$id'
    ");

    $exe = $this->db->trans_complete();
    return $exe;
  }
}
