<?php

function terbilang($x)
{
  $angka = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];

  if ($x < 12)
    return " " . $angka[$x];
  elseif ($x < 20)
    return terbilang($x - 10) . " belas";
  elseif ($x < 100)
    return terbilang($x / 10) . " puluh" . terbilang($x % 10);
  elseif ($x < 200)
    return "seratus" . terbilang($x - 100);
  elseif ($x < 1000)
    return terbilang($x / 100) . " ratus" . terbilang($x % 100);
  elseif ($x < 2000)
    return "seribu" . terbilang($x - 1000);
  elseif ($x < 1000000)
    return terbilang($x / 1000) . " ribu" . terbilang($x % 1000);
  elseif ($x < 1000000000)
    return terbilang($x / 1000000) . " juta" . terbilang($x % 1000000);
}

function ribuan($x)
{
  return number_format($x, 0, ",", ".");
}

function tgl_indo($x)
{
  $str = explode(" ", $x);
  switch ($str[1]) {
    case "January":
      return $str[0] . " Januari " . $str[2];
      break;
    case "February":
      return $str[0] . " Februari " . $str[2];
      break;
    case "March":
      return $str[0] . " Maret " . $str[2];
      break;
    case "April":
      return $str[0] . " April " . $str[2];
      break;
    case "May":
      return $str[0] . " Mei " . $str[2];
      break;
    case "June":
      return $str[0] . " Juni " . $str[2];
      break;
    case "July":
      return $str[0] . " Juli " . $str[2];
      break;
    case "August":
      return $str[0] . " Agustus " . $str[2];
      break;
    case "September":
      return $str[0] . " September " . $str[2];
      break;
    case "October":
      return $str[0] . " Oktober " . $str[2];
      break;
    case "November":
      return $str[0] . " November " . $str[2];
      break;
    case "December":
      return $str[0] . " Desember " . $str[2];
      break;
    default:
      return "";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan SBK</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-size: 16px;
      font-family: Arial;
    }

    .page_break {
      page-break-before: always;
    }
  </style>
</head>

<?php
$thn = substr($tgl,0,4);
$bln = substr($tgl,5,2);
$hari = substr($tgl,8,2);

if ($hari == 01) {
  $last_period = new DateTime($tgl);
  $last_period->add(new DateInterval('P14D'));
  $last_period = $last_period->format('d F Y');
} else {
  $last_period = date("Y-m-t", strtotime($tgl));
  $last_period = $str.$last_period.$str;
  $last_period = date("t F Y");
}
?>

<body>
  <div style="padding: 20px;">
    <?php $this->load->view("surat/kop_surat.php") ?>
    <div style="padding: 10px;">
      <p style="text-align: center; font-weight: bold; font-size: 18px;">LAPORAN PERJALANAN DINAS</p>
      <p style="text-align: center; font-weight: bold; font-size: 18px;">PELAKSANAAN KEKARANTINAAN KESEHATAN DI BANDARA JUANDA</p>
      <p style="text-align: center; font-weight: bold; font-size: 18px;">KANTOR KESEHATAN PELABUHAN KELAS I SURABAYA</p>
      <br>
      <table style="width: 100%;">
        <tr>
          <td style="width: 3%;">1.</td>
          <td style="width: 25%;">Nama</td>
          <td style="width: 2%;">:</td>
          <td style="width: 70%;"><?= $perwira_jaga; ?></td>
        </tr>
        <tr>
          <td style="width: 3%;">2.</td>
          <td style="width: 25%;">Kantor / Satuan Kerja</td>
          <td style="width: 2%;">:</td>
          <td style="width: 70%;">Kantor Kesehatan Pelabuhan Kelas I Surabaya</td>
        </tr>
        <tr>
          <td style="width: 3%; vertical-align: top;">3.</td>
          <td style="width: 25%; vertical-align: top;">Tempat Kegiatan</td>
          <td style="width: 2%; vertical-align: top;">:</td>
          <td style="width: 70%;">Bandara Internasional Juanda Surabaya Terminal 1, Terminal 2, Terminal Kargo</td>
        </tr>
        <tr>
          <td style="width: 3%;">4.</td>
          <td style="width: 25%;">Waktu Kegiatan</td>
          <td style="width: 2%;">:</td>
          <td style="width: 70%;">Tanggal <?= $hari ?> sd <?= tgl_indo($last_period)  ?></td>
        </tr>
        <tr>
          <td style="width: 3%;">5.</td>
          <td style="width: 25%;" colspan="3">Hasil</td>
        </tr>
        <tr>
          <td colspan="4">
            <ol type="a" style="padding-left: 45px;">
              <li>
                Pelaksanaan kekarantinaan kesehatan di Bandara Juanda dilakukan di 3 pos pelayanan. Jumlah keseluruhan petugas sebanyak <?= $jml_petugas; ?> orang yang terdiri dari
                <?php foreach ($role_petugas as $key => $values) : ?>
                  <?= $values->jml; ?> <?= $values->role; ?><?= $key == count($role_petugas) - 1 ? "" : ","; ?>
                <?php endforeach; ?>
              </li>
              <li>
                Pelaksanaan kekarantinaan kesehatan di Terminal 1 meliputi :
                <ul style="padding-left: 15px; list-style-type: '-  ';">
                  <li>Pengawasan kedatangan pesawat dalam negeri sebanyak <?= $t1_psw_d; ?> pesawat dengan jumlah kru <?= $t1_kru_psw_d; ?> orang serta <?= ribuan($t1_pnp_psw_d); ?> orang penumpang dengan suhu &lt;37,5&#8451; dan <?= $t1_pnp_psw_d_suhu; ?> orang penumpang dengan suhu &gt;37,5&#8451;</li>
                  <li>Pengawasan keberangkatan pesawat dalam negeri sebanyak <?= $t1_psw_b; ?> pesawat dengan jumlah kru <?= $t1_kru_psw_b; ?> orang dan <?= ribuan($t1_pnp_psw_b); ?> orang penumpang dapat melakukan perjalanan / laik terbang</li>
                  <li>Pelayanan pemeriksaan status vaksinasi sebagai persyaratan perjalanan sebanyak <?= $t1_pmrksn_sts_vksnasi; ?> orang dengan status memenuhi syarat sebanyak <?= $t1_pmrksn_sts_vksnasi_ms; ?> dan tidak memenuhi syarat sebanyak <?= $t1_pmrksn_sts_vksnasi_tms; ?> <?= $t1_pmrksn_sts_vksnasi_tms > 0 ? 'karena ' . $t1_pmrksn_sts_vksnasi_tms_als : ''; ?></li>
                  <li>Pelayanan kesehatan di bandara sebanyak <?= $t1_plyn_kshtn; ?> orang, yaitu kunjungan pengobatan di klinik karena penyakit tidak menular sebanyak <?= $t1_poli_tdk_mnlr; ?> orang dan penyakit menular sebanyak <?= $t1_poli_mnlr; ?> orang. Penanganan kasus kegawatdaruratan medis sebanyak <?= $t1_kgwtdrtn_mds; ?> orang dan pelayanan kesehatan rujukan sebanyak <?= $t1_plyn_kshtn_rujukan; ?> orang</li>
                  <li>Pemeriksaan penumpang dalam rangka penerbitan surat kelaikan terbang sebanyak <?= $t1_pmrksn_laik_trbng; ?> orang dengan hasil <?= $t1_laik_trbng; ?> orang laik terbang dan <?= $t1_tdk_laik_trbng; ?> orang tidak laik terbang <?= $t1_tdk_laik_trbng > 0 ? 'karena ' . $t1_tdk_laik_trbng_dgnosa : ''; ?>. Pada pemeriksaan penumpang untuk kelaikan terbang, sebagian besar adalah ibu hamil.</li>
                  <li>Pemberian perjalanan ijin orang sakit sebanyak <?= $t1_ijn_org_skt; ?> orang diantaranya dari kedatangan <?= $t1_ijn_org_skt_d; ?> orang dan dari keberangkatan <?= $t1_ijn_org_skt_b; ?> orang dengan diagnosa penyakit tidak menular sebanyak <?= $t1_org_skt_tdk_mnlr; ?> orang dan penyakit menular sebanyak <?= $t1_org_skt_mnlr; ?> orang</li>
                  <li>Kegiatan penanganan kasus kematian di pesawat/bandara sebanyak <?= $t1_kmtn_jnzh; ?> jenazah, <?= $t1_kmtn_jnzh > 0 ? 'karena ' . $t1_kmtn_jnzh_dgnosa : ''; ?> dengan dugaan penyebab penyakit menular <?= $t1_jnzh_mnlr; ?> orang dan penyebab penyakit tidak menular <?= $t1_jnzh_tdk_mnlr; ?> orang</li>
                  <li>Pelaksanaan vaksinasi covid sebanyak <?= $t1_vksnasi_covid; ?> orang</li>
                  <li>Kegiatan desinfeksi dilakukan setiap hari di <?= $t1_jml_dsnfksi; ?> lokasi diantaranya <?= $t1_lks_dsnfksi; ?></li>
                </ul>
              </li>
              <li>
                Pelaksanaan kekarantinaan kesehatan di Terminal 2 meliputi :
                <ul style="padding-left: 15px; list-style-type: '-  ';">
                  <li>Pengawasan kedatangan pesawat luar negeri sebanyak <?= $t2_psw_d; ?> pesawat dengan jumlah kru <?= $t2_kru_psw_d; ?> orang serta <?= ribuan($t2_pnp_psw_d); ?> orang penumpang dengan suhu &lt;37,5&#8451; dan <?= $t2_pnp_psw_d_suhu; ?> orang penumpang dengan suhu &gt;37,5&#8451;</li>
                  <li>Pengawasan keberangkatan pesawat dalam negeri sebanyak <?= $t2_psw_b; ?> pesawat dengan jumlah kru <?= $t2_kru_psw_b; ?> orang dan <?= ribuan($t2_pnp_psw_b); ?> orang penumpang dapat melakukan perjalanan / laik terbang</li>
                  <li>Pelayanan pemeriksaan status vaksinasi sebagai persyaratan perjalanan sebanyak <?= $t2_pmrksn_sts_vksnasi; ?> orang dengan status memenuhi syarat sebanyak <?= $t2_pmrksn_sts_vksnasi_ms; ?> dan tidak memenuhi syarat sebanyak <?= $t2_pmrksn_sts_vksnasi_tms; ?> <?= $t2_pmrksn_sts_vksnasi_tms > 0 ? 'karena ' . $t2_pmrksn_sts_vksnasi_tms_als : ''; ?></li>
                  <li>Pelayanan kesehatan di bandara sebanyak <?= $t2_plyn_kshtn; ?> orang, yaitu kunjungan pengobatan di klinik karena penyakit tidak menular sebanyak <?= $t2_poli_tdk_mnlr; ?> orang dan penyakit menular sebanyak <?= $t2_poli_mnlr; ?> orang. Penanganan kasus kegawatdaruratan medis sebanyak <?= $t2_kgwtdrtn_mds; ?> orang dan pelayanan kesehatan rujukan sebanyak <?= $t2_plyn_kshtn_rujukan; ?> orang</li>
                  <li>Pemeriksaan penumpang dalam rangka penerbitan surat kelaikan terbang sebanyak <?= $t2_pmrksn_laik_trbng; ?> orang dengan hasil <?= $t2_laik_trbng; ?> orang laik terbang dan <?= $t2_tdk_laik_trbng; ?> orang tidak laik terbang <?= $t2_tdk_laik_trbng > 0 ? 'dikarenakan ' . $t2_tdk_laik_trbng_dgnosa : ''; ?>. Pada pemeriksaan penumpang untuk kelaikan terbang, sebagian besar adalah ibu hamil.</li>
                  <li>Pemberian perjalanan ijin orang sakit sebanyak <?= $t2_ijn_org_skt; ?> orang diantaranya dari kedatangan <?= $t2_ijn_org_skt_d; ?> orang dan dari keberangkatan <?= $t2_ijn_org_skt_b; ?> orang dengan diagnosa penyakit tidak menular sebanyak <?= $t2_org_skt_tdk_mnlr; ?> orang dan penyakit menular sebanyak <?= $t2_org_skt_mnlr; ?> orang</li>
                  <li>Kegiatan penanganan kasus kematian di pesawat/bandara sebanyak <?= $t2_kmtn_jnzh; ?> jenazah, <?= $t2_kmtn_jnzh > 0 ? 'disebabkan ' . $t2_kmtn_jnzh_dgnosa : ''; ?> dengan dugaan penyebab penyakit menular <?= $t2_jnzh_mnlr; ?> orang dan penyebab penyakit tidak menular <?= $t2_jnzh_tdk_mnlr; ?> orang</li>
                </ul>
              </li>
            </ol>
          </td>
        </tr>
      </table>
    </div>
  </div>
  <div class="page_break"></div>
  <div style="padding: 20px;">
    <div style="padding: 10px;">
      <table style="width: 100%;">
        <tr>
          <td colspan="4">
            <ol style="padding-left: 45px; list-style-type: none;">
              <li>
                <ul style="padding-left: 15px; list-style-type: '-  ';">
                  <li>Kegiatan desinfeksi dilakukan setiap hari di <?= $t2_jml_dsnfksi; ?> lokasi diantaranya <?= $t2_lks_dsnfksi; ?></li>
                  <li>Pemeriksaan sanitasi pesawat sebanyak <?= $t2_pmrksn_snts_psw; ?> pesawat dengan hasil laik sebanyak <?= $t2_snts_psw_laik; ?> pesawat dan tidak laik sebanyak <?= $t2_snts_psw_tdk_laik; ?> <?= $t2_snts_psw_tdk_laik > 0 ? 'maka perlu dilakukan tindakan ' . $t2_snts_psw_tdk_laik_tndkn : ''; ?></li>
                </ul>
              </li>
            </ol>
          </td>
        </tr>
        <tr>
          <td colspan="4">
            <ol type="a" start="4" style="padding-left: 45px;">
              <li>
                Pengawasan Terminal Kargo :
                <ul style="padding-left: 15px; list-style-type: '-  ';">
                  <li>Pengawasan ijin angkut jenazah sebanyak <?= $crg_ijn_angkt_jnzh; ?> kali dengan penyebab kematian karena bukan penyakit menular sebanyak <?= $crg_jnzh_tdk_mnlr; ?> jenazah dan penyakit menular sebanyak <?= $crg_jnzh_mnlr; ?> jenazah. Ijin angkut jenazah berasal dari luar negeri sebanyak <?= $crg_jnzh_luar_ngri; ?> kali dan dari dalam negeri sebanyak <?= $crg_jnzh_dlm_ngri; ?> kali</li>
                  <li>Pemeriksaan jenazah sebanyak <?= $crg_pmrksn_jnzh; ?> kali, diantaranya <?= $crg_pmrksn_jnzh_d; ?> dari kedatangan dan <?= $crg_pmrksn_jnzh_b; ?> dari keberangkatan</li>
                  <li>Penerbitan surat ijin angkut jenazah sebanyak <?= $crg_ijn_angkt_jnzh; ?> dokumen, diantaranya <?= $crg_ijn_angkt_jnzh_d; ?> dari kedatangan dan <?= $crg_ijn_angkt_jnzh_b; ?> dari keberangkatan</li>
                  <li>Penerbitan surat ijin angkut abu jenazah sebanyak <?= $crg_ijn_angkt_abu_jnzh; ?> dokumen, diantaranya <?= $crg_ijn_angkt_abu_jnzh_d; ?> dari kedatangan dan <?= $crg_ijn_angkt_abu_jnzh_b; ?> dari keberangkatan</li>
                </ul>
              </li>
            </ol>
          </td>
        </tr>
        <tr>
          <td style="width: 3%;">6.</td>
          <td style="width: 25%;" colspan="3">Permasalahan :</td>
        </tr>
        <tr>
          <td colspan="4">
            <ul style="padding-left: 45px; list-style-type: '-  ';">
              <?php foreach ($masalah as $key => $values) : ?>
                <li><?= $values->poin; ?></li>
              <?php endforeach; ?>
            </ul>
          </td>
        </tr>
        <tr>
          <td style="width: 3%;">7.</td>
          <td style="width: 25%;" colspan="3">Saran - saran :</td>
        </tr>
        <tr>
          <td colspan="4">
            <ul style="padding-left: 45px; list-style-type: '-  ';">
              <?php foreach ($saran as $key => $values) : ?>
                <li><?= $values->poin; ?></li>
              <?php endforeach; ?>
            </ul>
          </td>
        </tr>
      </table>
      <br><br>
      <table style=" width: 100%;">
        <tr>
          <td style="width: 35%;">
            <table>
              <tr>
                <td>Mengetahui</td>
                <td>:</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Nama</td>
                <td>:</td>
                <td>Slamet Mulsiswanto</td>
              </tr>
              <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>Kepala Kantor</td>
              </tr>
              <tr>
                <td><br><br></td>
              </tr>
              <tr>
                <td>Tanda tangan</td>
                <td>:</td>
                <td>..............................................</td>
              </tr>
            </table>
          </td>
          <td style="width: 30%;"></td>
          <td style="width: 35%;">
            <table>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Sidoarjo, <?= tgl_indo($last_period)  ?></td>
              </tr>
              <tr>
                <td>Perwira Jaga,</td>
              </tr>
              <tr>
                <td><br><br><br><br></td>
              </tr>
              <tr>
                <td><b><?= $perwira_jaga; ?></b></td>
              </tr>
              <tr>
                <td>NIP. <?= $nip_perwira_jaga; ?></td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <br><br>
      <p>Diisi oleh Bendaharawan Proyek/Staf :</p>
      <table style="width: 100%;">
        <tr>
          <td style="width: 2%;">1).</td>
          <td style="width: 30%;">Tolak ukur</td>
          <td style="width: 2%;">:</td>
          <td>..............................................................</td>
        </tr>
        <tr>
          <td>2).</td>
          <td>Jumlah biaya yang dipakai</td>
          <td>:</td>
          <td>..............................................................</td>
        </tr>
        <tr>
          <td>3).</td>
          <td>Tanda tangan/paraf</td>
          <td>:</td>
          <td>..............................................................</td>
        </tr>
      </table>
    </div>
  </div>
</body>

</html>