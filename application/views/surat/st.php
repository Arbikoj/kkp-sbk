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
  <title>Dokumen SBK</title>
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

<!-- tanggal periode -->

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
    <h5 style="text-align: center; font-size: 12px;">DAFTAR NOMINATIF PEGAWAI</h5>
    <h5 style="text-align: center; font-size: 12px;">YANG MENERIMA UANG TRANSPORT</h5>
    <h5 style="text-align: center; font-size: 12px;">PETUGAS PELAKSANAAN KEKARANTINAAN KESEHATAN DI BANDARA INTERNASIONAL JUANDA</h5>
    <h5 style="text-align: center; font-size: 12px;">KANTOR KESEHATAN PELABUHAN KELAS I SURABAYA</h5>
    <h5 style="text-align: center; font-size: 12px;">TANGGAL <?= $hari ?> sd <?= tgl_indo($last_period)  ?> </h5>
    <h5 style="text-align: center; font-size: 12px;">MAK. 4249.QAH.U02.051.A.524113.RM</h5>
    <br>
    <table style="width: 100%; border-collapse: collapse;" border="1">
      <tr>
        <th style="text-align: center; width: 5%; padding: 5px; font-size: 12px;">NO</th>
        <th style="text-align: center; width: 20%; padding: 5px; font-size: 12px;">NAMA/NIP <br> PENERIMA</th>
        <th style="text-align: center; width: 5%; padding: 5px; font-size: 12px;">GOL</th>
        <th style="text-align: center; width: 10%; padding: 5px; font-size: 12px;">TANGGAL <br> KEGIATAN</th>
        <th style="text-align: center; width: 20%; padding: 5px; font-size: 12px;">KEGIATAN</th>
        <th style="text-align: center; width: 10%; padding: 5px; font-size: 12px;">LAMANYA <br> PERJALANAN</th>
        <th style="text-align: center; width: 10%; padding: 5px; font-size: 12px;">ASAL -<br>TUJUAN</th>
        <th style="text-align: center; width: 10%; padding: 5px; font-size: 12px;">JUMLAH YANG <br> DIBAYARKAN</th>
      </tr>
      <tr>
        <td style="text-align: center; font-size: 12px;">1</td>
        <td style="text-align: center; font-size: 12px;">2</td>
        <td style="text-align: center; font-size: 12px;">3</td>
        <td style="text-align: center; font-size: 12px;">4</td>
        <td style="text-align: center; font-size: 12px;">5</td>
        <td style="text-align: center; font-size: 12px;">6</td>
        <td style="text-align: center; font-size: 12px;">7</td>
        <td style="text-align: center; font-size: 12px;">8</td>
      </tr>
              <!-- RUPIAH FORMAT -->
        <?php
        
        function rupiah($angka){
	
          $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
          return $hasil_rupiah;
        
        } 
        ?>
      <?php foreach ($petugas as $key => $values) : ?>
        <?php 
          $harga += $values->hehe;
        ?>
        <tr>
          <td style="text-align: center; padding: 5px; font-size: 12px;"><?= $key + 1; ?></td>
          <td style="text-align: left; padding: 5px; font-size: 12px;"><?= $values->nama; ?> <br><?= $values->nip; ?></td>
          <td style="text-align: center; padding: 5px; font-size: 12px;"><?= $values->gol; ?></td>
          <!-- <td style="text-align: left; padding: 5px; font-size: 12px;"><?= tgl_indo($tgl_sbk); ?></td> -->
          <td style="text-align: left; padding: 5px; font-size: 12px;"><?= $values->tgl_lembur ?></td>
          <td style="text-align: left; padding: 5px; font-size: 12px;">Pelaksanaan Kekarantinaan Kesehatan di Bandara Internasional Juanda</td>
          <td style="text-align: center; padding: 5px; font-size: 12px;"><?= $values->hehe;?></td>
          <td style="text-align: left; padding: 5px; font-size: 12px;">Kantor - Bandara</td>
          <td style="text-align: right; padding: 5px; font-size: 12px;"><?= rupiah($values->salary); ?></td>
        </tr>
      <?php endforeach;?>

      <tr>
        <th colspan="7" style="font-size: 12px; padding: 5px;">Jumlah</th>
        <!-- <th style="text-align: right; font-size: 12px; padding: 5px;">Rp &nbsp; <?= number_format((150000 * count($petugas)), 0, ',', '.') ?></th> -->
        <th style="text-align: right; font-size: 12px; padding: 5px;">Rp &nbsp; <?= number_format((150000 * $harga), 0, ',', '.') ?></th>
        
      </tr>
    </table>
    <br>
    <table style="width: 100%;">
      <tr>
        <td style="width: 65%;"></td>
        <td style="width: 35%;">
          <table>
            <tr>
              <td style="font-size: 12px;">Sidoarjo, <?= tgl_indo($last_period); ?></td>
            </tr>
            <tr>
              <td style="font-size: 12px;">Pejabat Pembuat Komitmen</td>
            </tr>
            <tr>
              <td style="font-size: 12px;">Kantor Kesehatan Pelabuhan Kelas I Surabaya</td>
            </tr>
            <tr>
              <td><br><br><br></td>
            </tr>
            <tr>
              <td><b style="font-size: 12px;">Yanita Setyaningrum, SKM, M.Kes</b></td>
            </tr>
            <tr>
              <td style="font-size: 12px;">NIP. 198502202008122003</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <br>
    <table style="width: 100%;">
      <tr>
        <td>
          <table>
            <tr>
              <td style="font-size: 12px;">Catatan:</td>
            </tr>
            <tr>
              <td style="font-size: 12px;">1. Dibayarkan Berdasarkan Surat Tugas Kepala Kantor</td>
              <td style="padding-left: 50px; font-size: 12px;">Nomor : &nbsp; <?= $no_st; ?></td>
            </tr>
            <tr>
              <td></td>
              <td style="padding-left: 50px; font-size: 12px;">Tanggal : &nbsp; <?= tgl_indo($last_period); ?></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </div>
  <div class="page_break"></div>
  <div style="padding: 20px;">
    <?php $this->load->view("surat/kop_surat.php") ?>
    <div style="padding: 10px;">
      <p style="text-align: center; font-weight: bold; font-size: 18px;">SURAT TUGAS</p>
      <p style="text-align: center; font-weight: bold; font-size: 18px;">Nomor : <?= $no_st; ?></p>
      <br>
      <div>
        <p style="font-size: 16px; text-indent: 30px;">Sehubungan dengan tugas pokok dan fungsi Kantor Kesehatan Pelabuhan Kelas I Surabaya, dengan ini kami menugaskan kepada :</p>
        <br>
        <p style="text-align: center;">(Nama, NIP, Pangkat/Golongan dan Jabatan Terlampir)</p>
        <br>
        <table style="width: 100%;">
          <tr>
            <td style="vertical-align: top; font-size: 16px; width: 5%;">Untuk</td>
            <td style="vertical-align: top; width: 5%;">:</td>
            <td style="padding-left: 20px;">
              <ol>
                <li>Melakukan kegiatan kekarantinaan kesehatan di Bandara Internasional Juanda</li>
                <li>Biaya perjalanan dinas dibebankan pada anggaran Kantor Kesehatan Pelabuhan Kelas I Surabaya Tahun Anggaran 2023</li>
                <li>Surat Tugas ini berlaku tanggal <?= tgl_indo($tgl_sbk); ?></li>
                <li>Tetap melakukan rekam kehadiran datang dan / atau pulang</li>
                <li>Tidak diperkenankan menerima, meminta, dan / atau memberikan gratifikasi serta suap dalam bentuk apapun</li>
                <li>Melaporkan Hasil Kegiatan kepada atasan langsung</li>
              </ol>
            </td>
          </tr>
        </table>
        <br>
        <p style="text-indent: 30px;">Agar yang bersangkutan melaksanakan tugas dengan baik dan penuh tanggung jawab.</p>
        <br><br><br>
        <table style="width: 100%;">
          <tr>
            <td style="width: 70%;"></td>
            <td style="width: 30%;">
              <table>
                <tr>
                  <td><?= tgl_indo($tgl_sbk); ?></td>
                </tr>
                <tr>
                  <td>Kepala,</td>
                </tr>
                <tr>
                  <td><br><br><br><br><br></td>
                </tr>
                <tr>
                  <td><b>Slamet Mulsiswanto</b></td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <div class="page_break"></div>
  <div style="padding: 20px;">
    <table style="width: 100%;">
      <tr>
        <td style="width: 70%;"></td>
        <td style="width: 30%;">
          <table>
            <tr>
              <td style="font-size: 12px;">Lampiran</td>
              <td style="font-size: 12px;">:</td>
              <td style="font-size: 12px;">Surat Tugas</td>
            </tr>
            <tr>
              <td style="font-size: 12px;">Nomor</td>
              <td style="font-size: 12px;">:</td>
              <td style="font-size: 12px;"><?= $no_st; ?></td>
            </tr>
            <tr>
              <td style="font-size: 12px;">Tanggal</td>
              <td style="font-size: 12px;">:</td>
              <td style="font-size: 12px;"><?= tgl_indo($tgl_sbk); ?></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <br>
    <p style="text-align: center; font-weight: bold;">DAFTAR PEJABAT / PEGAWAI YANG DITUGASKAN</p>
    <br>
    <table style="width: 100%; border-collapse: collapse;" border="1">
      <tr>
        <th style="text-align: center; width: 5%; padding: 5px;">NO</th>
        <th style="text-align: center; width: 25%; padding: 5px;">NAMA</th>
        <th style="text-align: center; width: 20%; padding: 5px;">NIP</th>
        <th style="text-align: center; width: 20%; padding: 5px;">PANGKAT/GOL</th>
        <th style="text-align: center; width: 30%; padding: 5px;">JABATAN</th>
      </tr>
      <?php foreach ($petugas as $key => $values) : ?>
        <tr>
          <td style="text-align: center; padding: 5px;"><?= $key + 1; ?></td>
          <td style="text-align: left; padding: 5px;"><?= $values->nama; ?></td>
          <td style="text-align: left; padding: 5px;"><?= $values->nip; ?></td>
          <td style="text-align: left; padding: 5px;"><?= $values->pangkat; ?> / <?= $values->gol; ?></td>
          <td style="text-align: left; padding: 5px;"><?= $values->jabatan; ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
    <br><br><br>
    <table style="width: 100%;">
      <tr>
        <td style="width: 70%;"></td>
        <td style="width: 30%;">
          <table>
            <tr>
              <td>Kepala,</td>
            </tr>
            <tr>
              <td><br><br><br><br><br></td>
            </tr>
            <tr>
              <td><b>Slamet Mulsiswanto</b></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </div>
  <div class="page_break"></div>
  <div style="padding: 20px;">
    <p style="text-align: center; font-weight: bold;">DAFTAR HADIR</p>
    <p style="text-align: center; font-weight: bold;">PETUGAS PELAKSANAAN KEKARANTINAAN KESEHATAN</p>
    <p style="text-align: center; font-weight: bold;">DI BANDARA INTERNASIONAL JUANDA</p>
    <p style="text-align: center; font-weight: bold;">TANGGAL : <?= $hari ?> sd <?= tgl_indo($last_period)  ?></p>
    <br>
    <table style="width: 100%; border-collapse: collapse;" border="1">
      <tr>
        <th style="text-align: center; width: 5%; padding: 5px;">NO</th>
        <th style="text-align: center; width: 25%; padding: 5px;">Nama</th>
        <th style="text-align: center; width: 20%; padding: 5px;">Instansi</th>
        <th style="text-align: center; width: 20%; padding: 5px;">Tanggal Kegiatan</th>
      </tr>
      <?php foreach ($petugas as $key => $values) : ?>
        <tr>
          <td style="text-align: center; padding: 0 5px;"><?= $key + 1; ?></td>
          <td style="text-align: left; padding: 0 5px;"><?= $values->nama; ?></td>
          <td style="text-align: left; padding: 0 5px;">Kantor Kesehatan Pelabuhan Kelas I Surabaya</td>
          <td style="text-align: center; padding: 0 5px;"><?= $values->tgl_lembur ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
    <br><br>
    <table style="width: 100%;">
      <tr>
        <td style="width: 55%;"></td>
        <td style="width: 45%;">
          <table>
            <tr>
              <td>Sidoarjo, <?= tgl_indo($last_period); ?></td>
            </tr>
            <tr>
              <td>Koordinator Pengendalian Karantina dan SE</td>
            </tr>
            <tr>
              <td><br><br><br><br><br></td>
            </tr>
            <tr>
              <td><b>dr. Rofiud Darojat</b></td>
            </tr>
            <tr>
              <td>NIP. 197205212001121001</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </div>
  <div class="page_break"></div>
  <div style="padding: 20px;">
    <div style="padding: 10px; border: 1px solid #000;">
      <p style="text-align: center; font-weight: bold; font-size: 12px;">KUITANSI PEMBAYARAN LS</p>
      <table style="width: 100%;">
        <tr>
          <td style="width: 65%;"></td>
          <td style="width: 35%;">
            <table>
              <tr>
                <td style="font-size: 12px;">T.A</td>
                <td style="font-size: 12px;">:</td>
                <td style="font-size: 12px;">2023</td>
              </tr>
              <tr>
                <td style="font-size: 12px;">Nomor Bukti</td>
                <td style="font-size: 12px;">:</td>
                <td style="font-size: 12px;"></td>
              </tr>
              <tr>
                <td style="font-size: 12px;">MAK</td>
                <td style="font-size: 12px;">:</td>
                <td style="font-size: 12px;">4249.QAH.U02.051.A.524113</td>
              </tr>
              <tr>
                <td style="font-size: 12px;">Sumber Dana</td>
                <td style="font-size: 12px;">:</td>
                <td style="font-size: 12px;">RM</td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <p style="text-align: center; font-weight: bold; font-size: 12px;">KUITANSI / BUKTI PEMBAYARAN</p>
      <br>
      <table style="width: 100%;">
        <tr>
          <td style="font-size: 12px;">Sudah terima dari</td>
          <td style="font-size: 12px;">:</td>
          <td style="font-size: 12px;">Pejabat Pembuat Komitmen Kantor Kesehatan Pelabuhan Kelas I Surabaya</td>
        </tr>
        <tr>
          <td style="font-size: 12px;">Jumlah Uang</td>
          <td style="font-size: 12px;">:</td>
          <td style="font-size: 12px;">Rp <?= number_format((150000 * $harga), 0, ',', '.') ?></td>
        </tr>
        <tr>
          <td style="font-size: 12px;">Terbilang</td>
          <td style="font-size: 12px;">:</td>
          <td style="font-size: 12px;"><?= ucwords(terbilang(150000 * $harga)) . ' Rupiah'; ?></td>
        </tr>
        <tr>
          <td style="font-size: 12px;">Untuk Pembayaran</td>
          <td style="font-size: 12px;">:</td>
          <td style="font-size: 12px;">Uang transport petugas pelaksanaan kekarantinaan kesehatan di bandara internasional juanda, tanggal <?= $hari ?> sd <?= tgl_indo($last_period)  ?></td>
        </tr>
      </table>
      <table style="width: 100%; border-collapse: collapse;" border="1">
        <tr>
          <th style="text-align: center; width: 5%; font-size: 12px; padding: 1px;">NO</th>
          <th style="text-align: center; width: 20%; font-size: 12px; padding: 1px;">NAMA/NIP PENERIMA</th>
          <th style="text-align: center; width: 5%; font-size: 12px; padding: 1px;">GOL</th>
          <th style="text-align: center; width: 10%; font-size: 12px; padding: 1px;">TANGGAL KEGIATAN</th>
          <th style="text-align: center; width: 20%; font-size: 12px; padding: 1px;">URAIAN KEGIATAN</th>
          <th style="text-align: center; width: 10%; font-size: 12px; padding: 1px;">JUMLAH HARI</th>
          <th style="text-align: center; width: 10%; font-size: 12px; padding: 1px;">ASAL - TUJUAN</th>
          <th style="text-align: center; width: 10%; font-size: 12px; padding: 1px;">JUMLAH YANG DIBAYARKAN</th>
          <th style="text-align: center; width: 10%; font-size: 12px; padding: 1px;">TANDA TANGAN</th>
        </tr>
        <tr>
          <td style="text-align: center; font-size: 12px;">1</td>
          <td style="text-align: center; font-size: 12px;">2</td>
          <td style="text-align: center; font-size: 12px;">3</td>
          <td style="text-align: center; font-size: 12px;">4</td>
          <td style="text-align: center; font-size: 12px;">5</td>
          <td style="text-align: center; font-size: 12px;">6</td>
          <td style="text-align: center; font-size: 12px;">7</td>
          <td style="text-align: center; font-size: 12px;">8</td>
          <td style="text-align: center; font-size: 12px;">9</td>
        </tr>
        <?php foreach ($petugas as $key => $values) : ?>
          <tr>
            <td style="text-align: center; font-size: 12px; padding: 0 5px;"><?= $key + 1; ?></td>
            <td style="text-align: left; font-size: 12px; padding: 0 5px;"><?= $values->nama; ?> <br><?= $values->nip; ?></td>
            <td style="text-align: center; font-size: 12px; padding: 0 5px;"><?= $values->gol; ?></td>
            <td style="text-align: left; font-size: 12px; padding: 0 5px;"><?= $values->tgl_lembur ?></td>
            <td style="text-align: left; font-size: 12px; padding: 0 5px;">Pelaksanaan Kekarantinaan Kesehatan di Bandara Internasional Juanda</td>
            <td style="text-align: center; font-size: 12px; padding: 0 5px;"><?= $values->hehe;?></td>
            <td style="text-align: left; font-size: 12px; padding: 0 5px;">Kantor - Bandara</td>
            <td style="text-align: right; font-size: 12px; padding: 0 5px;"><?= rupiah($values->salary); ?></td>
            <td style="text-align: center; font-size: 12px; padding: 0 5px;"><br><br></td>
          </tr>
        <?php endforeach; ?>
        <tr>
          <th colspan="7" style="text-align: center; font-size: 12px; padding: 0 5px;">Jumlah</th>
          <th style="text-align: right; font-size: 12px; padding: 0 5px;">Rp <?= number_format((150000 * $harga), 0, ',', '.') ?></th>
          <th></th>
        </tr>
      </table>
    </div>
    <div style="padding: 10px; border: 1px solid #000;">
      <table style="width: 100%;">
        <tr>
          <td style="width: 40%;">
            <table>
              <tr>
                <td style="font-size: 12px;">Setuju dibebankan pada mata anggaran berkenan,</td>
              </tr>
              <tr>
                <td style="font-size: 12px;">An. Kuasa Pengguna Anggaran</td>
              </tr>
              <tr>
                <td style="font-size: 12px;">Pejabat Pembuat Komitmen</td>
              </tr>
              <tr>
                <td><br><br></td>
              </tr>
              <tr>
                <td><b style="font-size: 12px;">Yanita Setyaningrum, SKM, M.Kes</b></td>
              </tr>
              <tr>
                <td style="font-size: 12px;">NIP. 198502202008122003</td>
              </tr>
            </table>
          </td>
          <td style="width: 20%;"></td>
          <td style="width: 40%;">
            <table>
              <tr>
                <td style="font-size: 12px;">Lunas dibayar tanggal</td>
              </tr>
              <tr>
                <td style="font-size: 12px;">Bendahara Pengeluaran</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><br><br></td>
              </tr>
              <tr>
                <td><b style="font-size: 12px;">RR. Ayuningtyas Dian Paramita, SE</b></td>
              </tr>
              <tr>
                <td style="font-size: 12px;">NIP. 198801282010122001</td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </div>
    <div style="padding: 10px; border: 1px solid #000;">
      <table style="width: 100%;">
        <tr>
          <td style="font-size: 12px;">Barang/ pekerjaan tersebut telah diterima/ diselesaikan dengan lengkap dan baik</td>
        </tr>
        <tr>
          <td style="font-size: 12px;">Pejabat Yang Bertanggung Jawab</td>
        </tr>
        <tr>
          <td style="font-size: 12px;">Koordinator Pengendalian Karantina dan Surveilans Epidemiologi</td>
        </tr>
        <tr>
          <td><br><br></td>
        </tr>
        <tr>
          <td><b style="font-size: 12px;">dr. Rofiud Darojat</b></td>
        </tr>
        <tr>
          <td style="font-size: 12px;">NIP. 197205212001121001</td>
        </tr>
      </table>
    </div>
  </div>
  <?php foreach ($petugas as $key => $values) : ?>
    <div class="page_break"></div>
    <div style="padding: 20px;">
      <?php $this->load->view("surat/kop_surat.php") ?>
      <div style="padding: 10px;">
        <table style="width: 100%;">
          <tr>
            <td style="width: 55%;"></td>
            <td style="width: 45%;">
              <table>
                <tr>
                  <td style="font-size: 12px;">Peraturan Menteri Keuangan Tentang</td>
                </tr>
                <tr>
                  <td style="font-size: 12px;">Perjalanan Dinas Jabatan Dalam Negeri Bagi Pejabat Negara,</td>
                </tr>
                <tr>
                  <td style="font-size: 12px;">Pegawai Negeri dan Pegawai Tidak Tetap</td>
                </tr>
                <tr>
                  <td style="font-size: 12px;">Nomor : 113/PMK.05/2012</td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <br>
        <p style="text-align: center; font-weight: bold; font-size: 18px;">RINCIAN BIAYA PERJALANAN DINAS</p>
        <br>
        <table style="width: 100%;">
          <tr>
            <td style="width: 20%;">No</td>
            <td style="width: 5%;"></td>
            <td><?= $key + 1; ?></td>
          </tr>
          <tr>
            <td>Lampiran SPD No</td>
            <td>:</td>
            <td><?= $no_st; ?></td>
          </tr>
          <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td><?= tgl_indo($tgl_sbk); ?></td>
          </tr>
        </table>
        <table style="width: 100%; border-collapse: collapse;" border="1">
          <tr>
            <th style="text-align: center; width: 5%; padding: 5px;">NO</th>
            <th style="text-align: center; width: 30%; padding: 5px;">PERINCIAN BIAYA</th>
            <th style="text-align: center; width: 15%; padding: 5px;">JUMLAH</th>
            <th style="text-align: center; width: 10%; padding: 5px;">PPH 21</th>
            <th style="text-align: center; width: 15%; padding: 5px;">PENERIMAAN</th>
            <th style="text-align: center; width: 25%; padding: 5px;">KETERANGAN</th>
          </tr>
          <tr>
            <td style="text-align: center; padding: 5px; vertical-align: top;">
              <p>1</p>
              <br>
              <p>&nbsp;</p>
              <br>
              <p>&nbsp;</p>
            </td>
            <td style="text-align: left; padding: 5px; vertical-align: top;">
              <p>Uang Transport</p>
              <p style="text-indent: 20px;"><?= $values->hehe;?> X Rp 150.000</p>
              <br>
              <p>- Transport darat dari tempat kedudukan ke Bandara Juanda (PP)</p>
              <br>
              <p>Tanggal : <?= $values->tgl_lembur ?></p>
            </td>
            <td style="text-align: right; padding: 5px; vertical-align: top;">
              <p>&nbsp;</p>
              <p><?= rupiah($values->salary); ?></p>
              <br>
              <p>&nbsp;</p>
              <br>
              <p>&nbsp;</p>
            </td>
            <td>
            <td style="text-align: right; padding: 5px; vertical-align: top;">
              <p>&nbsp;</p>
              <p><?= rupiah($values->salary); ?></p>
              <br>
              <p>&nbsp;</p>
              <br>
              <p>&nbsp;</p>
            </td>
            <td style="text-align: left; padding: 5px; vertical-align: top;">
              <p>Belanja perjalanan dinas petugas pelaksanaan kekarantinaan kesehatan di Bandara Internasional Juanda</p>
              <br>
              <p>&nbsp;</p>
              <br>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
            </td>
          </tr>
          <tr>
            <td colspan="2" style="text-align: center; font-weight: bold; padding: 5px;">TOTAL</td>
            <td style="text-align: right; font-weight: bold; padding: 5px;"><?= rupiah($values->salary); ?></td>
            <td style="text-align: right; font-weight: bold; padding: 5px;"></td>
            <td style="text-align: right; font-weight: bold; padding: 5px;"><?= rupiah($values->salary); ?></td>
            <td style="text-align: center; font-weight: bold; padding: 5px;"></td>
          </tr>
          <tr>
            <td colspan="6" style="text-align: left; font-weight: bold; padding: 10px;">
              Terbilang : <?= ucwords(terbilang($values->salary)) . ' Rupiah'; ?>
            </td>
          </tr>
        </table>
        <table style="width: 100%;">
          <tr>
            <td style="width: 45%;">
              <table>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>Telah dibayar sejumlah</td>
                </tr>
                <tr>
                  <td><?= rupiah($values->salary); ?></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>Bendahara Pengeluaran,</td>
                </tr>
                <tr>
                  <td><br><br><br></td>
                </tr>
                <tr>
                  <td><b>RR. Ayuningtyas Dian Paramita, SE</b></td>
                </tr>
                <tr>
                  <td>NIP. 198801282010122001</td>
                </tr>
              </table>
            </td>
            <td style="width: 10%;"></td>
            <td style="width: 45%;">
              <table>
                <tr>
                  <td>Sidoarjo, <?= tgl_indo($last_period); ?></td>
                </tr>
                <tr>
                  <td>Telah menerima jumlah uang sebesar</td>
                </tr>
                <tr>
                  <td><?= rupiah($values->salary); ?></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>Yang Menerima</td>
                </tr>
                <tr>
                  <td><br><br><br></td>
                </tr>
                <tr>
                  <td><b><?= $values->nama; ?></b></td>
                </tr>
                <tr>
                  <td>NIP. <?= $values->nip; ?></td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <hr>
        <p style="text-align: center; font-weight: bold; font-size: 16px;">PERHITUNGAN SPD RAMPUNG</p>
        <br>
        <table style="width: 100%;">
          <tr>
            <td style="width: 50%;">
              <table>
                <tr>
                  <td>Ditetapkan sejumlah</td>
                  <td>:</td>
                  <td><?= rupiah($values->salary); ?></td>
                </tr>
                <tr>
                  <td>Yang telah dibayar semula</td>
                  <td>:</td>
                  <td><?= rupiah($values->salary); ?></td>
                </tr>
                <tr>
                  <td>Sisa kurang/lebih</td>
                  <td>:</td>
                  <td>Rp -</td>
                </tr>
              </table>
            </td>
            <td style="width: 50%;"></td>
          </tr>
        </table>
        <table style="width: 100%;">
          <tr>
            <td style="width: 45%;"></td>
            <td style="width: 10%;"></td>
            <td style="width: 45%;">
              <table>
                <tr>
                  <td>Mengetahui dan Setuju dibayar : </td>
                </tr>
                <tr>
                  <td>Pejabat Pembuat Komitmen</td>
                </tr>
                <tr>
                  <td><br><br><br></td>
                </tr>
                <tr>
                  <td><b>Yanita Setyaningrum, SKM, M.Kes</b></td>
                </tr>
                <tr>
                  <td>NIP. 198502202008122003</td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </div>
    </div>
    <div class="page_break"></div>
    <div style="padding: 20px;">
      <?php $this->load->view("surat/kop_surat.php") ?>
      <div style="padding: 10px;">
        <table style="width: 100%;">
          <tr>
            <td style="width: 55%;"></td>
            <td style="width: 45%;">
              <table>
                <tr>
                  <td style="font-size: 12px;">Peraturan Menteri Keuangan Tentang</td>
                </tr>
                <tr>
                  <td style="font-size: 12px;">Perjalanan Dinas Jabatan Dalam Negeri Bagi Pejabat Negara,</td>
                </tr>
                <tr>
                  <td style="font-size: 12px;">Pegawai Negeri dan Pegawai Tidak Tetap</td>
                </tr>
                <tr>
                  <td style="font-size: 12px;">Nomor : 113/PMK.05/2012</td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <br>
        <p style="text-align: center; font-weight: bold; font-size: 18px;">DAFTAR PENGELUARAN RIIL</p>
        <br>
        <table style="width: 100%;">
          <tr>
            <td style="width: 20%;">No</td>
            <td style="width: 5%;"></td>
            <td><?= $key + 1; ?></td>
          </tr>
          <tr>
            <td colspan="3">Yang bertanda tangan di bawah ini :</td>
          </tr>
          <tr>
            <td>Nama</td>
            <td>:</td>
            <td><?= $values->nama; ?></td>
          </tr>
          <tr>
            <td>NIP</td>
            <td>:</td>
            <td><?= $values->nip; ?></td>
          </tr>
          <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td><?= $values->jabatan; ?></td>
          </tr>
        </table>
        <br>
        <p>Berdasarkan Surat Perjalanan Dinas (SPD) Nomor <?= $no_st; ?>, tanggal <?= tgl_indo($tgl_sbk); ?> dengan ini kami menyatakan dengan sesungguhnya bahwa :</p>
        <br>
        <table style="width: 100%;">
          <tr>
            <td style="width: 2%; vertical-align: top;">1.</td>
            <td style="width: 98%;">Biaya transport pegawai dan/atau biaya penginapan di bawah ini yang tidak dapat diperoleh bukti-bukti pengeluarannya, meliputi :</td>
          </tr>
        </table>
        <br>
        <table style="width: 100%; border-collapse: collapse;" border="1">
          <tr>
            <th style="text-align: center; width: 5%; padding: 5px;">NO</th>
            <th style="text-align: center; width: 70%; padding: 5px;">URAIAN</th>
            <th style="text-align: center; width: 25%; padding: 5px;">JUMLAH</th>
          </tr>
          <tr>
            <td style="text-align: center; padding: 5px; vertical-align: top;">
              <p>1</p>
              <p>&nbsp;</p>
              <br>
              <p>&nbsp;</p>
              <br>
              <p>&nbsp;</p>
            </td>
            <td style="text-align: left; padding: 5px; vertical-align: top;">
              <p>- Transport darat dari tempat kedudukan ke Bandara Juanda (PP)</p>
              <p>Tanggal : <?= $values->tgl_lembur ?></p>
              <br>
              <p>Belanja perjalanan dinas petugas pelaksanaan kekarantinaan kesehatan di Bandara Internasional Juanda</p>
              <br>
              <p><?= $values->hehe ?> x Rp 150.000</p>
            </td>
            <td style="text-align: right; padding: 5px; vertical-align: top;">
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <br>
              <p>&nbsp;</p>
              <br><br>
              <p><?= rupiah($values->salary); ?></p>
            </td>
          </tr>
          <tr>
            <td colspan="2" style="text-align: left; font-weight: bold; padding: 5px;">Jumlah</td>
            <td style="text-align: right; font-weight: bold; padding: 5px;"><?= rupiah($values->salary); ?></td>
          </tr>
          <tr>
            <td colspan="2" style="text-align: left; font-weight: bold; padding: 5px;">
              Terbilang : <?= ucwords(terbilang($values->salary)) . ' Rupiah'; ?>
            </td>
            <td style="text-align: right; font-weight: bold; padding: 5px;"><?= rupiah($values->salary); ?></td>
          </tr>
        </table>
        <br>
        <table style="width: 100%;">
          <tr>
            <td style="width: 2%; vertical-align: top;"><b>2.</b></td>
            <td style="width: 98%;"><b>Jumlah uang tersebut pada angka 1 di atas benar-benar dikeluarkan untuk pelaksanaan perjalanan dinas dimaksud dan apabila di kemudian hari terdapat kelebihan atas pembayaran, kami bersedia untuk menyetorkan kelebihan tersebut ke Kas Negara.</b></td>
          </tr>
        </table>
        <br>
        <p>Demikian pernyataan ini kami buat dengan sebenarnya, untuk dipergunakan sebagaimana mestinya.</p>
        <br>
        <table style=" width: 100%;">
          <tr>
            <td style="width: 45%;">
              <table>
                <tr>
                  <td>Mengetahui / Menyetujui</td>
                </tr>
                <tr>
                  <td>Pejabat Pembuat Komitmen,</td>
                </tr>
                <tr>
                  <td><br><br><br><br></td>
                </tr>
                <tr>
                  <td><b>Yanita Setyaningrum, SKM, M.Kes</b></td>
                </tr>
                <tr>
                  <td>NIP. 198502202008122003</td>
                </tr>
              </table>
            </td>
            <td style="width: 10%;"></td>
            <td style="width: 45%;">
              <table>
                <tr>
                  <td>Sidoarjo, <?= tgl_indo($last_period); ?></td>
                </tr>
                <tr>
                  <td>Pelaksana SPD,</td>
                </tr>
                <tr>
                  <td><br><br><br><br></td>
                </tr>
                <tr>
                  <td><b><?= $values->nama; ?></b></td>
                </tr>
                <tr>
                  <td>NIP. <?= $values->nip; ?></td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </div>
    </div>
  <?php endforeach; ?>
</body>

</html>