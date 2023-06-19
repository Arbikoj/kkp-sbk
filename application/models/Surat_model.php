<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat_model extends CI_Model
{
  public function data_sbk()
  {
    $id = $this->uri->segment('3');
    $thn = substr($id,3,2);
    $bln = substr($id,5,2);
    $hari = substr($id,7,2);

    $str = chr(39);
    $now = $str.'20'.$thn.'-'.$bln.'-'.$hari.$str;
    $dateku = '20'.$thn.'-'.$bln.'-'.$hari;

    // untuk menentukan period
    if ($hari <= 15) {
      // get tengah bulan
      $lastmonth = $str.'20'.$thn.'-'.$bln.'-15'.$str;
    }else {
      // get last month
      $lastmonth = date("Y-m-t", strtotime($dateku));
      $lastmonth = $str.$lastmonth.$str;
    }

    $sql = "
      SELECT
        a.id_sbk,
        tgl_sbk as tgl,
        DATE_FORMAT(tgl_sbk, '%d %M %Y') tgl_sbk,
        no_st,
        IFNULL(t1_psw_d, 0) t1_psw_d, 
        IFNULL(t1_kru_psw_d, 0) t1_kru_psw_d, 
        IFNULL(t1_pnp_psw_d, 0) t1_pnp_psw_d, 
        IFNULL(t1_pnp_psw_d_suhu, 0) t1_pnp_psw_d_suhu,
        IFNULL(t1_psw_b, 0) t1_psw_b, 
        IFNULL(t1_kru_psw_b, 0) t1_kru_psw_b, 
        IFNULL(t1_pnp_psw_b, 0) t1_pnp_psw_b, 
        IFNULL(t1_pmrksn_sts_vksnasi, 0) t1_pmrksn_sts_vksnasi, 
        IFNULL(t1_pmrksn_sts_vksnasi_ms, 0) t1_pmrksn_sts_vksnasi_ms,
        IFNULL(t1_pmrksn_sts_vksnasi_tms, 0) t1_pmrksn_sts_vksnasi_tms,
        IFNULL(t1_pmrksn_sts_vksnasi_tms_als, '') t1_pmrksn_sts_vksnasi_tms_als,
        IFNULL(t1_plyn_kshtn, 0) t1_plyn_kshtn, 
        IFNULL(t1_poli_tdk_mnlr, 0) t1_poli_tdk_mnlr, 
        IFNULL(t1_poli_mnlr, 0) t1_poli_mnlr, 
        IFNULL(t1_kgwtdrtn_mds, 0) t1_kgwtdrtn_mds, 
        IFNULL(t1_plyn_kshtn_rujukan, 0) t1_plyn_kshtn_rujukan, 
        IFNULL(t1_pmrksn_laik_trbng, 0) t1_pmrksn_laik_trbng, 
        IFNULL(t1_laik_trbng, 0) t1_laik_trbng, 
        IFNULL(t1_tdk_laik_trbng, 0) t1_tdk_laik_trbng, 
        IFNULL(t1_tdk_laik_trbng_dgnosa, '') t1_tdk_laik_trbng_dgnosa,
        IFNULL(t1_ijn_org_skt, 0) t1_ijn_org_skt, 
        IFNULL(t1_org_skt_d, 0) t1_org_skt_d,
        IFNULL(t1_org_skt_b, 0) t1_org_skt_b,
        IFNULL(t1_org_skt_tdk_mnlr, 0) t1_org_skt_tdk_mnlr, 
        IFNULL(t1_org_skt_mnlr, 0) t1_org_skt_mnlr, 
        IFNULL(t1_kmtn_jnzh, 0) t1_kmtn_jnzh,
        IFNULL(t1_kmtn_jnzh_dgnosa, '') t1_kmtn_jnzh_dgnosa, 
        IFNULL(t1_jnzh_tdk_mnlr, 0) t1_jnzh_tdk_mnlr, 
        IFNULL(t1_jnzh_mnlr, 0) t1_jnzh_mnlr, 
        IFNULL(t1_vksnasi_covid, 0) t1_vksnasi_covid, 
        IFNULL(t1_jml_dsnfksi, 0) t1_jml_dsnfksi,
        IFNULL(t1_lks_dsnfksi, '') t1_lks_dsnfksi,
        IFNULL(t2_psw_d, 0) t2_psw_d, 
        IFNULL(t2_kru_psw_d, 0) t2_kru_psw_d, 
        IFNULL(t2_pnp_psw_d, 0) t2_pnp_psw_d, 
        IFNULL(t2_pnp_psw_d_suhu, 0) t2_pnp_psw_d_suhu,
        IFNULL(t2_psw_b, 0) t2_psw_b, 
        IFNULL(t2_kru_psw_b, 0) t2_kru_psw_b, 
        IFNULL(t2_pnp_psw_b, 0) t2_pnp_psw_b, 
        IFNULL(t2_pmrksn_sts_vksnasi, 0) t2_pmrksn_sts_vksnasi, 
        IFNULL(t2_pmrksn_sts_vksnasi_ms, 0) t2_pmrksn_sts_vksnasi_ms,
        IFNULL(t2_pmrksn_sts_vksnasi_tms, 0) t2_pmrksn_sts_vksnasi_tms,
        IFNULL(t2_pmrksn_sts_vksnasi_tms_als, '') t2_pmrksn_sts_vksnasi_tms_als,
        IFNULL(t2_plyn_kshtn, 0) t2_plyn_kshtn, 
        IFNULL(t2_poli_tdk_mnlr, 0) t2_poli_tdk_mnlr, 
        IFNULL(t2_poli_mnlr, 0) t2_poli_mnlr, 
        IFNULL(t2_kgwtdrtn_mds, 0) t2_kgwtdrtn_mds, 
        IFNULL(t2_plyn_kshtn_rujukan, 0) t2_plyn_kshtn_rujukan, 
        IFNULL(t2_pmrksn_laik_trbng, 0) t2_pmrksn_laik_trbng, 
        IFNULL(t2_laik_trbng, 0) t2_laik_trbng, 
        IFNULL(t2_tdk_laik_trbng, 0) t2_tdk_laik_trbng, 
        IFNULL(t2_tdk_laik_trbng_dgnosa, '') t2_tdk_laik_trbng_dgnosa,
        IFNULL(t2_ijn_org_skt, 0) t2_ijn_org_skt, 
        IFNULL(t2_org_skt_d, 0) t2_org_skt_d,
        IFNULL(t2_org_skt_b, 0) t2_org_skt_b,
        IFNULL(t2_org_skt_tdk_mnlr, 0) t2_org_skt_tdk_mnlr, 
        IFNULL(t2_org_skt_mnlr, 0) t2_org_skt_mnlr, 
        IFNULL(t2_kmtn_jnzh, 0) t2_kmtn_jnzh,
        IFNULL(t2_kmtn_jnzh_dgnosa, '') t2_kmtn_jnzh_dgnosa, 
        IFNULL(t2_jnzh_tdk_mnlr, 0) t2_jnzh_tdk_mnlr, 
        IFNULL(t2_jnzh_mnlr, 0) t2_jnzh_mnlr, 
        IFNULL(t2_jml_dsnfksi, 0) t2_jml_dsnfksi,
        IFNULL(t2_lks_dsnfksi, '') t2_lks_dsnfksi,
        IFNULL(t2_pmrksn_snts_psw, 0) t2_pmrksn_snts_psw, 
        IFNULL(t2_snts_psw_laik, 0) t2_snts_psw_laik,
        IFNULL(t2_snts_psw_tdk_laik, 0) t2_snts_psw_tdk_laik,
        IFNULL(t2_snts_psw_tdk_laik_tndkn, '') t2_snts_psw_tdk_laik_tndkn,
        IFNULL(crg_ijn_angkt_jnzh, 0) crg_ijn_angkt_jnzh, 
        IFNULL(crg_ijn_angkt_jnzh_d, 0) crg_ijn_angkt_jnzh_d,
        IFNULL(crg_ijn_angkt_jnzh_b, 0) crg_ijn_angkt_jnzh_b,
        IFNULL(crg_jnzh_tdk_mnlr, 0) crg_jnzh_tdk_mnlr, 
        IFNULL(crg_jnzh_mnlr, 0) crg_jnzh_mnlr, 
        IFNULL(crg_jnzh_luar_ngri, 0) crg_jnzh_luar_ngri, 
        IFNULL(crg_jnzh_dlm_ngri, 0) crg_jnzh_dlm_ngri,
        IFNULL(crg_pmrksn_jnzh, 0) crg_pmrksn_jnzh,
        IFNULL(crg_pmrksn_jnzh_d, 0) crg_pmrksn_jnzh_d,
        IFNULL(crg_pmrksn_jnzh_b, 0) crg_pmrksn_jnzh_b,
        IFNULL(crg_ijn_angkt_abu_jnzh, 0) crg_ijn_angkt_abu_jnzh,
        IFNULL(crg_ijn_angkt_abu_jnzh_d, 0) crg_ijn_angkt_abu_jnzh_d,
        IFNULL(crg_ijn_angkt_abu_jnzh_b, 0) crg_ijn_angkt_abu_jnzh_b,
        ( SELECT nama
          FROM petugas
          WHERE tgl = $lastmonth
          AND role = 1
        ) perwira_jaga,
        ( SELECT nip
          FROM petugas
          WHERE tgl = (select tgl_sbk from sbk where id_sbk = '$id')
          AND role = 1
        ) nip_perwira_jaga,
        ( SELECT COUNT(*)
          FROM petugas
          WHERE tgl = (select tgl_sbk from sbk where id_sbk = '$id')
        ) jml_petugas
      FROM sbk a
      LEFT JOIN laporan b ON b.id_sbk = a.id_sbk
      WHERE a.id_sbk = '$id'
    ";

    $data = $this->db->query($sql)->row_array();
    return $data;
  }

  public function data_poin_masalah()
  {
    $id = $this->uri->segment('3');

    $sql = "
      SELECT id_sbk, sub, poin
      FROM laporan_masalah
      WHERE id_sbk = '$id'
      ORDER BY id_sbk, sub
    ";

    $data = $this->db->query($sql)->result();
    return $data;
  }

  public function data_poin_saran()
  {
    $id = $this->uri->segment('3');

    $sql = "
      SELECT id_sbk, sub, poin
      FROM laporan_saran
      WHERE id_sbk = '$id'
      ORDER BY id_sbk, sub
    ";

    $data = $this->db->query($sql)->result();
    return $data;
  }

  public function data_petugas()
  {
    $id = $this->uri->segment('3');
    $thn = substr($id,3,2);
    $bln = substr($id,5,2);
    $hari = substr($id,7,2);
    
    
    
    
    $str = chr(39);
    $now = $str.'20'.$thn.'-'.$bln.'-'.$hari.$str;
    $dateku = '20'.$thn.'-'.$bln.'-'.$hari;
    
    
    //menghitung jumlah orang



    // untuk menentukan period
    if ($hari <= 15) {
      // get tengah bulan
      $lastmonth = $str.'20'.$thn.'-'.$bln.'-15'.$str;
    }else {
      // get last month
      $lastmonth = date("Y-m-t", strtotime($dateku));
      $lastmonth = $str.$lastmonth.$str;
    }

    // $sql = "
    //   SELECT a.nip, a.nama, a.gol, a.status, a.pangkat, a.jabatan, b.role
    //   FROM petugas a
    //   LEFT JOIN role b ON b.id_role = a.role
    //   WHERE tgl = (select tgl_sbk from sbk where id_sbk = '$id') 
    //   ORDER By status, id_role
    // ";

    // WHERE tgl between '2023-06-01' and '2023-06-02'

    // $sql = "
    //   SELECT a.nip, a.nama, a.gol, a.status, a.pangkat, a.jabatan, b.role, COUNT(a.nama) as hehe
    //   FROM petugas a
    //   LEFT JOIN role b ON b.id_role = a.role
    //   WHERE tgl between $now and $lastmonth
    //   ORDER By status, id_role


    // ";
    $sql = "
    SELECT COUNT(petugas.nip) as hehe, 
    petugas.gol, 
    petugas.nip, 
    petugas.nama, 
    petugas.status, 
    petugas.pangkat, 
    petugas.jabatan, 
    petugas.role,
    petugas.tgl, 
    role.role,
    COUNT(petugas.nip) * 150000 as salary,
    GROUp_CONCAT(DAY(petugas.tgl) SEPARATOR ', ') AS tgl_lembur
    FROM petugas
    LEFT JOIN role ON role.id_role = petugas.role
    WHERE tgl between $now and $lastmonth
    GROUP BY nip
    ORDER By status, id_role
  ";

//   SELECT a.column1, COUNT(b.column2) AS count_column2
// FROM table_a AS a
// JOIN table_b AS b ON a.id = b.a_id
// GROUP BY a.column1
// ORDER BY count_column2 DESC;
    $data = $this->db->query($sql)->result();
    return $data;
  }

  public function data_role_petugas()
  {
    $id = $this->uri->segment('3');

    $sql = "
      SELECT b.role, COUNT(*) AS jml
      FROM petugas a
      LEFT JOIN role b ON b.id_role = a.role
      WHERE tgl = (select tgl_sbk from sbk where id_sbk = '$id')
      GROUP BY role
      ORDER By b.id_role
    ";

    $data = $this->db->query($sql)->result();
    return $data;
  }

  public function data_st()
  {
    $id = $this->uri->segment('3');

    $sql = "
      SELECT
        id_sbk,
        tgl_sbk as tgl,
        DATE_FORMAT(tgl_sbk, '%d %M %Y') tgl_sbk,
        no_st
      FROM sbk
      WHERE id_sbk = '$id'
    ";

    $data = $this->db->query($sql)->row_array();
    return $data;
  }
}
