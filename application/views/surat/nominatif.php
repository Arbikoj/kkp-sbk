<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nominatif</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    table.main th,
    td {
      padding: 5px;
      font-size: 14px;
    }

    table.sign td {
      padding: 1px;
      font-size: 14px;
    }
  </style>
</head>

<body style="font-family: Arial;">
  <div style="padding: 50px;">
    <h5 style="text-align: center;">DAFTAR NOMINATIF PEGAWAI</h5>
    <h5 style="text-align: center;">YANG MENERIMA UANG TRANSPORT</h5>
    <h5 style="text-align: center;">PETUGAS PELAKSANAAN KEKARANTINAAN KESEHATAN DI BANDARA INTERNASIONAL JUANDA</h5>
    <h5 style="text-align: center;">KANTOR KESEHATAN PELABUHAN KELAS I SURABAYA</h5>
    <h5 style="text-align: center;">TANGGAL <?= $tgl_sbk; ?></h5>
    <h5 style="text-align: center;">MAK. 4249.QAH.U02.051.A.524113.RM</h5>
    <br>
    <table class="main" style="width: 100%; border-collapse: collapse;" border="1">
      <tr>
        <th style="text-align: center; width: 40px;">NO</th>
        <th style="text-align: center; width: 250px;">NAMA/NIP <br> PENERIMA</th>
        <th style="text-align: center; width: 40px;">GOL</th>
        <th style="text-align: center; width: 140px;">TANGGAL <br> KEGIATAN</th>
        <th style="text-align: center; width: 400px;">KEGIATAN</th>
        <th style="text-align: center; width: 100px;">LAMANYA <br> PERJALANAN</th>
        <th style="text-align: center; width: 60px;">ASAL -<br>TUJUAN</th>
        <th style="text-align: center; width: 100px;">JUMLAH YANG <br> DIBAYARKAN</th>
      </tr>
      <tr>
        <td style="text-align: center;">1</td>
        <td style="text-align: center;">2</td>
        <td style="text-align: center;">3</td>
        <td style="text-align: center;">4</td>
        <td style="text-align: center;">5</td>
        <td style="text-align: center;">6</td>
        <td style="text-align: center;">7</td>
        <td style="text-align: center;">8</td>
      </tr>
      <?php foreach ($petugas as $key => $values) : ?>
        <tr>
          <td style="text-align: center;"><?= $key + 1; ?></td>
          <td style="text-align: left;"><?= $values->nama; ?> <br><?= $values->nip; ?></td>
          <td style="text-align: center;"><?= $values->gol; ?></td>
          <td style="text-align: left;"><?= $tgl_sbk; ?></td>
          <td style="text-align: left;">Pelaksanaan Kekarantinaan Kesehatan di Bandara Internasional Juanda</td>
          <td style="text-align: center;">2 hari</td>
          <td style="text-align: left;">Kantor - Bandara</td>
          <td style="text-align: right;">Rp &nbsp; 150.000</td>
        </tr>
      <?php endforeach; ?>
      <tr>
        <th colspan="7">Jumlah</th>
        <th style="text-align: right;">Rp &nbsp; <?= number_format((150000 * count($petugas)), 0, ',', '.') ?></th>
      </tr>
    </table>
    <br>
    <table style="width: 100%;">
      <tr>
        <td style="width: 65%;"></td>
        <td style="width: 35%;">
          <table class="sign">
            <tr>
              <td>Sidoarjo, <?= $tgl_sbk; ?></td>
            </tr>
            <tr>
              <td>Pejabat Pembuat Komitmen</td>
            </tr>
            <tr>
              <td>Kantor Kesehatan Pelabuhan Kelas I Surabaya</td>
            </tr>
            <tr>
              <td><br><br><br><br><br></td>
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
    <br>
    <table style="width: 100%;">
      <tr>
        <td>
          <table class="sign">
            <tr>
              <td>Catatan:</td>
            </tr>
            <tr>
              <td>1. Dibayarkan Berdasarkan Surat Tugas Kepala Kantor</td>
              <td style="padding-left: 50px;">Nomor : &nbsp; <?= $no_st; ?></td>
            </tr>
            <tr>
              <td></td>
              <td style="padding-left: 50px;">Tanggal : &nbsp; <?= $tgl_sbk; ?></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </div>
</body>

</html>